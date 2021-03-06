<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <link rel="icon" href="favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Register</title>
        <link href="static/style.css" rel="stylesheet" type="text/css">
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
                <h1 class="display-4">Datasetbeschrijving aanmelden</h1>
                <p class="lead">Inzicht in erfgoeddatasets</p>
                <p><br/></p>
				<p>Voer een URL in van een pagina met een schema.org/Dataset of schema.org/DataCatalog (inline JSON-LD of direct RDF) om deze via de <a href="apidoc.php">Register API</a> aan te melden. Als de domeinnaam voorkomt op de lijst van toegestane domeinnamen (zie <a href="faq.php#allowed_domain_names">FAQ</a>) en de aangetroffen datasetbeschrijving(en) voldoen aan de <a href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/" target="_blank">dataset requirements</a> dan zullen deze in het Register worden opgenomen.</p>
                <p><br/></p>
                <p>
					<input type="url" id="datasetdescriptionurl" placeholder="URL van pagina met datasetbeschrijving" class="form-control form-control-lg" name="db_url" value="https://demo.netwerkdigitaalerfgoed.nl/datasets/kb/2.html"><br>
					<button class="btn btn-success" onclick="call_api()">URL datasetbeschrijving toevoegen</button>
				</p>
				<br/>
				<xmp id="api_result"></xmp>
                </p>
            </div>
        </div>
		
        <footer class="text-muted border-top">
            <div class="container">
                <p>Een initiatief van het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a></p>
            </div>
        </footer>

		<script>
		function call_api() {
			document.getElementById("api_result").innerHTML="Calling API ..."; 
			fetch("https://demo.netwerkdigitaalerfgoed.nl/register-api/datasets", {
			  "method": "POST",
			  "headers": {
				"Link": "<http://www.w3.org/ns/ldp#RDFSource>; rel=\"type\",<http://www.w3.org/ns/ldp#Resource>; rel=\"type\"",
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

    </body>
</html>