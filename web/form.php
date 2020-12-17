<?php 

include('includes/form-definition.php'); 
include('includes/form-util.php'); 

?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <link rel="icon" href="favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Register</title>
		<link href="static/style.css" rel="stylesheet" type="text/css">		
		<link href="static/vendor/chosen/chosen.css" rel="stylesheet" type="text/css">		
		<link href="static/form.css" rel="stylesheet" type="text/css">		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    </head>
    <body>
	
        <nav class="navbar navbar-expand-sm navbar-light border-bottom shadow-sm">
            <div class="container">
                <a href="." class="router-link-active router-link-exact-active navbar-brand" aria-current="page">
                    <img src="static/logo-nl.png" height="30" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"><span class="navbar-toggler-icon"></span></button>
                <div id="navbarSupportedContent" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a href="." class="router-link-active router-link-exact-active nav-link" aria-current="page">Home</a></li>
                        <li class="nav-item"><a href="faq.php" class="nav-link">FAQ</a></li>
                        <!--
						<li class="nav-item dropdown">
                            <a id="navbarDropdownMenuLink" class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Language</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a href="" class="dropdown-item">English</a><a href="" class="active dropdown-item">Nederlands</a>
                            </div>
                        </li>
						-->
                    </ul>
                </div>
            </div>
        </nav>
		
        <div class="container px-3 pt-3 pt-md-5 pb-md-4 mx-auto">
            <div class="text-center">
                <div id="beta">
                    <span class="note"><a href="faq.php#prototype">Demonstrator</a></span>
                </div>
                <h1 class="display-4">Datasetbeschrijving maken</h1>
                <p class="lead">Handmatig via formulier</p>
            </div>
        </div>

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
						<a class="nav-link" id="dist-tab" data-toggle="tab" href="#dist" role="tab" aria-controls="dist" aria-selected="false">4 - Verplichte distributies</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="jsonld-tab" data-toggle="tab" href="#jsonld" role="tab" aria-controls="jsonld" aria-selected="false">5 - Datasetbeschrijving in JSON-LD</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="uitleg" role="tabpanel" aria-labelledby="uitleg-tab">
					
						<br>
						<p>Het formulier op een datasetbeschrijving meer te maken is gebaseerd op het <a target="_new" href="https://github.com/netwerk-digitaal-erfgoed/project-organisations-datasets/tree/master/publication-model">Publication model for dataset descriptions</a>. Het formulier geleid de gebruiker in het beschrijven van de dataset en daarna de distributies van de dataset.</p>
						<br>
						<p>Vul zo veel mogelijk van de invoervelden in, minimaal de verplichte invoervelden. Via een tooltip bij het label van een veld wordt er een beschrijving gegeven van het veld, wanneer er op een label geklikt wordt dan wordt de property beschrijving op schema.org geopend. Een groene plus knop voegt een extra invoerveld of invoerveldenset (bij distributie) toe.<br>Op het laatste tabblad kan de datasetbeschrijving in JSON-LD worden gemaakt op basis van de ingevulde waarden. De dataset beschrijving kan ook - puur voor testdoeleinden - opgeslagen worden in een test-register.</p>
						<br>
						<p>Dit is een <strong>demonstrator</strong>, heeft is bedoeld om een indruk te geven van een dataset beschrijving. Klik op <a id="dataset_examples" href="#">voorbeelddata</a> om alle invulvelden te vullen met voorbeelddata, om een beter beeld te krijgen van wat er gevraagd wordt.<br><br>
				
						Het formulier implementeert niet het volledige publicatiemodel, zo kunnen er alleen organisaties gekozen worden als eigenaar en verstrekker (een persoon is volgens het publicatie model ook mogelijk) en is er geen meertaligheid. Voor enkele properties zijn voor het gemak <a target="_new" href="https://waardelijsten.dcat-ap-donl.nl/">waardelijsten gekoppeld van DCAT-AP-DONL</a>, deze stelt het publicatiemodel niet verplicht, maar adviseert het gebruik van waardelijsten wel.</p>
									
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
						<!-- <button class="btn btn-success" type="submit" id="do_script_jsonld">Maak een machine-leesbare versie van deze datasetbeschrijving (in JSON-LD formaat)</button> -->
						
						<div id="result">
						
						</div>
						<form id="dataset_store" action="form-store.php" method="post">
							<textarea readonly name="datasetdescription" id="id_script_jsonld_schema"></textarea>
							<button class="btn btn-success" type="submit">Sla bovenstaande datasetbeschrijving op (en neem op in het test-register)</button>
						</form>
					</div>
				</div>

			</div>
		</div>

        <footer class="text-muted border-top">
            <div class="container">
                <p>Een initiatief van het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a></p>
            </div>
        </footer>

		<!-- jQuery  -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="static/vendor/chosen/chosen.jquery.min.js"></script>
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
			$("#id_script_jsonld_schema").val(jsonldString);
		}

		/*
		TODO (nice)
		- Catalog waarden in localStorage opnemen
		- Waardelijsten vs. vrije invoer
		- Meertaligheid
		*/
		
		</script>

    </body>
</html>