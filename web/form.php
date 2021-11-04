<?php 

include('includes/form-definition.php'); 
include('includes/form-util.php'); 
include("includes/header.php");

?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,600" integrity="sha384-b71qHkM9yz+jZ/D+E8iSoeT0wWu4lsltA9v/vHPif0KtZaikbMStnBmJxSBdlT1D" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.9/css/bootstrap-select.min.css" integrity="sha384-YT6Vh7LpL+LTEi0RVF6MlYgTcoBIji2PmGBbXk3D4So5lw1e64pyuwTtbLOED1Li" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<link href="assets/vendor/chosen/chosen.css" rel="stylesheet" type="text/css">
<<main>
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
         <h1 class="title--l">Maak een datasetbeschrijving</h1>
         <p><br></p>
         <h2 class="title--m">Datasetbeschrijvingen uw (collectiebeheer)systeem</h2>
         <p>Het beschrijven van een dataset toont grote overeenkomsten met het beschrijven van een erfgoedcollectie. Het is dan ook logisch om ook de datasets in het collectiebeheersysteem te beheren. Dicht bij de bron, want vanuit hier worden veelal ook de datasets (als bestand of als API) beschikbaar gesteld. Online publicatie van de datasetbeschrijvingen is hierdoor vaak een eenvoudige en vooral geautomatiseerde stap. Vraag bij uw leverancier wat de mogelijkheden zijn om datasetbeschrijvingen te maken en te publiceren zodat ook uw datasets beter vindbaar worden.</p>
         <p><br></p>
         <h2 class="title--m">Maak handmatig een datasetbeschrijving</h2>
         <p>Als uw leverancier (nog) geen mogelijkheden biedt om een datasetbeschrijving te maken, dan kunt u handmatig een datasetbeschrijving maken conform de <a href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/">requirements</a>. Als hulpmiddel is onderstaand formulier beschikbaar. Deze handmatige werkwijze staat los van het collectiebeheersysteem en is dus verre van ideaal.</p>
         <p><strong>Let wel</strong>: het resultaat van het formulier is een datasetbeschrijving in JSON-LD, deze moet nog wel online worden gepubliceerd voordat het kan worden aangemeld bij het Datasetregister.</p>
         <p><br></p>
         <h2 class="title--m">Datasetbeschrijving formulier</h2>
      </div>
   </section>
   <section id="" class="m-t-quarter-space m-theme-bg m-theme--teal search-div">
      <div class="o-container o-container__small">
      <div class="container">
         <div class="row">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="uitleg-tab" data-toggle="tab" href="#uitleg" role="tab" aria-controls="uitleg" aria-selected="true">1 - Uitleg</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="req-tab" data-toggle="tab" href="#req" role="tab" aria-controls="req" aria-selected="false">2 - Verplichte velden</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="rec-tab" data-toggle="tab" href="#rec" role="tab" aria-controls="rec" aria-selected="false">3 - Aanbevolen velden</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="dist-tab" data-toggle="tab" href="#dist" role="tab" aria-controls="dist" aria-selected="false">4 - Distributies</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="jsonld-tab" data-toggle="tab" href="#jsonld" role="tab" aria-controls="jsonld" aria-selected="false">5 - Resultaat</a>
               </li>
            </ul>
            <div class="tab-content" id="myTabContent">
               <div  class="tab-pane fade show active" id="uitleg" role="tabpanel" aria-labelledby="uitleg-tab">
                  <br>
                  <p>Vul zo veel mogelijk van de invoervelden in, minimaal de verplichte invoervelden. Via een tooltip bij het label van een veld wordt er een beschrijving gegeven van het veld, wanneer er op een label geklikt wordt dan wordt de property beschrijving op schema.org geopend. Een groene plus knop voegt een extra invoerveld of invoerveldenset (bij distributie) toe.<br>Op het laatste tabblad kan de datasetbeschrijving in JSON-LD worden gemaakt op basis van de ingevulde waarden.</p>
                  <br>
                  <p>Wilt u alleen een indruk krijgen van een datasetbeschrijving? Klik dan op <a id="dataset_examples" href="#">voorbeelddata</a> om alle invulvelden te vullen met voorbeelddata.</p>
                  <br>
                  <p>Via het formulier is niet alles mogelijk, zo kunnen er alleen organisaties gekozen worden als eigenaar en verstrekker (een persoon is volgens de eisen ook mogelijk) en is er geen meertaligheid. Voor enkele waarden zijn voor het gemak <a target="_new" href="https://waardelijsten.dcat-ap-donl.nl/">waardelijsten gekoppeld van DCAT-AP-DONL</a>, deze zijn waardelijsten zijn niet verplicht maar wel handig.</p>
               </div>
               <div class="tab-pane fade" id="req" role="tabpanel" aria-labelledby="req-tab">					
                  <br><?php echo_datasetfields(1); ?>
               </div>
               <div class="tab-pane fade" id="rec" role="tabpanel" aria-labelledby="rec-tab">
                  <br><?php echo_datasetfields(2); ?>
               </div>
               <div class="tab-pane fade" id="dist" role="tabpanel" aria-labelledby="dist-tab">
                  <br><?php echo_datasetfields(3); ?>
               </div>
               <div class="tab-pane fade" id="jsonld" role="tabpanel" aria-labelledby="jsonld-tab">
                  <br>
                  <div id="result">
                  </div>
                  <xmp id="id_script_jsonld_schema">
                  </xmp>
                  <p id="copy-status" class="m-text-align--right">Klik de JSON-LD om deze te kopieren.</p>
                  <p><br></p>
                  <p>Heeft u niet zelf de mogelijkheden om deze JSON-LD te publiceren?<br>Dan kunt u gebruik maken van de <a href="https://github.com/netwerk-digitaal-erfgoed/dataset-register-entries">"publicatieservice" via Github</a>.</p>
               </div>
            </div>
         </div>
      </div>
   </section>
</main>

<!-- jQuery  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="assets/vendor/chosen/chosen.jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

<script>
<?php echo_datasetscript(); ?>

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  if (e.target.id=="jsonld-tab") {
	make_script_jsonld();
  }
})

$(document).ready(function() {
	set_guid_elems();
	$('#dataset_examples').on('click', function() {
		fill_with_example_data();
		return false;
	});		
});

function set_guid_elems() {
	$(document).ready(function(){$('label').tooltip({placement:"right"});});
	selects.forEach(function (item, index) {
	  $("#"+item).chosen({width: "100%"});
	});
}

function plus(id) {
	part_html = $("#val_" + id  + " .multi").html();
	Object.keys(pluss).forEach(function(element) {
		if (element.substr(0, 3) == 'id_' && part_html.indexOf(element + "_") > -1) {
			re1 = new RegExp(element + "_0", "g");
			pluss[element]++;
			part_html = part_html.replace(re1, element + "_" + pluss[element]);				
			if (part_html.includes("<select")) {
				part_html = part_html.replace(/\<\/select\>.*$/si,'</select>');
				part_html = part_html.replace(/ style=\".*?\"/si,'</select>');
				selects.push(element + "_" + pluss[element]);
			}
		}
	});
	$("#val_" + id).append(part_html);
	set_guid_elems();
}

function uuidv4() {
	return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c => (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16));
}


function make_script_jsonld() {
	<?php echo_script_jsonld_schema(); ?>
	jsonldString = JSON.stringify(schema, null, '\t');
	$("#id_script_jsonld_schema").html(jsonldString);
}


document.getElementById('id_script_jsonld_schema').addEventListener(
  "click",
  function (event) {
    if (!navigator.clipboard) {
      // Clipboard API not available
      return;
    }
    const text = document.getElementById('id_script_jsonld_schema').innerHTML;
    try {
      navigator.clipboard.writeText(text);
      document.getElementById("copy-status").innerText = "De JSON-LD is gekopieerd.";
      setTimeout(function () {
        document.getElementById("copy-status").innerText = "Klik de JSON-LD om deze te kopieren.";
      }, 1200);
    } catch (err) {
      console.error("Failed to copy!", err);
    }
  },
  false
);

// TODO (nice)
// - Catalog waarden in localStorage opnemen
// - Waardelijsten vs. vrije invoer
// - Meertaligheid

</script>
<?php 


include("includes/footer.php") ?>