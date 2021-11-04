<?php

define('SPARQL_ENDPOINT', 'https://triplestore.netwerkdigitaalerfgoed.nl/repositories/registry');
define('SPARQL_CACHE_DURATION_HOURS',1);
define('CACHE_DIRECTORY','/tmp/');

function getFormats() {
	$sparqlGetPublishers='PREFIX dct: <http://purl.org/dc/terms/>
		SELECT DISTINCT ?format WHERE {
		  ?distribution dct:format ?format
		} GROUP BY ?format ORDER BY ?format';

	$sparqlResults=getSPARQLresults($sparqlGetPublishers);

	$formats=array();
	foreach ($sparqlResults["results"]["bindings"] as $item) {
		array_push($formats,$item["format"]["value"]);
	}
	return $formats;
}


function getCreators() {
	$sparqlGetPublishers='PREFIX foaf: <http://xmlns.com/foaf/0.1/>
		PREFIX dcat: <http://www.w3.org/ns/dcat#>
		PREFIX dct: <http://purl.org/dc/terms/>
		SELECT DISTINCT ?creator ?creator_name WHERE {
		  ?dataset a dcat:Dataset .
		  ?dataset dct:creator ?creator .
		  ?creator foaf:name ?creator_name
		  FILTER isIRI(?creator) 
		} ORDER BY ?publisher_name';

	$sparqlResults=getSPARQLresults($sparqlGetPublishers);

	$creators=array();
	foreach ($sparqlResults["results"]["bindings"] as $item) {
		$creators[$item["creator"]["value"]]=$item["creator_name"]["value"];
	}
	return $creators;
}

function getPublishers() {
	$sparqlGetPublishers='PREFIX foaf: <http://xmlns.com/foaf/0.1/>
		PREFIX dcat: <http://www.w3.org/ns/dcat#>
		PREFIX dct: <http://purl.org/dc/terms/>
		SELECT DISTINCT ?publisher ?publisher_name WHERE {
		  ?dataset a dcat:Dataset .
		  ?dataset dct:publisher ?publisher .
		  ?publisher foaf:name ?publisher_name
		  FILTER isIRI(?publisher) 
		} ORDER BY ?publisher_name';

	$sparqlResults=getSPARQLresults($sparqlGetPublishers);

	$publishers=array();
	foreach ($sparqlResults["results"]["bindings"] as $item) {
		$publishers[$item["publisher"]["value"]]=$item["publisher_name"]["value"];
	}
	return $publishers;
}

function getSPARQLresults($sparqlQueryString) {
	$cacheFile=CACHE_DIRECTORY.md5($sparqlQueryString).".json";
	if (file_exists($cacheFile) && (time() - filectime($cacheFile))/3600<SPARQL_CACHE_DURATION_HOURS && !isset($_GET["nocache"])) {
		$contents=file_get_contents($cacheFile);
	} else {
		$contents=doSPARQLcall($sparqlQueryString);
		file_put_contents($cacheFile,$contents);
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