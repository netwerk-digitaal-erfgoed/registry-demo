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
	"title"=>"The unique identification of the dataset",
	"script_schema"=>'if ($("#id_dataset_identifier").val()) { schema["@id"]=$("#id_dataset_identifier").val(); schema["identifier"]=$("#id_dataset_identifier").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_name",
	"label"=>"Naam",
	"example"=>"Voorbeeld dataset",
	"property_uri"=>"schema:name",
	"mandatory"=>1,
	"range"=>"xml:string",
	"title"=>"The name of the dataset",
	"script_schema"=>'if ($("#id_dataset_name").val()) { schema["name"]=$("#id_dataset_name").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_description",
	"label"=>"Beschrijving inhoud",
	"example"=>"Door het formulier vooringevulde, vaste waarden om het testen te vereenvoudigen.",
	"property_uri"=>"schema:description",
	"mandatory"=>1,
	"range"=>"xml:string",
	"title"=>"The description of the dataset",
	"script_schema"=>'if ($("#id_dataset_description").val()) { schema["description"]=$("#id_dataset_description").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_license",
	"label"=>"Licentie",
	"example"=>"http://creativecommons.org/publicdomain/zero/1.0/deed.nl",
	"mandatory"=>1,
	"property_uri"=>"schema:license",
	"range"=>"DONL:License",
	"select"=>"donl_license",
	"title"=>"A license document that applies to this content, typically indicated by URL.",
	"script_schema"=>'if ($("#id_dataset_license").val() != "") { schema["license"]=$("#id_dataset_license").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_metadataLanguage",
	"label"=>"Taal metadata",
	"example"=>"http://publications.europa.eu/resource/authority/language/NLD",
	"property_uri"=>"schema:InLanguage",
	"mandatory"=>1,
	"select"=>"donl_language",
	"range"=>"donl:language",
	"title"=>"This property refers to a language used in the textual metadata describing titles, descriptions, etc. of the Dataset. This property can be repeated if the metadata is provided in multiple languages.",
	"script_schema"=>'if ($("#id_dataset_metadataLanguage").val() != "") { 	
	if ($("#id_distribution_"+dataset_idx+"_language_"+lang_idx).val()=="http://publications.europa.eu/resource/authority/language/NLD") { schema["inLanguage"].push("nl-NL"); }
	if ($("#id_distribution_"+dataset_idx+"_language_"+lang_idx).val()=="http://publications.europa.eu/resource/authority/language/DEU") { schema["inLanguage"].push("de-DE"); }
	if ($("#id_distribution_"+dataset_idx+"_language_"+lang_idx).val()=="http://publications.europa.eu/resource/authority/language/ENG") { schema["inLanguage"].push("en-US"); }
	if ($("#id_distribution_"+dataset_idx+"_language_"+lang_idx).val()=="http://publications.europa.eu/resource/authority/language/FRY") { schema["inLanguage"].push("nl-FY"); }
	}'
);

$datasetfields[]=array(
	"id"=>"dataset_mainEntityOfPage",
	"label"=>"Meer informatie",
	"example"=>"http://demo.netwerkdigitaalerfgoed.nl/",
	"property_uri"=>"schema:mainEntityOfPage",
	"multiple"=>1,
	"range"=>"xsd:anyURI",
	"title"=>"Webpage where more information about the dataset can be found.",
	"script_schema"=>'if ($("#id_dataset_documentation_0").val()) { var mainEntityOfPage_idx=0; schema["mainEntityOfPage"]=[]; while ($("#id_dataset_mainEntityOfPage_"+mainEntityOfPage_idx).val()) { schema["keywords"].push($("#id_dataset_mainEntityOfPage_"+mainEntityOfPage_idx).val()); mainEntityOfPage_idx++; }}'
);



$datasetfields[]=array(
	"id"=>"dataset_dateCreated",
	"label"=>"Creatiedatum",
	"example"=>"2020-03-30T04:05",
	"property_uri"=>"schema:dateCreated",
	"range"=>"xsd:datetime", // of xsd:date
	"title"=>"This property contains the date of creation of the Dataset.",
	"script_schema"=>'if ($("#id_dataset_dateCreated").val()) { schema["dateCreated"]=$("#id_dataset_dateCreated").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_datePublished",
	"label"=>"Publicatiedatum",
	"example"=>"2020-03-30T04:05",
	"property_uri"=>"schema:datePublished",
	"range"=>"xsd:datetime", // of xsd:date
	"title"=>"This property contains the date of formal issuance (e.g., publication) of the Dataset.",
	"script_schema"=>'if ($("#id_dataset_datePublished").val()) { schema["datePublished"]=$("#id_dataset_datePublished").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_dateModified",
	"label"=>"Wijzigingsdatum",
	"example"=>"2020-03-31T04:05",
	"property_uri"=>"schema:dateModified",
	"range"=>"xsd:datetime", // of xsd:date
	"title"=>"This property contains the most recent date on which the Dataset was changed or modified.",
	"script_schema"=>'if ($("#id_dataset_dateModified").val()) { schema["dateModified"]=$("#id_dataset_dateModified").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_version",
	"label"=>"Versie",
	"example"=>"4",
	"property_uri"=>"schema:version",
	"range"=>"xml:string",
	"title"=>"The version of the dataset",
	"script_schema"=>'if ($("#id_dataset_version").val()) { schema["version"]=$("#id_dataset_version").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_authority",
	"label"=>"Data-eigenaar",
	"example"=>"http://standaarden.overheid.nl/owms/terms/Ministerie_van_Onderwijs,_Cultuur_en_Wetenschap",
	"mandatory"=>1,
	"property_uri"=>"schema:creator",	
	"range"=>"donl:authority",
	"select"=>"donl_organization",
	"title"=>"The creator (or owner) of the dataset",
	"script_schema"=>'schema["creator"]={}; schema["creator"]["@type"]="Organization"; schema["creator"]["name"]=$("#id_dataset_authority option:selected").text(); schema["creator"]["url"]=$("#id_dataset_authority").val();'
);


$datasetfields[]=array(
	"id"=>"dataset_contactPointCreator_name",
	"label"=>"Data-eigenaar contact Naam",
	"example"=>"T. Ester",
	"property_uri"=>"schema:name",
	"range"=>"xml:string",
	"title"=>"This property contains contact information that can be used for sending comments about the Dataset.",
	"script_schema"=>'if ($("#id_dataset_contactPointCreator_name").val()) { if (schema["creator"]["contactPoint"]===undefined) { schema["creator"]["contactPoint"]={}; } schema["creator"]["contactPoint"]["@type"]="ContactPoint"; schema["creator"]["contactPoint"]["name"]=$("#id_dataset_contactPointCreator_name").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_contactPointCreator_email",
	"label"=>"Data-eigenaar contact E&#8209;mail",
	"example"=>"voorbeeld@nde.nl",
	"property_uri"=>"schema:email",
	"range"=>"xml:string",
	"title"=>"This property contains contact information that can be used for sending comments about the Dataset.",
	"script_schema"=>'if ($("#id_dataset_contactPointCreator_email").val()) { if (schema["creator"]["contactPoint"]===undefined) { schema["creator"]["contactPoint"]={}; } schema["creator"]["contactPoint"]["@type"]="ContactPoint"; schema["creator"]["contactPoint"]["email"]=$("#id_dataset_contactPointCreator_email").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_contactPointCreator_phone",
	"label"=>"Data-eigenaar contact Telefoon",
	"example"=>"088-1234567",
	"property_uri"=>"schema:telephone",
	"range"=>"xml:string",
	"title"=>"This property contains contact information that can be used for sending comments about the Dataset.",
	"script_schema"=>'if ($("#id_dataset_contactPointCreator_phone").val()) { if (schema["creator"]["contactPoint"]===undefined) { schema["creator"]["contactPoint"]={}; } schema["creator"]["contactPoint"]["@type"]="ContactPoint"; schema["creator"]["contactPoint"]["telephone"]=$("#id_dataset_contactPointCreator_phone").val(); }'
);


$datasetfields[]=array(
	"id"=>"dataset_publisher",
	"label"=>"Verstrekker",
	"example"=>"http://standaarden.overheid.nl/owms/terms/Nationaal_Archief",
	"property_uri"=>"schema:publisher",
	"mandatory"=>1,
	"range"=>"donl:authority",
	"select"=>"donl_organization",
	"title"=>"The publisher of the dataset",
	"script_schema"=>'if ($("#id_dataset_publisher").val()) { var publisher={}; publisher["@id"]=$("#id_dataset_publisher").val(); publisher["@type"]="Organization"; publisher["name"]=$("#id_dataset_publisher option:selected").text(); schema["publisher"]=publisher; }'
);

$datasetfields[]=array(
	"id"=>"dataset_contactPointPublisher_name",
	"label"=>"Verstrekker contact Naam",
	"example"=>"T. Ester",
	"property_uri"=>"schema:name",
	"range"=>"xml:string",
	"title"=>"This property contains contact information that can be used for sending comments about the Dataset.",
	"script_schema"=>'if ($("#id_dataset_contactPointPublisher_name").val()) { if (schema["publisher"]["contactPoint"]===undefined) { schema["publisher"]["contactPoint"]={}; } schema["publisher"]["contactPoint"]["@type"]="ContactPoint"; schema["publisher"]["contactPoint"]["name"]=$("#id_dataset_contactPointCreator_name").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_contactPointPublisher_email",
	"label"=>"Verstrekker contact E&#8209;mail",
	"example"=>"voorbeeld@nde.nl",
	"property_uri"=>"schema:email",
	"range"=>"xml:string",
	"title"=>"This property contains contact information that can be used for sending comments about the Dataset.",
	"script_schema"=>'if ($("#id_dataset_contactPointCreator_email").val()) { if (schema["publisher"]["contactPoint"]===undefined) { schema["publisher"]["contactPoint"]={}; } schema["publisher"]["contactPoint"]["@type"]="ContactPoint"; schema["publisher"]["contactPoint"]["email"]=$("#id_dataset_contactPointCreator_email").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_contactPointPublisher_phone",
	"label"=>"Verstrekker contact Telefoon",
	"example"=>"088-1234567",
	"property_uri"=>"schema:telephone",
	"range"=>"xml:string",
	"title"=>"This property contains contact information that can be used for sending comments about the Dataset.",
	"script_schema"=>'if ($("#id_dataset_contactPointCreator_phone").val()) { if (schema["publisher"]["contactPoint"]===undefined) { schema["publisher"]["contactPoint"]={}; } schema["publisher"]["contactPoint"]["@type"]="ContactPoint"; schema["publisher"]["contactPoint"]["telephone"]=$("#id_dataset_contactPointCreator_phone").val(); }'
);


$datasetfields[]=array(
	"id"=>"dataset_keyword",
	"label"=>"Tag",
	"example"=>"Test",
	"property_uri"=>"schema:keywords",
	"multiple"=>1,
	"range"=>"xml:string",
	"title"=>"This property contains a keyword or tag describing the Dataset.",
	"script_schema"=>'if ($("#id_dataset_keyword_0").val()) { var keyword_idx=0; schema["keywords"]=[]; while ($("#id_dataset_keyword_"+keyword_idx).val()) { schema["keywords"].push($("#id_dataset_keyword_"+keyword_idx).val()); keyword_idx++; }}'
);

$datasetfields[]=array(
	"id"=>"dataset_genre",
	"label"=>"Genre",
	"example"=>"http://standaarden.overheid.nl/owms/terms/Recreatie_(thema)",
	"property_uri"=>"schema:genre",
	"multiple"=>1,
	"select"=>"overheid_taxonomiebeleidsagenda",
	"range"=>"overheid:taxonomiebeleidsagenda",
	"title"=>"This property refers to the genre of the dataset."
);


$datasetfields[]=array(
	"id"=>"dataset_citation",
	"label"=>"Bronvermelding",
	"example"=>"Oorspronkelijk uit boek A uit archief B inventaris C",
	"property_uri"=>"schema:citation",
	"range"=>"xml:string",
	"title"=>"A citation or reference to another creative work, such as another publication, web page, scholarly article, etc.",
	"script_schema"=>'if ($("#id_dataset_citation").val()) { schema["citation"]=$("#id_dataset_citation").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_spatialCoverage",
	"label"=>"Dekking plaats/gebied",
	"example"=>"Nederland",
	"property_uri"=>"schema:spatialCoverage",
	"range"=>"xml:string",
	"title"=>"Indicates the place(s) which are the focus of the dataset",
	"script_schema"=>'if ($("#id_dataset_spatialCoverage").val()) { schema["spatialCoverage"]=$("#id_dataset_spatialCoverage").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_temporalCoverage",
	"label"=>"Dekking tijd/periode",
	"example"=>"1900-2000",
	"property_uri"=>"schema:temporalCoverage",
	"range"=>"xml:string",
	"title"=>"Indicates the period that the dataset applies to",
	"script_schema"=>'if ($("#id_dataset_temporalCoverage").val()) { schema["temporalCoverage"]=$("#id_dataset_temporalCoverage").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_isBasedOnUrl",
	"label"=>"URI dataset waar deze dataset op is gebaseerd",
	"example"=>"http://www.example.com/1",
	"property_uri"=>"schema:isBasedOnUrl",
	"range"=>"xsd:anyURI",
	"title"=>"The URI of dataset this dataset is based",
	"script_schema"=>'if ($("#id_dataset_includedInDataCatalog").val()) { schema["isBasedOnUrl"]=$("#id_dataset_isBasedOnUrl").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_includedInDataCatalog",
	"label"=>"Naam datacatalogus waar dataset onderdeel van uitmaakt",
	"example"=>"http://www.example.com/2",
	"property_uri"=>"schema:includedInDataCatalog",
	"range"=>"xml:string",
	"title"=>"The URI of the data catalog in which the dataset is included",
	"script_schema"=>'if ($("#id_dataset_includedInDataCatalog").val()) { schema["includedInDataCatalog"]={};  schema["includedInDataCatalog"]["@type"]="DataCatalog"; schema["includedInDataCatalog"]["url"]=$("#id_dataset_includedInDataCatalog").val(); }'
);
	  
$datasetfields[]=array(
	"id"=>"dataset_distribution",
	"label"=>"Distributie",
	"mandatory"=>1,
	"multiple"=>1,
	"property_uri"=>"schema:DataDownload",
	"range"=>"schema:DataDownload",
	"title"=>"This property links the Dataset to an available Distribution."
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
	"title"=>"Actual bytes of the media object, for example the image file or video file.",
	"script_schema"=>'distribution["contentUrl"]={}; distribution["contentUrl"]=$("#id_distribution_"+dataset_idx+"_accessURL").val();'
);

$distributionfields[]=array(
	"id"=>"distribution_0_encodingFormat",
	"label"=>"Formaat",
	"example"=>"http://publications.europa.eu/resource/authority/file-type/RDF_TURTLE",
	"mandatory"=>1,
	"multiple"=>1,
	"property_uri"=>"schema:encodingFormat",
	"select"=>"mdr_filetype_nal",
	"range"=>"mdr:filetype",
	"title"=>"Media type typically expressed using a MIME format (see IANA site and MDN reference) e.g. application/zip for a SoftwareApplication binary, audio/mpeg for .mp3 etc.).",
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_encodingFormat_0").val()) {
var encodingFormat_idx=0; distribution["encodingFormat"]=[]; while ($("#id_distribution_"+dataset_idx+"_encodingFormat_"+encodingFormat_idx).val()) { distribution["encodingFormat"].push($("#id_distribution_"+dataset_idx+"_encodingFormat_"+encodingFormat_idx).val()); encodingFormat_idx++; }}'
);

$distributionfields[]=array(
	"id"=>"distribution_0_name",
	"label"=>"Naam/soort",
	"example"=>"SPARQL-endpoint",
	"mandatory"=>1,
	"property_uri"=>"schema:name",  // alternatief "schema:conditionsOfAccess"
	"range"=>"xml:string",
	"title"=>"Een identifier die duidelijk maakt op welke manier gegevens beschikbaar worden gesteld: via een SPARQL-endpoint, OAI-PMH-endpoint, LDF-endpoint of een datadump.",
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_name").val()) { distribution["name"]=$("#id_distribution_"+dataset_idx+"_name").val(); }'
);

$distributionfields[]=array(
	"id"=>"distribution_0_license",
	"label"=>"Licentie",
	"example"=>"http://creativecommons.org/publicdomain/zero/1.0/deed.nl",
	"property_uri"=>"schema:license",
	"range"=>"DONL:License",
	"select"=>"donl_license",
	"title"=>"A license document that applies to this content, typically indicated by URL.",
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_license").val() != "") { distribution["license"]=$("#id_distribution_"+dataset_idx+"_license").val(); }'
);

$distributionfields[]=array(
	"id"=>"distribution_0_description",
	"label"=>"Omschrijving",
	"example"=>"Heleboel triple statements",
	"property_uri"=>"schema:description",
	"range"=>"xml:string",
	"mandatory"=>0,
	"title"=>"This property contains a free-text account of the Distribution. This property can be repeated for parallel language versions of the description.",
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
	"title"=>"The language of the content or performance or used in an action. Please use one of the language codes from the IETF BCP 47 standard.",
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
	"title"=>"This property contains the most recent date on which the distribution was published.",
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_datePublished").val()) { distribution["datePublished"]=$("#id_distribution_"+dataset_idx+"_datePublished").val(); }'
);

$distributionfields[]=array(
	"id"=>"distribution_0_dateModified",
	"label"=>"Wijzigingsdatum",
	"example"=>"2020-03-28T04:05",
	"property_uri"=>"schema:dateModified", 
	"range"=>"xsd:datetime", // or Date
	"title"=>"This property contains the most recent date on which the distribution was changed or modified.",
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_dateModified").val()) { distribution["dateModified"]=$("#id_distribution_"+dataset_idx+"_dateModified").val(); }'
);

$distributionfields[]=array(
	"id"=>"distribution_0_contentSize",
	"label"=>"Bestandsgrootte",
	"example"=>"123456",
	"property_uri"=>"schema:contentSize",
	"range"=>"xml:string",
	"title"=>"File size in (mega/kilo) bytes.",
	"script_schema"=>'distribution["contentSize"]={}; distribution["contentSize"]=$("#id_distribution_"+dataset_idx+"_contentSize").val();'
);

$contactPointfields=array();