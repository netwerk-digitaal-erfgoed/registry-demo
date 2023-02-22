<?php include("includes/search.php"); include("includes/header.php"); 

$starTitle=array();
$starTitle["☆"]='This dataset description has a license, a title and a publisher, but lacks a description, one or more distributions, a creator, a landing page, a created, modified/updated and/or issued/published date and a language, a source, one or more keywords, spatial coverage and/or temporal coverage.';
$starTitle["☆☆"]='This dataset description has a license, a title, a publisher, a description and one or more distributions, but lacks a creator, a landing page, a created, modified/updated and/or issued/published date and a language, a source, one or more keywords, spatial coverage and/or temporal coverage.';
$starTitle["☆☆☆"]='This dataset description has a license, a title, a publisher, a description, one or more distributions, a creator and a landing page but lacks a created, modified/updated and/or issued/published date and a language, a source, one or more keywords, spatial coverage and/or temporal coverage.';
$starTitle["☆☆☆☆"]='This dataset description has a license, a title, a publisher, a description, one or more distributions, a creator and a landing page and a created, modified/updated and/or issued/published date but lacks a language, a source, one or more keywords, spatial coverage and/or temporal coverage.';
$starTitle["☆☆☆☆☆"]='This dataset description has a license, a title, a publisher, a description, one or more distributions, a creator, and a landing page, a created, modified/updated and/or issued/published date, and a language, a source, one or more keywords, spatial coverage and/or temporal coverage.';

$dataset_uri='';
if (isset($_GET["uri"]) && filter_var($_GET["uri"], FILTER_VALIDATE_URL)) {
	$dataset_uri=$_GET["uri"];
}
$stars='';
$star_title='';
if (isset($_GET["stars"])) {
	$stars = preg_replace("/[^☆]+/", "", $_GET["stars"]);
	if (!empty($stars)) {
		$star_title = $starTitle[$stars];
	}
}
?>
<link rel="stylesheet" href="/assets/search.20230222.css" type="text/css" media="all">

<main>
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
         <h1 class="title--l"><?= t('Datasetbeschrijving') ?> <span title="<?= $star_title ?>" style="float:right"><?= $stars ?></span></h1>
		 <h3><?= htmlentities($dataset_uri,ENT_QUOTES) ?></h3>
		 
		 <?php if (empty($dataset_uri)) { ?>
		 <div class="m-theme-bg m-theme--teal search-div"><p>De opgegeven URI is ongeldig.</p></div>
		 <?php } else { ?>
		 <table id="dataset_description"></table>
		 <?php } ?>
		 
		 <?php if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) { ?>
		 <a href="javascript:history.back();"><span class="btn btn--arrow m-t-half-space">Terug naar zoekresultaten <svg class="rect"> <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 578; stroke-dashoffset: 578;"></rect> </svg> <svg class="icon icon-arrow-right"> <use xlink:href="#icon-arrow-right"></use> </svg> </span></a>
		 <?php } else { ?>
		 <a href="search.php"><span class="btn btn--arrow m-t-half-space">Doorzoek het Dataset Register <svg class="rect"> <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 578; stroke-dashoffset: 578;"></rect> </svg> <svg class="icon icon-arrow-right"> <use xlink:href="#icon-arrow-right"></use> </svg> </span></a>
		 <?php } ?>

      </div>
   </section>
</main>
<?php if (!empty($dataset_uri)) { ?>
<script>
var querylang="<?php if(isset($_GET["lang"]) && $_GET["lang"]=="en") { echo "en"; } else { echo "nl"; } ?>";
var sparqlUrl = 'https://triplestore.netwerkdigitaalerfgoed.nl/sparql?query=';
var sparqlQuery;



function getDatasetDescription(uri) {

    var sparlDataset = "SELECT * FROM <" + uri + "> WHERE { ?s ?p ?o }";

    var url = 'https://triplestore.netwerkdigitaalerfgoed.nl/repositories/registry?query=' + encodeURIComponent(sparlDataset);
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url);
    xhr.setRequestHeader("Accept", "application/json");

    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          showDataset(uri, JSON.parse(xhr.responseText));
        } else {
          console.log("Call to triplestore got HTTP code " + xhr.status);
        }
      }
    };

    xhr.send();
}


function showDataset(uri, sparqlresult) {

  var table = document.getElementById("dataset_description");
  table.className = "props";

  var strTable = "<tr><th>URI</th><td colspan=2>";
  strTable += "<a target=\"_blank\" href=\"" + uri + "\">" + uri + "</a></td></tr>";

  for (var prop in sparqlresult.results.bindings) {
    subject_value = sparqlresult.results.bindings[prop].s.value;
    property_value = sparqlresult.results.bindings[prop].p.value;
    object_value = sparqlresult.results.bindings[prop].o.value;

	
    if (subject_value == uri && property_value != "http://www.w3.org/1999/02/22-rdf-syntax-ns#type") {

      strTable += "<tr><th>" + prefix(property_value);
	  if (typeof sparqlresult.results.bindings[prop].o["xml:lang"] !== 'undefined') {
        strTable += ' <span class="xmllang">' + sparqlresult.results.bindings[prop].o["xml:lang"] + '</span>';
      }
	  strTable += "</th><td colspan=2>";
      if (isValidHttpUrl(object_value)) {
         strTable += "<a target=\"_blank\" href=\"" + object_value + "\">" + object_value + "</a>";
      } else {
        strTable += object_value;
      }	  
	  strTable += "</td></tr>";
      
      if ((property_value == "http://www.w3.org/ns/dcat#distribution") ||
        (property_value == "http://purl.org/dc/terms/creator") ||
        (property_value == "http://purl.org/dc/terms/publisher")) {
        for (var prop in sparqlresult.results.bindings) {
          sub_subject_value = sparqlresult.results.bindings[prop].s.value;
          sub_property_value = sparqlresult.results.bindings[prop].p.value;
          sub_object_value = sparqlresult.results.bindings[prop].o.value;

          if (sub_subject_value == object_value && sub_property_value != "http://www.w3.org/1999/02/22-rdf-syntax-ns#type") {
			strTable += "<tr><td></td><th>" + prefix(sub_property_value)
			if (typeof sparqlresult.results.bindings[prop].o["xml:lang"] !== 'undefined') {
				strTable += ' <span class="xmllang">' + sparqlresult.results.bindings[prop].o["xml:lang"] + '</span>';
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

getDatasetDescription('<?= $dataset_uri ?>');

</script>
<?php 
} 

include("includes/footer.php") ?>