<?php

define('LANGUAGE','nl-NL');

/* schema.org/Dataset */

$datasetfields=array();

$datasetfields[]=array(
	"id"=>"dataset_identifier",
	"example"=>"http://archief.io/id/B8CA13423A834E8CB9C23DF85F239E31",
	"label"=>"Identificatie",
	"property_uri"=>"schema:identifier",
	"mandatory"=>1,
	"range"=>"xsd:anyURI",
	"title"=>"De unieke identificatie van de datasetbeschrijving (een URI)",
	"description"=>"",
	"script_schema"=>'if ($("#id_dataset_identifier").val()) { schema["@id"]=$("#id_dataset_identifier").val(); schema["identifier"]=$("#id_dataset_identifier").val(); }',
	"screen"=>1
);

$datasetfields[]=array(
	"id"=>"dataset_name",
	"label"=>"Naam",
	"example"=>"Voorbeeld dataset",
	"property_uri"=>"schema:name",
	"mandatory"=>1,
	"range"=>"xml:string",
	"title"=>"De naam van de dataset",
	"script_schema"=>'if ($("#id_dataset_name").val()) { schema["name"]=$("#id_dataset_name").val(); }',
	"screen"=>1
);

$datasetfields[]=array(
	"id"=>"dataset_license",
	"label"=>"Licentie",
	"example"=>"http://creativecommons.org/publicdomain/zero/1.0/deed.nl",
	"mandatory"=>1,
	"property_uri"=>"schema:license",
	"range"=>"DONL:License",
	"select"=>"donl_license",
	"title"=>"De licentie die van toepassing is op de dataset",
	"script_schema"=>'if ($("#id_dataset_license").val() != "") { schema["license"]=$("#id_dataset_license").val(); }',
	"screen"=>1
);

$datasetfields[]=array(
	"id"=>"dataset_publisher",
	"label"=>"Verstrekker",
	"example"=>"http://standaarden.overheid.nl/owms/terms/Nationaal_Archief",
	"property_uri"=>"schema:publisher",
	"mandatory"=>1,
	"range"=>"donl:authority",
	"select"=>"donl_organization",
	"title"=>"De uitgever (publisher) van de dataset",
	"script_schema"=>'if ($("#id_dataset_publisher").val()) { var publisher={}; publisher["@id"]=$("#id_dataset_publisher").val(); publisher["@type"]="Organization"; publisher["name"]=$("#id_dataset_publisher option:selected").text(); schema["publisher"]=publisher; }',
	"screen"=>1
);

#-----

$datasetfields[]=array(
	"id"=>"dataset_description",
	"label"=>"Beschrijving inhoud",
	"example"=>"Door het formulier vooringevulde, vaste waarden om het testen te vereenvoudigen.",
	"property_uri"=>"schema:description",
	"mandatory"=>0,
	"range"=>"xml:string",
	"title"=>"De beschrijving van de inhoud van de dataset",
	"script_schema"=>'if ($("#id_dataset_description").val()) { schema["description"]=$("#id_dataset_description").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_metadataLanguage",
	"label"=>"Taal metadata",
	"example"=>"http://publications.europa.eu/resource/authority/language/NLD",
	"property_uri"=>"schema:InLanguage",
	"mandatory"=>0,
	"select"=>"donl_language",
	"range"=>"donl:language",
	"title"=>"De in de beschrijving gebruikte taal",
	"script_schema"=>'if ($("#id_dataset_metadataLanguage").val() != "") { 	
	if ($("#id_dataset_metadataLanguage").val()=="http://publications.europa.eu/resource/authority/language/NLD") { schema["inLanguage"]="nl-NL"; }
	if ($("#id_dataset_metadataLanguage").val()=="http://publications.europa.eu/resource/authority/language/DEU") { schema["inLanguage"]="de-DE"; }
	if ($("#id_dataset_metadataLanguage").val()=="http://publications.europa.eu/resource/authority/language/ENG") { schema["inLanguage"]="en-US"; }
	if ($("#id_dataset_metadataLanguage").val()=="http://publications.europa.eu/resource/authority/language/FRY") { schema["inLanguage"]="nl-FY"; }
	}',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_creator",
	"label"=>"Data-eigenaar",
	"example"=>"http://standaarden.overheid.nl/owms/terms/Ministerie_van_Onderwijs,_Cultuur_en_Wetenschap",
	"mandatory"=>0,
	"property_uri"=>"schema:creator",	
	"range"=>"donl:authority",
	"select"=>"donl_organization",
	"title"=>"De maker (creator) of eigenaar van de dataset",
	"script_schema"=>'if ($("#id_dataset_creator").val()) { schema["creator"]={}; schema["creator"]["@type"]="Organization"; schema["creator"]["name"]=$("#id_dataset_creator option:selected").text(); schema["creator"]["@id"]=$("#id_dataset_creator").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_mainEntityOfPage",
	"label"=>"Meer informatie",
	"example"=>"https://demo.netwerkdigitaalerfgoed.nl/datasets/kb/2.html",
	"property_uri"=>"schema:mainEntityOfPage",
	"multiple"=>1,
	"range"=>"xsd:anyURI",
	"title"=>"Webpagina met meer informatie over de dataset",
	"script_schema"=>'if ($("#id_dataset_mainEntityOfPage_0").val()) { var mainEntityOfPage_idx=0; schema["mainEntityOfPage"]=[]; while ($("#id_dataset_mainEntityOfPage_"+mainEntityOfPage_idx).val()) { schema["mainEntityOfPage"].push($("#id_dataset_mainEntityOfPage_"+mainEntityOfPage_idx).val()); mainEntityOfPage_idx++; }}',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_dateCreated",
	"label"=>"Creatiedatum",
	"example"=>"2020-03-30T04:05",
	"property_uri"=>"schema:dateCreated",
	"range"=>"xsd:datetime", // of xsd:date
	"title"=>"Datum waarom de dataset is aangemaakt",
	"script_schema"=>'if ($("#id_dataset_dateCreated").val()) { schema["dateCreated"]=$("#id_dataset_dateCreated").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_datePublished",
	"label"=>"Publicatiedatum",
	"example"=>"2020-03-30T04:05",
	"property_uri"=>"schema:datePublished",
	"range"=>"xsd:datetime", // of xsd:date
	"title"=>"Datum waarop de dataset is gepubliceerd",
	"script_schema"=>'if ($("#id_dataset_datePublished").val()) { schema["datePublished"]=$("#id_dataset_datePublished").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_dateModified",
	"label"=>"Wijzigingsdatum",
	"example"=>"2020-03-31T04:05",
	"property_uri"=>"schema:dateModified",
	"range"=>"xsd:datetime", // of xsd:date
	"title"=>"Datum waarop de dataset voor het laatst is bijgewerkt",
	"script_schema"=>'if ($("#id_dataset_dateModified").val()) { schema["dateModified"]=$("#id_dataset_dateModified").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_version",
	"label"=>"Versie",
	"example"=>"4",
	"property_uri"=>"schema:version",
	"range"=>"xml:string",
	"title"=>"De versie van de dataset",
	"script_schema"=>'if ($("#id_dataset_version").val()) { schema["version"]=$("#id_dataset_version").val(); }',
	"screen"=>2
);



$datasetfields[]=array(
	"id"=>"dataset_contactPointCreator_name",
	"label"=>"Data-eigenaar contact Naam",
	"example"=>"T. Ester",
	"property_uri"=>"schema:name",
	"range"=>"xml:string",
	"title"=>"Naam van de contactpersoon bij de maker van de dataset",
	"script_schema"=>'if ($("#id_dataset_contactPointCreator_name").val()) { if (schema["creator"]["contactPoint"]===undefined) { schema["creator"]["contactPoint"]={}; } schema["creator"]["contactPoint"]["@type"]="ContactPoint"; schema["creator"]["contactPoint"]["name"]=$("#id_dataset_contactPointCreator_name").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_contactPointCreator_email",
	"label"=>"Data-eigenaar contact E&#8209;mail",
	"example"=>"voorbeeld@nde.nl",
	"property_uri"=>"schema:email",
	"range"=>"xml:string",
	"title"=>"E-mail van de contactpersoon bij de maker van de dataset",
	"script_schema"=>'if ($("#id_dataset_contactPointCreator_email").val()) { if (schema["creator"]["contactPoint"]===undefined) { schema["creator"]["contactPoint"]={}; } schema["creator"]["contactPoint"]["@type"]="ContactPoint"; schema["creator"]["contactPoint"]["email"]=$("#id_dataset_contactPointCreator_email").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_contactPointCreator_phone",
	"label"=>"Data-eigenaar contact Telefoon",
	"example"=>"088-1234567",
	"property_uri"=>"schema:telephone",
	"range"=>"xml:string",
	"title"=>"Telefoonnummer van de contactpersoon bij de maker van de dataset.",
	"script_schema"=>'if ($("#id_dataset_contactPointCreator_phone").val()) { if (schema["creator"]["contactPoint"]===undefined) { schema["creator"]["contactPoint"]={}; } schema["creator"]["contactPoint"]["@type"]="ContactPoint"; schema["creator"]["contactPoint"]["telephone"]=$("#id_dataset_contactPointCreator_phone").val(); }',
	"screen"=>2
);


$datasetfields[]=array(
	"id"=>"dataset_contactPointPublisher_name",
	"label"=>"Verstrekker contact Naam",
	"example"=>"T. Ester",
	"property_uri"=>"schema:name",
	"range"=>"xml:string",
	"title"=>"Naam van de contactpersoon bij de verstrekker van de dataset",
	"script_schema"=>'if ($("#id_dataset_contactPointPublisher_name").val()) { if (schema["publisher"]["contactPoint"]===undefined) { schema["publisher"]["contactPoint"]={}; } schema["publisher"]["contactPoint"]["@type"]="ContactPoint"; schema["publisher"]["contactPoint"]["name"]=$("#id_dataset_contactPointPublisher_name").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_contactPointPublisher_email",
	"label"=>"Verstrekker contact E&#8209;mail",
	"example"=>"voorbeeld@nde.nl",
	"property_uri"=>"schema:email",
	"range"=>"xml:string",
	"title"=>"E-mail van de contactpersoon bij de verstrekker van de dataset",
	"script_schema"=>'if ($("#id_dataset_contactPointPublisher_email").val()) { if (schema["publisher"]["contactPoint"]===undefined) { schema["publisher"]["contactPoint"]={}; } schema["publisher"]["contactPoint"]["@type"]="ContactPoint"; schema["publisher"]["contactPoint"]["email"]=$("#id_dataset_contactPointPublisher_email").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_contactPointPublisher_phone",
	"label"=>"Verstrekker contact Telefoon",
	"example"=>"088-1234567",
	"property_uri"=>"schema:telephone",
	"range"=>"xml:string",
	"title"=>"Telefoonnummer van de contactpersoon bij de verstrekker van de dataset",
	"script_schema"=>'if ($("#id_dataset_contactPointPublisher_phone").val()) { if (schema["publisher"]["contactPoint"]===undefined) { schema["publisher"]["contactPoint"]={}; } schema["publisher"]["contactPoint"]["@type"]="ContactPoint"; schema["publisher"]["contactPoint"]["telephone"]=$("#id_dataset_contactPointPublisher_phone").val(); }',
	"screen"=>2
);


$datasetfields[]=array(
	"id"=>"dataset_keyword",
	"label"=>"Tag",
	"example"=>"Test",
	"property_uri"=>"schema:keywords",
	"multiple"=>1,
	"range"=>"xml:string",
	"title"=>"Steekwoord (keyword/tag) die de dataset beschrijft",
	"script_schema"=>'if ($("#id_dataset_keyword_0").val()) { var keyword_idx=0; schema["keywords"]=[]; while ($("#id_dataset_keyword_"+keyword_idx).val()) { schema["keywords"].push($("#id_dataset_keyword_"+keyword_idx).val()); keyword_idx++; }}',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_genre",
	"label"=>"Genre",
	"example"=>"http://standaarden.overheid.nl/owms/terms/Recreatie_(thema)",
	"property_uri"=>"schema:genre",
	"multiple"=>1,
	"select"=>"overheid_taxonomiebeleidsagenda",
	"range"=>"overheid:taxonomiebeleidsagenda",
	"title"=>"Genre waarbinnen de dataset valt",
	"script_schema"=>'if ($("#id_dataset_genre_0").val()) { var genre_idx=0; schema["genre"]=[]; while ($("#id_dataset_genre_"+genre_idx).val()) { schema["genre"].push($("#id_dataset_genre_"+genre_idx).val()); genre_idx++; }}',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_citation",
	"label"=>"Bronvermelding",
	"example"=>"Oorspronkelijk uit boek A uit archief B inventaris C",
	"property_uri"=>"schema:citation",
	"range"=>"xml:string",
	"title"=>"Een vermelding of referentie naar een andere creatief werk",
	"script_schema"=>'if ($("#id_dataset_citation").val()) { schema["citation"]=$("#id_dataset_citation").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_spatialCoverage",
	"label"=>"Dekking plaats/gebied",
	"example"=>"Nederland",
	"property_uri"=>"schema:spatialCoverage",
	"range"=>"xml:string",
	"title"=>"Plaat of gebied waar de dataset betrekking op heeft",
	"script_schema"=>'if ($("#id_dataset_spatialCoverage").val()) { schema["spatialCoverage"]=$("#id_dataset_spatialCoverage").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_temporalCoverage",
	"label"=>"Dekking tijd/periode",
	"example"=>"1900-2000",
	"property_uri"=>"schema:temporalCoverage",
	"range"=>"xml:string",
	"title"=>"Tijdsperiode waar de dataset betrekking op heeft",
	"script_schema"=>'if ($("#id_dataset_temporalCoverage").val()) { schema["temporalCoverage"]=$("#id_dataset_temporalCoverage").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_isBasedOnUrl",
	"label"=>"URI dataset waar deze dataset op is gebaseerd",
	"example"=>"http://www.example.com/1",
	"property_uri"=>"schema:isBasedOnUrl",
	"range"=>"xsd:anyURI",
	"title"=>"De URI van de dataset waar deze dataset op is gebaseerd",
	"script_schema"=>'if ($("#id_dataset_isBasedOnUrl").val()) { schema["isBasedOnUrl"]=$("#id_dataset_isBasedOnUrl").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_includedInDataCatalog",
	"label"=>"Naam datacatalogus waar dataset onderdeel van uitmaakt",
	"example"=>"http://www.example.com/2",
	"property_uri"=>"schema:includedInDataCatalog",
	"range"=>"xml:string",
	"title"=>"De URI van de datacatalogus waar deze dataset deel van uit maakt",
	"script_schema"=>'if ($("#id_dataset_includedInDataCatalog").val()) { schema["includedInDataCatalog"]=$("#id_dataset_includedInDataCatalog").val(); }',
	"screen"=>2
);

# ----

$datasetfields[]=array(
	"id"=>"dataset_distribution",
	"label"=>"Distributie",
	"mandatory"=>0,
	"multiple"=>1,
	"property_uri"=>"schema:DataDownload",
	"range"=>"schema:DataDownload",
	"title"=>"This property links the Dataset to an available Distribution.",
	"screen"=>3
);




/* schema.org/DataDownload */

$distributionfields=array();

$distributionfields[]=array(
	"id"=>"distribution_0_accessURL",
	"label"=>"URL",
	"example"=>"http://archief.io/dataset/B8CA13423A834E8CB9C23DF85F239E31",
	"class"=>"distribution_first",
	"property_uri"=>"schema:contentUrl",
	"mandatory"=>1,
	"range"=>"xsd:anyURI",
	"title"=>"Het adres waar de datasetdistributie benaderd kan worden",
	"script_schema"=>'distribution["contentUrl"]={}; distribution["contentUrl"]=$("#id_distribution_"+dataset_idx+"_accessURL").val();'
);

$distributionfields[]=array(
	"id"=>"distribution_0_encodingFormat",
	"label"=>"Formaat",
	"example"=>"application/ld+json",
	"mandatory"=>1,
	"multiple"=>1,
	"property_uri"=>"schema:encodingFormat",
	"select"=>"iana_mediatypes",
	"range"=>"dcat:mediaType",
	"title"=>"Media type (MIME formaat)",
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_encodingFormat_0").val()) {
var encodingFormat_idx=0; distribution["encodingFormat"]=[]; while ($("#id_distribution_"+dataset_idx+"_encodingFormat_"+encodingFormat_idx).val()) { distribution["encodingFormat"].push($("#id_distribution_"+dataset_idx+"_encodingFormat_"+encodingFormat_idx).val()); encodingFormat_idx++; }}'
);

$distributionfields[]=array(
	"id"=>"distribution_0_name",
	"label"=>"Soort",
	"mandatory"=>1,
	"property_uri"=>"schema:name",  // alternatief "schema:conditionsOfAccess"

	"example"=>"SPARQL-endpoint",
	"range"=>"xml:string",
	"title"=>"Een identifier die duidelijk maakt op welke manier gegevens beschikbaar worden gesteld: via een SPARQL-endpoint, OAI-PMH-endpoint, LDF-endpoint of een datadump.",
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_name").val()) { distribution["name"]=$("#id_distribution_"+dataset_idx+"_name").val(); }'
	
#	"example"=>"http://netwerkdigitaalerfgoed.nl/def/soort#datadump",
#	"range"=>"DONL:License",
#	"title"=>"Soort datadistributie",
#	"select"=>"naam-soort",
#	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_name").val() != "") { distribution["name"]=$("#id_distribution_"+dataset_idx+"_name").val(); }'
		
);

$distributionfields[]=array(
	"id"=>"distribution_0_license",
	"label"=>"Licentie",
	"example"=>"http://creativecommons.org/publicdomain/zero/1.0/deed.nl",
	"property_uri"=>"schema:license",
	"range"=>"DONL:License",
	"select"=>"donl_license",
	"title"=>"Licentie (URI) die van toepassing is op de dataset",
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_license").val() != "") { distribution["license"]=$("#id_distribution_"+dataset_idx+"_license").val(); }'
);

$distributionfields[]=array(
	"id"=>"distribution_0_description",
	"label"=>"Omschrijving",
	"example"=>"Heleboel triple statements",
	"property_uri"=>"schema:description",
	"range"=>"xml:string",
	"mandatory"=>0,
	"title"=>"Beschrijving van de datasetdistributie",
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_description").val()) { distribution["description"]=$("#id_distribution_"+dataset_idx+"_description").val(); }'
);

$distributionfields[]=array(
	"id"=>"distribution_0_inLanguage",
	"label"=>"Taal",
	"example"=>"http://publications.europa.eu/resource/authority/language/ENG",
	"property_uri"=>"schema:inLanguage",
	"mandatory"=>0,
	"multiple"=>1,
	"select"=>"donl_language",
	"range"=>"donl:language",
	"title"=>"Gebruikte taal in de datasetdistributie",
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_inLanguage_0").val()!="") { var lang_idx=0; distribution["inLanguage"]=[]; while ($("#id_distribution_"+dataset_idx+"_inLanguage_"+lang_idx).val()) {
	if ($("#id_distribution_"+dataset_idx+"_inLanguage_"+lang_idx).val()=="http://publications.europa.eu/resource/authority/language/NLD") { distribution["inLanguage"].push("nl-NL"); }
	if ($("#id_distribution_"+dataset_idx+"_inLanguage_"+lang_idx).val()=="http://publications.europa.eu/resource/authority/language/DEU") { distribution["inLanguage"].push("de-DE"); }
	if ($("#id_distribution_"+dataset_idx+"_inLanguage_"+lang_idx).val()=="http://publications.europa.eu/resource/authority/language/ENG") { distribution["inLanguage"].push("en-US"); }
	if ($("#id_distribution_"+dataset_idx+"_inLanguage_"+lang_idx).val()=="http://publications.europa.eu/resource/authority/language/FRY") { distribution["inLanguage"].push("nl-FY"); }
	lang_idx++; }}'
);

$distributionfields[]=array(
	"id"=>"distribution_0_datePublished",
	"label"=>"Publicatiedatum",
	"example"=>"2020-03-27T04:05",
	"property_uri"=>"schema:datePublished",
	"range"=>"xsd:datetime", // or Date
	"title"=>"Datum waarop de datasetdistributie is gepubliceerd",
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_datePublished").val()) { distribution["datePublished"]=$("#id_distribution_"+dataset_idx+"_datePublished").val(); }'
);

$distributionfields[]=array(
	"id"=>"distribution_0_dateModified",
	"label"=>"Wijzigingsdatum",
	"example"=>"2020-03-28T04:05",
	"property_uri"=>"schema:dateModified", 
	"range"=>"xsd:datetime", // or Date
	"title"=>"Datum waarop de datasetdistributie voor het laatste is bijgewerkt",
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_dateModified").val()) { distribution["dateModified"]=$("#id_distribution_"+dataset_idx+"_dateModified").val(); }'
);

$distributionfields[]=array(
	"id"=>"distribution_0_contentSize",
	"label"=>"Bestandsgrootte",
	"example"=>"123456",
	"property_uri"=>"schema:contentSize",
	"range"=>"xml:string",
	"title"=>"Grootte van het bestand in bytes",
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_contentSize").val()) { distribution["contentSize"]={}; distribution["contentSize"]=$("#id_distribution_"+dataset_idx+"_contentSize").val(); }'
);

$contactPointfields=array();