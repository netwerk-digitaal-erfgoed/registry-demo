<?php 

$url="";
if (isset($_GET["url"]) && filter_var($_GET["url"], FILTER_VALIDATE_URL)) {
	$url=$_GET["url"];
}
include("includes/header.php") ?>
<style>
.naardetails {
	border: 1px solid #aaa;
    padding: 4px;
    color: #444!important;
    text-decoration: none!important;
    cursor: pointer;
    margin-left: 1em;
}
</style>
<main>
   <section class="text m-t-space m-b-space">
      <div class="o-container o-container__small m-t-space">
         <h1 class="title--l"><?= t('Valideer een datasetbeschrijving via URL') ?></h1>
         <p><?= t('Voer een URL in van een pagina met een schema.org/Dataset of schema.org/DataCatalog (inline JSON-LD of direct RDF) om deze via de <a href="apidoc.php">Datasetregister API</a> te valideren. Er wordt dan gecontroleerd de aangetroffen datasetbeschrijving (of datasetbeschrijvingen) voldoen aan de <a href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/" target="_blank">dataset requirements</a>. De validate wordt uitgevoerd op basis van een <a href="https://github.com/netwerk-digitaal-erfgoed/dataset-register/blob/main/requirements/shacl.ttl">SHACL bestand</a>. Als de op de URL aangetroffen dataset niet voldoet, dan wordt het resultaat van de SHACL validatie getoond.') ?></p>
		 <p><?= t('De datasetbeschrijving wordt niet opgeslagen of toegevoegd aan het Dataset Register. Via de <a href="viaurl.php">Meld aan</a> pagina kan een URL van een online gepubliceerde datasetbeschrijving worden aangemeld.') ?> <?= t('Staat de datasetbeschrijving nog niet online, plak dan de RDF van de datasetbeschrijving in de <a href="validate-post.php">directe validatie</a> pagina.') ?></p>		 
      </div>
   </section>
   <section class="m-flex c-module c-module--doorway p-t-space p-b-space m-theme-bg m-theme--teal">
      <div class="o-container o-container__small"><form action="validate.php" id="validate_form" class="form-control" method="get">
	  <?php if (isset($_GET["lang"]) && $_GET["lang"]=="en") { echo '<input type="hidden" name="lang" value="en">'; } ?>
         <label for="datasetdescriptionurl"><?= t('URL van pagina met datasetbeschrijving (of datacatalogus)')?>:</label>
         <input type="url" id="datasetdescriptionurl" class="form-control form-control-lg" name="url" value="<?= $url ?>"><br>
         <span class="btn btn--arrow m-t-half-space btn--api" onclick="validate_form.submit()">
		 <?= t('Datasetbeschrijving valideren') ?>
            <svg class="rect">
               <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 0; stroke-dashoffset: 0;"></rect>
            </svg>
            <svg class="icon icon-arrow-right">
               <use xlink:href="#icon-arrow-right"></use>
            </svg>
         </span>
         <p id="api_show"><br></p>
		 <div id="api_status"></div>
 
 <?php if(!empty($url)) { ?>
 
      </div>
   </section>
   
   <section class="m-t-quarter-space">
      <div class="o-container">
         <div id="api_result"></div>		 
		 <div id="cannot_add_datasetdescription" style="display:none">
		  <p style="background-color:#e44d26;color:white;padding:10px;margin:0 1em 2em 1em">
		    <?= t('Deze datasetbeschrijving (of datacatalogus) kan nog niet worden aangemeld op data de domeinnaam <span id="hostname_datasetdescription"></span> nog niet bekend is bij het Dataset Register. Neem contact op met het verzoek om deze domeinnaam op de "allowed domain list" te laten plaatsen.') ?>
		  </p>
	    </div>
      </div>
   </section>
   
   <section class="m-flex c-module c-module--doorway p-b-space m-theme-bg m-theme--teal">
      <div class="o-container o-container__small">
	  
		<div id="can_add_datasetdescription" style="display:none">
		  <a id="btnAdd" class="btn btn--arrow m-t-half-space btn--api" style="display:none" href="viaurl.php">
		  <?= t('Datasetbeschrijving aanmelden') ?>
            <svg class="rect">
               <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 0; stroke-dashoffset: 0;"></rect>
            </svg>
            <svg class="icon icon-arrow-right">
               <use xlink:href="#icon-arrow-right"></use>
            </svg>
         </a>
		 
		 <span id="api_source_link" class="btn btn--arrow m-t-half-space btn--api" onclick="toggle_visibility()">
		 <?= t('Klik om de SHACL validatie resultaten te bekijken') ?>
            <svg class="rect">
               <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 0; stroke-dashoffset: 0;"></rect>
            </svg>
            <svg class="icon icon-arrow-right">
               <use xlink:href="#icon-arrow-right"></use>
            </svg>
         </span>
		</div>

		
		 <xmp id="api_source"></xmp>
<?php } ?>
        </p></form>
      </div>
   </section>
</main>

<?php if(!empty($url)) { ?>

<script>
var arrMessages = [];
var arrStats = [];
var preferLanguage = "<?php if (isset($_GET["lang"]) && $_GET["lang"]=="en") { echo 'en'; } else { echo "nl"; } ?>";
var strValidationResults = "";


function toggle_visibility() {
	document.getElementById("api_source_link").style.display = "none";
	document.getElementById("api_source").style.display = "block";
}

function showMessages(items) {
    var strOverview = '';
    var strDetails = '';
    var nrMessage = 1;

    // Severity order mapping
    const severityOrder = { "Violation": 0, "Failure": 0, "Warning": 1, "Info": 2 };

    // Collect messages into an array with severity attached
    let messages = Object.keys(items).map(message => {
        const severity = items[message][0]["http://www.w3.org/ns/shacl#resultSeverity"][0]["@id"].split("#")[1];
        return { key: message, severity, data: items[message] };
    });

    // Sort messages by severity order
    messages.sort((a, b) => severityOrder[a.severity] - severityOrder[b.severity]);

    // Now build output
    for (let { key: message, severity, data } of messages) {
        strOverview += '<p><span title="' + severity + '" class="val_count_' + severity + '">' + data.length + '</span>' + message + ' <a class="naardetails" href="#message' + nrMessage + '"><?= t('naar details') ?></a></p>';
        strDetails += '<p id="message' + nrMessage + '"><br></p>';
        strDetails += '<div class="imessage"><h3><span style="float:right" class="val_count_' + severity + '">';

        if (severity === 'Warning') {
            strDetails += "<?= t('Waarschuwing') ?>";
        } else if (severity === 'Info') {
            strDetails += "<?= t('Aanbeveling') ?>";
        } else {
            strDetails += "<?= t('Overtreding') ?>";
        }

        strDetails += '</span>' + message;
        if (data[0]["http://www.w3.org/ns/shacl#resultPath"]) {
            strDetails += ' via ' + data[0]["http://www.w3.org/ns/shacl#resultPath"][0]["@id"];
        }
        strDetails += '</h3><ul>';
        strDetails += '<li>Shape: ' + data[0]["http://www.w3.org/ns/shacl#sourceShape"][0]["@id"] + '</li>';
        strDetails += '<li>Constraint: ' + data[0]["http://www.w3.org/ns/shacl#sourceConstraintComponent"][0]["@id"] + '</li>';
        strDetails += '</ul><br><table><thead><th>Focus node</th><th>Property or path</th><th>Value</th></thead><tbody>';

        for (let imessage in data) {
            strDetails += '<tr><td>' + data[imessage]["http://www.w3.org/ns/shacl#focusNode"][0]["@id"];
            strDetails += '</td><td>';
            if (data[imessage]["http://www.w3.org/ns/shacl#resultPath"]) {
                strDetails += data[imessage]["http://www.w3.org/ns/shacl#resultPath"][0]["@id"];
            }
            strDetails += '</td><td>';
            if (typeof data[imessage]["http://www.w3.org/ns/shacl#value"] !== 'undefined'
                && typeof data[imessage]["http://www.w3.org/ns/shacl#value"][0] !== 'undefined'
                && typeof data[imessage]["http://www.w3.org/ns/shacl#value"][0]["@id"] !== 'undefined') {
                strDetails += data[imessage]["http://www.w3.org/ns/shacl#value"][0]["@id"];
            }
            strDetails += '</td></tr>';
        }
        strDetails += '</table></div>';
        nrMessage++;
    }

    strValidationResults += strOverview + strDetails;
}


function processMessages(shaclObject) {

	if (shaclObject["http://www.w3.org/ns/shacl#resultMessage"]) {
		var resultMessage = shaclObject["http://www.w3.org/ns/shacl#resultMessage"];
		if (resultMessage.length > 1) { // our own Messages are in 2 languages, SHACL's are in @en
			if (shaclObject["http://www.w3.org/ns/shacl#resultMessage"][0]["@language"] == preferLanguage) {
				resultMessageValue = shaclObject["http://www.w3.org/ns/shacl#resultMessage"][0]["@value"];
			} else { // our Messages are either @nl or @en
				resultMessageValue = shaclObject["http://www.w3.org/ns/shacl#resultMessage"][1]["@value"];
			}
		} else {
			resultMessageValue = shaclObject["http://www.w3.org/ns/shacl#resultMessage"][0]["@value"];
		}

		if (!arrMessages[resultMessageValue]) {
			arrMessages[resultMessageValue] = [];
		}
		arrMessages[resultMessageValue].push(shaclObject);

		var resultSeverity = shaclObject["http://www.w3.org/ns/shacl#resultSeverity"][0]["@id"].split("#");
		if (arrStats[resultSeverity[1]]) {
			arrStats[resultSeverity[1]]++;
		} else {
			arrStats[resultSeverity[1]] = 1;
		}
	}
}

function call_api() {
	var ab = document.getElementById("btnAdd");
	ab.style.display = "none";

	var al = document.getElementById("api_source_link");
	al.style.display = "none";

	var as = document.getElementById("api_status");

	as.style.backgroundColor = "none";
	as.innerHTML = "";




	document.getElementById("api_result").innerHTML = "Calling API ...";
	fetch("https://datasetregister.netwerkdigitaalerfgoed.nl/api/datasets/validate", {
			"method": "PUT",
			"headers": {
				"Accept": "application/ld+json",
				"Content-Type": "application/ld+json"
			},
			"body": JSON.stringify({
				"@id": document.getElementById("datasetdescriptionurl").value
			})
		})
		.then(response => {
			var as = document.getElementById("api_status");

			if (response.status == "200") {
				as.style.backgroundColor = "#5cb85c";
				as.innerHTML = "<?= t('Alle datasetbeschrijvingen op de ingediende URL zijn geldig volgens de <a href=\"https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/\">vereisten voor datasets</a>.') ?>";
				
				ab.style.display = "inline-block";
				ab.href = "viaurl.php?url="+document.getElementById("datasetdescriptionurl").value;

			} else {
				al.style.display = "block";
				as.style.backgroundColor = "#e44d26";
				if (response.status == "400") {
					as.innerHTML = "<?= t('Een of meer datasetbeschrijvingen zijn ongeldig volgens de <a href=\"https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/\">vereisten voor datasets</a>.')?>";
				} else {
					if (response.status == "404") {
						as.innerHTML = "<?= t('De URL kan niet worden gevonden.')?>";
					} else {
						if (response.status == "406") {
							as.innerHTML = "<?= t('De URL kan worden gevonden, maar bevat geen datasets.')?>";
						} else {
							as.innerHTML = "<?= t('Er heeft zich een onbekende fout voorgedaan. <a href=\"/contact.php\">Neem contact met ons op</a> en geef daarbij de door u ingevulde URL op.')?>";
						}
					}
				}
			}

			return response.text();
		})
		.then(response => {
			displayMessages(response);
		})
		.catch(err => {
			console.log(err);
		});
}


function displayMessages(response) {

	document.getElementById("api_source").innerHTML = response;
	
	try {
		results = JSON.parse(response);
		results.forEach(processMessages);
    } catch (err) {
        console.log(err);
    }

	var numberMessages = Object.keys(arrMessages).length;

	if (numberMessages > 0) {
		strValidationResults += "<h2><?= t('Er') ?> ";
		if (arrStats['Violation'] > 0) {
			if (arrStats['Violation'] > 1) {
				strValidationResults += "<?= t('zijn') ?> " + arrStats['Violation'] + " <?= t('overtredingen') ?>";
			} else {
				strValidationResults += "is " + arrStats['Violation'] + " <?= t('overtreding') ?>";
			}
		}

		if (arrStats['Warning'] > 0) {
			if (arrStats['Violation'] > 0) {
				strValidationResults += " <?= t('en er') ?> ";
			}
			if (arrStats['Warning'] > 1) {
				strValidationResults += "<?= t('zijn') ?> " + arrStats['Warning'] + " <?= t('waarschuwingen (in de toekomst worden deze aangemerkt als overtredingen)') ?>";
			} else {
				strValidationResults += "is " + arrStats['Warning'] + " <?= t('waarschuwing (in de toekomst wordt deze aangemerkt als overtreding)') ?>";
			}
		}

		if (arrStats['Info'] > 0) {
			if (arrStats['Violation'] > 0 || arrStats['Warning'] > 0) {
				strValidationResults += " <?= t('en er') ?> ";
			}
			if (arrStats['Info'] > 1) {
				strValidationResults += "<?= t('zijn') ?> " + arrStats['Info'] + " <?= t('aanbevelingen') ?>";
			} else {
				strValidationResults += "is " + arrStats['Info'] + " <?= t('aanbeveling') ?>";
			}
		}

		strValidationResults += " <?= t('geconstateerd') ?></h2>";
		showMessages(arrMessages);
	}

	document.getElementById("api_result").innerHTML = strValidationResults;
	document.getElementById("api_show").scrollIntoView({
		behavior: "smooth",
		block: "start"
	});

}

function get_base_hostname(url) {
  try {
    // Parse the URL
    const { hostname } = new URL(url);

    // Split into parts
    const parts = hostname.split('.');

    // If it's something like "bostaging.nl" → return it as-is
    // If it's longer (e.g., "verhaalvanutrecht-nl.bostaging.nl") → return last two parts
    if (parts.length >= 2) {
      return parts.slice(-2).join('.');
    }

    return hostname; // fallback
  } catch (e) {
    console.error("Invalid URL:", url);
    return null;
  }
}

const sparqlRepo = 'https://datasetregister.netwerkdigitaalerfgoed.nl/sparql?query=';

function check_allowed() {

  const datasetUrl = document.getElementById("datasetdescriptionurl")?.value || "";
  if (!datasetUrl) return;
  
  const baseHostname = get_base_hostname(datasetUrl);
  const sparqlAllowed = `SELECT ?s FROM <https://data.netwerkdigitaalerfgoed.nl/registry/allowed_domain_names> WHERE { ?s ?p ?o FILTER(?o = "${baseHostname}")}`;
  
  var url = sparqlRepo + encodeURIComponent(sparqlAllowed);
  var xhr = new XMLHttpRequest();
  xhr.open("GET", url);
  xhr.setRequestHeader("Accept", "application/json");

  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        show_or_hide_add(baseHostname, JSON.parse(xhr.responseText));
      } else {
        console.log("Call to triplestore got HTTP code " + xhr.status);
      }
    }
  };

  xhr.send();
}

function show_or_hide_add(baseHostname, sparqlresult) {
	console.log(sparqlresult);
  if (sparqlresult.results.bindings && sparqlresult.results.bindings.length > 0) {
	  document.getElementById("can_add_datasetdescription").style.display = "block";	
  } else {
	  document.getElementById("hostname_datasetdescription").innerHTML=baseHostname;
	  document.getElementById("cannot_add_datasetdescription").style.display = "block";		
  }
}

call_api();
check_allowed();
</script>
<?php } include("includes/footer.php") ?>
