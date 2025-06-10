<?php 

$url="";
if (isset($_GET["url"]) && filter_var($_GET["url"], FILTER_VALIDATE_URL)) {
	$url=$_GET["url"];
}
include("includes/header.php") ?>
<main>
   <section class="text m-t-space m-b-space">
      <div class="o-container o-container__small m-t-space">
         <h1 class="title--l"><?= t('Valideer een datasetbeschrijving via URL') ?></h1>
         <p><?= t('Voer een URL in van een pagina met een schema.org/Dataset of schema.org/DataCatalog (inline JSON-LD of direct RDF) om deze via de <a href="apidoc.php">Datasetregister API</a> te valideren. Er wordt dan gecontroleerd de aangetroffen datasetbeschrijving (of datasetbeschrijvingen) voldoen aan de <a href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/" target="_blank">dataset requirements</a>. De validate wordt uitgevoerd op basis van een <a href="https://github.com/netwerk-digitaal-erfgoed/dataset-register/blob/main/shacl/register.ttl">SHACL bestand</a>. Als de op de URL aangetroffen dataset niet voldoet, dan wordt het resultaat van de SHACL validatie getoond.') ?></p>
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
      </div>
   </section>
   
   <section class="m-flex c-module c-module--doorway p-b-space m-theme-bg m-theme--teal">
      <div class="o-container o-container__small">
	  
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

	for (var message in items) {

		var resultSeverity = items[message][0]["http://www.w3.org/ns/shacl#resultSeverity"][0]["@id"].split("#");

		strOverview += '<li><span title="' + resultSeverity[1] + '" class="val_count_' + resultSeverity[1] + '">' + items[message].length + '</span>' + message + ' <a href="#message' + nrMessage + '"><?= t('naar details') ?></a></li>';
		strDetails += '<p id="message' + nrMessage + '"><br></p>';
		strDetails += '<div class="imessage"><h3><span style="float:right" class="val_count_' + resultSeverity[1] + '">';
		if (resultSeverity[1] == 'Warning') {
			strDetails += "<?= t('Waarschuwing') ?>";
		} else {
			if (resultSeverity[1] == 'Info') {
			strDetails += "<?= t('Advies') ?>";
			} else {
				strDetails += "<?= t('Overtreding') ?>";
			}
		}
		strDetails += '</span>' + message;
		if (items[message][0]["http://www.w3.org/ns/shacl#resultPath"]) {
			strDetails+=' via ' + items[message][0]["http://www.w3.org/ns/shacl#resultPath"][0]["@id"];
		}
		strDetails += '</h3><ul>';
		strDetails += '<li>Shape: ' + items[message][0]["http://www.w3.org/ns/shacl#sourceShape"][0]["@id"] + '</li>';
		strDetails += '<li>Constraint: ' + items[message][0]["http://www.w3.org/ns/shacl#sourceConstraintComponent"][0]["@id"] + '</li>';
		strDetails += '</ul><br><table><thead><th>Focus node</th><th>Property or path</th><th>Value</th></thead><tbody>';

		for (var imessage in items[message]) {
			strDetails += '<tr><td>' + items[message][imessage]["http://www.w3.org/ns/shacl#focusNode"][0]["@id"];
			strDetails += '</td><td>';
			if (items[message][imessage]["http://www.w3.org/ns/shacl#resultPath"]) { 
				strDetails+=items[message][imessage]["http://www.w3.org/ns/shacl#resultPath"][0]["@id"];
			}
			strDetails += '</td><td>';
			if (typeof items[message][imessage]["http://www.w3.org/ns/shacl#value"] !== 'undefined' && typeof items[message][imessage]["http://www.w3.org/ns/shacl#value"][0] !== 'undefined' && typeof items[message][imessage]["http://www.w3.org/ns/shacl#value"][0]["@id"] !== 'undefined') {
				strDetails += items[message][imessage]["http://www.w3.org/ns/shacl#value"][0]["@id"];
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


	//Messages.sort(function(a, b) {
	//console.log(Messages[a].length-Messages[b].length);
	//   return Messages[a].length-Messages[b].length;
	//});

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
				strValidationResults += " <?= t('en er') ?> "
			}
			if (arrStats['Warning'] > 1) {
				strValidationResults += "<?= t('zijn') ?> " + arrStats['Warning'] + " <?= t('waarschuwingen') ?>";
			} else {
				strValidationResults += "is " + arrStats['Warning'] + " <?= t('waarschuwing') ?>";
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

call_api();
</script>
<?php } include("includes/footer.php") ?>
