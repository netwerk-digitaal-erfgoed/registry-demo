<?php 

include("includes/search.php"); 
include("includes/header.php"); 

$lang="nl";
if(isset($_GET["lang"]) && $_GET["lang"]=="en") { $lang="en"; } 

$dataset_uri='';
if (isset($_GET["uri"]) && filter_var($_GET["uri"], FILTER_VALIDATE_URL)) {
	$dataset_uri=$_GET["uri"];
}
?>

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
		<table id="table1" class="props propskg">
			<thead><tr><th><?= t('Eenheid') ?></th><th><?= t('Aantal voorkomens') ?></th></tr></thead>
			<tbody></tbody>
		</table>
	   </div>
   </section>
 
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
        <h3 class="title--l"><?= t('Gebruikte vocabulaires') ?></h3>
		<table id="table6" class="props propskg">
			<thead><tr><th><?= t('Vocabulaire') ?></th><th>Prefix</th></tr></thead>
			<tbody></tbody>	
		</table>
	   </div>
   </section>  
   
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
        <h3 class="title--l"><?= t('Klassegebruik') ?></h3>
		<table id="table2" class="props propskg">
			<thead><tr><th><?= t('Klasse') ?></th><th><?= t('Aantal keer gebruikt') ?></th></tr></thead>
			<tbody></tbody>
		</table>
	   </div>
   </section>

   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
        <h3 class="title--l"><?= t('Eigenschapgebruik') ?></h3>
		<table id="table3" class="props propskg">
			<thead><tr><th><?= t('Eigenschap') ?></th><th><?= t('Aantal keer gebruikt') ?></th></tr></thead>
			<tbody></tbody>
		</table>
	   </div>
   </section>
   
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
        <h3 class="title--l"><?= t('Eigenschapdichtheid per onderwerpklasse') ?></h3>
		<table id="table4" class="props propskg">
			<thead><tr><th class='double'><?= t('Klasse') ?></th><th class='double'><?= t('Eigenschap') ?></th><th><?= t('Aantal keer gebruikt') ?></th></tr></thead>
			<tbody></tbody>		
		</table>
	   </div>
   </section>

   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
        <h3 class="title--l"><?= t('Uitgaande links') ?></h3>
		<table id="table5" class="props propskg">
			<thead><tr><th><?= t('Uitgaande link') ?></th><th><?= t('Aantal voorkomens') ?></th></tr></thead>
			<tbody></tbody>		
		</table>
	   </div>
   </section>   
   
     <section class="text m-t-space m-b-space">
      <div class="o-container o-container__small m-t-space">
		<p><?= t('Deze datasetsamenvatting is gemaakt door de ') ?> <a href="https://github.com/netwerk-digitaal-erfgoed/dataset-knowledge-graph" target="_blank">NDE Dataset Knowledge Graph Pipeline</a>.</p> 
		 <a href="/show.php?lang=<?= $lang ?>&uri=<?= $dataset_uri ?>"><span class="btn btn--arrow m-t-half-space"><?= t('Terug naar datasetbeschrijving') ?> <svg class="rect"> <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 578; stroke-dashoffset: 578;"></rect> </svg> <svg class="icon icon-arrow-right"> <use xlink:href="#icon-arrow-right"></use> </svg> </span></a>
      </div>
   </section>
</main>
<?php if (!empty($dataset_uri)) { ?>
<script>

const sparqlRepo = 'https://triplestore.netwerkdigitaalerfgoed.nl/repositories/dataset-knowledge-graph?query=';
const datasetUri='<?= $dataset_uri ?>';

const sparqlQuery1=`PREFIX void: <http://rdfs.org/ns/void#>
PREFIX nde: <https://www.netwerkdigitaalerfgoed.nl/def#>
SELECT * {
OPTIONAL { <${datasetUri}> nde:distinctObjectsLiteral ?distinctObjectsLiteral . }
OPTIONAL { <${datasetUri}> nde:distinctObjectsURI ?distinctObjectsURI . }
OPTIONAL { <${datasetUri}> void:properties ?properties . }
OPTIONAL { <${datasetUri}> void:distinctSubjects ?distinctSubjects . } 
<${datasetUri}> void:triples ?triples .
}`;

const sparqlQuery2=`PREFIX void: <http://rdfs.org/ns/void#>
SELECT ?labelPart ?valuePart {
    <${datasetUri}> void:classPartition ?classPartition .
    ?classPartition void:class ?labelPart ;
                    void:entities ?valuePart .
} ORDER BY DESC(?valuePart)`;

const sparqlQuery3=`PREFIX void: <http://rdfs.org/ns/void#>
SELECT ?labelPart ?valuePart {
    <${datasetUri}> void:propertyPartition ?propertyPartition .
    ?propertyPartition void:property ?labelPart ;
                    void:entities ?valuePart .
} ORDER BY DESC(?valuePart)`;

const sparqlQuery4=`PREFIX void: <http://rdfs.org/ns/void#>
SELECT ?labelPart1 ?labelPart2 ?valuePart {
    <${datasetUri}> void:classPartition ?classPartition .
    ?classPartition void:class ?labelPart1 ;
                    void:propertyPartition ?propertyPartition .
    ?propertyPartition void:property ?labelPart2 ;
                       void:entities ?valuePart .
} ORDER BY ?labelPart1 ?labelPart2`;

const sparqlQuery5=`PREFIX void: <http://rdfs.org/ns/void#>
SELECT ?labelPart ?valuePart {
    [] a void:Linkset;
    void:subjectsTarget <${datasetUri}>;
    void:objectsTarget ?labelPart;
    void:triples ?valuePart.
} ORDER BY DESC(?valuepart)`;


const sparqlQuery6=`PREFIX void: <http://rdfs.org/ns/void#>
SELECT ?valuePart WHERE { 
<${datasetUri}> a void:Dataset;
    void:vocabulary ?valuePart.
}`;





// Vocabularies nog niet geïmplementeerd
// PREFIX void: <http://rdfs.org/ns/void#>
// SELECT ?p ?q {
//   <http://data.beeldengeluid.nl/id/dataset/0010> a void:Dataset; void:vocabulary  ?q
// }

function getFromDatasetKnowledgGraph(table,func,query) {
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
}

/*
document.getElementById('sparql-query').addEventListener(
  "click",
  function(event) {

    if (!navigator.clipboard) {
      // Clipboard API not available
      return;
    }
    const text = document.getElementById('sparql-query').innerHTML;
    try {
      navigator.clipboard.writeText(text);
      document.getElementById("copy-status").innerText = "<?= t('De SPARQL is gekopieerd.') ?>";
      setTimeout(function() {
        document.getElementById("copy-status").innerText = "<?= t('Klik de SPARQL om deze te kopieren.') ?>";
      }, 1200);
    } catch (err) {
      console.error("Failed to copy!", err);
    }
  },
  false
);
*/


function showList(table,sparqlresult) {
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
}

function showDoubleList(table,sparqlresult) {
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
}

function showValues(table,sparqlresult) {
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
}
	
function showSingleValues(table,sparqlresult) {
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
}
	 
function prefix(str) {

  alt = str.replace("http://schema.org/","schema:");
  alt = str.replace("http://schema.org","schema:");
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

getFromDatasetKnowledgGraph('table1',showValues,sparqlQuery1);
getFromDatasetKnowledgGraph('table2',showList,sparqlQuery2);
getFromDatasetKnowledgGraph('table3',showList,sparqlQuery3);
getFromDatasetKnowledgGraph('table4',showDoubleList,sparqlQuery4);
getFromDatasetKnowledgGraph('table5',showList,sparqlQuery5);
getFromDatasetKnowledgGraph('table6',showSingleValues,sparqlQuery6);

</script>
<?php 
} 

include("includes/footer.php") ?>