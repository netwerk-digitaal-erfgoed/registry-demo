<?php

$lang="nl";
if(isset($_GET["lang"]) && $_GET["lang"]=="en") { $lang="en"; }

if (isset($_GET["uri"]) && filter_var($_GET["uri"], FILTER_VALIDATE_URL)) {
	$uri=$_GET["uri"];
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
      <h1 class="title--l"><?= t('Datasets in data catalogus ') ?></h1>
      <p><?= t('De volgende') ?> <span id="countdatasets">0</span> <?= t('datasets maken onderdeel uit ')?> <?= htmlentities($uri,ENT_QUOTES) ?></p>
         <div id="searchresults" style="display:none">
            <h2></h2>
            <ul id="datasets"></ul>
         </div>
      </div>
   </section>

   <section class="text m-t-space m-b-space">
      <div class="o-container o-container__small m-t-space">
	     <p><a style="float:right" onclick="return searchTriplestore()" href="#"><?= t('Neem onderstaande SPARQL mee naar de triplestore')?></a></p>
		 <h2 id="sparql">SPARQL</h2>
         <xmp id="sparql-query">
         </xmp>
         <p id="copy-status" style="float:right"><?= t('Klik de SPARQL om deze te kopieren.')?></p>
      </div>
   </section>

   <section class="text m-t-space m-b-space">
     <div class="o-container o-container__small m-t-space">
       <a href="search.php?lang=<?= $lang ?>"><span class="btn btn--arrow m-t-half-space"><?= t('Doorzoek het Dataset Register') ?> <svg class="rect"> <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 578; stroke-dashoffset: 578;"></rect> </svg> <svg class="icon icon-arrow-right"> <use xlink:href="#icon-arrow-right"></use> </svg> </span></a>
     </div>
   </section>
</main>
<script>
var querylang1="<?php if(isset($_GET["lang"]) && $_GET["lang"]=="en") { echo "en"; } else { echo "nl"; } ?>";
var querylang2="<?php if(isset($_GET["lang"]) && $_GET["lang"]=="en") { echo "nl"; } else { echo "en"; } ?>";

const sparqlUrl = 'https://qlever-ui.demo.netwerkdigitaalerfgoed.nl/datasetregister?query=';
var sparqlQuery = `PREFIX dcat: <http://www.w3.org/ns/dcat#>
PREFIX dct:  <http://purl.org/dc/terms/>
PREFIX foaf: <http://xmlns.com/foaf/0.1/>
SELECT DISTINCT ?dataset ?title ?publisherName WHERE {
  ?dataset dct:isPartOf ?catalog .
  FILTER(STR(?catalog)="<?= htmlspecialchars($uri) ?>" || ?catalog=<<?= htmlspecialchars($uri) ?>>)
  ?dataset dct:publisher ?publisher .
  OPTIONAL { ?dataset dct:title ?title FILTER(langMatches(lang(?title), "${querylang1}")) }
  OPTIONAL { ?dataset dct:title ?title FILTER(langMatches(lang(?title), "${querylang2}")) }
  OPTIONAL { ?dataset dct:title ?title }
  OPTIONAL { ?publisher foaf:name ?publisherName FILTER(langMatches(lang(?publisherName), "${querylang1}")) }
  OPTIONAL { ?publisher foaf:name ?publisherName FILTER(langMatches(lang(?publisherName), "${querylang2}")) }
  OPTIONAL { ?publisher foaf:name ?publisherName }
} ORDER BY ?title
`;

function searchTriplestore() {
  var url = sparqlUrl + encodeURIComponent(sparqlQuery);
  window.open(url, 'triplestore').focus();
  return false;
}

function searchDatasets() {

  document.getElementById("searchresults").style.display = "none";

  var url = 'https://datasetregister.netwerkdigitaalerfgoed.nl/sparql?query=' + encodeURIComponent(sparqlQuery);
  var xhr = new XMLHttpRequest();
  xhr.open("GET", url);
  xhr.setRequestHeader("Accept", "application/json");

  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        showDatasets(JSON.parse(xhr.responseText));
      } else {
        console.log("Call to triplestore got HTTP code " + xhr.status);
      }
    }
  };

  xhr.send();
}

function showDatasets(sparqlresult) {

  document.getElementById("countdatasets").innerHTML = sparqlresult.results.bindings.length;
  document.getElementById("searchresults").style.display = "block";
  //document.getElementById("sparql").scrollIntoView();

  var ul = document.getElementById("datasets");
  ul.innerHTML = "";

  uriCount=0;
  for (var prop in sparqlresult.results.bindings) {
    uriCount++;
    dataset = sparqlresult.results.bindings[prop].dataset.value;
    title = sparqlresult.results.bindings[prop].title.value;
    publisherName = sparqlresult.results.bindings[prop].publisherName.value;

    var li = document.createElement("li");
    li.setAttribute("class", "linkprop");

    var link = document.createElement("a");
    var linkText = document.createTextNode(title);
    link.setAttribute("href", "/datasets/"+dataset);
    link.appendChild(linkText);
    li.appendChild(link);
    li.appendChild(document.createTextNode(" ("+publisherName+")"));

    var div = document.createElement("div");
    div.setAttribute("class", "scroll");
	  li.appendChild(div);

    var eul = document.createElement("table");
    eul.setAttribute("id", "props-" + dataset);
    div.appendChild(eul);

    ul.appendChild(li);
  }
}

document.getElementById('sparql-query').innerHTML=sparqlQuery;
searchDatasets();


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

</script>
<?php include("includes/footer.php") ?>
