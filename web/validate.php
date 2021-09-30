<?php include("includes/header.php") ?>
<main>
   <section class="text m-t-space m-b-space">
      <div class="o-container o-container__small m-t-space">
         <h1 class="title--l">Datasetbeschrijving valideren</h1>
         <p><br></p>
         <p>Voer een URL in van een pagina met een schema.org/Dataset of schema.org/DataCatalog (inline JSON-LD of direct RDF) om deze via de <a href="apidoc.php">Datasetregister API</a> te valideren. Er wordt dan gecontroleerd de aangetroffen datasetbeschrijving (of datasetbeschrijvingen) voldoen aan de <a href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/" target="_blank">dataset requirements</a>. De validate wordt uitgevoerd op basis van een SHACL bestand. Als de op de URL aangetroffen dataset niet voldoet, dan wordt het resultaat van de SHACL validatie getoond.</p>
         <p>
            <input type="url" id="datasetdescriptionurl" placeholder="URL van pagina met datasetbeschrijving" class="form-control form-control-lg" name="db_url" value="https://demo.netwerkdigitaalerfgoed.nl/datasets/kb/2.html"><br>
            <button class="btn btn-success" onclick="call_api()">URL datasetbeschrijving valideren</button>
         </p>
         <br/>
         <xmp id="api_result"></xmp>
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
