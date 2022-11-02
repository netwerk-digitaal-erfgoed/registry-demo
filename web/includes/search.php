<?php

define('SPARQL_ENDPOINT', 'https://triplestore.netwerkdigitaalerfgoed.nl/repositories/registry');
define('SPARQL_CACHE_DURATION_HOURS',1);
define('CACHE_DIRECTORY','/tmp/');

function getFormats() {
	$sparqlGetPublishers='PREFIX dct: <http://purl.org/dc/terms/>
		SELECT DISTINCT ?format WHERE {
		  ?distribution dct:format ?format
		} GROUP BY ?format ORDER BY ?format';

	$sparqlResults=getSPARQLresults($sparqlGetPublishers,'nn');

	$formats=array();
	if (isset($sparqlResults)) {
		foreach ($sparqlResults["results"]["bindings"] as $item) {
			array_push($formats,$item["format"]["value"]);
		}
	}
	return $formats;
}

function getCreators() {

	if(isset($_GET["lang"]) && $_GET["lang"]=="en") { $lang="en"; } else { $lang="nl"; }

	$sparqlGetPublishers='PREFIX foaf: <http://xmlns.com/foaf/0.1/>
	PREFIX dcat: <http://www.w3.org/ns/dcat#>
	PREFIX dct: <http://purl.org/dc/terms/>
	PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
	SELECT DISTINCT ?creator ?creator_name WHERE {
		?dataset a dcat:Dataset .
		?dataset dct:creator ?creator .
		?creator foaf:name ?creator_name
		FILTER isIRI(?creator) 
		FILTER(LANG(?creator_name) = "" || LANGMATCHES(LANG(?creator_name), "'.$lang.'")) 
		BIND(LCASE(STRDT(STR(?creator_name), xsd:string)) AS ?creator_name2)
	} ORDER BY ?creator_name2';

	$sparqlResults=getSPARQLresults($sparqlGetPublishers,$lang);

	$creators=array();
	if (isset($sparqlResults)) {
		foreach ($sparqlResults["results"]["bindings"] as $item) {
			$creators[$item["creator"]["value"]]=$item["creator_name"]["value"];
		}
	}
	return $creators;
}

function getPublishers() {

	if(isset($_GET["lang"]) && $_GET["lang"]=="en") { $lang="en"; } else { $lang="nl"; }

	$sparqlGetPublishers='PREFIX foaf: <http://xmlns.com/foaf/0.1/>
	PREFIX dcat: <http://www.w3.org/ns/dcat#>
	PREFIX dct: <http://purl.org/dc/terms/>
	PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
	SELECT DISTINCT ?publisher ?publisher_name WHERE {
		?dataset a dcat:Dataset .
		?dataset dct:publisher ?publisher .
		?publisher foaf:name ?publisher_name
		FILTER isIRI(?publisher) 
		FILTER(LANG(?publisher_name) = "" || LANGMATCHES(LANG(?publisher_name), "'.$lang.'")) 
		BIND(LCASE(STRDT(STR(?publisher_name), xsd:string)) AS ?publisher_name2)
	} ORDER BY ?publisher_name2';

	$sparqlResults=getSPARQLresults($sparqlGetPublishers,$lang);

	$publishers=array();
	if (isset($sparqlResults)) {
		foreach ($sparqlResults["results"]["bindings"] as $item) {
			$publishers[$item["publisher"]["value"]]=$item["publisher_name"]["value"];
		}
	}
	return $publishers;
}

function getSPARQLresults($sparqlQueryString,$lang) {
	$cacheFile=CACHE_DIRECTORY.md5($sparqlQueryString).".".$lang.".json";
	if (file_exists($cacheFile) && filesize($cacheFile)>0 && (time() - filectime($cacheFile))/3600<SPARQL_CACHE_DURATION_HOURS && !isset($_GET["nocache"])) {
		$contents=file_get_contents($cacheFile);
	} else {
		$contents=doSPARQLcall($sparqlQueryString);
		if (!empty($contents)) {
			file_put_contents($cacheFile,$contents);
		}
	}
	return json_decode($contents, true);	
}

function doSPARQLcall($sparqlQueryString) {
	$url = SPARQL_ENDPOINT . '?query=' . urlencode($sparqlQueryString);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch,CURLOPT_USERAGENT,'DatasetregisterDemonstrator');
	$headers = [
		'Accept: application/sparql-results+json'
	];

	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$response = curl_exec ($ch);
	curl_close ($ch);

	return $response;
}