<?php include("includes/header.php") ?>
<main>
   <section class="text m-t-space m-b-space">
      <div class="o-container o-container__small m-t-space">
         <h1 class="title--l">Datasetbeschrijving valideren</h1>
         <p>Voer een URL in van een pagina met een schema.org/Dataset of schema.org/DataCatalog (inline JSON-LD of direct RDF) om deze via de <a href="apidoc.php">Datasetregister API</a> te valideren. Er wordt dan gecontroleerd de aangetroffen datasetbeschrijving (of datasetbeschrijvingen) voldoen aan de <a href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/" target="_blank">dataset requirements</a>. De validate wordt uitgevoerd op basis van een SHACL bestand. Als de op de URL aangetroffen dataset niet voldoet, dan wordt het resultaat van de SHACL validatie getoond.</p>
      </div>
   </section>
   <section id="" class="m-flex c-module c-module--doorway p-t-space p-b-space m-theme-bg m-theme--teal m-txt-clr--inverse">
      <div class="o-container o-container__small">
         <label>URL van de datasetbeschrijving (of datacatalogus):</label>
         <input type="url" id="datasetdescriptionurl" placeholder="URL van pagina met datasetbeschrijving (of -catalogus)" class="form-control form-control-lg" name="db_url" value=""><br>
         <span class="btn btn--arrow m-t-half-space" onclick="call_api()">
            Datasetbeschrijving valideren
            <svg class="rect">
               <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 0; stroke-dashoffset: 0;"></rect>
            </svg>
            <svg class="icon icon-arrow-right">
               <use xlink:href="#icon-arrow-right"></use>
            </svg>
         </span>
         <p><br></p>
         <xmp id="api_result">(Hier komt het resultaat van de aanroep van de validatie functie via de API)</xmp>
         </p>
      </div>
   </section>
</main>

<script>
function call_api() {
	document.getElementById("api_result").innerHTML="Calling API ..."; 
	fetch("https://datasetregister.netwerkdigitaalerfgoed.nl/api/datasets/validate", {
	  "method": "PUT",
	  "headers": {
		"Accept": "application/ld+json",
		"Content-Type": "application/ld+json"
	  },
	  "body": JSON.stringify( {"@id": document.getElementById("datasetdescriptionurl").value })
	})
	.then(response => { 
		document.getElementById("api_result").innerHTML="Status: "+response.status+"\n\n"; 
		return response.text(); 
	})
	.then(response => {
		document.getElementById("api_result").innerHTML+=response
	})
	.catch(err => {
	  console.log(err);
	});
}
</script>
<?php include("includes/footer.php") ?>
