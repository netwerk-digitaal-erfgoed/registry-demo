<?php

define('LANGUAGE','nl-NL');

/* schema.org/Dataset */

$datasetfields=array();

$datasetfields[]=array(
	"id"=>"dataset_identifier",
	"example"=>"http://archief.io/id/B8CA13423A834E8CB9C23DF85F239E31",
	"label"=>t("Identificatie"),
	"property_uri"=>"schema:identifier",
	"mandatory"=>1,
	"range"=>"xsd:anyURI",
	"title"=>t('De unieke identificatie (URI) van de datasetbeschrijving'),
	"description"=>"",
	"script_schema"=>'if ($("#id_dataset_identifier").val()) { schema["@id"]=$("#id_dataset_identifier").val(); schema["identifier"]=$("#id_dataset_identifier").val(); }',
	"screen"=>1
);

$datasetfields[]=array(
	"id"=>"dataset_name",
	"label"=>t("Naam"),
	"example"=>"Voorbeeld dataset",
	"property_uri"=>"schema:name",
	"mandatory"=>1,
	"range"=>"xml:string",
	"title"=>t("De naam van de dataset"),
	"script_schema"=>'if ($("#id_dataset_name").val()) { schema["name"]=$("#id_dataset_name").val(); }',
	"screen"=>1
);

$datasetfields[]=array(
	"id"=>"dataset_license",
	"label"=>t("Licentie"),
	"example"=>"https://creativecommons.org/publicdomain/zero/1.0/",
	"mandatory"=>1,
	"property_uri"=>"schema:license",
	"range"=>"DONL:License",
	"select"=>"donl_license",
	"title"=>t("De licentie die van toepassing is op de dataset"),
	"script_schema"=>'if ($("#id_dataset_license").val() != "") { schema["license"]=$("#id_dataset_license").val(); }',
	"screen"=>1
);

#$datasetfields[]=array(
#	"id"=>"dataset_publisher",
#	"label"=>t("Verstrekker"),
#	"example"=>"http://standaarden.overheid.nl/owms/terms/Nationaal_Archief",
#	"property_uri"=>"schema:publisher",
#	"mandatory"=>1,
#	"range"=>"donl:authority",
#	"select"=>"donl_organization",
#	"title"=>t("De uitgever (publisher) van de dataset"),
#	"script_schema"=>'if ($("#id_dataset_publisher").val()) { var publisher={}; publisher["@id"]=$("#id_dataset_publisher").val(); publisher["@type"]="Organization"; publisher["name"]=$("#id_dataset_publisher option:selected").text(); schema["publisher"]=publisher; }',
#	"screen"=>1
#);

$datasetfields[]=array(
	"id"=>"dataset_publisher_uri",
	"label"=>t("Verstrekker URI"),
	"example"=>"https://www.museum.nl/",
	"mandatory"=>1,
	"property_uri"=>"schema:publisher",	
	"range"=>"xsd:anyURI",
#	"select"=>"donl_organization",
	"title"=>t("De URI van de organisatie die de verstrekker (publisher) van de dataset is"),
	"script_schema"=>'schema["publisher"]={}; schema["publisher"]["@type"]="Organization"; schema["publisher"]["@id"]=$("#id_dataset_publisher_uri").val();',
	"screen"=>1
);

$datasetfields[]=array(
	"id"=>"dataset_publisher_name",
	"label"=>t("Verstrekker naam"),
	"example"=>"Museum De Lier",
	"mandatory"=>1,
	"property_uri"=>"schema:publisher",	
	"range"=>"xml:string",
#	"select"=>"donl_organization",
	"title"=>t("De naam van de organisatie die de verstrekker (publisher) van de dataset is"),
	"script_schema"=>'schema["publisher"]["name"]=$("#id_dataset_publisher_name").val();',
	"screen"=>1
);


#-----

$datasetfields[]=array(
	"id"=>"dataset_description",
	"label"=>t("Beschrijving"),
	"example"=>"Door het formulier vooringevulde, vaste waarden om het testen te vereenvoudigen.",
	"property_uri"=>"schema:description",
	"mandatory"=>0,
	"large"=>1,
	"range"=>"xml:string",
	"title"=>t("De 'wervende' beschrijving van de inhoud van de dataset"),
	"script_schema"=>'if ($("#id_dataset_description").val()) { schema["description"]=$("#id_dataset_description").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_metadataLanguage",
	"label"=>t("Taal metadata"),
	"example"=>"nl",
	"property_uri"=>"schema:InLanguage",
	"mandatory"=>0,
	"select"=>"bcp47_language",
	"range"=>"bcp47:language",
	"title"=>t("De IETF BCP 47 standaard taalcode van in de beschrijving gebruikte taal"),
	"script_schema"=>'if ($("#id_dataset_metadataLanguage").val() != "") { schema["inLanguage"]=$("#id_dataset_metadataLanguage").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_contactPointPublisher_name",
	"label"=>t("Verstrekker contact Naam"),
	"example"=>"T. Ester",
	"property_uri"=>"schema:name",
	"range"=>"xml:string",
	"title"=>t("Naam van de contactpersoon bij de verstrekker van de dataset"),
	"script_schema"=>'if ($("#id_dataset_contactPointPublisher_name").val()) { if (schema["publisher"]["contactPoint"]===undefined) { schema["publisher"]["contactPoint"]={}; } schema["publisher"]["contactPoint"]["@type"]="ContactPoint"; schema["publisher"]["contactPoint"]["name"]=$("#id_dataset_contactPointPublisher_name").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_contactPointPublisher_email",
	"label"=>t("Verstrekker contact E&#8209;mail"),
	"example"=>"voorbeeld@nde.nl",
	"property_uri"=>"schema:email",
	"range"=>"xml:string",
	"title"=>t("E-mail van de contactpersoon bij de verstrekker van de dataset"),
	"script_schema"=>'if ($("#id_dataset_contactPointPublisher_email").val()) { if (schema["publisher"]["contactPoint"]===undefined) { schema["publisher"]["contactPoint"]={}; } schema["publisher"]["contactPoint"]["@type"]="ContactPoint"; schema["publisher"]["contactPoint"]["email"]=$("#id_dataset_contactPointPublisher_email").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_contactPointPublisher_phone",
	"label"=>t("Verstrekker contact Telefoon"),
	"example"=>"088-1234567",
	"property_uri"=>"schema:telephone",
	"range"=>"xml:string",
	"title"=>t("Telefoonnummer van de contactpersoon bij de verstrekker van de dataset"),
	"script_schema"=>'if ($("#id_dataset_contactPointPublisher_phone").val()) { if (schema["publisher"]["contactPoint"]===undefined) { schema["publisher"]["contactPoint"]={}; } schema["publisher"]["contactPoint"]["@type"]="ContactPoint"; schema["publisher"]["contactPoint"]["telephone"]=$("#id_dataset_contactPointPublisher_phone").val(); }',
	"screen"=>2
);

#$datasetfields[]=array(
#	"id"=>"dataset_creator",
#	"label"=>t("Data-eigenaar"),
#	"example"=>"http://standaarden.overheid.nl/owms/terms/Ministerie_van_Onderwijs,_Cultuur_en_Wetenschap",
#	"mandatory"=>0,
#	"property_uri"=>"schema:creator",	
#	"range"=>"donl:authority",
#	"select"=>"donl_organization",
#	"title"=>t("De maker (creator) of eigenaar van de dataset"),
#	"script_schema"=>'if ($("#id_dataset_creator").val()) { schema["creator"]={}; schema["creator"]["@type"]="Organization"; schema["creator"]["name"]=$("#id_dataset_creator option:selected").text(); schema["creator"]["@id"]=$("#id_dataset_creator").val(); }',
#	"screen"=>2
#);

$datasetfields[]=array(
	"id"=>"dataset_creator_uri",
	"label"=>t("Data-eigenaar URI"),
	"example"=>"https://www.museum.nl/",
	"mandatory"=>0,
	"property_uri"=>"schema:creator",	
	"range"=>"xsd:anyURI",
#	"select"=>"donl_organization",
	"title"=>t("De URI van de organisatie die maker (creator) of eigenaar van de dataset is"),
	"script_schema"=>'if ($("#id_dataset_creator_uri").val()) { if (schema["creator"]===undefined) { schema["creator"]={}; schema["creator"]["@type"]="Organization"; } schema["creator"]["@id"]=$("#id_dataset_creator_uri").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_creator_name",
	"label"=>t("Data-eigenaar naam"),
	"example"=>"Museum De Lier",
	"mandatory"=>0,
	"property_uri"=>"schema:creator",	
	"range"=>"xml:string",
#	"select"=>"donl_organization",
	"title"=>t("De naam van de organisatie die maker (creator) of eigenaar van de dataset is"),
	"script_schema"=>'if ($("#id_dataset_creator_name").val()) { if (schema["creator"]===undefined) { schema["creator"]={}; schema["creator"]["@type"]="Organization"; } schema["creator"]["name"]=$("#id_dataset_creator_name").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_contactPointCreator_name",
	"label"=>t("Data-eigenaar contact Naam"),
	"example"=>"T. Ester",
	"property_uri"=>"schema:name",
	"range"=>"xml:string",
	"title"=>t("Naam van de contactpersoon bij de maker van de dataset"),
	"script_schema"=>'if ($("#id_dataset_contactPointCreator_name").val()) { if (schema["creator"]===undefined) { schema["creator"]={}; schema["creator"]["@type"]="Organization"; } if (schema["creator"]["contactPoint"]===undefined) {  schema["creator"]["contactPoint"]={}; } schema["creator"]["contactPoint"]["@type"]="ContactPoint"; schema["creator"]["contactPoint"]["name"]=$("#id_dataset_contactPointCreator_name").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_contactPointCreator_email",
	"label"=>t("Data-eigenaar contact E&#8209;mail"),
	"example"=>"voorbeeld@nde.nl",
	"property_uri"=>"schema:email",
	"range"=>"xml:string",
	"title"=>t("E-mail van de contactpersoon bij de maker van de dataset"),
	"script_schema"=>'if ($("#id_dataset_contactPointCreator_email").val()) { if (schema["creator"]===undefined) { schema["creator"]={}; schema["creator"]["@type"]="Organization"; } if (schema["creator"]["contactPoint"]===undefined) { schema["creator"]["contactPoint"]={}; } schema["creator"]["contactPoint"]["@type"]="ContactPoint"; schema["creator"]["contactPoint"]["email"]=$("#id_dataset_contactPointCreator_email").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_contactPointCreator_phone",
	"label"=>t("Data-eigenaar contact Telefoon"),
	"example"=>"088-1234567",
	"property_uri"=>"schema:telephone",
	"range"=>"xml:string",
	"title"=>t("Telefoonnummer van de contactpersoon bij de maker van de dataset"),
	"script_schema"=>'if ($("#id_dataset_contactPointCreator_phone").val()) { if (schema["creator"]===undefined) { schema["creator"]={}; schema["creator"]["@type"]="Organization"; } if (schema["creator"]["contactPoint"]===undefined) { schema["creator"]["contactPoint"]={}; } schema["creator"]["contactPoint"]["@type"]="ContactPoint"; schema["creator"]["contactPoint"]["telephone"]=$("#id_dataset_contactPointCreator_phone").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_mainEntityOfPage",
	"label"=>t("Meer informatie"),
	"example"=>"https://demo.netwerkdigitaalerfgoed.nl/datasets/kb/2.html",
	"property_uri"=>"schema:mainEntityOfPage",
	"multiple"=>1,
	"range"=>"xsd:anyURI",
	"title"=>t("Webpagina met meer informatie over de dataset"),
	"script_schema"=>'if ($("#id_dataset_mainEntityOfPage_0").val()) { var mainEntityOfPage_idx=0; schema["mainEntityOfPage"]=[]; while ($("#id_dataset_mainEntityOfPage_"+mainEntityOfPage_idx).val()) { schema["mainEntityOfPage"].push($("#id_dataset_mainEntityOfPage_"+mainEntityOfPage_idx).val()); mainEntityOfPage_idx++; }}',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_dateCreated",
	"label"=>t("Creatiedatum"),
	"example"=>"2020-03-30T04:05",
	"property_uri"=>"schema:dateCreated",
	"range"=>"xsd:datetime", // of xsd:date
	"title"=>t("Datum waarom de dataset is aangemaakt"),
	"script_schema"=>'if ($("#id_dataset_dateCreated").val()) { schema["dateCreated"]=$("#id_dataset_dateCreated").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_datePublished",
	"label"=>t("Publicatiedatum"),
	"example"=>substr(date("c"),0,16),  # "2020-03-30T04:05"
	"property_uri"=>"schema:datePublished",
	"range"=>"xsd:datetime", // of xsd:date
	"title"=>t("Datum waarop de dataset is gepubliceerd"),
	"script_schema"=>'if ($("#id_dataset_datePublished").val()) { schema["datePublished"]=$("#id_dataset_datePublished").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_dateModified",
	"label"=>t("Wijzigingsdatum"),
	"example"=>"2020-03-31T04:05",
	"property_uri"=>"schema:dateModified",
	"range"=>"xsd:datetime", // of xsd:date
	"title"=>t("Datum waarop de dataset voor het laatst is bijgewerkt"),
	"script_schema"=>'if ($("#id_dataset_dateModified").val()) { schema["dateModified"]=$("#id_dataset_dateModified").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_version",
	"label"=>t("Versie"),
	"example"=>"4",
	"property_uri"=>"schema:version",
	"range"=>"xml:string",
	"title"=>t("De versie van de dataset"),
	"script_schema"=>'if ($("#id_dataset_version").val()) { schema["version"]=$("#id_dataset_version").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_keyword",
	"label"=>t("Tag"),
	"example"=>"Test",
	"property_uri"=>"schema:keywords",
	"multiple"=>1,
	"range"=>"xml:string",
	"title"=>t("Steekwoord (keyword/tag) die de dataset beschrijft"),
	"script_schema"=>'if ($("#id_dataset_keyword_0").val()) { var keyword_idx=0; schema["keywords"]=[]; while ($("#id_dataset_keyword_"+keyword_idx).val()) { schema["keywords"].push($("#id_dataset_keyword_"+keyword_idx).val()); keyword_idx++; }}',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_genre",
	"label"=>t("Genre"),
	"example"=>"Cultuur",
	"property_uri"=>"schema:genre",
	"multiple"=>1,
#	"select"=>"overheid_taxonomiebeleidsagenda",
#	"range"=>"overheid:taxonomiebeleidsagenda",
	"range"=>"xml:string",
	"title"=>t("Genre(s) waarbinnen de dataset valt"),
	"description"=>"Een of meer genres waarbinnen de dataset passend is. Kies bijvoorbeeld een genre uit de Activiteitenindex (of Taxonomie Beleidsagenda), beheert door KOOP, via https://standaarden.overheid.nl/owms/terms/TaxonomieBeleidsagenda.html.",
	"script_schema"=>'if ($("#id_dataset_genre_0").val()) { var genre_idx=0; schema["genre"]=[]; while ($("#id_dataset_genre_"+genre_idx).val()) { schema["genre"].push($("#id_dataset_genre_"+genre_idx).val()); genre_idx++; }}',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_citation",
	"label"=>t("Bronvermelding"),
	"example"=>"Oorspronkelijk uit boek A uit archief B inventaris C",
	"property_uri"=>"schema:citation",
	"range"=>"xml:string",
	"title"=>t("Een vermelding of referentie naar een andere creatief werk"),
	"script_schema"=>'if ($("#id_dataset_citation").val()) { schema["citation"]=$("#id_dataset_citation").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_spatialCoverage",
	"label"=>t("Dekking plaats/gebied"),
	"example"=>"Nederland",
	"property_uri"=>"schema:spatialCoverage",
	"range"=>"xml:string",
	"title"=>t("Plaats of gebied waar de dataset betrekking op heeft"),
	"script_schema"=>'if ($("#id_dataset_spatialCoverage").val()) { schema["spatialCoverage"]=$("#id_dataset_spatialCoverage").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_temporalCoverage",
	"label"=>t("Dekking tijd/periode"),
	"example"=>"1900-2000",
	"property_uri"=>"schema:temporalCoverage",
	"range"=>"xml:string",
	"title"=>t("Tijdsperiode waar de dataset betrekking op heeft"),
	"script_schema"=>'if ($("#id_dataset_temporalCoverage").val()) { schema["temporalCoverage"]=$("#id_dataset_temporalCoverage").val(); }',
	"screen"=>2
);

$datasetfields[]=array(
	"id"=>"dataset_isBasedOnUrl",
	"label"=>t("URI dataset waar deze dataset op is gebaseerd"),
	"example"=>"http://www.example.com/1",
	"property_uri"=>"schema:isBasedOnUrl",
	"range"=>"xsd:anyURI",
	"title"=>t("De URI van de dataset waar deze dataset op is gebaseerd"),
	"script_schema"=>'if ($("#id_dataset_isBasedOnUrl").val()) { schema["isBasedOnUrl"]=$("#id_dataset_isBasedOnUrl").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_includedInDataCatalog",
	"label"=>t("Naam datacatalogus waar dataset onderdeel van uitmaakt"),
	"example"=>"http://www.example.com/2",
	"property_uri"=>"schema:includedInDataCatalog",
	"range"=>"xml:string",
	"title"=>t("De URI van de datacatalogus waar deze dataset deel van uit maakt"),
	"script_schema"=>'if ($("#id_dataset_includedInDataCatalog").val()) { schema["includedInDataCatalog"]=$("#id_dataset_includedInDataCatalog").val(); }',
	"screen"=>2
);

# ----

$datasetfields[]=array(
	"id"=>"dataset_distribution",
	"label"=>t("Distributie"),
	"mandatory"=>0,
	"multiple"=>1,
	"property_uri"=>"schema:DataDownload",
	"range"=>"schema:DataDownload",
	"title"=>t("Deze waarde linkt the dataset met de beschikbare distributie(s)"),
	"screen"=>3
);


/* schema.org/DataDownload */

$distributionfields=array();

$distributionfields[]=array(
	"id"=>"distribution_0_accessURL",
	"label"=>t("URL"),
	"example"=>"http://archief.io/dataset/B8CA13423A834E8CB9C23DF85F239E31",
	"class"=>"distribution_first",
	"property_uri"=>"schema:contentUrl",
	"mandatory"=>1,
	"range"=>"xsd:anyURI",
	"title"=>t("Het adres waar de datasetdistributie benaderd kan worden"),
	"script_schema"=>'distribution["contentUrl"]={}; distribution["contentUrl"]=$("#id_distribution_"+dataset_idx+"_accessURL").val();'
);

$distributionfields[]=array(
	"id"=>"distribution_0_encodingFormat",
	"label"=>t("Formaat"),
	"example"=>"application/sparql-results+json",
	"mandatory"=>1,
	"multiple"=>1,
	"property_uri"=>"schema:encodingFormat",
	"select"=>"iana_mediatypes",
	"range"=>"dcat:mediaType",
	"title"=>t("Media type (MIME formaat)"),
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_encodingFormat_0").val()) { var encodingFormat_idx=0; distribution["encodingFormat"]=[]; while ($("#id_distribution_"+dataset_idx+"_encodingFormat_"+encodingFormat_idx).val()) { distribution["encodingFormat"].push($("#id_distribution_"+dataset_idx+"_encodingFormat_"+encodingFormat_idx).val()); encodingFormat_idx++; }}'
);

$distributionfields[]=array(
	"id"=>"distribution_0_name",
	"label"=>t("Soort"),
	"mandatory"=>1,
	"property_uri"=>"schema:name",  // alternatief "schema:conditionsOfAccess"
	"example"=>"SPARQL-endpoint",
	"range"=>"xml:string",
	"title"=>t("Een identifier die duidelijk maakt op welke manier gegevens beschikbaar worden gesteld, zoals: SPARQL-endpoint, OAI-PMH-endpoint, LDF-endpoint, (gecomprimeerde) datadump"),
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_name").val()) { distribution["name"]=$("#id_distribution_"+dataset_idx+"_name").val(); }'
	
#	"example"=>"http://netwerkdigitaalerfgoed.nl/def/soort#datadump",
#	"range"=>"DONL:License",
#	"title"=>t("Soort datadistributie"),
#	"select"=>"naam-soort",
#	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_name").val() != "") { distribution["name"]=$("#id_distribution_"+dataset_idx+"_name").val(); }'
		
);

$distributionfields[]=array(
	"id"=>"distribution_0_license",
	"label"=>t("Licentie"),
	"example"=>"https://creativecommons.org/publicdomain/zero/1.0/",
	"property_uri"=>"schema:license",
	"range"=>"DONL:License",
	"select"=>"donl_license",
	"title"=>t("Licentie (URI) die van toepassing is op de dataset"),
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_license").val() != "") { distribution["license"]=$("#id_distribution_"+dataset_idx+"_license").val(); }'
);

$distributionfields[]=array(
	"id"=>"distribution_0_description",
	"label"=>t("Omschrijving"),
	"example"=>"Heleboel triple statements",
	"property_uri"=>"schema:description",
	"range"=>"xml:string",
	"mandatory"=>0,
	"large"=>1,
	"title"=>t("Beschrijving van de datasetdistributie"),
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_description").val()) { distribution["description"]=$("#id_distribution_"+dataset_idx+"_description").val(); }'
);

$distributionfields[]=array(
	"id"=>"distribution_0_inLanguage",
	"label"=>t("Taal"),
	"example"=>"nl",
	"property_uri"=>"schema:inLanguage",
	"mandatory"=>0,
	"multiple"=>1,
	"select"=>"bcp47_language",
	"range"=>"bcp47:language",
	"title"=>t("De IETF BCP 47 standaard taalcode van in de datasetdistributie gebruikte taal"),
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_inLanguage_0").val()!="") { distribution["inLanguage"]=$("#id_distribution_"+dataset_idx+"_inLanguage_0").val(); }'
);

$distributionfields[]=array(
	"id"=>"distribution_0_datePublished",
	"label"=>t("Publicatiedatum"),
	"example"=>substr(date("c"),0,16),  # "2020-03-30T04:05"
	"property_uri"=>"schema:datePublished",
	"range"=>"xsd:datetime", // or Date
	"title"=>t("Datum waarop de datasetdistributie is gepubliceerd"),
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_datePublished").val()) { distribution["datePublished"]=$("#id_distribution_"+dataset_idx+"_datePublished").val(); }'
);

$distributionfields[]=array(
	"id"=>"distribution_0_dateModified",
	"label"=>t("Wijzigingsdatum"),
	"example"=>"2020-03-28T04:05",
	"property_uri"=>"schema:dateModified", 
	"range"=>"xsd:datetime", // or Date
	"title"=>t("Datum waarop de datasetdistributie voor het laatste is bijgewerkt"),
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_dateModified").val()) { distribution["dateModified"]=$("#id_distribution_"+dataset_idx+"_dateModified").val(); }'
);

$distributionfields[]=array(
	"id"=>"distribution_0_contentSize",
	"label"=>t("Bestandsgrootte"),
	"example"=>"123456",
	"property_uri"=>"schema:contentSize",
	"range"=>"xml:string",
	"title"=>t("Grootte van het bestand in bytes"),
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_contentSize").val()) { distribution["contentSize"]={}; distribution["contentSize"]=$("#id_distribution_"+dataset_idx+"_contentSize").val(); }'
);

$contactPointfields=array();