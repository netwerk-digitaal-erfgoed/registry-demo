<?php 

include("includes/header.php");
include('includes/form-definition.php'); 
include('includes/form-util.php'); 

?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,600" integrity="sha384-vVYzIakwDZ/whaaTP/uINizi/BMq0wvFYPh9c/kzsGmGC2qwhbiAuC1Fd5na2aBr" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.9/css/bootstrap-select.min.css" integrity="sha384-YT6Vh7LpL+LTEi0RVF6MlYgTcoBIji2PmGBbXk3D4So5lw1e64pyuwTtbLOED1Li" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<link href="assets/vendor/chosen/chosen.css" rel="stylesheet" type="text/css">
<main>
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
         <h1 class="title--l"><?= t('Datasetbeschrijving formulier')?></h1>
      </div>
   </section>
   <section id="" class="m-t-quarter-space m-theme-bg m-theme--teal search-div">
      <div class="o-container o-container__small">
      <div class="container">
         <div class="row">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
               <li class="nav-item" role="tab">
                  <a class="nav-link active" id="uitleg-tab" data-toggle="tab" href="#uitleg" aria-controls="uitleg" aria-selected="true">1 - <?= t('Uitleg')?></a>
               </li>
               <li class="nav-item" role="tab">
                  <a class="nav-link" id="req-tab" data-toggle="tab" href="#req" aria-controls="req" aria-selected="false">2 - <?= t('Verplichte velden')?></a>
               </li>
               <li class="nav-item" role="tab">
                  <a class="nav-link" id="rec-tab" data-toggle="tab" href="#rec" aria-controls="rec" aria-selected="false">3 - <?= t('Aanbevolen velden')?></a>
               </li>
               <li class="nav-item" role="tab">
                  <a class="nav-link" id="dist-tab" data-toggle="tab" href="#dist" aria-controls="dist" aria-selected="false">4 - <?= t('Distributies')?></a>
               </li>
               <li class="nav-item" role="tab">
                  <a class="nav-link" id="jsonld-tab" data-toggle="tab" href="#jsonld" aria-controls="jsonld" aria-selected="false">5 - <?= t('Resultaat')?></a>
               </li>
            </ul>
            <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="uitleg" role="tabpanel" aria-labelledby="uitleg-tab">
                  <br>
                  <p><?= t('Vul zo veel mogelijk van de invoervelden in, minimaal de verplichte invoervelden. Via een tooltip bij het label van een veld wordt er een beschrijving gegeven van het veld, wanneer er op een label geklikt wordt dan wordt de property beschrijving op schema.org geopend. Een groene plus knop voegt een extra invoerveld of invoerveldenset (bij distributie) toe. Op het laatste tabblad kan de datasetbeschrijving in JSON-LD worden gemaakt op basis van de ingevulde waarden.')?></p>
                  <br>
                  <p><?= t('Wilt u alleen een indruk krijgen van een datasetbeschrijving? Klik dan op <a id="dataset_examples" href="#">voorbeelddata</a> om alle invulvelden te vullen met voorbeelddata.')?></p>
                  <br>
                  <p><?= t('Via het formulier is niet alles mogelijk, zo kunnen er als verwerken en maker alleen nog organisatie ingevuld worden (en niet een persoon), kunnen bij velden met een uitklaplijst geen eigen waarden ingevuld worden en is er geen meertaligheid. Dit kan wel door het resultaat te bewerken in een tekstverwerker.')?></p>
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
                  <p id="copy-status" class="m-text-align--right"><?= t('Klik op de bovenstaande JSON-LD om deze te kopieren.')?></p>
                  <p><br></p>
                  <p><?= t('Heeft u niet zelf de mogelijkheden om deze JSON-LD te publiceren?<br>Dan kunt u gebruik maken van de <a href="https://github.com/netwerk-digitaal-erfgoed/dataset-register-entries">"publicatieservice" via Github</a>.')?></p>
               </div>
            </div>
         </div>
      </div>
   </section>
</main>

<!-- jQuery  -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
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
      document.getElementById("copy-status").innerText = "<?= t('De JSON-LD is gekopieerd.')?>";
      setTimeout(function () {
        document.getElementById("copy-status").innerText = "<?= t('Klik op de bovenstaande JSON-LD om deze te kopieren.')?>";
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