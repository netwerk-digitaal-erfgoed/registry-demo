<?php include("includes/header.php") ?>
<main>
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
      <h1 class="title--l">Datasetbeschrijving aanmelden</h1>
      <p>Voer een URL in van een pagina met een schema.org/Dataset of schema.org/DataCatalog (inline JSON-LD of direct RDF) om deze via de <a href="apidoc.php">Datasetregister API</a> aan te melden. Als de domeinnaam voorkomt op de lijst van toegestane domeinnamen (zie <a href="faq-ontwikkelaars.php#allowed_domain_names">FAQ</a>) en de aangetroffen datasetbeschrijving(en) voldoen aan de <a href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/" target="_blank">dataset requirements</a> dan zullen deze in het Datasetregister worden opgenomen.</p>
   </section>
   <section id="" class="m-flex c-module c-module--doorway p-t-space p-b-space m-theme-bg m-theme--teal">
      <div class="o-container o-container__small">
         <label>URL van pagina met datasetbeschrijving (of datacatalogus):</label>
         <input type="url" id="datasetdescriptionurl" class="form-control form-control-lg" name="db_url" value=""><br>
         <span class="btn btn--arrow m-t-half-space btn--api" onclick="call_api()">
            Datasetbeschrijving aanmelden
            <svg class="rect">
               <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 0; stroke-dashoffset: 0;"></rect>
            </svg>
            <svg class="icon icon-arrow-right">
               <use xlink:href="#icon-arrow-right"></use>
            </svg>
         </span>
         <p><br/></p>
		 <div id="api_status"></div>
         <xmp id="api_result">(Hier komt het resultaat van de aanroep van de aanmeld functie via de API)</xmp>
         </p>
      </div>
   </section>
</main>
<script>
   function call_api() {
   	var as=document.getElementById("api_status");
	as.style.backgroundColor="none";
	as.innerHTML="";

	document.getElementById("api_result").innerHTML="Calling API ..."; 
   	fetch("https://datasetregister.netwerkdigitaalerfgoed.nl/api/datasets", {
   	  "method": "POST",
   	  "headers": {
   		"Link": "<http://www.w3.org/ns/ldp#RDFSource>; rel=\"type\",<http://www.w3.org/ns/ldp#Resource>; rel=\"type\"",
   		"Content-Type": "application/ld+json"
   	  },
   	  "body": JSON.stringify( {"@id": document.getElementById("datasetdescriptionurl").value })
   	})
   	.then(response => { 
   		//document.getElementById("api_result").innerHTML="Status: "+response.status+"\n\n"; 
		var as=document.getElementById("api_status");

		if (response.status=="202") {
			as.style.backgroundColor="#5cb85c";
			as.innerHTML="Alle datasetbeschrijvingen op de ingediende URL zijn geldig volgens de <a href=\"https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/\">vereisten voor datasets</a>. De datasets worden binnenkort toegevoegd aan het Dataset Register.";
		} else {
			as.style.backgroundColor="#e44d26";
			if (response.status=="400") {
				as.innerHTML="Een of meer datasetbeschrijvingen zijn ongeldig volgens de <a href=\"https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/\">vereisten voor datasets</a>. De antwoordtekst bevat een lijst met SHACL-overtredingen.";
			} else {
				if (response.status=="403") {
					as.innerHTML="De domeinnaam van de ingediende URL staat niet op de lijst met toegestane domeinnamen. <a href=\"/contact.php\">Neem contact met ons op</a> om de domeinnaam van uw instelling toe te voegen.";
				} else {
					if (response.status=="404") {
						as.innerHTML="De URL kan niet worden gevonden.";
					} else {
						if (response.status=="406") {
							as.innerHTML="De URL kan worden gevonden, maar bevat geen datasets.";
						} else {
							as.innerHTML="Er heeft zich een onbekende fout voorgedaan. <a href=\"/contact.php\">Neem contact met ons op</a> en geef daarbij de door u ingevulde URL op.";
						}
					}
				}
			}
		}

   		return response.text(); 
   	})
   	.then(response => {
   		document.getElementById("api_result").innerHTML=response
   	})
   	.catch(err => {
   	  console.log(err);
   	});
   }
</script>
<?php include("includes/footer.php") ?>