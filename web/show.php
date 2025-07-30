<?php 

$lang="nl";
if(isset($_GET["lang"]) && $_GET["lang"]=="en") { $lang="en"; } 

$dataset_uri='';
if (isset($_GET["uri"]) && filter_var($_GET["uri"], FILTER_VALIDATE_URL)) {
	$dataset_uri=$_GET["uri"];
} else {
  header("Location: /",TRUE,400);
  exit;
}

include("includes/search.php"); 
include("includes/header.php"); 

?>

<main>
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
        <h1 class="title--l"><?= t('Datasetbeschrijving') ?></h1>
        <h3><?= htmlentities($dataset_uri,ENT_QUOTES) ?></h3>
        <div id="archived"></div>
        <?php if (empty($dataset_uri)) { ?>
        <div class="m-theme-bg m-theme--teal search-div"><p><?= t('De opgegeven URI is ongeldig') ?>.</p></div>
        <?php } else { ?>
        <table id="dataset_description"></table>
        <?php } ?>
	   </div>
   </section>

   <section class="text m-t-space m-b-space m-theme--blue" id="datasummary_section" style="display:none">
      <div class="o-container o-container__small m-t-space" id="datasummary_div"></div>
   </section>
	  
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
        <h2 class="title--l"><?= t('Metadata') ?></h2>
        <table id="tableMetadata" class="props">
		  <tr id="row_postedURL"><th><?= t('Geregistreerde URL') ?></th><td id="val_postedURL"></td></tr>
		  <tr id="row_postedDate"><th><?= t('Registratiedatum') ?></th><td id="val_postedDate"></td></tr>
		  <tr id="row_validUntil"><th><?= t('Was geldig tot') ?></th><td id="val_validUntil"></td></tr>
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
const datasetUri = '<?= htmlspecialchars($dataset_uri,ENT_QUOTES) ?>';
const sparqlQuery = "SELECT * FROM <" + datasetUri + "> WHERE { ?subject ?predicate ?object . }";

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

function getDataSummary() {
    const url = "https://lab.coret.org/datasetregister/data-summary.php?dataset="+encodeURIComponent(datasetUri);
    
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok: " + response.statusText);
            }
            return response.text(); // Get response as plain text (HTML)
        })
        .then(html => {
			if (html != "") {
				document.getElementById("datasummary_section").style.display="block";
				document.getElementById("datasummary_div").innerHTML=html;
			}
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
}
function getMetadata() {
  var sparqlLastDateRead = "PREFIX schema: <http://schema.org/> SELECT ?postedURL ?postedDate ?lastDateRead ?ratingValue ?ratingExplanation ?validUntil WHERE { <"+datasetUri+">  schema:subjectOf ?postedURL . OPTIONAL { ?postedURL schema:validUntil ?validUntil . } OPTIONAL { ?postedURL schema:datePosted ?postedDate . } OPTIONAL { ?postedURL schema:dateRead ?lastDateRead . } OPTIONAL { ?dataset schema:contentRating/schema:ratingValue ?ratingValue ; schema:contentRating/schema:ratingExplanation ?ratingExplanation . } } ORDER BY DESC(?lastDateRead) LIMIT 1";

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

function showMetadata(sparqlresult) {
    for (const [prop, value] of Object.entries(sparqlresult.results.bindings[0])) {
        if (prop === 'validUntil') {
            banner = document.getElementById('archived');
            banner.innerHTML = '<?= t('<strong>Let op</strong>: dit is een gearchiveerde datasetbeschrijving, de datasetbeschrijving is niet meer bij de bron beschikbaar, de inhoud van de datasetbeschrijving is waarschijnlijk niet meer kloppend.') ?>';
            banner.style.display = 'block';
        }

		document.getElementById('row_'+prop).style.display="table-row";
		let val=value.value.replaceAll('http://purl.org/dc/terms/','');
        if (value.type === 'uri') {
			val = '<a target="_blank" href="'+val+'">'+val+'</a>';
		} else if (value.datatype === 'http://www.w3.org/2001/XMLSchema#dateTime') {
            const date = new Date(value.value);
            val = date.toLocaleString(undefined, {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                timeZone: 'UTC'
            });
		}
        document.getElementById('val_' + prop).innerHTML = val;
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

  maxShownDistribution=20;

  var table = document.getElementById("dataset_description");
  table.className = "props";

  var strTable = "<tr><th>URI</th><td colspan=2>";
  strTable += "<a target=\"_blank\" href=\"" + datasetUri + "\">" + datasetUri + "</a></td></tr>";

  for (var prop in sparqlresult.results.bindings) {
    subject_value = sparqlresult.results.bindings[prop].subject.value;
    property_value = sparqlresult.results.bindings[prop].predicate.value;
    object_value = sparqlresult.results.bindings[prop].object.value;

    if (subject_value == datasetUri && property_value != "http://www.w3.org/1999/02/22-rdf-syntax-ns#type") {
      if ((property_value == "http://www.w3.org/ns/dcat#distribution" && maxShownDistribution>0) || property_value != "http://www.w3.org/ns/dcat#distribution") {
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
      }
      if (property_value == "http://www.w3.org/ns/dcat#distribution" && maxShownDistribution==0) {
          strTable += '<tr><th style="background-color:white;text-align:center;border-top:1px dashed #be2c00;border-bottom:1px dashed #be2c00;" colspan="3"><?= t('Let op: er worden hier maximaal 20 distributies weergegeven,<br>gebruik SPARQL om alle distributies te bekijken!') ?></th>';
          maxShownDistribution--;
      }    
      if ((property_value == "http://purl.org/dc/terms/creator") ||
        (property_value == "http://purl.org/dc/terms/publisher")) {
        for (var prop in sparqlresult.results.bindings) {
          sub_subject_value = sparqlresult.results.bindings[prop].subject.value;
          sub_property_value = sparqlresult.results.bindings[prop].predicate.value;

          if (sub_subject_value == object_value && sub_property_value != "http://www.w3.org/1999/02/22-rdf-syntax-ns#type") {
            strTable += "<tr><td></td><th>" + prefix(sub_property_value)
            if (typeof sparqlresult.results.bindings[prop].object["xml:lang"] !== 'undefined') {
              strTable += ' <span class="xmllang">' + sparqlresult.results.bindings[prop].object["xml:lang"] + '</span>';
            }
            strTable += "</th><td>";
            sub_object_value = sparqlresult.results.bindings[prop].object.value;
            if (isValidHttpUrl(sub_object_value)) {
              strTable += "<a target=\"_blank\" href=\"" + sub_object_value + "\">" + sub_object_value + "</a></td></tr>";
            } else {
              strTable += sub_object_value;
            }
            strTable += "</td></tr>";
          }
        }
      }

      if (property_value == "http://www.w3.org/ns/dcat#distribution") {
        if (maxShownDistribution>0) {
          for (var prop in sparqlresult.results.bindings) {
            sub_subject_value = sparqlresult.results.bindings[prop].subject.value;
            sub_property_value = sparqlresult.results.bindings[prop].predicate.value;

            if (sub_subject_value == object_value && sub_property_value != "http://www.w3.org/1999/02/22-rdf-syntax-ns#type") {
              strTable += "<tr><td></td><th>" + prefix(sub_property_value)
              if (typeof sparqlresult.results.bindings[prop].object["xml:lang"] !== 'undefined') {
                strTable += ' <span class="xmllang">' + sparqlresult.results.bindings[prop].object["xml:lang"] + '</span>';
              }
              strTable += "</th><td>";
              sub_object_value = sparqlresult.results.bindings[prop].object.value;
              if (isValidHttpUrl(sub_object_value)) {
                strTable += "<a target=\"_blank\" href=\"" + sub_object_value + "\">" + sub_object_value + "</a></td></tr>";
              } else {
                strTable += sub_object_value;
              }
              strTable += "</td></tr>";
            }
          }
          maxShownDistribution--;
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
  pre = pre.replace("http://www.w3.org/2002/07/owl#", "");

  alt = str.replace("http://schema.org/", "schema:");
  alt = alt.replace("https://schema.org/", "schema:");
  alt = alt.replace("http://www.w3.org/1999/02/22-rdf-syntax-ns#", "rdf:");
  alt = alt.replace("http://www.w3.org/ns/dcat#", "dcat:");
  alt = alt.replace("http://purl.org/dc/terms/", "dct:");
  alt = alt.replace("http://xmlns.com/foaf/0.1/", "foaf:");
  alt = alt.replace("http://www.w3.org/2002/07/owl#", "owl:");

  return "<strong title=\"" + alt + "\">" + pre.charAt(0).toUpperCase() + pre.slice(1) + "</strong>";
}

getDatasetDescription();
getMetadata();
getDataSummary();
</script>
<?php 
} 

include("includes/footer.php") ?>