<?php

define('SPARQL_ENDPOINT', 'https://datasetregister.netwerkdigitaalerfgoed.nl/sparql');
define('SPARQL_CACHE_DURATION_HOURS',1);
define('CACHE_DIRECTORY','/tmp/');
define('SHOW_NEWEST',25);

function getMediaTypes() {
	$sparqlGetPublishers='PREFIX dct: <http://purl.org/dc/terms/>
PREFIX dcat: <http://www.w3.org/ns/dcat#>
PREFIX schema: <http://schema.org/>
SELECT DISTINCT ?format WHERE {
    ?dataset a dcat:Dataset .
	?dataset schema:subjectOf ?registrationUrl .
    FILTER (NOT EXISTS { ?registrationUrl schema:validUntil ?validUntil })
    ?dataset dcat:distribution ?distribution .
    ?distribution dct:format|dcat:mediaType ?format
    FILTER(isLITERAL(?format))
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
	PREFIX schema: <http://schema.org/>
	SELECT DISTINCT ?creator ?creator_name WHERE {
		?dataset a dcat:Dataset .
		?dataset schema:subjectOf ?registrationUrl .
        FILTER (NOT EXISTS { ?registrationUrl schema:validUntil ?validUntil })
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
			# not-so-nice work-around to deduplicate organisation names
			$index=trim($item["creator_name"]["value"]);
			if ($index=="Rijksdienst voor Cultureel Erfgoed") {  $index="Rijksdienst voor het Cultureel Erfgoed";}
			if ($index=="Rijksdienst voor Cultureel Erfgoed - Kunstcollectie") {  $index="Rijksdienst voor het Cultureel Erfgoed";}
			if ($index=="Rijksdienst voor het Cultureel Erfgoed (RCE)") {  $index="Rijksdienst voor het Cultureel Erfgoed";}
			if (!isset($creators[$index])) {
				$creators[$index]=$item["creator"]["value"];
			} else {
				$creators[$index].="|".$item["creator"]["value"];
			} 
		}
	}

	return array_flip($creators);
}


function getPublishers() {

	if(isset($_GET["lang"]) && $_GET["lang"]=="en") { $lang="en"; } else { $lang="nl"; }

	$sparqlGetPublishers='PREFIX foaf: <http://xmlns.com/foaf/0.1/>
	PREFIX dcat: <http://www.w3.org/ns/dcat#>
	PREFIX dct: <http://purl.org/dc/terms/>
	PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
	PREFIX schema: <http://schema.org/>
	SELECT DISTINCT ?publisher ?publisher_name WHERE {
		?dataset a dcat:Dataset .
		?dataset schema:subjectOf ?registrationUrl .
        FILTER (NOT EXISTS { ?registrationUrl schema:validUntil ?validUntil })
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
			# not-so-nice work-around to deduplicate organisation names
			$index=trim($item["publisher_name"]["value"]);
			if ($index=="Rijksdienst voor Cultureel Erfgoed") {  $index="Rijksdienst voor het Cultureel Erfgoed";}
			if ($index=="Rijksdienst voor Cultureel Erfgoed - Kunstcollectie") {  $index="Rijksdienst voor het Cultureel Erfgoed";}
			if ($index=="Rijksdienst voor het Cultureel Erfgoed (RCE)") {  $index="Rijksdienst voor het Cultureel Erfgoed";}
			if (!isset($publishers[$index])) {
				$publishers[$index]=$item["publisher"]["value"];
			} else {
				$publishers[$index].="|".$item["publisher"]["value"];
			} 
		}
	}
	return array_flip($publishers);
}

function getNewest() {

	if(isset($_GET["lang"]) && $_GET["lang"]=="en") { 
		$lang="en"; $bilang="nl";
	} else { 
		$lang="nl"; $bilang="en"; 
	}

	$sparqlGetPublishers='PREFIX dcat: <http://www.w3.org/ns/dcat#>
	PREFIX dct:  <http://purl.org/dc/terms/>
	PREFIX foaf: <http://xmlns.com/foaf/0.1/>
	SELECT DISTINCT ?dataset ?title ?publisherName ?postedDate WHERE {
	  ?postedURL <http://schema.org/about> ?dataset ;
	  <http://schema.org/datePosted> ?postedDate .
	  ?dataset dct:publisher ?publisher .
	  OPTIONAL { ?dataset dct:title ?title FILTER(langMatches(lang(?title), "'.$lang.'")) }
	  OPTIONAL { ?dataset dct:title ?title FILTER(langMatches(lang(?title), "'.$bilang.'")) }
	  OPTIONAL { ?dataset dct:title ?title }    
	  OPTIONAL { ?publisher foaf:name ?publisherName FILTER(langMatches(lang(?publisherName), "'.$lang.'")) }
	  OPTIONAL { ?publisher foaf:name ?publisherName FILTER(langMatches(lang(?publisherName), "'.$bilang.'")) }
	  OPTIONAL { ?publisher foaf:name ?publisherName }
	} ORDER BY DESC(?postedDate) LIMIT '.SHOW_NEWEST;

	$sparqlResults=getSPARQLresults($sparqlGetPublishers,$lang);

	$newest=array();
	if (isset($sparqlResults)) {
		foreach ($sparqlResults["results"]["bindings"] as $item) {
			$newest[]=array("dataset"=>$item["dataset"]["value"],
							"title"=>$item["title"]["value"],
							"publisherName"=>$item["publisherName"]["value"],
							"postedDate"=>$item["postedDate"]["value"]);
		}
	}
	return $newest;	
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



function getOrganisationLocations($listtype) {

	if(isset($_GET["lang"]) && $_GET["lang"]=="en") { 
		$lang="en"; $bilang="nl";
	} else { 
		$lang="nl"; $bilang="en"; 
	}

	$dct_type="dct:publisher";
	switch ($listtype) {	
		case 2: $dct_type="dct:creator"; break;
		case 3: $dct_type="dct:creator|dct:publisher"; break;
	}
	
	$sparql='PREFIX foaf: <http://xmlns.com/foaf/0.1/>
PREFIX dcat: <http://www.w3.org/ns/dcat#>
PREFIX dct: <http://purl.org/dc/terms/>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
PREFIX schema: <http://schema.org/>
PREFIX sdo: <https://schema.org/>
SELECT DISTINCT ?organisation_uri ?organisation_name ?geonames ?organisation_placename ?latitude ?longitude WHERE {
    ?dataset a dcat:Dataset .
    #?dataset schema:subjectOf ?registrationUrl .
    #FILTER (NOT EXISTS { ?registrationUrl schema:validUntil ?validUntil })
    ?dataset '.$dct_type.' ?organisation_uri .
    ?organisation_uri foaf:name ?organisation_name
    FILTER(LANG(?organisation_name) = "" || LANGMATCHES(LANG(?organisation_name), "nl")) 
    # lookup location in organization_locations graph
    ?organisation_uri sdo:location ?geonames .
    SERVICE <https://demo.netwerkdigitaalerfgoed.nl/geonames/sparql> {
        ?geonames <https://www.geonames.org/ontology#name> ?organisation_placename ;
        <http://www.w3.org/2003/01/geo/wgs84_pos#latitude> ?latitude ;
        <http://www.w3.org/2003/01/geo/wgs84_pos#longitude> ?longitude .
    }
}';

	$sparqlResults=getSPARQLresults($sparql,$lang);

	$orglocs=array();
	if (isset($sparqlResults)) {
		foreach ($sparqlResults["results"]["bindings"] as $item) {
			$orglocs[]=array("organisation_uri"=>$item["organisation_uri"]["value"],
							"organisation_name"=>$item["organisation_name"]["value"],
							"organisation_placename"=>$item["organisation_placename"]["value"],
							"geonames"=>$item["geonames"]["value"],
							"latitude"=>$item["latitude"]["value"],
							"longitude"=>$item["longitude"]["value"]);
		}
	}
	return $orglocs;	
}
