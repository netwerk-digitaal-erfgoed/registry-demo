<?php 

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
         <h1 class="title--l"><?= t('Directe datasetbeschrijving validatie') ?></h1>
         <p><?= t('Voer de inhoud van een datasetbeschrijving (of datacatalogus) in RDF in om deze via de <a href="apidoc.php">Datasetregister API</a> te valideren en selecteer het type RDF. Er wordt dan gecontroleerd of deze voldoet aan de <a href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/" target="_blank">dataset requirements</a>. De validate wordt uitgevoerd op basis van een <a href="https://github.com/netwerk-digitaal-erfgoed/dataset-register/blob/main/requirements/shacl.ttl">SHACL bestand</a>. Als de aangeleverde RDF niet voldoet, dan wordt het resultaat van de SHACL validatie getoond.') ?></p>
		 <p><?= t('De datasetbeschrijving wordt niet opgeslagen of toegevoegd aan het Dataset Register. Via de <a href="viaurl.php">Meld aan</a> pagina kan een URL van een online gepubliceerde datasetbeschrijving worden aangemeld.') ?> <?= t('Staat de datasetbeschrijving al online, plak dan de URL van de datasetbeschrijving in de <a href="validate.php">validatie</a> pagina.') ?></p>
      </div>
   </section>
   <section class="m-flex c-module c-module--doorway p-t-space p-b-space m-theme-bg m-theme--teal">
      <div class="o-container o-container__small">
         <label><?= t('Typering van de inhoud')?>: 
         <input type="radio" name="contenttype" checked value="application/ld+json"> JSON-LD
		 <input type="radio" name="contenttype" value="text/turtle"> Turtle
		 <input type="radio" name="contenttype" value="application/n-triples"> N-triples
         <input type="radio" name="contenttype" value="text/n3"> N3
         <input type="radio" name="contenttype" value="application/trig"> Trig
         <input type="radio" name="contenttype" value="application/n-quads"> N-quads
		 </label><br><br>
         <label for="datasetdescription"><?= t('Inhoud van de datasetbeschrijving (of datacatalogus)')?>:</label>
         <textarea style="background-color:white;width:100%" id="datasetdescription" class="form-control form-control-lg" rows="10"></textarea><br>
         <span class="btn btn--arrow m-t-half-space btn--api" onclick="call_api()">
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
      </div>
   </section>
   
   <section class="text">
      <div class="o-container">
         <div id="api_result" style="display:none">Calling API ...</div>
      </div>
   </section>
   
   <section class="m-flex c-module c-module--doorway p-b-space m-theme-bg m-theme--teal">
      <div class="o-container o-container__small">
		 <div style="display:none" id="api_source_link" class="btn btn--arrow m-t-half-space btn--api" onclick="toggle_visibility()">
		 <?= t('Klik om de SHACL validatie resultaten te bekijken') ?>
            <svg class="rect">
               <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 0; stroke-dashoffset: 0;"></rect>
            </svg>
            <svg class="icon icon-arrow-right">
               <use xlink:href="#icon-arrow-right"></use>
            </svg>
         </div>
		 <xmp id="api_source"></xmp>
        </p>
      </div>
   </section>
</main>

<script>
let arrMessages;
let arrStats;
const preferLanguage = "<?php echo (isset($_GET['lang']) && $_GET['lang'] === 'en') ? 'en' : 'nl'; ?>";
let strValidationResults = "";

// Toggle source link visibility
function toggle_visibility() {
  document.getElementById("api_source_link").style.display = "none";
  document.getElementById("api_source").style.display = "block";
}

// Build and show messages
function showMessages(items) {
  let strOverview = '';
  let strDetails = '';
  let nrMessage = 1;
  strValidationResults = "";
  
  const severityOrder = { Violation: 0, Failure: 0, Warning: 1, Info: 2 };
  const severityLabels = {
    Warning: "<?= t('Waarschuwing') ?>",
    Info: "<?= t('Aanbeveling') ?>",
    default: "<?= t('Overtreding') ?>"
  };

  const messages = Object.entries(items).map(([message, data]) => ({
    key: message,
    severity: data[0]["http://www.w3.org/ns/shacl#resultSeverity"][0]["@id"].split("#")[1],
    data
  }));

  messages.sort((a, b) => severityOrder[a.severity] - severityOrder[b.severity]);

  for (let { key: message, severity, data } of messages) {
    strOverview += `
      <p>
        <span title="${severity}" class="val_count_${severity}">${data.length}</span>
        ${message} <a class="naardetails" href="#message${nrMessage}"><?= t('naar details') ?></a>
      </p>
    `;

    strDetails += `
      <p id="message${nrMessage}"><br></p>
      <div class="imessage">
        <h3>
          <span style="float:right" class="val_count_${severity}">
            ${severityLabels[severity] ?? severityLabels.default}
          </span>
          ${message}${data[0]["http://www.w3.org/ns/shacl#resultPath"] ? " via " + data[0]["http://www.w3.org/ns/shacl#resultPath"][0]["@id"] : ""}
        </h3>
        <ul>
          <li>Shape: ${data[0]["http://www.w3.org/ns/shacl#sourceShape"][0]["@id"]}</li>
          <li>Constraint: ${data[0]["http://www.w3.org/ns/shacl#sourceConstraintComponent"][0]["@id"]}</li>
        </ul><br>
        <table>
          <thead><th>Focus node</th><th>Property or path</th><th>Value</th></thead>
          <tbody>
    `;

    for (let imessage of data) {
      const path = imessage["http://www.w3.org/ns/shacl#resultPath"]?.[0]?.["@id"] ?? "";
      const value = imessage["http://www.w3.org/ns/shacl#value"]?.[0]?.["@id"] ?? "";

      strDetails += `
        <tr>
          <td>${imessage["http://www.w3.org/ns/shacl#focusNode"][0]["@id"]}</td>
          <td>${path}</td>
          <td>${value}</td>
        </tr>
      `;
    }

    strDetails += `</tbody></table></div>`;
    nrMessage++;
  }

  strValidationResults += strOverview + strDetails;
}

// Process messages from SHACL
function processMessages(shaclObject) {
  const resultMessage = shaclObject["http://www.w3.org/ns/shacl#resultMessage"];
  if (!resultMessage) return;

  const resultMessageValue =
    resultMessage.length > 1
      ? (resultMessage[0]["@language"] === preferLanguage ? resultMessage[0]["@value"] : resultMessage[1]["@value"])
      : resultMessage[0]["@value"];

  arrMessages[resultMessageValue] ??= [];
  arrMessages[resultMessageValue].push(shaclObject);

  const severity = shaclObject["http://www.w3.org/ns/shacl#resultSeverity"][0]["@id"].split("#")[1];
  arrStats[severity] = (arrStats[severity] || 0) + 1;
}

// Call API
function call_api() {

  // clear previous results
  arrMessages = {};
  arrStats = {};

  const al = document.getElementById("api_source_link");
  const as = document.getElementById("api_status");
  const ar = document.getElementById("api_result");

  al.style.display = "none";
  as.style.backgroundColor = "none";
  as.innerHTML = "";
  ar.innerHTML = "In progress...";
  ar.style.display = "block";

  fetch("https://datasetregister.netwerkdigitaalerfgoed.nl/api/datasets/validate", {
    method: "POST",
    headers: {
      Accept: "application/ld+json",
      "Content-Type": document.querySelector('input[name="contenttype"]:checked').value
    },
    body: document.getElementById("datasetdescription").value
  })
    .then(response => {
      if (response.status == 200) {
        as.style.backgroundColor = "#5cb85c";
        as.innerHTML = "<?= t('Alle datasetbeschrijvingen op de ingediende URL zijn geldig volgens de <a href=\"https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/\">vereisten voor datasets</a>.') ?>";
      } else {
        al.style.display = "block";
        as.style.backgroundColor = "#e44d26";
        const messages = {
          400: "<?= t('Een of meer datasetbeschrijvingen zijn ongeldig volgens de <a href=\"https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/\">vereisten voor datasets</a>.')?>",
          404: "<?= t('De URL kan niet worden gevonden.')?>",
          406: "<?= t('De URL kan worden gevonden, maar bevat geen datasets.')?>"
        };
        as.innerHTML = messages[response.status] ?? "<?= t('Er heeft zich een onbekende fout voorgedaan. <a href=\"/contact.php\">Neem contact met ons op</a> en geef daarbij de door u ingevulde URL op.')?>";
      }
      return response.text();
    })
    .then(displayMessages)
    .catch(err => console.warn("call_api error:", err));
}

// Display messages
function displayMessages(response) {
  document.getElementById("api_source").innerHTML = response;

  try {
    JSON.parse(response).forEach(processMessages);
  } catch (err) {
    console.log(err);
  }

  const numberMessages = Object.keys(arrMessages).length;
  if (numberMessages > 0) {
    strValidationResults += "<h2><?= t('Er') ?> ";
    const pluralize = (count, singular, plural) =>
      count > 1 ? `<?= t('zijn') ?> ${count} ${plural}` : `is ${count} ${singular}`;

    if (arrStats.Violation) {
      strValidationResults += pluralize(arrStats.Violation, "<?= t('overtreding') ?>", "<?= t('overtredingen') ?>");
    }
    if (arrStats.Warning) {
      if (arrStats.Violation) strValidationResults += " <?= t('en er') ?> ";
      strValidationResults += pluralize(
        arrStats.Warning,
        "<?= t('waarschuwing (in de toekomst wordt deze aangemerkt als overtreding)') ?>",
        "<?= t('waarschuwingen (in de toekomst worden deze aangemerkt als overtredingen)') ?>"
      );
    }
    if (arrStats.Info) {
      if (arrStats.Violation || arrStats.Warning) strValidationResults += " <?= t('en er') ?> ";
      strValidationResults += pluralize(arrStats.Info, "<?= t('aanbeveling') ?>", "<?= t('aanbevelingen') ?>");
    }

    strValidationResults += " <?= t('geconstateerd') ?></h2>";
    showMessages(arrMessages);
  } else {
	strValidationResults = "";
  }

  document.getElementById("api_result").innerHTML = strValidationResults;
  document.getElementById("api_show").scrollIntoView({ behavior: "smooth", block: "start" });
}
</script>
<?php 

include("includes/footer.php") 

?>
