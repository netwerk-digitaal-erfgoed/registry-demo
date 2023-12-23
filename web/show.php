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
        <h1 class="title--l"><?= t('Datasetbeschrijving') ?></h1>
        <h3><?= htmlentities($dataset_uri,ENT_QUOTES) ?></h3>
        
        <?php if (empty($dataset_uri)) { ?>
        <div class="m-theme-bg m-theme--teal search-div"><p><?= t('De opgegeven URI is ongeldig') ?>.</p></div>
        <?php } else { ?>
        <table id="dataset_description"></table>
        <?php } ?>
	   </div>
   </section>

   <section class="text m-t-space m-b-space m-theme--blue" id="sectionSummary">
     <div class="o-container o-container__small m-t-space">
 	 <div class="all-1_2 tablet-portrait-1_2 phablet-1_1">
		<a href="dataset-summary.php?lang=<?= $lang ?>&uri=<?= urlencode($dataset_uri) ?>"><span style="font-size:1.6em" class="btn btn--arrow m-t-half-space btn--api">Er is een datasetsamenvatting beschikbaar <svg class="rect"> <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 0; stroke-dashoffset: 0;"></rect> </svg> <svg class="icon icon-arrow-right"> <use xlink:href="#icon-arrow-right"></use> </svg> </span></a>
      </div>
	  </div>
   </section>
				
   <section class="text m-t-space m-b-space m-theme--blue" id="sectionMetadata">
      <div class="o-container o-container__small m-t-space">
        <h2 class="title--l"><?= t('Metadata') ?></h2>
        <table id="tableMetadata" class="props">
		  <tr id="row_postedURL"><th><?= t('Geregistreerde URL') ?></th><td id="val_postedURL"></td></tr>
		  <tr id="row_postedDate"><th><?= t('Registratiedatum') ?></th><td id="val_postedDate"></td></tr>
		  <tr id="row_lastDateRead"><th><?= t('Laatste cache update') ?></th><td id="val_lastDateRead"></td></tr>
		  <tr id="row_ratingValue"><th><?= t('Beoordeling (25-100)') ?></th><td id="val_ratingValue"></td></tr>
		  <tr id="row_ratingExplanation"><th><?= t('Missende eigenschappen') ?></th><td id="val_ratingExplanation"></td></tr>		
		</table>
	   </div>
   </section>
   
   <section class="text m-t-space m-b-space">
      <div class="o-container o-container__small m-t-space">
	     <p><a style="float:right" onclick="return searchTriplestore()" href="#"><?= t('Neem onderstaande SPARQL mee naar de triplestore')?></a></p>
		 <h2 id="sparql">SPARQL</h2>
         <xmp id="sparql-query">SELECT * FROM <<?= htmlentities($dataset_uri,ENT_QUOTES) ?>> WHERE { 
  ?subject ?predicate ?object
}</xmp>
         <p id="copy-status" style="float:right"><?= t('Klik de SPARQL om deze te kopieren.')?></p>
         <div id="searchresults" style="display:none">
            <h2><?= t('Zoekresultaten')?> (<span id="countdatasets">0</span>)</h2>
            <ul id="datasets"></ul>
         </div>
      </div>
   </section>
   
     <section class="text m-t-space m-b-space">
      <div class="o-container o-container__small m-t-space">
		 <?php if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) { ?>
		 <a href="javascript:history.back();"><span class="btn btn--arrow m-t-half-space"><?= t('Terug naar zoekresultaten') ?> <svg class="rect"> <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 578; stroke-dashoffset: 578;"></rect> </svg> <svg class="icon icon-arrow-right"> <use xlink:href="#icon-arrow-right"></use> </svg> </span></a>
		 <?php } else { ?>
		 <a href="search.php?lang=<?= $lang ?>"><span class="btn btn--arrow m-t-half-space"><?= t('Doorzoek het Dataset Register') ?> <svg class="rect"> <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 578; stroke-dashoffset: 578;"></rect> </svg> <svg class="icon icon-arrow-right"> <use xlink:href="#icon-arrow-right"></use> </svg> </span></a>
		 <?php } ?>
      </div>
   </section>
</main>
<?php if (!empty($dataset_uri)) { ?>
<script>
const sparqlUrl = 'https://triplestore.netwerkdigitaalerfgoed.nl/sparql?query=';
const sparqlRepo = 'https://triplestore.netwerkdigitaalerfgoed.nl/repositories/registry?query=';
const sparqlKgRepo = 'https://triplestore.netwerkdigitaalerfgoed.nl/repositories/dataset-knowledge-graph?query=';
const datasetUri='<?= $dataset_uri ?>';
const sparqlQuery="SELECT * FROM <" + datasetUri + "> WHERE {\n  ?subject ?predicate ?object .\n}";
const sparqlKqQuery="PREFIX void: <http://rdfs.org/ns/void#> SELECT ?triples { <" + datasetUri + "> a void:Dataset; void:triples ?triples . }";

function checkDatasetSummary(uri) {
    var url = sparqlKgRepo + encodeURIComponent(sparqlKqQuery);
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url);
    xhr.setRequestHeader("Accept", "application/json");

    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          showDatasetSummaryButton(JSON.parse(xhr.responseText));
        } else {
          console.log("Call to triplestore got HTTP code " + xhr.status);
        }
      }
    };

    xhr.send();
}

function getDatasetDescription(uri) {
    var url = sparqlRepo + encodeURIComponent(sparqlQuery);
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url);
    xhr.setRequestHeader("Accept", "application/json");

    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          showDataset(JSON.parse(xhr.responseText));
        } else {
          console.log("Call to triplestore got HTTP code " + xhr.status);
        }
      }
    };

    xhr.send();
}

function getMetadata() {
  var sparqlLastDateRead = "SELECT ?postedURL ?postedDate ?lastDateRead ?ratingValue ?ratingExplanation WHERE { ?postedURL <http://schema.org/about> <"+datasetUri+"> ; <http://schema.org/datePosted> ?postedDate . <"+datasetUri+"> <http://schema.org/dateRead> ?lastDateRead . OPTIONAL { <"+datasetUri+"> <http://schema.org/contentRating>/<http://schema.org/ratingValue> ?ratingValue ; <http://schema.org/contentRating>/<http://schema.org/ratingExplanation> ?ratingExplanation . } } ORDER BY DESC(?lastDateRead) LIMIT 1";
  
  var url = sparqlRepo + encodeURIComponent(sparqlLastDateRead);
  var xhr = new XMLHttpRequest();
  xhr.open("GET", url);
  xhr.setRequestHeader("Accept", "application/json");

  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        showMetadata(JSON.parse(xhr.responseText));
      } else {
        console.log("Call to triplestore got HTTP code " + xhr.status);
      }
    }
  };

  xhr.send();
}

function showDatasetSummaryButton(sparqlresult) {
	triples=parseInt(sparqlresult.results.bindings[0].triples.value);
	if (triples>0) {
		document.getElementById('sectionSummary').style.display="block";
	}
}

function showMetadata(sparqlresult) {
	document.getElementById('sectionMetadata').style.display="block";
	for (var prop in sparqlresult.results.bindings[0]) { 
		document.getElementById('row_'+prop).style.display="table-row";
		let val=sparqlresult.results.bindings[0][prop].value.replaceAll('http://purl.org/dc/terms/','');
		if (sparqlresult.results.bindings[0][prop].type=="uri") {
			document.getElementById('val_'+prop).innerHTML='<a target="_blank" href="'+val+'">'+val+'</a>';
		} else {
			const niceDateTime = /^(\d{4})\-(\d{2})-(\d{2})T(\d{2}\:\d{2}).*/g
			document.getElementById('val_'+prop).innerText=val.replace(niceDateTime, "$3-$2-$1 ($4)");;		
		}
	}
}

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

function searchTriplestore() {
  var url = sparqlUrl + encodeURIComponent(sparqlQuery);
  window.open(url, 'triplestore').focus();
  return false;
}

function showDataset(sparqlresult) {

  var table = document.getElementById("dataset_description");
  table.className = "props";

  var strTable = "<tr><th>URI</th><td colspan=2>";
  strTable += "<a target=\"_blank\" href=\"" + datasetUri + "\">" + datasetUri + "</a></td></tr>";

  for (var prop in sparqlresult.results.bindings) {
    subject_value = sparqlresult.results.bindings[prop].subject.value;
    property_value = sparqlresult.results.bindings[prop].predicate.value;
    object_value = sparqlresult.results.bindings[prop].object.value;

    if (subject_value == datasetUri && property_value != "http://www.w3.org/1999/02/22-rdf-syntax-ns#type") {

      strTable += "<tr><th>" + prefix(property_value);
	  if (typeof sparqlresult.results.bindings[prop].object["xml:lang"] !== 'undefined') {
        strTable += ' <span class="xmllang">' + sparqlresult.results.bindings[prop].object["xml:lang"] + '</span>';
      }
	  strTable += "</th><td colspan=2>";
	  if(property_value == "http://purl.org/dc/terms/isPartOf") {
          strTable += "<a target=\"_blank\" href=\"" + object_value + "\">" + object_value + "</a>";
		  strTable += "<a class=\"datacatalog\" href=\"catalog.php?lang=<?= $lang ?>&uri=" + encodeURI(object_value) + "\"><?= t('Bekijk datasets binnen deze datacatalog') ?></a>";
	  } else {
		  if (isValidHttpUrl(object_value)) {
			 strTable += "<a target=\"_blank\" href=\"" + object_value + "\">" + object_value + "</a>";
		  } else {
			strTable += object_value;
		  }	  
	  }
	  strTable += "</td></tr>";
      
      if ((property_value == "http://www.w3.org/ns/dcat#distribution") ||
        (property_value == "http://purl.org/dc/terms/creator") ||
        (property_value == "http://purl.org/dc/terms/publisher")) {
        for (var prop in sparqlresult.results.bindings) {
          sub_subject_value = sparqlresult.results.bindings[prop].subject.value;
          sub_property_value = sparqlresult.results.bindings[prop].predicate.value;
          sub_object_value = sparqlresult.results.bindings[prop].object.value;

          if (sub_subject_value == object_value && sub_property_value != "http://www.w3.org/1999/02/22-rdf-syntax-ns#type") {
			strTable += "<tr><td></td><th>" + prefix(sub_property_value)
			if (typeof sparqlresult.results.bindings[prop].object["xml:lang"] !== 'undefined') {
				strTable += ' <span class="xmllang">' + sparqlresult.results.bindings[prop].object["xml:lang"] + '</span>';
			}
			strTable += "</th><td>";
			if (isValidHttpUrl(sub_object_value)) {
              strTable += "<a target=\"_blank\" href=\"" + sub_object_value + "\">" + sub_object_value + "</a></td></tr>";
            } else {
              strTable += sub_object_value;
            }
			strTable += "</td></tr>";
          }
        }
      }
    }
  }

  table.innerHTML = strTable;
}

function isValidHttpUrl(string) {
  let url;

  try {
    url = new URL(string);
  } catch (_) {
    return false;
  }

  return url.protocol === "http:" || url.protocol === "https:";
}

function prefix(str) {
  pre = str.replace("http://schema.org/", "");
  pre = pre.replace("https://schema.org/", "");
  pre = pre.replace("http://www.w3.org/1999/02/22-rdf-syntax-ns#", "");
  pre = pre.replace("http://www.w3.org/ns/dcat#", "");
  pre = pre.replace("http://purl.org/dc/terms/", "");
  pre = pre.replace("http://xmlns.com/foaf/0.1/", "");

  alt = str.replace("http://schema.org/", "schema:");
  alt = alt.replace("https://schema.org/", "schema:");
  alt = alt.replace("http://www.w3.org/1999/02/22-rdf-syntax-ns#", "rdf:");
  alt = alt.replace("http://www.w3.org/ns/dcat#", "dcat:");
  alt = alt.replace("http://purl.org/dc/terms/", "dct:");
  alt = alt.replace("http://xmlns.com/foaf/0.1/", "foaf:");

  return "<strong title=\"" + alt + "\">" + pre.charAt(0).toUpperCase() + pre.slice(1) + "</strong>";
}

getDatasetDescription();
getMetadata();
</script>
<?php 
} 

include("includes/footer.php") ?>