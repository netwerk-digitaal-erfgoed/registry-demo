<?php 

$dataset_uri='';
if (isset($_GET["uri"]) && filter_var($_GET["uri"], FILTER_VALIDATE_URL)) {
	$dataset_uri=$_GET["uri"];
} else  {
	header("Location: /");
	exit;
}

include("includes/search.php"); 
include("includes/header.php"); 

$lang="nl";
if(isset($_GET["lang"]) && $_GET["lang"]=="en") { $lang="en"; } 

?>
<style>
.sparqlbtn {
	border-left: 3px solid #be2c00;
    border-bottom: 3px solid #be2c00;
    padding: 5px 10px;
	font-size:1.6em;
	display:inline-block;
</style>
	
<main>
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
        <h1 class="title--l"><?= t('Datasetsamenvatting') ?></h1>
        <?php if (empty($dataset_uri)) { ?>
        <div class="m-theme-bg m-theme--teal search-div"><p><?= t('De opgegeven URI is ongeldig') ?>.</p></div>
        <?php } else { ?>
		<h3><?= htmlentities($dataset_uri,ENT_QUOTES) ?></h3>
        <?php } ?>
	   </div>
   </section>
   
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
        <h3 class="title--l"><?= t('Grootte') ?></h3>
		<table id="tableKGsize" class="props propskg">
			<thead><tr><th><?= t('Eenheid') ?></th><th><?= t('Aantal voorkomens') ?></th></tr></thead>
			<tbody></tbody>
		</table>
	   </div>
   </section>
   
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
        <h3 class="title--l"><?= t('Voorbeeld resources') ?></h3>
		<ul id="listKGexamples">
		</ul>
	   </div>
   </section>
 
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
        <h3 class="title--l"><?= t('Uitgaande links naar termenbronnen') ?></h3>
		<table id="tableKGoutgoinglinks" class="props propskg">
			<thead><tr><th><?= t('Termenbron') ?></th><th><?= t('Aantal voorkomens') ?></th></tr></thead>
			<tbody></tbody>		
		</table>
	   </div>
   </section> 
 
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
        <h3 class="title--l"><?= t('Gebruikte vocabulaires') ?></h3>
		<table id="tableKGvocabularies" class="props propskg">
			<thead><tr><th><?= t('Vocabulaire') ?></th><th>Prefix</th></tr></thead>
			<tbody></tbody>	
		</table>
	   </div>
   </section>  
   
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
        <h3 class="title--l"><?= t('Klassegebruik') ?></h3>
		<table id="tableKGclasses" class="props propskg">
			<thead><tr><th><?= t('Klasse') ?></th><th><?= t('Aantal keer gebruikt') ?></th></tr></thead>
			<tbody></tbody>
		</table>
	   </div>
   </section>

   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
        <h3 class="title--l"><?= t('Eigenschapgebruik') ?></h3>
		<table id="tableKGproperties" class="props propskg">
			<thead><tr><th><?= t('Eigenschap') ?></th><th><?= t('Aantal keer gebruikt') ?></th></tr></thead>
			<tbody></tbody>
		</table>
	   </div>
   </section>
   
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
        <h3 class="title--l"><?= t('Eigenschapdichtheid per onderwerpklasse') ?></h3>
		<table id="tableKGpropertydensity" class="props propskg">
			<thead><tr><th class='double'><?= t('Klasse') ?></th><th class='double'><?= t('Eigenschap') ?></th><th><?= t('Aantal keer gebruikt') ?></th></tr></thead>
			<tbody></tbody>		
		</table>
	   </div>
   </section>
    
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
        <h3 class="title--l"><?= t('Licenties') ?></h3>
		<table id="tableKGlicenses" class="props propskg">
			<thead><tr><th><?= t('Licentie') ?></th><th><?= t('Aantal voorkomens') ?></th></tr></thead>
			<tbody></tbody>
		</table>
	   </div>
   </section>
   
     <section class="text m-t-space m-b-space">
      <div class="o-container o-container__small m-t-space">
		<p><?= t('Deze datasetsamenvatting is gemaakt door de ') ?> <a href="https://github.com/netwerk-digitaal-erfgoed/dataset-knowledge-graph" target="_blank">NDE Dataset Knowledge Graph Pipeline</a>. <br><?= t('Er is ook een <a href="https://datastories.demo.netwerkdigitaalerfgoed.nl/dataset-knowledge-graph/">Data story</a> beschikbaar op de gehele Dataset Knowledge Graph.') ?></p> 
		 <a href="/show.php?lang=<?= $lang ?>&uri=<?= $dataset_uri ?>"><span class="btn btn--arrow m-t-half-space"><?= t('Terug naar datasetbeschrijving') ?> <svg class="rect"> <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 578; stroke-dashoffset: 578;"></rect> </svg> <svg class="icon icon-arrow-right"> <use xlink:href="#icon-arrow-right"></use> </svg> </span></a>
      </div>
   </section>
</main>
<?php if (!empty($dataset_uri)) { ?>
<script>

const sparqlRepo = 'https://triplestore.netwerkdigitaalerfgoed.nl/repositories/dataset-knowledge-graph?query=';
const datasetUri='<?= $dataset_uri ?>';

// https://github.com/netwerk-digitaal-erfgoed/dataset-knowledge-graph > Size
const sparqlKGsize=`PREFIX void: <http://rdfs.org/ns/void#>
PREFIX nde: <https://www.netwerkdigitaalerfgoed.nl/def#>
SELECT ?triples ?distinctSubjects ?properties ?distinctObjectsURI ?distinctObjectsLiteral {
OPTIONAL { <${datasetUri}> nde:distinctObjectsLiteral ?distinctObjectsLiteral . }
OPTIONAL { <${datasetUri}> nde:distinctObjectsURI ?distinctObjectsURI . }
OPTIONAL { <${datasetUri}> void:properties ?properties . }
OPTIONAL { <${datasetUri}> void:distinctSubjects ?distinctSubjects . } 
<${datasetUri}> void:triples ?triples .
}`;

// https://github.com/netwerk-digitaal-erfgoed/dataset-knowledge-graph > Classes
const sparqlKGclasses=`PREFIX void: <http://rdfs.org/ns/void#>
SELECT ?labelPart ?valuePart {
    <${datasetUri}> void:classPartition ?classPartition .
    ?classPartition void:class ?labelPart ;
                    void:entities ?valuePart .
} ORDER BY DESC(?valuePart)`;

// https://github.com/netwerk-digitaal-erfgoed/dataset-knowledge-graph > Properties
const sparqlKGproperties=`PREFIX void: <http://rdfs.org/ns/void#>
SELECT ?labelPart ?valuePart ?valuePart2 {
    <${datasetUri}> void:propertyPartition ?propertyPartition .
    ?propertyPartition void:property ?labelPart ;
                    void:entities ?valuePart ;
                    void:distinctObjects ?valuePart2 .
} ORDER BY DESC(?valuePart)`;

// https://github.com/netwerk-digitaal-erfgoed/dataset-knowledge-graph > Property density per subject class
const sparqlKGpropertydensity=`PREFIX void: <http://rdfs.org/ns/void#>
SELECT ?labelPart1 ?labelPart2 ?valuePart ?valuePart2 {
    <${datasetUri}> void:classPartition ?classPartition .
    ?classPartition void:class ?labelPart1 ;
                    void:propertyPartition ?propertyPartition .
    ?propertyPartition void:property ?labelPart2 ;
                       void:entities ?valuePart ;
					   void:distinctObjects ?valuePart2 .
} ORDER BY ?labelPart1 ?labelPart2`;

// https://github.com/netwerk-digitaal-erfgoed/dataset-knowledge-graph > Outgoing links to terminology sources
const sparqlKGoutgoinglinks=`PREFIX void: <http://rdfs.org/ns/void#>
SELECT ?labelPart ?valuePart {
    [] a void:Linkset;
    void:subjectsTarget <${datasetUri}>;
    void:objectsTarget ?labelPart;
    void:triples ?valuePart.
} ORDER BY DESC(?valuepart)`;

// https://github.com/netwerk-digitaal-erfgoed/dataset-knowledge-graph > Vocabularies
const sparqlKGvocabularies=`PREFIX void: <http://rdfs.org/ns/void#>
SELECT ?valuePart WHERE { 
<${datasetUri}> a void:Dataset;
    void:vocabulary ?valuePart.
}`;

// https://github.com/netwerk-digitaal-erfgoed/dataset-knowledge-graph > Licenses
const sparqlKGlicenses=`PREFIX void: <http://rdfs.org/ns/void#>
PREFIX dcterms: <http://purl.org/dc/terms/>
SELECT ?labelPart ?valuePart WHERE { 
	<${datasetUri}> a void:Dataset;
		void:subset ?subset.
	?subset dcterms:license ?labelPart ;
	void:triples ?valuePart .
}`;

// https://github.com/netwerk-digitaal-erfgoed/dataset-knowledge-graph > Example resources
const sparqlKGexample=`PREFIX void: <http://rdfs.org/ns/void#>
SELECT ?valuePart WHERE { 
	<${datasetUri}> a void:Dataset;
		void:exampleResource ?valuePart .
}`;

// Distributions not yet implemented

function getFromDatasetKnowledgGraph(table,func,query) {
	var tableObj=document.getElementById(table);
	
	if (tableObj) {
		var url = sparqlRepo + encodeURIComponent(query);
		var xhr = new XMLHttpRequest();
		xhr.open("GET", url);
		xhr.setRequestHeader("Accept", "application/json");

		xhr.onreadystatechange = function() {
		  if (xhr.readyState === 4) {
			if (xhr.status === 200) {
			  func(table,JSON.parse(xhr.responseText));
			} else {
			  console.log("Call to triplestore got HTTP code " + xhr.status);
			}
		  }
		};

		xhr.send();
		
		// annoyingly you have to manually set the repository to dataset-knowledge-graph (not the default)
		const newElement = document.createElement('div');
		newElement.innerHTML = '<a title="Klik om de onderliggende SPARQL query uit te voeren op de Datasetregister Knowledge Graph (let op: in de triplestore, selecteer rechtboven de \'dataset-knowledge-graph\' repository!)" class="sparqlbtn" target="triplestore" href="https://triplestore.netwerkdigitaalerfgoed.nl/sparql?query='+encodeURIComponent(query)+'">SPARQL</a>';
		tableObj.parentNode.appendChild(newElement);
	} else {
	 console.info("table "+table+" not present in HTML");
	}
}

function hideTableSection(table) {	
	table.parentNode.parentNode.style.opacity=0.2;
}

function showList(list,sparqlresult) {
	var ul = document.getElementById(list);
	var rowCount = 0;
	for (var prop in sparqlresult.results.bindings) {	  
		newLi = "<li><a href=\"" + sparqlresult.results.bindings[prop].valuePart.value + "\">" + sparqlresult.results.bindings[prop].valuePart.value + "</a></li>";
		ul.appendChild(newLi);
		rowCount++;
	}
	if (rowCount==0) {
		hideTableSection(ul);
	}
}

function showRows(table,sparqlresult) {
	var table = document.getElementById(table);
	var tBody = table.getElementsByTagName('tbody')[0];
	var rowCount = 0;
	for (var prop in sparqlresult.results.bindings) {	  
		var strRow = "<tr>";
		strRow += "<th>" + prefix(sparqlresult.results.bindings[prop].labelPart.value) + "</th>";
		strRow += "<td>" + parseInt(sparqlresult.results.bindings[prop].valuePart.value).toLocaleString('nl-NL') + "</th>";
		strRow += "</tr>";
		tBody.insertRow(rowCount++).innerHTML = strRow;
	}
	if (rowCount==0) {
		hideTableSection(table);
	}	
}
	
function showDoubleColRows(table,sparqlresult) {
	var table = document.getElementById(table);
	var tBody = table.getElementsByTagName('tbody')[0];
	var rowCount = 0;
	for (var prop in sparqlresult.results.bindings) {
		var strRow = "<tr>";
		strRow += "<th class='double'>" + prefix(sparqlresult.results.bindings[prop].labelPart1.value) + "</th>";
		strRow += "<th class='double'>" + prefix(sparqlresult.results.bindings[prop].labelPart2.value) + "</th>";
		strRow += "<td>" + parseInt(sparqlresult.results.bindings[prop].valuePart.value).toLocaleString('nl-NL') + "</th>";
		strRow += "</tr>";
		tBody.insertRow(rowCount++).innerHTML = strRow;
	}
	if (rowCount==0) {
		hideTableSection(table);
	}	
}

function showValueRows(table,sparqlresult) {
	var table = document.getElementById(table);
	var tBody = table.getElementsByTagName('tbody')[0];
	var rowCount = 0;
	for (var prop in sparqlresult.results.bindings[0]) {	  
		var strRow = "<tr>";
		strRow += "<th>" + prop + "</th>";
		strRow += "<td>" + parseInt(sparqlresult.results.bindings[0][prop].value).toLocaleString('nl-NL') + "</th>";
		strRow += "</tr>";
		tBody.insertRow(rowCount++).innerHTML = strRow;
	}
	if (rowCount==0) {
		hideTableSection(table);
	}	
}
	
function showSingleValueRows(table,sparqlresult) {
	var table = document.getElementById(table);
	var tBody = table.getElementsByTagName('tbody')[0];
	var rowCount = 0;
	for (var prop in sparqlresult.results.bindings) {	  
		var strRow = "<tr>";
		strRow += "<th>"+sparqlresult.results.bindings[prop].valuePart.value+"</th>";
		strRow += "<td>"+prefix(sparqlresult.results.bindings[prop].valuePart.value)+"</td>";
		strRow += "</tr>";
		tBody.insertRow(rowCount++).innerHTML = strRow;
	}
	if (rowCount==0) {
		hideTableSection(table);
	}	
}
	 
function prefix(str) {

  alt = str.replace("http://schema.org/","schema:");
  alt = alt.replace("http://schema.org","schema:");
  alt = alt.replace("https://schema.org/","schema:");
  alt = alt.replace("http://www.w3.org/1999/02/22-rdf-syntax-ns#","rdf:");
  alt = alt.replace("http://www.w3.org/ns/dcat#","dcat:");
  alt = alt.replace("http://purl.org/dc/terms/","dct:");
  alt = alt.replace("http://xmlns.com/foaf/0.1/","foaf:");
  alt = alt.replace("http://www.w3.org/2004/02/skos/core#","skos:");
  alt = alt.replace("http://www.w3.org/ns/org#","org:");
  alt = alt.replace("http://omeka.org/s/vocabs/o#","o:");
  alt = alt.replace("http://semanticweb.cs.vu.nl/2009/11/sem/","sem:");
  alt = alt.replace("http://www.opengis.net/ont/geosparql#","geosparql:");
  alt = alt.replace("http://www.w3.org/2003/01/geo/wgs84_pos#","geo:");
  alt = alt.replace("http://www.w3.org/2002/07/owl#","owl:");
  alt = alt.replace("http://rdf.histograph.io/","hg:");
  alt = alt.replace("https://w3id.org/pnv#","pnv:");
  alt = alt.replace("https://w3id.org/roar#","roar:");
  alt = alt.replace("https://linkeddata.cultureelerfgoed.nl/def/ceo#","ceo:");
  alt = alt.replace("https://data.cbg.nl/pico#","pico:");
  alt = alt.replace("http://www.w3.org/ns/prov#","prov:");
  alt = alt.replace("http://www.w3.org/2000/01/rdf-schema#","rdfs:");
  alt = alt.replace("https://www.ica.org/standards/RiC/ontology#","rico:");
  alt = alt.replace("https://www.goudatijdmachine.nl/def#","gtm:");
  alt = alt.replace("http://www.w3.org/ns/shacl#","shacl:");
  alt = alt.replace("http://www.cidoc-crm.org/cidoc-crm/","cidoc:");
  alt = alt.replace("http://vocab.getty.edu/aat/","aat:");
  alt = alt.replace("https://www.ica.org/standards/RiC/ontology","rico:");
  alt = alt.replace("http://proton.semanticweb.org/protonsys#","psys:");
  
  
  return "<abbr title=\"" + str + "\">" + alt + "</abbr>";
}

getFromDatasetKnowledgGraph('tableKGsize',showValueRows,sparqlKGsize);
getFromDatasetKnowledgGraph('tableKGclasses',showRows,sparqlKGclasses);
getFromDatasetKnowledgGraph('tableKGproperties',showRows,sparqlKGproperties);
getFromDatasetKnowledgGraph('tableKGpropertydensity',showDoubleColRows,sparqlKGpropertydensity);
getFromDatasetKnowledgGraph('tableKGoutgoinglinks',showRows,sparqlKGoutgoinglinks);
getFromDatasetKnowledgGraph('tableKGvocabularies',showSingleValueRows,sparqlKGvocabularies);
getFromDatasetKnowledgGraph('tableKGlicenses',showRows,sparqlKGlicenses);
getFromDatasetKnowledgGraph('listKGexamples',showList,sparqlKGexample);

</script>
<?php 
} 

include("includes/footer.php") ?>