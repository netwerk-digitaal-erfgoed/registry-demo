<html lang="en">
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
                <a href="." class="router-link-active router-link-exact-active navbar-brand" aria-current="page">
                    <img src="static/logo-nl.png" height="30" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"><span class="navbar-toggler-icon"></span></button>
                <div id="navbarSupportedContent" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a href="" class="router-link-active router-link-exact-active nav-link" aria-current="page">Home</a></li>
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
			<h1 class="display-4 text-center">Triplestore bevragen</h1>
			<p class="lead text-center">Inzicht in erfgoeddatasets</p>
			
			<div class="content">
			
				<h2>Triplestore</h2>
				<p>De opgehaalde datasetbeschrijvingen worden opgeslagen in de <a target="_blank" href="https://graphdb.ddeboer.nl">triplestore van het Register</a> (in&nbsp;repository&nbsp;"registry"), deze is openbaar en query-baar via SPARQL.</p>
				
				<h2>SPARQL</h2>

				<ul>
				<li>
				<b>Register - Aantal datasets per erfgoedinstelling (creator)</b>
				<xmp>PREFIX schema: <http://schema.org/> 
SELECT DISTINCT ?creatorname (count(distinct ?s) as ?count) WHERE { 
	?s schema:creator ?o . 
	?o schema:name ?creatorname 
} GROUP BY ?creatorname ORDER BY DESC(?count) LIMIT 10
</xmp>
</li>
<p class="text-center">
<?php

$ch = curl_init("https://graphdb.ddeboer.nl/repositories/registry");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, 'query=PREFIX+schema%3A+%3Chttp%3A%2F%2Fschema.org%2F%3E%0ASELECT+DISTINCT+%3Fcreatorname+(count(distinct+%3Fs)+as+%3Fcount)+WHERE+%7B%0A++%3Fs+schema%3Acreator+%3Fo+.%0A++%3Fo+schema%3Aname+%3Fcreatorname%0A%7D+GROUP+BY+%3Fcreatorname+ORDER+BY+DESC(%3Fcount)+LIMIT+10&infer=true&sameAs=true&limit=1000&offset=0');
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded; charset=UTF-8','Accept: application/x-sparqlstar-results+json, application/sparql-results+json;q=0.9, */*;q=0.8'));
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$result_json = curl_exec($ch);
curl_close($ch);

$result=json_decode($result_json,true);

foreach ($result["results"]["bindings"] as $r) {
	echo $r["creatorname"]["value"]." (".$r["count"]["value"]." datasets)<br>";
}
?>
</p>
<li><b>Register - Aantal datasets per licentie-vorm (literal/URI)</b>
<xmp>PREFIX schema: <http://schema.org/>
SELECT ?url (count(distinct ?dataset) as ?count) WHERE {
    {
        SELECT (IRI(?name) AS ?url) ?dataset WHERE {
            ?dataset a schema:Dataset .
			?dataset schema:license ?name
			FILTER(isLiteral(?name))
		}
    } UNION {
        SELECT ?url ?dataset WHERE {
            ?dataset a schema:Dataset .
  			?dataset schema:license ?license .
  			?license schema:url ?url
            FILTER(isURI(?license))
		} 
    }
} GROUP BY ?url</xmp>
</li>
<div id="piechart"></div>
<li><b>Register - Datasets met een Turtle distributie</b>
<xmp>PREFIX schema: <http://schema.org/>

SELECT * WHERE {
  ?dataset schema:name ?name .
  ?dataset schema:distribution ?distribution .
  ?distribution schema:encodingFormat "application/n-triples"
} LIMIT 10</xmp></li>
<li><b>Register - Datasets met genealogie als keyword</b>
<xmp>
PREFIX schema: <http://schema.org/> SELECT * WHERE { 
	?dataset schema:name ?name . 
	?dataset schema:keywords "Genealogie" 
}</xmp></li>
</ul>
				
			</div>
		</div>

        <footer class="text-muted border-top">
            <div class="container">
                <p>Een initiatief van het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a></p>
            </div>
        </footer>



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
		  
<?php

$ch = curl_init("https://graphdb.ddeboer.nl/repositories/registry");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, 'query=PREFIX+schema%3A+%3Chttp%3A%2F%2Fschema.org%2F%3E%0ASELECT+%3Furl+(count(distinct+%3Fdataset)+as+%3Fcount)+WHERE+%7B%0A++++%7B%0A++++++++SELECT+(IRI(%3Fname)+AS+%3Furl)+%3Fdataset+WHERE+%7B%0A++++++++++++%3Fdataset+a+schema%3ADataset+.%0A%09%09%09%3Fdataset+schema%3Alicense+%3Fname%0A%09%09%09FILTER(isLiteral(%3Fname))%0A%09%09%7D%0A++++%7D+UNION+%7B%0A++++++++SELECT+%3Furl+%3Fdataset+WHERE+%7B%0A++++++++++++%3Fdataset+a+schema%3ADataset+.%0A++%09%09%09%3Fdataset+schema%3Alicense+%3Flicense+.%0A++%09%09%09%3Flicense+schema%3Aurl+%3Furl%0A++++++++++++FILTER(isURI(%3Flicense))%0A%09%09%7D+%0A++++%7D%0A%7D+GROUP+BY+%3Furl&infer=true&sameAs=true&limit=1000&offset=0');
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded; charset=UTF-8','Accept: application/x-sparqlstar-results+json, application/sparql-results+json;q=0.9, */*;q=0.8'));
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$result_json = curl_exec($ch);
curl_close($ch);

  
$result=json_decode($result_json,true);

foreach ($result["results"]["bindings"] as $r) {
	echo "['".$r["url"]["value"]."',".$r["count"]["value"]."],";
}
?>
        ]);

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data);
      }
    </script>
	
    </body>
</html>