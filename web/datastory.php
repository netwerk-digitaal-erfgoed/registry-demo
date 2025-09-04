<?php 

include("includes/search.php"); 
include("includes/header.php"); 

$lang="nl";
if(isset($_GET["lang"]) && $_GET["lang"]=="en") { $lang="en"; } 
# TODO make queries bilingual
?>
<link href="/assets/stories.min.css" rel="stylesheet" type="text/css">
<link href="/assets/yasgui.bootstrap.css" rel="stylesheet" type="text/css">
<style>
table {font-size:1.5em!important}
.dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_paginate, .dataTables_wrapper .dataTables_processing { color: #be2c00; font-size: 1.5em; }
.yasr .dataTables_wrapper div.dataTables_paginate.paging_simple_numbers a.paginate_button { border: none; background: transparent; color: #be2c00!important; }
.yasr .svgImg svg { fill: #be2c00; }
th:first-child{ width:20px!important }
</style>

<main class="story" data-endpoint="https://datasetregister.netwerkdigitaalerfgoed.nl/sparql">
	<div class="o-container o-container__small m-t-space">
		<h1 class="title--l"><?= t('Datasetregister datastory') ?></h1>

		<h2><?= t('Inzicht in erfgoeddatasets') ?></h2>
		<p><?= t('De bij het NDE Datasetregister aangemelde datasetbeschrijvingen worden geharvest en samengebracht in een openbare triplestore. Het doel van het datasetregister is om de vindbaarheid van datasets (API\'s en bestanden/dumps) te vergroten. Ben je op zoek naar een dataset, ga dan naar de <a href="https://triplestore.netwerkdigitaalerfgoed.nl/">triplestore van het Datasetregister</a> en doorzoek de datasetbeschrijvingen via SPARQL. Lees de <a href="datamodel.php">uitleg van de dataconcepten</a> en de <a href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/">Requirements voor Datasets</a> voor gebruikte RDF klassen en eigenschappen.') ?></p>

		<h2><?= t('SPARQL\'n maar!') ?></h2>
		<p><?= t('Om je op weg te helpen geven we je hier enkele voorbeeld SPARQL-queries. Klik op de rode "pijl-omhoog" om de betreffende SPARQL-query te tonen. Je kunt deze ook aanpassen en opnieuw uitvoeren! Klik op een kolomkop om op de betreffende kolom te sorteren.') ?></p>

		<h2><?= t('Welke Linked Dataset zijn als datadumps beschikbaar?') ?></h2>
		<p><?= t('De onderstaande tabel geeft een overzicht van alle datasets die in een Linked Data format te downloaden zijn:') ?></p>
	</div>

	<section class="m-t-quarter-space m-theme-bg m-theme--teal search-div"><div class="o-container no-container__small">
		<query data-config="https://api.triplydb.com/s/Am2yY73bK"></query>
	</div></section>

	<div class="o-container o-container__small m-t-space">
		<h2><?= t('Welke Linked Dataset zijn via een SPARQL-endpoint bevraagbaar?') ?></h2>
		<p><?= t('De onderstaande tabel geeft een overzicht van alle datasets die via een SPARQL endpoint bevraagbaar zijn:') ?></p>
	</div>

	<section class="m-t-quarter-space m-theme-bg m-theme--teal search-div"><div class="o-container no-container__small">
		<query data-config="https://api.triplydb.com/s/4hzRQIFRP"></query>
	</div></section>

	<div class="o-container o-container__small m-t-space">
		<h2><?= t('Wanneer zijn de dataset beschrijvingen van de Linked Dataset voor het laatst succesvol opgehaald?') ?></h2>
		<p><?= t('De onderstaande tabel geeft wat een algemene informatie over de beschikbare Linked Datasets inclusief de laatste keer dat de datasetbeschrijving succesvol opgehaald is:') ?></p>
	</div>

	<section class="m-t-quarter-space m-theme-bg m-theme--teal search-div"><div class="o-container no-container__small">
		<query data-config="https://api.triplydb.com/s/Dt1eLnR8C"></query>
	</div></section>

	<div class="o-container o-container__small m-t-space">
		<h2><?= t('Welke erfgoedinstellingen bieden hoeveel datasets?') ?></h2>
		<p><?= t('Het volgende overzicht laat zien welke organisaties datasets (API/datadumps) beschikbaar stellen (in de rol van uitgever):') ?></p>
	</div>

	<section class="m-t-quarter-space m-theme-bg m-theme--teal search-div"><div class="o-container no-container__small">
		<query data-config="https://demo.netwerkdigitaalerfgoed.nl/hackalod/datasetregister/#query=PREFIX%20dct%3A%20%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%0APREFIX%20foaf%3A%20%3Chttp%3A%2F%2Fxmlns.com%2Ffoaf%2F0.1%2F%3E%0ASELECT%20DISTINCT%20%3Fname%20(count(distinct%20%3Fs)%20as%20%3Fcount)%20WHERE%20%7B%0A%20%20%3Fs%20dct%3Apublisher%20%3Fo%20.%0A%20%20%3Fo%20foaf%3Aname%20%3Fname%0A%7D%20GROUP%20BY%20%3Fname%20ORDER%20BY%20DESC(%3Fcount)&endpoint=https%3A%2F%2Ftriplestore.netwerkdigitaalerfgoed.nl%2Frepositories%2Fregistry&requestMethod=POST&tabTitle=Query%2019&headers=%7B%7D&contentTypeConstruct=text%2Fturtle%2C*%2F*%3Bq%3D0.9&contentTypeSelect=application%2Fsparql-results%2Bjson%2C*%2F*%3Bq%3D0.9&outputFormat=table&outputSettings=%7B%22pageSize%22%3A10%7D"></query>
	</div></section>

	<div class="o-container o-container__small m-t-space">
		<h2 id="opdekaart"><?= t('Waar zijn de erfgoedinstellingen gevestigd?') ?></h2>
		<p><?= t('De onderstaande kaart toont de vestigingsplaatsen van de erfgoedinstellingen(in de rol van maker of uitgever):') ?></p>
	</div>

	<section class="m-t-quarter-space m-theme-bg m-theme--teal search-div"><div class="o-container no-container__small">
		<query data-config="https://api.triplydb.com/s/PU2B2RNU6"></query>
	</div></section>

	<div class="o-container o-container__small m-t-space">
		<h2><?= t('Welke datasets worden er geboden?') ?></h2>
		<p><?= t('Het volgende overzicht laat de titels zien van de beschikbare datasets:') ?></p>
	</div>

	<section class="m-t-quarter-space m-theme-bg m-theme--teal search-div"><div class="o-container no-container__small">
		<query data-config="https://api.triplydb.com/s/IGg0TwpwW"></query>
	</div></section>

	<div class="o-container o-container__small m-t-space">
		<h2><?= t('Onder welke licentie worden de datasets beschikbaar gesteld?') ?></h2>
		<p><?= t('Voor hergebruik van data zijn open licentievormen van belang, maar ook "gesloten" datasets (vanwege auteursrecht of privacy) kunnen opgenomen worden in het Datasetregister:') ?></p>
	</div>

	<section class="m-t-quarter-space m-theme-bg m-theme--teal search-div"><div class="o-container no-container__small">
		<query data-config="https://demo.netwerkdigitaalerfgoed.nl/hackalod/datasetregister/#query=PREFIX%20dcat%3A%20%3Chttp%3A%2F%2Fwww.w3.org%2Fns%2Fdcat%23%3E%0APREFIX%20dct%3A%20%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%0ASELECT%20%3Furl%20(count(distinct%20%3Fdataset)%20as%20%3Fcount)%20WHERE%20%7B%0A%20%20%20%20%7B%0A%20%20%20%20%20%20%20%20SELECT%20(IRI(%3Fname)%20AS%20%3Furl)%20%3Fdataset%20WHERE%20%7B%0A%20%20%20%20%20%20%20%20%20%20%20%20%3Fdataset%20a%20dcat%3ADataset%20.%0A%09%09%09%3Fdataset%20dct%3Alicense%20%3Fname%0A%09%09%09FILTER(isLiteral(%3Fname))%0A%09%09%7D%0A%20%20%20%20%7D%20UNION%20%7B%0A%20%20%20%20%20%20%20%20SELECT%20%3Furl%20%3Fdataset%20WHERE%20%7B%0A%20%20%20%20%20%20%20%20%20%20%20%20%3Fdataset%20a%20dcat%3ADataset%20.%0A%20%20%09%09%09%3Fdataset%20dct%3Alicense%20%3Flicense%20.%0A%20%20%09%09%09%3Flicense%20dct%3Aurl%20%3Furl%0A%20%20%20%20%20%20%20%20%20%20%20%20FILTER(isURI(%3Flicense))%0A%09%09%7D%20%0A%20%20%20%20%7D%20UNION%20%7B%0A%20%20%20%20%20%20%20%20SELECT%20%3Furl%20%3Fdataset%20WHERE%20%7B%0A%20%20%20%20%20%20%20%20%20%20%20%20%3Fdataset%20a%20dcat%3ADataset%20.%0A%20%20%20%20%20%20%20%20%20%20%20%20%3Fdataset%20dct%3Alicense%20%3Furl%0A%20%20%20%20%20%20%20%20%20%20%20%20FILTER(isIRI(%3Furl))%0A%20%20%20%20%20%20%20%20%7D%0A%20%20%20%20%7D%0A%7D%20GROUP%20BY%20%3Furl&endpoint=https%3A%2F%2Ftriplestore.netwerkdigitaalerfgoed.nl%2Frepositories%2Fregistry&requestMethod=POST&tabTitle=Query%2019&headers=%7B%7D&contentTypeConstruct=text%2Fturtle%2C*%2F*%3Bq%3D0.9&contentTypeSelect=application%2Fsparql-results%2Bjson%2C*%2F*%3Bq%3D0.9&outputFormat=gchart&outputSettings=%7B%22chartConfig%22%3A%7B%22options%22%3A%7B%22hAxis%22%3A%7B%22useFormatFromData%22%3Atrue%2C%22viewWindow%22%3A%7B%22max%22%3Anull%2C%22min%22%3Anull%7D%2C%22minValue%22%3Anull%2C%22maxValue%22%3Anull%7D%2C%22legacyScatterChartLabels%22%3Atrue%2C%22tooltip%22%3A%7B%22isHtml%22%3Atrue%7D%2C%22vAxes%22%3A%5B%7B%22useFormatFromData%22%3Atrue%2C%22viewWindow%22%3A%7B%22max%22%3Anull%2C%22min%22%3Anull%7D%2C%22minValue%22%3Anull%2C%22maxValue%22%3Anull%7D%2C%7B%22useFormatFromData%22%3Atrue%2C%22viewWindow%22%3A%7B%22max%22%3Anull%2C%22min%22%3Anull%7D%2C%22minValue%22%3Anull%2C%22maxValue%22%3Anull%7D%5D%2C%22is3D%22%3Afalse%2C%22pieHole%22%3A0.5%2C%22booleanRole%22%3A%22certainty%22%2C%22width%22%3A%22100%25%22%2C%22height%22%3A%22100%25%22%2C%22legend%22%3A%22left%22%7D%2C%22state%22%3A%7B%7D%2C%22view%22%3A%7B%22columns%22%3Anull%2C%22rows%22%3Anull%7D%2C%22isDefaultVisualization%22%3Afalse%2C%22chartType%22%3A%22PieChart%22%7D%7D"></query>
	</div></section>

	<div class="o-container o-container__small m-t-space">
		<h2><?= t('Hoe staat het met het aanbod van linked data?') ?></h2>
		<p><?= t('Het volgende overzicht laat zien in welke linked data distributievormen de datasets beschikbaar worden gemaakt:') ?></p>
	</div>

	<section class="m-t-quarter-space m-theme-bg m-theme--teal search-div"><div class="o-container no-container__small">
		<query data-config="https://demo.netwerkdigitaalerfgoed.nl/hackalod/datasetregister/#query=PREFIX%20dct%3A%20%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%0ASELECT%20DISTINCT%20%3Fformat%20(count(distinct%20%3Fdistribution)%20as%20%3FAantal)%20WHERE%20%7B%0A%20%20%3Fdistribution%20dct%3Aformat%20%3Fformat%0A%20FILTER(%0A%20%20%20%20%20%20%20%20%3Fformat%3D%22text%2Fturtle%22%20%7C%7C%20%3Fformat%3D%22application%2Fn-triples%22%20%7C%7C%20%3Fformat%3D%22application%2Fld%2Bjson%22%20%7C%7C%20%0A%20%20%20%20%20%20%20%20%3Fformat%3D%22application%2Frdf%2Bxml%22%20%7C%7C%20%3Fformat%3D%22application%2Fn-quads%22%20%7C%7C%20%3Fformat%3D%22text%2Fn3%22%20%7C%7C%20%0A%20%20%20%20%20%20%20%20%3Fformat%3D%22application%2Ftrig%22%20%7C%7C%20%3Fformat%3D%22application%2Fsparql-query%22%20%7C%7C%20%3Fformat%3D%22application%2Fvnd.hdt%22%0A%20%20%20%20)%0A%7D%20GROUP%20BY%20%3Fformat%20ORDER%20BY%20DESC(%3FAantal)&endpoint=https%3A%2F%2Ftriplestore.netwerkdigitaalerfgoed.nl%2Frepositories%2Fregistry&requestMethod=POST&tabTitle=Query%2019&headers=%7B%7D&contentTypeConstruct=text%2Fturtle%2C*%2F*%3Bq%3D0.9&contentTypeSelect=application%2Fsparql-results%2Bjson%2C*%2F*%3Bq%3D0.9&outputFormat=gchart&outputSettings=%7B%22chartConfig%22%3A%7B%22options%22%3A%7B%22legacyScatterChartLabels%22%3Atrue%2C%22tooltip%22%3A%7B%22isHtml%22%3Atrue%7D%2C%22isStacked%22%3Afalse%2C%22booleanRole%22%3A%22certainty%22%2C%22vAxes%22%3A%5B%7B%22minValue%22%3Anull%2C%22maxValue%22%3Anull%2C%22viewWindow%22%3Anull%2C%22viewWindowMode%22%3Anull%2C%22useFormatFromData%22%3Atrue%7D%2C%7B%22useFormatFromData%22%3Atrue%7D%5D%2C%22hAxis%22%3A%7B%22viewWindow%22%3A%7B%22max%22%3Anull%2C%22min%22%3Anull%7D%2C%22minValue%22%3Anull%2C%22maxValue%22%3Anull%2C%22useFormatFromData%22%3Atrue%7D%2C%22legend%22%3A%22right%22%2C%22width%22%3A%22100%25%22%2C%22height%22%3A%22100%25%22%7D%2C%22state%22%3A%7B%7D%2C%22view%22%3A%7B%22columns%22%3Anull%2C%22rows%22%3Anull%7D%2C%22isDefaultVisualization%22%3Afalse%2C%22chartType%22%3A%22BarChart%22%7D%7D"></query>
	</div></section>

	<div class="o-container o-container__small m-t-space">
		<h2><?= t('Welke distributies zijn het meest recent?') ?></h2>
		<p><?= t('Het volgende overzicht laat een top 50 zien van distributies die recent zijn gepubliceerd of bijgewerkt:') ?></p>
	</div>

	<section class="m-t-quarter-space m-theme-bg m-theme--teal search-div"><div class="o-container no-container__small">
		<query data-config="https://demo.netwerkdigitaalerfgoed.nl/hackalod/datasetregister/#query=PREFIX%20dct%3A%20%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%0APREFIX%20xsd%3A%20%3Chttp%3A%2F%2Fwww.w3.org%2F2001%2FXMLSchema%23%3E%0APREFIX%20dcat%3A%20%3Chttp%3A%2F%2Fwww.w3.org%2Fns%2Fdcat%23%3E%0ASELECT%20%3Fdataset%20%3FaccessURL%20%3Fformat%20%3Fsize%20%3Fmodified%20%20WHERE%20%7B%0A%20%20%20%20%3Fdataset%20dcat%3Adistribution%20%3Fdistribution%20.%0A%20%20%20%20%23%20%3Ftitle%20niet%20getoond%20vanwege%20breedte%20tabel%0A%20%20%20%20OPTIONAL%20%7B%0A%20%20%20%20%20%20%20%20%3Fdataset%20dct%3Atitle%20%3Ftitle%20FILTER%28langMatches%28lang%28%3Ftitle%29%2C%20%22nl%22%29%29%20%0A%20%20%20%20%7D%0A%20%20%20%20OPTIONAL%20%7B%0A%20%20%20%20%20%20%20%20%3Fdataset%20dct%3Atitle%20%3Ftitle%20FILTER%28langMatches%28lang%28%3Ftitle%29%2C%20%22en%22%29%29%20%0A%20%20%20%20%7D%0A%20%20%20%20OPTIONAL%20%7B%0A%20%20%20%20%20%20%20%20%3Fdataset%20dct%3Atitle%20%3Ftitle%20%0A%20%20%20%20%7D%20%0A%20%20%20%20%7B%0A%20%20%20%20%20%20%20%20%3Fdistribution%20dct%3Amodified%20%3Fm%20%3B%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20dcat%3AaccessURL%20%3FaccessURL%3B%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20dct%3Aformat%20%3Fformat.%0A%20%20%20%20%7D%20UNION%20%7B%0A%20%20%20%20%20%20%20%20%3Fdistribution%20dct%3Aissued%20%3Fm%20%3B%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20dcat%3AaccessURL%20%3FaccessURL%3B%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20dct%3Aformat%20%3Fformat.%0A%20%20%20%20%7D%0A%20%20%20%20OPTIONAL%20%7B%0A%20%20%20%20%20%20%20%20%3Fdistribution%20dcat%3AbyteSize%20%3Fsize%20%0A%20%20%20%20%7D%0A%20%20%20%20BIND%28SUBSTR%28STR%28%3Fm%29%2C1%2C10%29%20AS%20%3Fmodified%29%20%20%23%20kan%20%3Chttp%3A%2F%2Fschema.org%2FDate%3E%20of%20xsd%3Adate%20zijn%20...%0A%7D%20ORDER%20BY%20DESC%28%3Fmodified%29%20LIMIT%2050"></query>
	</div></section>

	<div class="o-container o-container__small m-t-space">
		<h2><?= t('Welke musea bieden linked data?') ?></h2>
		<p><?= t('Het volgende overzicht laat de linked data datasets zien van musea:') ?></p>
	</div>

	<section class="m-t-quarter-space m-theme-bg m-theme--teal search-div"><div class="o-container no-container__small">
		<query data-config="https://demo.netwerkdigitaalerfgoed.nl/hackalod/datasetregister/#query=PREFIX%20dcat%3A%20%3Chttp%3A%2F%2Fwww.w3.org%2Fns%2Fdcat%23%3E%0APREFIX%20dct%3A%20%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%0A%0ASELECT%20DISTINCT%20%3Fdataset%20%3Ftitle%20%3Fdescription%20WHERE%20%7B%0A%20%20%20%20%3Fdataset%20dct%3Atitle%20%3Ftitle%20.%0A%20%20%20%20%3Fdataset%20dct%3Adescription%20%3Fdescription%20.%0A%20%20%20%20%3Fdataset%20dcat%3Adistribution%20%3Fdistribution%20.%0A%20%20%20%20%3Fdistribution%20dct%3Aformat%20%3Fformat%20.%0A%20%20%20%20%23%20alleen%20linked%20data%20formaten%0A%20%20%20%20FILTER(%0A%20%20%20%20%20%20%20%20%3Fformat%3D%22text%2Fturtle%22%20%7C%7C%20%3Fformat%3D%22application%2Fn-triples%22%20%7C%7C%20%3Fformat%3D%22application%2Fld%2Bjson%22%20%7C%7C%20%0A%20%20%20%20%20%20%20%20%3Fformat%3D%22application%2Frdf%2Bxml%22%20%7C%7C%20%3Fformat%3D%22application%2Fn-quads%22%20%7C%7C%20%3Fformat%3D%22text%2Fn3%22%20%7C%7C%20%0A%20%20%20%20%20%20%20%20%3Fformat%3D%22application%2Ftrig%22%20%7C%7C%20%3Fformat%3D%22application%2Fsparql-query%22%0A%20%20%20%20)%0A%20%20%20%20%23%20de%20term%20museum%20komt%20(hoofdletterongevoelig)%20voor%20in%20de%20beschrijving%20van%20de%20dataset%0A%20%20%20%20FILTER%20REGEX(STR(%3Fdescription)%2C%20%22museum%22%2C%20%22i%22%20)%20.%0A%7D&endpoint=https%3A%2F%2Ftriplestore.netwerkdigitaalerfgoed.nl%2Frepositories%2Fregistry&requestMethod=POST&tabTitle=Query%2019&headers=%7B%7D&contentTypeConstruct=text%2Fturtle%2C*%2F*%3Bq%3D0.9&contentTypeSelect=application%2Fsparql-results%2Bjson%2C*%2F*%3Bq%3D0.9&outputFormat=table&outputSettings=%7B%22pageSize%22%3A10%7D"></query>
	</div></section>

	<div class="o-container o-container__small m-t-space">
		<h2><?= t('Welke data bevatten informatie uit bevolkingsregisters?') ?></h2>
		<p><?= t('Het volgende overzicht laat datasets zien die als keyword "bevolkingsregister" hebben:') ?></p>
	</div>

	<section class="m-t-quarter-space m-theme-bg m-theme--teal search-div"><div class="o-container no-container__small">
		<query data-config="https://demo.netwerkdigitaalerfgoed.nl/hackalod/datasetregister/#query=PREFIX%20dcat%3A%20%3Chttp%3A%2F%2Fwww.w3.org%2Fns%2Fdcat%23%3E%0APREFIX%20dct%3A%20%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%0A%0ASELECT%20DISTINCT%20%3Fdataset%20%3Ftitle%20%3Fdescription%20WHERE%20%7B%0A%20%20%20%20%3Fdataset%20dct%3Atitle%20%3Ftitle%20.%0A%20%20%20%20%3Fdataset%20dct%3Adescription%20%3Fdescription%20.%0A%20%20%20%20%3Fdataset%20dcat%3Akeyword%20%3Fkeyword%20.%0A%20%20%20%0A%20%20%20%20%23%20de%20term%20Bevolkingsregisters%20komt%20(hoofdletterongevoelig)%20voor%20als%20keyword%20bij%20de%20dataset%0A%20%20%20%20FILTER%20REGEX(STR(%3Fkeyword)%2C%20%22bevolkingsregister%22%2C%22i%22)%0A%7D&endpoint=https%3A%2F%2Ftriplestore.netwerkdigitaalerfgoed.nl%2Frepositories%2Fregistry&requestMethod=POST&tabTitle=Query%2019&headers=%7B%7D&contentTypeConstruct=text%2Fturtle%2C*%2F*%3Bq%3D0.9&contentTypeSelect=application%2Fsparql-results%2Bjson%2C*%2F*%3Bq%3D0.9&outputFormat=table&outputSettings=%7B%22pageSize%22%3A10%7D"></query>
	</div></section>
</main>

<script src="/assets/stories.min.js"></script>
<script>window.onload = function() {window.stories()};</script>
<?php include("includes/footer.php") ?>
