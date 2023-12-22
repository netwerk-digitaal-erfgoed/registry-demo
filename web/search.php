<?php include("includes/search.php"); include("includes/header.php"); 

$lang="nl"; 
$notlang="en";
if(isset($_GET["lang"]) && $_GET["lang"]=="en") { 
	$lang="en"; 
	$notlang="nl";
} 

if (isset($_GET["o"]) && filter_var($_GET["o"], FILTER_VALIDATE_URL)) {
	$o=$_GET["o"];
}

?>
<main>
  <section class="text m-t-space m-b-space m-theme--blue">
    <div class="o-container o-container__small m-t-space">
      <h1 class="title--l"><?= t('Doorzoek alle datasetbeschrijvingen') ?></h1>
      <p><?= t('Door erfgoedinstellingen aangemelde datasetbeschrijvingen worden opgeslagen in een openbare <a target="triplestore" href="https://triplestore.netwerkdigitaalerfgoed.nl/">triplestore</a> op basis van het DCAT <a href="datamodel.php">datamodel</a>. Via de <a target="datastory" href="https://datastories.demo.netwerkdigitaalerfgoed.nl/hackalod/datasetregister/">Data Stories</a> leer je hoe te zoeken middels SPARQL. Deze pagina toont een zoekinterface op het datasetregister. Ook is dit een hulpmiddel voor het maken van SPARQL queries om de datasetbeschrijvingen te doorzoeken.')?></p>
    </div>
  </section>
  <section id="" class="m-t-quarter-space m-theme-bg m-theme--teal search-div">
    <div class="o-container no-container__small">
      <div class="row">
        <div class="column">
          <label id="searchTermLabel"><?= t('Zoekwoord')?> (<?= t('doorzoekt namen, omschrijvingen en steekwoorden') ?>)</label> 
          <input aria-labelledby="searchTermLabel" title="<?= t('Als er meerdere zoektermen worden opgegeven dan bevatten de zoekresultaten één of meer van deze termen. Wil je dat alle zoektermen moeten voorkomen koppel de zoektermen dan met AND.') ?>" class="form-control" value="" type="search" id="searchTerm" onkeyup="updateSparql()">
          <br><br>
          <label id="publisher_listLabel"><?= t('Uitgever')?></label>
          <select aria-labelledby="publisher_listLabel" class="form-control" id="publisher_list" name="publisher">
            <option value=""><?= t('Alle organisaties')?></option>
<?php
                     $publishers=getPublishers();
                     foreach ($publishers as $publisher_uri => $publisher_name) {
                     	echo '            <option ';
						if (isset($o) && $publisher_uri==$o) { echo 'selected '; }
                     	echo 'value="'.htmlentities($publisher_uri).'">'.str_replace(" ","&nbsp;",htmlentities($publisher_name))."</option>";
                     }
                     ?>
          </select>
          <br>- <?= t('of') ?> -<br>
          <label id="creator_listLabel"><?= t('Maker')?></label>
          <select aria-labelledby="creator_listLabel" class="form-control" id="creator_list"  name="creator">
            <option value=""><?= t('Alle organisaties')?></option>
<?php
                     $creators=getCreators();
                     foreach ($creators as $creator_uri => $creator_name) {
                     	echo '            <option ';
						if (isset($o) && $creator_uri==$o) { echo 'selected '; }
						echo 'value="'.htmlentities($creator_uri).'">'.str_replace(" ","&nbsp;",htmlentities($creator_name))."</option>";
                     }
                     ?>
          </select>
        </div>
        <div class="column2">
          <label><?= t('Formaat')?></label>
          <div class="formatcheckboxes">
                  <?php
                     $formats=getFormats();
                     foreach ($formats as $format_name) {
                     	echo '<label>';
                     	echo '<input class="choice" type="checkbox" name="format[]" value="'.htmlentities($format_name).'">';
                     	echo '&nbsp;&nbsp;'.htmlentities($format_name);
                     	echo '</label>';
                     }
                     ?>
               </div>
               <p class="choices"><a href="#" onclick="return set_lod_choices()"><?= t('Selecteer Linked Data formaten')?></a> | <a href="#" onclick="return set_sparql_choices()"><?= t('Selecteer SPARQL formaten')?></a> | <a href="#" onclick="return clear_formats()"><?= t('Verwijder selectie(s)')?></a></p>
               <span class="btn btn--arrow m-t-half-space btn--api" style="display:block" onclick="searchDatasets()">
               <?= t('Zoek datasets')?><div id="wait" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                  <svg class="rect">
                     <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 586; stroke-dashoffset: 586;"></rect>
                  </svg>
                  <svg class="icon icon-arrow-right">
                     <use xlink:href="#icon-arrow-right"></use>
                  </svg>
               </span>
            </div>
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
         <div id="searchresults" style="display:none">
			<div id="facet_block"><strong><?= t('Filter op organisatie') ?></strong>: <div id="facets"></div></div>
            <h2><?= t('Zoekresultaten')?> (<span id="countdatasets">0</span>)</h2>
            <ul id="datasets"></ul>
         </div>
      </div>
   </section>
</main>
<script>
const sparqlUrl = 'https://triplestore.netwerkdigitaalerfgoed.nl/sparql?query=';
var sparqlQuery;

function updateSparql() {

  searchTerm = document.getElementById("searchTerm").value.trim().replace(/"/g, '\\"');

  sparqlQuery = `PREFIX dcat: <http://www.w3.org/ns/dcat#>
PREFIX dct:  <http://purl.org/dc/terms/>
PREFIX foaf: <http://xmlns.com/foaf/0.1/>
PREFIX luc: <http://www.ontotext.com/connectors/lucene#>
PREFIX luc-index: <http://www.ontotext.com/connectors/lucene/instance#>
SELECT DISTINCT ?dataset ?title ?publisherName WHERE {
  ?search a luc-index:datasetregister ;
          luc:query "${searchTerm}" ;
          luc:entities ?dataset .
  ?dataset dct:publisher ?publisher .
  OPTIONAL { ?dataset dct:title ?title FILTER(langMatches(lang(?title), "<?= $lang ?>")) }
  OPTIONAL { ?dataset dct:title ?title FILTER(langMatches(lang(?title), "<?= $notlang ?>")) }
  OPTIONAL { ?dataset dct:title ?title }    
  OPTIONAL { ?publisher foaf:name ?publisherName FILTER(langMatches(lang(?publisherName), "<?= $lang ?>")) }
  OPTIONAL { ?publisher foaf:name ?publisherName FILTER(langMatches(lang(?publisherName), "<?= $notlang ?>")) }
  OPTIONAL { ?publisher foaf:name ?publisherName }
`;
  if (creator) {
    sparqlQuery += "  ?dataset dct:creator <" + creator + "> .\n";
  }
  if (publisher) {
    sparqlQuery += "  ?dataset dct:publisher <" + publisher + "> .\n";
  }
  if (formats.size > 0) {
    sparqlQuery += "  ?dataset dcat:distribution ?distribution .\n";
    sparqlQuery += "  ?distribution dct:format ?format .\n";
    sparqlQuery += "  FILTER( ?format=\"" + Array.from(formats).join('" || ?format="') + "\")\n";
  }

  sparqlQuery += "} ORDER BY ?title";

  document.getElementById('sparql-query').innerHTML = sparqlQuery;
  console.log(sparqlQuery);
  toHash();
}

function set_creator(value) {
  creator = value;
  publisher = "";
  document.getElementById('publisher_list').options[0].selected = true;
}

function set_publisher(value) {
  creator = "";
  document.getElementById('creator_list').options[0].selected = true;
  publisher = value;
}

function set_choice(name, value, checked) {
  switch (name) {
    case 'format[]':
      if (checked) {
        formats.add(value);
      } else {
        formats.delete(value);
      }
      break;
    case 'searchIn[]':
      if (checked) {
        searchIn.add(value);
      } else {
        searchIn.delete(value);
      }
      break;
  }
  updateSparql();
}

function searchTriplestore() {
  updateSparql();
  var url = sparqlUrl + encodeURIComponent(sparqlQuery);
  window.open(url, 'triplestore').focus();
  return false;
}

function searchDatasets() {
	
  document.getElementById("wait").style.display="inline-block";
	
  updateSparql();

  document.getElementById("searchresults").style.display = "none";

  var url = 'https://triplestore.netwerkdigitaalerfgoed.nl/repositories/registry?query=' + encodeURIComponent(sparqlQuery);
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
    document.getElementById("wait").style.display="none";
  };

  xhr.send();
}

var organisationFacet;

function showDatasets(sparqlresult) {

  document.getElementById("countdatasets").innerHTML = sparqlresult.results.bindings.length;
  document.getElementById("searchresults").style.display = "block";
  document.getElementById("sparql").scrollIntoView();

  organisationFacet=new Object();
  
  var ul = document.getElementById("datasets");
  ul.innerHTML = "";

  uriCount=0;
  for (var prop in sparqlresult.results.bindings) {
    uriCount++;
    dataset = sparqlresult.results.bindings[prop].dataset.value;
    title = sparqlresult.results.bindings[prop].title.value;
    publisherName = sparqlresult.results.bindings[prop].publisherName.value;
	if (organisationFacet[publisherName]) {
		organisationFacet[publisherName]++;
	} else {
		organisationFacet[publisherName]=1;
	}
	
    var li = document.createElement("li");
    li.setAttribute("class", "linkprop");
	li.setAttribute("data-organisation", publisherName);

    var link = document.createElement("a");
    var linkText = document.createTextNode(title);
    link.setAttribute("href", "show.php?lang=<?= $lang ?>&uri="+encodeURIComponent(dataset));
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
  showFacets();
}

function showFacets() {
	if (Object.keys(organisationFacet).length>1) {
		  document.getElementById("facet_block").style.display = "block";

		  facet_options="";
		  // sort by number of occurences
		  var organisations = Object.keys(organisationFacet);
		  organisations.sort(function(a, b) { return organisationFacet[b] - organisationFacet[a] });

		  organisations.forEach(function(org) {
			facet_options+='<label><input type="checkbox" checked class="org_facet" onclick="showhideListFacets(this)" value="'+org+'"> '+org+' ('+organisationFacet[org]+')</label> ';			
		  });
		
		  document.getElementById("facets").innerHTML=facet_options;
	} else {
		  document.getElementById("facet_block").style.display = "none";
	}	
}

function showhideListFacets(organisation) {
	var ul = document.getElementById("datasets");
	var items = ul.getElementsByTagName("li");
	var nrFacetResults=0;
	for (var i = 0; i < items.length; ++i) {
		if(items[i].getAttribute('data-organisation')==organisation.value) {
			if (organisation.checked) {
				items[i].style.display="list-item";
			} else {
				items[i].style.display="none";
			}
		}
        if (items[i].style.display!="none") {
            nrFacetResults++;
		}
	}
	document.getElementById("countdatasets").innerHTML=nrFacetResults;
}

function getSortedKeys(obj) {
    var keys = Object.keys(obj);
    return keys.sort(function(a,b){return obj[b]-obj[a]});
}

function set_lod_choices() {
  choices = document.getElementsByClassName('choice');
  for (i = 0; i < choices.length; i++) {
    if (choices[i].name == "format[]") {
      if (["application/ld+json", "application/n-quads", "application/n-triples", "application/rdf+xml", "application/sparql-query", "application/trig", "application/turtle", "application/vnd.hdt", "text/turtle", "text/n3", "application/x-sparqlstar-results+json", "application/sparql-results+xml", "application/sparql-results+json", "application/x-sparqlstar-results", "application/sparql-results","application/ld+json+gzip","application/n-quads+gzip","application/n-triples+gzip","application/rdf+xml+gzip","text/n3+gzip","text/turtle+gzip"].includes(choices[i].value)) {
        choices[i].checked = true;
        formats.add(choices[i].value);
      } else {
        choices[i].checked = false;
        formats.delete(choices[i].value);
      }
    }
  }
  updateSparql();
  return false;
}

function set_sparql_choices() {
  choices = document.getElementsByClassName('choice');
  for (i = 0; i < choices.length; i++) {
    if (choices[i].name == "format[]") {
      if (["application/sparql-query", "application/x-sparqlstar-results+json", "application/sparql-results+xml", "application/sparql-results+json", "application/x-sparqlstar-results", "application/sparql-results"].includes(choices[i].value)) {
        choices[i].checked = true;
        formats.add(choices[i].value);
      } else {
        choices[i].checked = false;
        formats.delete(choices[i].value);
      }
    }
  }
  updateSparql();
  return false;
}

function clear_formats() {
  choices = document.getElementsByClassName('choice');
  for (i = 0; i < choices.length; i++) {
    if (choices[i].name == "format[]") {
      choices[i].checked = false;
      formats.delete(choices[i].value);
    }
  }
  return false;
}

function toHash() {
	var searchData={};

	if (creator) {
		searchData.c=creator;
	}
	if (publisher) {
		searchData.p=publisher;
	}
	if (formats.size > 0) {
		searchData.f=Array.from(formats);
	}
	searchData.t=document.getElementById("searchTerm").value.trim();
	history.pushState({}, "", "#"+btoa(JSON.stringify(searchData)));
}

function fromHash() {

	var hash = new URL(document.URL).hash.substring(1);

	if (hash.length>0) {
		try {
			var searchData=JSON.parse(atob(hash));
			if (searchData.c) {
				creator=searchData.c;
				document.getElementById("creator_list").value=creator;
			}
			if (searchData.p) {
				publisher=searchData.p;
				document.getElementById("publisher_list").value=publisher;
			}
			
			searchIn=new Set(searchData.i);	  
			document.getElementById("searchTerm").value=searchData.t;

			if (searchData.f) {
				formats=new Set(searchData.f);		
				formatChoices=document.getElementsByClassName("choice");
				Array.prototype.forEach.call(formatChoices, function(el) {
					el.checked=searchData.f.includes(el.value);
				});
			}
			searchDatasets();
		} catch (e) {
			console.log(e);
			return false;
		}
	} else {
		updateSparql();		
	}
}

var bSearch=0;
var creator = '';
if (document.getElementById('creator_list').selectedIndex>0) { 
	creator=document.getElementById('creator_list').options[document.getElementById('creator_list').selectedIndex].value; 
	bSearch=1;
}
var publisher = '';
if (document.getElementById('publisher_list').selectedIndex>0) { 
	publisher=document.getElementById('publisher_list').options[document.getElementById('publisher_list').selectedIndex].value; 
	bSearch=1;
}
var formats = new Set();
var searchIn = new Set(["dct:title"]);

if (bSearch) {
	 searchDatasets();
} else {
	fromHash();
}

document.getElementById('creator_list').addEventListener('change', function() {
  set_creator(this.value);
  updateSparql();
});

document.getElementById('publisher_list').addEventListener('change', function() {
  set_publisher(this.value);
  updateSparql();
});

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

document.getElementById("searchTerm").addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
	searchDatasets();
  }
});

choices = document.getElementsByClassName('choice');
for (i = 0; i < choices.length; i++) {
  choices[i].addEventListener('click', function(a) {
    set_choice(this.name, this.value, this.checked);
    updateSparql();
  });
}
</script>
<?php include("includes/footer.php") ?>