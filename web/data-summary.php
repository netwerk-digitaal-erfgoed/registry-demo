<?php

# Proof-of-concept Linked Data Dataset Summary
# TODO: meertalig maken
# TODO: namespaces ($namespace) automatiseren
# TODO: terminologiebronnen ($ts) automatiseren

define('SPARQL_ENDPOINT', 'https://triplestore.netwerkdigitaalerfgoed.nl/repositories/dataset-knowledge-graph');
define('SPARQL_CACHE_DURATION_HOURS',1);
define('CACHE_DIRECTORY','/tmp/');
define('TOP_NUMBER',10);
define('PREFIXES', "PREFIX void: <http://rdfs.org/ns/void#>\nPREFIX nde: <https://www.netwerkdigitaalerfgoed.nl/def#>\nPREFIX prov: <http://www.w3.org/ns/prov#>\n");

$namespace=array();

$namespace["http://jena.apache.org/ARQ/function#"]="afn:";
$namespace["http://jena.apache.org/ARQ/function/aggregate#"]="agg:";
$namespace["http://jena.apache.org/ARQ/property#"]="apf:";
$namespace["http://www.w3.org/2005/xpath-functions/array"]="array:";
$namespace["https://linkeddata.cultureelerfgoed.nl/def/ceo#"]="ceo:";
$namespace["http://purl.org/dc/dcmitype/"]="dctype:";
$namespace["http://www.w3.org/2005/xpath-functions"]="fn:";
$namespace["http://www.opengis.net/ont/geosparql#"]="geo:";
$namespace["http://rdf.useekm.com/ext#"]="geoext:";
$namespace["http://www.opengis.net/def/function/geosparql/"]="geof:";
$namespace["http://www.geonames.org/ontology#"]="gn:";
$namespace["http://www.ontotext.com/config/graphdb#"]="graphdb:";
$namespace["https://www.goudatijdmachine.nl/def#"]="gtm:";
$namespace["http://rdf.histograph.io/"]="hg:";
$namespace["http://www.ontotext.com/connectors/lucene/instance#"]="inst:";
$namespace["http://jena.apache.org/ARQ/list#"]="list:";
$namespace["http://www.w3.org/2005/xpath-functions/map"]="map:";
$namespace["http://www.w3.org/2005/xpath-functions/math"]="math:";
$namespace["http://omeka.org/s/vocabs/o#"]="o:";
$namespace["http://omeka.org/s/vocabs/module/comment#"]="o-comment:";
$namespace["http://www.ontotext.com/sparql/functions/"]="ofn:";
$namespace["http://www.ontotext.com/owlim/geo#"]="omgeo:";
$namespace["http://www.ontotext.com/plugins/geosparql#"]="onto-geo:";
$namespace["http://www.w3.org/2002/07/owl#"]="owl:";
$namespace["http://www.ontotext.com/path#"]="path:";
$namespace["https://personsincontext.org/model#"]="picom:";
$namespace["https://w3id.org/pnv#"]="pnv:";
$namespace["http://www.ontotext.com/connectors/lucene#"]="prefix:";
$namespace["http://www.w3.org/ns/prov#"]="prov:";
$namespace["http://www.w3.org/1999/02/22-rdf-syntax-ns#"]="rdf:";
$namespace["http://rdf4j.org/schema/rdf4j#"]="rdf4j:";
$namespace["http://www.w3.org/2000/01/rdf-schema#"]="rdfs:";
$namespace["http://www.openrdf.org/config/repository#"]="rep:";
$namespace["http://www.ontotext.com/connectors/retrieval#"]="retr:";
$namespace["http://www.ontotext.com/connectors/retrieval/instance#"]="retr-index:";
$namespace["https://www.ica.org/standards/RiC/ontology#"]="rico:";
$namespace["https://w3id.org/roar#"]="roar:";
$namespace["http://www.openrdf.org/config/sail#"]="sail:";
$namespace["https://schema.org/"]="sdo:";
$namespace["http://www.openrdf.org/schema/sesame#"]="sesame:";
$namespace["http://spinrdf.org/spif#"]="spif:";
$namespace["http://www.openrdf.org/config/repository/sail#"]="sr:";
$namespace["http://www.w3.org/2003/01/geo/wgs84_pos#"]="wgs:";
$namespace["http://www.w3.org/2001/XMLSchema#"]="xsd:";
$namespace["http://www.w3.org/2004/02/skos/core#"]="skos:";
$namespace["http://purl.org/dc/terms/"]="dct:";
$namespace["http://schema.org/"]="schema:";
$namespace["http://schema.org"]="schema:";
$namespace["https://schema.org/"]="sdo:";
$namespace["https://schema.org"]="sdo:";
$namespace["https://www.ica.org/standards/RiC/ontology"]="rico:";
$namespace["http://xmlns.com/foaf/0.1/"]="foaf:";
$namespace["http://www.cidoc-crm.org/cidoc-crm/"]="cidoc:";
$namespace["http://www.cidoc-crm.org/cidoc-crm"]="cidoc:";

# alle JSON-LD in een graph in GraphDB laden (lijkt niet helemaal goed te gaan https://schema.org wordt http://schema.org ??)
/*
 PREFIX schema: <http://schema.org/>
SELECT ?ts_php  {
    ?ts a schema:Dataset .
    ?ts schema:name ?sourcename_nl
    FILTER (lang(?sourcename_nl) = "nl")
    ?ts schema:creator/schema:name ?creator_name_nl .
    FILTER (lang(?creator_name_nl) = "nl")
    BIND(CONCAT(?sourcename_nl," (",?creator_name_nl,")") AS ?ts_nl)
        
    ?ts schema:name ?sourcename_en
    FILTER (lang(?sourcename_en) = "en")
    ?ts schema:creator/schema:name ?creator_name_en .
    FILTER (lang(?creator_name_en) = "en")
    BIND(CONCAT(?sourcename_en," (",?creator_name_en,")") AS ?ts_en)
 
    BIND(CONCAT("$ts[\"",STR(?ts),"\"][\"nl\"]=",?ts_nl,"\"; $ts[\"",STR(?ts),"\"][\"en\"]=",?ts_en,"\";") AS ?ts_php)
}
*/

$ts=array();

$ts["http://vocab.getty.edu/aat"]["nl"]="Art & Architecture Thesaurus (Getty Research Institute)"; $ts["http://vocab.getty.edu/aat"]["en"]="Art & Architecture Thesaurus (Getty Research Institute)";
$ts["http://vocab.getty.edu/aat#materials"]["nl"]="Art & Architecture Thesaurus - materialen (Getty Research Institute)"; $ts["http://vocab.getty.edu/aat#materials"]["en"]="Art & Architecture Thesaurus - materials (Getty Research Institute)";
$ts["http://vocab.getty.edu/aat#processes-and-techniques"]["nl"]="Art & Architecture Thesaurus - processen en technieken (Getty Research Institute)"; $ts["http://vocab.getty.edu/aat#processes-and-techniques"]["en"]="Art & Architecture Thesaurus - processes and techniques (Getty Research Institute)";
$ts["http://vocab.getty.edu/aat#styles-and-periods"]["nl"]="Art & Architecture Thesaurus - stijlen en periodes (Getty Research Institute)"; $ts["http://vocab.getty.edu/aat#styles-and-periods"]["en"]="Art & Architecture Thesaurus - styles and periods (Getty Research Institute)";
$ts["https://data.cultureelerfgoed.nl/term/id/abr"]["nl"]="Archeologisch Basisregister (Rijksdienst voor het Cultureel Erfgoed)"; $ts["https://data.cultureelerfgoed.nl/term/id/abr"]["en"]="Archaeological Basic Register (Cultural Heritage Agency)";
$ts["http://data.bibliotheken.nl/id/dataset/brinkman"]["nl"]="Brinkman trefwoordenthesaurus (Koninklijke Bibliotheek)"; $ts["http://data.bibliotheken.nl/id/dataset/brinkman"]["en"]="Brinkman subjects (National Library of the Netherlands)";
$ts["https://data.cultureelerfgoed.nl/term/id/cht"]["nl"]="Cultuurhistorische Thesaurus (Rijksdienst voor het Cultureel Erfgoed)"; $ts["https://data.cultureelerfgoed.nl/term/id/cht"]["en"]="Cultural-historical Thesaurus (Cultural Heritage Agency)";
$ts["https://data.cultureelerfgoed.nl/term/id/cht#materials"]["nl"]="Cultuurhistorische Thesaurus - Materialen (Rijksdienst voor het Cultureel Erfgoed)"; $ts["https://data.cultureelerfgoed.nl/term/id/cht#materials"]["en"]="Cultural-historical Thesaurus - Materials (Cultural Heritage Agency)";
$ts["https://data.cultureelerfgoed.nl/term/id/cht#styles-and-periodes"]["nl"]="Cultuurhistorische Thesaurus - Stijlen en periodes (Rijksdienst voor het Cultureel Erfgoed)"; $ts["https://data.cultureelerfgoed.nl/term/id/cht#styles-and-periodes"]["en"]="Cultural-historical Thesaurus - Styles and periods (Cultural Heritage Agency)";
$ts["https://data.europa.eu/data/datasets/eurovoc"]["nl"]="EuroVoc - thesaurus van de Europese Unie (Bureau voor publicaties van de Europese Unie)"; $ts["https://data.europa.eu/data/datasets/eurovoc"]["en"]="EuroVoc - thesaurus of the European Union (Publications Office of the European Union)";
$ts["https://www.goudatijdmachine.nl/id/straten"]["nl"]="Goudse straten (Gouda Tijdmachine)"; $ts["https://www.goudatijdmachine.nl/id/straten"]["en"]="Gouda streets (Gouda Time Machine)";
$ts["http://data.beeldengeluid.nl/gtaa/Classificatie"]["nl"]="GTAA: classificatie (Nederlands Instituut voor Beeld en Geluid)"; $ts["http://data.beeldengeluid.nl/gtaa/Classificatie"]["en"]="GTAA: classification (Netherlands Institute for Sound and Vision)";
$ts["http://data.beeldengeluid.nl/gtaa/Genre"]["nl"]="GTAA: genres (Nederlands Instituut voor Beeld en Geluid)"; $ts["http://data.beeldengeluid.nl/gtaa/Genre"]["en"]="GTAA: genres (Netherlands Institute for Sound and Vision)";
$ts["http://data.beeldengeluid.nl/gtaa/GeografischeNamen"]["nl"]="GTAA: geografische namen (Nederlands Instituut voor Beeld en Geluid)"; $ts["http://data.beeldengeluid.nl/gtaa/GeografischeNamen"]["en"]="GTAA: geographical names (Netherlands Institute for Sound and Vision)";
$ts["http://data.beeldengeluid.nl/gtaa/Namen"]["nl"]="GTAA: namen (Nederlands Instituut voor Beeld en Geluid)"; $ts["http://data.beeldengeluid.nl/gtaa/Namen"]["en"]="GTAA: names (Netherlands Institute for Sound and Vision)";
$ts["http://data.beeldengeluid.nl/gtaa/Onderwerpen"]["nl"]="GTAA: onderwerpen (Nederlands Instituut voor Beeld en Geluid)"; $ts["http://data.beeldengeluid.nl/gtaa/Onderwerpen"]["en"]="GTAA: subjects (Netherlands Institute for Sound and Vision)";
$ts["http://data.beeldengeluid.nl/gtaa/OnderwerpenBenG"]["nl"]="GTAA: onderwerpen beeld-geluid (Nederlands Instituut voor Beeld en Geluid)"; $ts["http://data.beeldengeluid.nl/gtaa/OnderwerpenBenG"]["en"]="GTAA: subjects sound-vision (Netherlands Institute for Sound and Vision)";
$ts["http://data.beeldengeluid.nl/gtaa/Persoonsnamen"]["nl"]="GTAA: persoonsnamen (Nederlands Instituut voor Beeld en Geluid)"; $ts["http://data.beeldengeluid.nl/gtaa/Persoonsnamen"]["en"]="GTAA: personal names (Netherlands Institute for Sound and Vision)";
$ts["https://iconclass.org"]["nl"]="Iconclass (Stichting Hendri van de Waal)"; $ts["https://iconclass.org"]["en"]="Iconclass (Henri van de Waal Foundation)";
$ts["https://data.cultureelerfgoed.nl/koloniaalverleden/"]["nl"]="Koloniaal Verleden (Rijksdienst voor het Cultureel Erfgoed)"; $ts["https://data.cultureelerfgoed.nl/koloniaalverleden/"]["en"]="Colonial Past (Cultural Heritage Agency)";
$ts["https://data.muziekschatten.nl/#onderwerpen"]["nl"]="Muziekschatten: onderwerpen (Stichting Omroep Muziek)"; $ts["https://data.muziekschatten.nl/#onderwerpen"]["en"]="Muziekschatten: subjects (Stichting Omroep Muziek)";
$ts["https://data.muziekschatten.nl/#personen"]["nl"]="Muziekschatten: personen (Stichting Omroep Muziek)"; $ts["https://data.muziekschatten.nl/#personen"]["en"]="Muziekschatten: persons (Stichting Omroep Muziek)";
$ts["https://data.muziekweb.nl/MuziekwebOrganization/Muziekweb#mw-genresstijlen"]["nl"]="Muziek: genres en stijlen (Muziekweb)"; $ts["https://data.muziekweb.nl/MuziekwebOrganization/Muziekweb#mw-genresstijlen"]["en"]="Music: genres and styles (Muziekweb)";
$ts["https://data.muziekweb.nl/MuziekwebOrganization/Muziekweb#mw-personengroepen"]["nl"]="Muziek: personen en groepen (Muziekweb)"; $ts["https://data.muziekweb.nl/MuziekwebOrganization/Muziekweb#mw-personengroepen"]["en"]="Music: persons and groups (Muziekweb)";
$ts["https://data.colonialcollections.nl/nmvw/thesaurus"]["nl"]="Thesaurus Nationaal Museum van Wereldculturen (Stichting Nationaal Museum van Wereldculturen)"; $ts["https://data.colonialcollections.nl/nmvw/thesaurus"]["en"]="Thesaurus National Museum of World Cultures (National Museum of World Cultures)";
$ts["http://data.bibliotheken.nl/id/dataset/persons"]["nl"]="Nederlandse Thesaurus van Auteursnamen (Koninklijke Bibliotheek)"; $ts["http://data.bibliotheken.nl/id/dataset/persons"]["en"]="Dutch National Thesaurus for Author Names (National Library of the Netherlands)";
$ts["https://terms.personsincontext.org/ThesaurusHistorischePersoonsgegevens/523"]["nl"]="Thesaurus Historische Persoonsgegevens - brontypes (Centrum voor familiegeschiedenis)"; $ts["https://terms.personsincontext.org/ThesaurusHistorischePersoonsgegevens/523"]["en"]="Thesaurus Historische Persoonsgegevens - source types (Center for family history)";
$ts["https://terms.personsincontext.org/ThesaurusHistorischePersoonsgegevens/44"]["nl"]="Thesaurus Historische Persoonsgegevens - rollen (Centrum voor familiegeschiedenis)"; $ts["https://terms.personsincontext.org/ThesaurusHistorischePersoonsgegevens/44"]["en"]="Thesaurus Historische Persoonsgegevens - roles (Center for family history)";
$ts["https://linkeddata.cultureelerfgoed.nl/cho-kennis/id/rijksmonument/"]["nl"]="Rijksmonumentenregister (Rijksdienst voor het Cultureel Erfgoed)"; $ts["https://linkeddata.cultureelerfgoed.nl/cho-kennis/id/rijksmonument/"]["en"]="Rijksmonumentenregister (Cultural Heritage Agency)";
$ts["https://data.rkd.nl/rkdartists"]["nl"]="RKDartists (RKD – Nederlands Instituut voor Kunstgeschiedenis)"; $ts["https://data.rkd.nl/rkdartists"]["en"]="RKDartists (RKD – Netherlands Institute for Art History)";
$ts["http://data.bibliotheken.nl/id/dataset/stcn/printers"]["nl"]="STCN: drukkers (Koninklijke Bibliotheek)"; $ts["http://data.bibliotheken.nl/id/dataset/stcn/printers"]["en"]="STCN: printers (National Library of the Netherlands)";
$ts["https://data.kampwesterbork.nl/thesaurus"]["nl"]="Thesaurus Kamp Westerbork (Herinneringscentrum Kamp Westerbork)"; $ts["https://data.kampwesterbork.nl/thesaurus"]["en"]="Thesaurus Camp Westerbork (Camp Westerbork Memorial Centre)";
$ts["https://www.wikidata.org#entities-all"]["nl"]="Wikidata: alle entiteiten (Wikimedia Foundation)"; $ts["https://www.wikidata.org#entities-all"]["en"]="Wikidata: all entities (Wikimedia Foundation)";
$ts["https://www.wikidata.org#entities-persons"]["nl"]="Wikidata: personen (Wikimedia Foundation)"; $ts["https://www.wikidata.org#entities-persons"]["en"]="Wikidata: persons (Wikimedia Foundation)";
$ts["https://www.wikidata.org#entities-places"]["nl"]="Wikidata: plaatsen in Nederland en België (Wikimedia Foundation)"; $ts["https://www.wikidata.org#entities-places"]["en"]="Wikidata: places in the Netherlands and Belgium (Wikimedia Foundation)";
$ts["https://www.wikidata.org#entities-streets"]["nl"]="Wikidata: straten in Nederland (Wikimedia Foundation)"; $ts["https://www.wikidata.org#entities-streets"]["en"]="Wikidata: streets in the Netherlands (Wikimedia Foundation)";
$ts["https://data.niod.nl/WO2_biografieen"]["nl"]="WO2-biografieën (Instituut voor oorlogs-, holocaust- en genocidestudies)"; $ts["https://data.niod.nl/WO2_biografieen"]["en"]="WW2 biographies (Institute for war, holocaust and genocide studies)";
$ts["https://data.niod.nl/WO2_Thesaurus"]["nl"]="WO2-thesaurus (Instituut voor oorlogs-, holocaust- en genocidestudies)"; $ts["https://data.niod.nl/WO2_Thesaurus"]["en"]="Thesaurus WW2 (Institute for war, holocaust and genocide studies)";

#handmatig

$ts["https://data.ihlia.nl/homosaurus"]["nl"]="Homosaurus (IHLIA LGBTI Heritage)"; $ts["https://data.ihlia.nl/homosaurus"]["en"]="Homosaurus (IHLIA LGBTI Heritage)";
$ts["https://www.geonames.org/"]["en"]="GeoNames: global geographical names"; $ts["https://www.geonames.org/"]["nl"]="GeoNames: geografische namen wereldwijd";
$ts["https://www.geonames.org"]["en"]="GeoNames: global geographical names"; $ts["https://www.geonames.org"]["nl"]="GeoNames: geografische namen wereldwijd";

if (!isset($_GET["uri"]) || !filter_var($_GET["uri"], FILTER_VALIDATE_URL)) {
	exit;
}

$dataset_uri=$_GET["uri"];

$stats=array();

getTripleCounts($dataset_uri);

if (!isset($stats["totalNumberOfTriples"]) || $stats["totalNumberOfTriples"]==0) {
	exit;
}

getUriLiteralCounts($dataset_uri);
getPublicationType($dataset_uri);
getUsedVocabularies($dataset_uri);
getTermsUser($dataset_uri);
getMostUsedClasses($dataset_uri);

$str ='<h2 class="title--l">Linked Data Dataset Summary</h2>';
$str.="<ul>";
$str.="<li>De dataset bevat ".nf($stats["totalNumberOfTriples"])." triples ";
$str.="die ".nf($stats["totalNumberOfSubjects"])." resources beschrijven met ".nf($stats["totalNumberOfDistinctLiterals"])." unieke literals en ".nf($stats["totalNumberOfDistinctUris"])." unieke URI's, via ".nf($stats["totalNumberOfDistinctProperties"])." (unieke) properties.</li>";

if (isset($stats["usedVocabularies"]) && count($stats["usedVocabularies"])>0) {
	$str.="<li>De dataset maakt gebruik van de volgende vocabulaires: ";
	
	$uv=array();
	foreach ($stats["usedVocabularies"] as $voc) {
		array_push($uv,strNSprint($voc));
	}

	$str.=join(", ",$uv).".</li>";
} else {
	$str.="<li>Er is geen informatie over de in dataset gebruikte vocabulaires.</li>";
}

if (isset($stats["classUse"]) && count($stats["classUse"])>0) {
	$str.="<li>De top ".TOP_NUMBER." gebruikte klassen voor resources in deze dataset zijn: ";
	$cu=array();
	foreach ($stats["classUse"] as $classUri => $count) {
		array_push($cu,strNSprint($classUri)." ($count)");
	}
		
	$str.=join(", ",$cu).".</li>";
} else {
	$str.="<li>Er is geen informatie over de in dataset gebruikte resource klassen.</li>";
}


if (isset($stats["termUse"]) && count($stats["termUse"])>0) {
	$str.="<li>De resources in deze dataset maken gebruik van termen uit de volgende bronnen: ";
	$tu=array();
	foreach ($stats["termUse"] as $termUri => $count) {
		array_push($tu,strTSprint($termUri)." ($count)");
	}
		
	$str.=join(", ",$tu).".</li>";
} else {
	$str.="<li>Er is geen informatie over de in dataset gebruikte terminologiebronnen.</li>";
}


$str.="<li>";
if (isset($stats["publicationType"]["RDF dump"]) && isset($stats["publicationType"]["SPARQL endpoint"])) {
	$str.="De dataset is kan gedownload worden als RDF dump en bevraagd worden via een SPARQL endpoint.";
} elseif (isset($stats["publicationType"]["RDF dump"])) {
	$str.="De dataset is kan gedownload worden als RDF dump.";
} elseif (isset($stats["publicationType"]["SPARQL endpoint"])) {
	$str.="De dataset is kan bevraagd worden via een SPARQL endpoint (maar niet gedownload worden als RDF dump).";
}
$str.="</li>";


$str.="</ul>";
echo $str;



function nf($number) {
	return number_format($number,0,"",".");
}

function strNSprint($uri) {
		global $namespace;
		
		foreach ($namespace as $ur=>$ns) {
			if (substr($uri,0,strlen($ur))==$ur) {
				return '<abbr title="'.$uri.'">'.$ns.substr($uri,strlen($ur)).'</abbr>';
			}
		}
		return $uri;
}

function strTSprint($uri,$lang="nl") {
		global $ts;
		
		if (isset($ts[$uri])) {
				return '<abbr title="'.$uri.'">'.$ts[$uri][$lang].'</abbr>';
		}
		return $uri;
}

function getMostUsedClasses($dataset_uri) {
	global $stats;
	
	$sparql=PREFIXES.'SELECT ?typeClass (sum(?entities) AS ?typeCount) { BIND(<'.$dataset_uri.'> AS ?dataset) ?dataset void:classPartition [ void:class ?typeClass ; void:entities ?entities ; ] } GROUP BY ?typeClass ORDER BY DESC(?typeCount) LIMIT '.TOP_NUMBER; 

	$sparqlResults=getSPARQLresults($sparql);
	
	if (isset($sparqlResults)) {
		foreach ( $sparqlResults["results"]["bindings"] as $item) {
			$stats["classUse"][$item["typeClass"]["value"]]=$item["typeCount"]["value"];
		}
	}
}


	
function getTermsUser($dataset_uri) {
	global $stats;
	
	$sparql=PREFIXES.'SELECT ?terminologySource ?numberOfTriples { ?s a void:Linkset ; void:subjectsTarget <'.$dataset_uri.'> ; void:objectsTarget ?terminologySource ; void:triples ?numberOfTriples ; }';

	$sparqlResults=getSPARQLresults($sparql);
	
	if (isset($sparqlResults)) {
		foreach ( $sparqlResults["results"]["bindings"] as $item) {
			$stats["termUse"][$item["terminologySource"]["value"]]=$item["numberOfTriples"]["value"];
		}
	}
}


function getUsedVocabularies($dataset_uri) {
	global $stats, $namespace;
	$sparql=PREFIXES.'SELECT DISTINCT ?vocabularyUsed { <'.$dataset_uri.'> a void:Dataset ; void:vocabulary ?vocabularyUsed }';

	$sparqlResults=getSPARQLresults($sparql);

	if (isset($sparqlResults)) {
		foreach ( $sparqlResults["results"]["bindings"] as $item) {
			$v=$item["vocabularyUsed"]["value"];
			#if (isset($namespace[$v])) { $v=$namespace[$v]; }
			$stats["usedVocabularies"][]=$v;
		}
	}
}


function getPublicationType($dataset_uri) {
	global $stats;
	$sparql=PREFIXES.'SELECT ?ldPublicationType (COUNT(?dataset) AS ?ldPublicationCount) { BIND(<'.$dataset_uri.'> AS ?dataset) ?dataset a prov:Entity ; { ?dataset void:sparqlEndpoint ?distribution . BIND("SPARQL endpoint" AS ?ldPublicationType) } UNION { ?dataset void:dataDump ?distribution . BIND("RDF dump" AS ?ldPublicationType) } UNION { FILTER NOT EXISTS { ?dataset ?p ?distribution . VALUES ?p { void:dataDump void:sparqlEndpoint } } BIND("No valid distribution" AS ?ldPublicationType) } } GROUP BY ?ldPublicationType';

	$sparqlResults=getSPARQLresults($sparql);

	if (isset($sparqlResults)) {
		foreach ( $sparqlResults["results"]["bindings"] as $item) {
			$stats["publicationType"][$item["ldPublicationType"]["value"]]=$item["ldPublicationCount"]["value"];
		}
	}
}


function getTripleCounts($dataset_uri) {
	global $stats;
	$sparql=PREFIXES.'SELECT (SUM(?triples) AS ?totalNumberOfTriples) (SUM(?subjects) AS ?totalNumberOfSubjects) { <'.$dataset_uri.'> a void:Dataset ; void:triples ?triples ; void:distinctSubjects ?subjects ; }';

	$sparqlResults=getSPARQLresults($sparql);

	if (isset($sparqlResults)) {
		foreach ( $sparqlResults["results"]["bindings"][0] as $key=>$item) {
			$stats[$key]=$item["value"];
		}
	}
}

function getUriLiteralCounts($dataset_uri) {
	global $stats;
	$sparql=PREFIXES.'SELECT ?totalNumberOfDistinctLiterals ?totalNumberOfDistinctUris ?totalNumberOfDistinctProperties { <'.$dataset_uri.'> a <http://rdfs.org/ns/void#Dataset> ; nde:distinctObjectsLiteral ?totalNumberOfDistinctLiterals ; nde:distinctObjectsURI ?totalNumberOfDistinctUris ; void:properties ?totalNumberOfDistinctProperties }';

	$sparqlResults=getSPARQLresults($sparql);

	if (isset($sparqlResults)) {
		foreach ( $sparqlResults["results"]["bindings"][0] as $key=>$item) {
			$stats[$key]=$item["value"];
		}
	}
}

function getSPARQLresults($sparqlQueryString) {
	$cacheFile=CACHE_DIRECTORY.md5($sparqlQueryString).".json";
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
