<?php

if (isset($_GET["guid"]) && preg_match('/^[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/', $_GET["guid"])) {

	$datasetdescriptionfile="../datasetdescriptions/".$_GET["guid"].".json";
	$datasetdescriptionstring=file_get_contents($datasetdescriptionfile);
	$datasetdescription=json_decode($datasetdescriptionstring,true);

?><html lang="en">
    <head>
        <meta charset="UTF-8" />
        <link rel="icon" href="/favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Register</title>
		<link href="static/style.css" rel="stylesheet" type="text/css">		
    </head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-light border-bottom shadow-sm">
            <div class="container">
                <a href="/" class="router-link-active router-link-exact-active navbar-brand" aria-current="page">
                    <img src="/static/logo-nl.png" height="30" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"><span class="navbar-toggler-icon"></span></button>
                <div id="navbarSupportedContent" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a href="/" class="router-link-active router-link-exact-active nav-link" aria-current="page">Home</a></li>
                        <li class="nav-item"><a href="/faq.php" class="nav-link">FAQ</a></li>
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
                    <span class="note"><a href="/faq.php#prototype">Bèta</a></span>
                </div>
                <h1 class="display-4">Register</h1>
                <p class="lead">Inzicht in erfgoed datasets</p>
			</div>
        </div>

		<div class="container">
			<div class="row">
				<h2 class="mt-5">Datasetbeschrijving <?= $datasetdescription["name"] ?></h2>
				<pre><?= $datasetdescriptionstring ?></pre>
			</div>
			<div class="row">
				<br>
				<a class="btn btn-outline-primary" href="list.php">Terug naar het overzicht van datasetbeschrijvingen</a>
			</div>
		</div>
		
        <footer class="text-muted border-top">
            <div class="container">
                <p>Een initiatief van het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a></p>
            </div>
        </footer>
<!--
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.9/js/bootstrap-select.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
-->

<script type="application/ld+json">
<?= $datasetdescriptionstring ?>
</script>

    </body>
</html>
<?php

} else {
	error_log("invalid or missing guid");
	header("Location: /");
	exit;
}