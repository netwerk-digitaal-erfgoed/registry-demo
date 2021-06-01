<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <link rel="icon" href="favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Datasetregister</title>
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
                <h1 class="display-4">Overzicht datasetbeschrijvingen</h1>
                <p class="lead">Tijdelijk test-register</p>
			</div>
        </div>

		<div class="container">
			<div class="row">
				<ul>
<?php
				
	$datacatalogdir="/datasetdescriptions/";
	$datacatalogfile=$datacatalogdir."index.json";
	$datasets=array();
	
	if (file_exists($datacatalogfile)) {
		$datacatalog=json_decode(file_get_contents($datacatalogfile),true);
		$dateModified=date(DATE_RFC3339,filemtime($datacatalogfile));
		
		foreach ($datacatalog as $d) {
			$datasetdescriptionfile="../datasetdescriptions/".$d["guid"].".json";
			if (file_exists($datasetdescriptionfile)) {
				echo '					<li><a href="dataset.php?guid='.$d["guid"].'">'.$d["identifier"]." &raquo; ".$d["name"].'</a></li>';
				$dataset=file_get_contents($datasetdescriptionfile);
				array_push($datasets,str_replace("\n","",str_replace("\t","",$dataset)));
			} else {
				error_log("WARN: $datasetdescriptionfile doesn't exist");
			}
		}
	} else {
		if (!file_exists($datacatalogdir)) {
			mkdir($datacatalogdir);
		}
		file_put_contents($datacatalogfile,json_encode($datasets));
	}
?>

				</ul>
			</div>
		</div>
		
        <footer class="text-muted border-top">
            <div class="container">
                <p>Een initiatief van het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a></p>
            </div>
        </footer>

	<script type="application/ld+json">
	{
		"@context": "https://schema.org/",
		"@type": "DataCatalog",
		"@id": "https://demo.netwerkdigitaalerfgoed.nl/register/",
		"url": "https://demo.netwerkdigitaalerfgoed.nl/register/list.php",
		"name": "Tijdelijk gepubliceerde datasets via de demonstrator van het Datasetregister.",
		"datePublished": "2020-11-20T08:55:19+00:00",
		"dateModifier": "<?= $dateModified ?>",
		"publisher": {
			"@type": "Organization",
			"name": "Netwerk Digitaal Erfgoed",
			"url": "https://www.netwerkdigitaalerfgoed.nl/"
		},
		"dataset": [
			<?php
		print join(",\n\t\t\t",$datasets);
	?>
		]
	}
	</script>
    </body>
</html>