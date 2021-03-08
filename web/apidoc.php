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
                <h1 class="display-4">API documentatie</h1>
                <p class="lead">Inzicht in erfgoeddatasets</p>
                <p><br/></p>
				<h4 class="text-left">API specificatie</h4>
                <p class="text-left">De Register API is bedoeld om online pagina's met datasetbeschrijving aan te melden en te valideren.<br>De API beschrijving is op basis van een Open API specification beschikbaar via <a href="https://demo.netwerkdigitaalerfgoed.nl/register-api/static/index.html" target="_blank">Swagger UI</a>.</p>
				<p><br/></p>
				<h4 class="text-left">Voorbeeld aanmelding URL van pagina met datasetbeschrijving via API met Curl</h4>
				<xmp>curl 'https://demo.netwerkdigitaalerfgoed.nl/register-api/datasets' \
  -H 'link: <http://www.w3.org/ns/ldp#RDFSource>; rel="type",<http://www.w3.org/ns/ldp#Resource>; rel="type"' \
  -H 'content-type: application/ld+json' \
  --data-binary '{"@id":"https://demo.netwerkdigitaalerfgoed.nl/datasets/kb/2.html"}'
</xmp>
				<p><br/></p>
				<h4 class="text-left">Voorbeeld validatie datasetbeschrijving via API met Curl</h4>
				<xmp>curl -i -X PUT 'https://demo.netwerkdigitaalerfgoed.nl/register-api/datasets/validate' \
  -H 'link: <http://www.w3.org/ns/ldp#RDFSource>; rel="type",<http://www.w3.org/ns/ldp#Resource>; rel="type"' \
  -H 'content-type: application/ld+json' \
  --data-binary '{"@id":"https://demo.netwerkdigitaalerfgoed.nl/datasets/kb/2.html"}'
</xmp>
            </div>
        </div>
		
        <footer class="text-muted border-top">
            <div class="container">
                <p>Een initiatief van het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a></p>
            </div>
        </footer>

    </body>
</html>