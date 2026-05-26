<?php 

include("includes/header.php");

?>
<main>
	<section class="text m-t-space m-b-space m-theme--blue">
		<div class="o-container o-container__small m-t-space">
			<h1 class="title--l"><?= t('Zoek in het Datasetregister')?></h1>
			<p><?=  t('Ben je benieuwd welk digitaal erfgoed er op dit moment beschikbaar is? Het Datasetregister is de plek om dit te ontdekken. Je vindt hier geen digitaal erfgoed, maar wel beschrijvingen van datasets die direct doorverwijzen naar de datasets bij de bron.') ?></p>
			<br>
			<p><?=  t('Gebruik de <a href="/datasets">zoekfunctie</a> om snel de juiste datasets te vinden. Met filters en zoektermen haal je eenvoudig de informatie boven die bij jouw vraag past.') ?></p>
			<p><?=  t('Erfgoedorganisaties bieden hun datasets meestal aan onder een open licentie, vaak CC0. Dit betekent dat de datasets vrij gebruikt en gedeeld mogen worden, zonder dat vooraf toestemming nodig is. Zo kunnen datasets makkelijker worden gekoppeld, onderzocht en gebruikt in bijvoorbeeld websites, apps of onderzoek.') ?></p>
			<p><?=  t('Voor technisch gebruik is ook de onderliggende triplestore beschikbaar. Deze draait op GraphDB en is toegankelijk via <a href="https://qlever-ui.demo.netwerkdigitaalerfgoed.nl/datasetregister">https://qlever-ui.demo.netwerkdigitaalerfgoed.nl/datasetregister</a>. Hier kun je zelf SPARQL queries uitvoeren en datasetbeschrijvingen direct doorzoeken. Wil je meer inzicht in de mogelijkheden van het SPARQL-endpoint en de triplestore? De <a href="/datastory.php">datastory-pagina</a> laat stap voor stap zien hoe queries zijn opgebouwd.') ?></p>
			<p><?=  t('De zoekfunctie op de website en het SPARQL-endpoint zijn vrij toegankelijk. Iedereen kan de datasetbeschrijvingen doorzoeken.') ?></p>
		</div>
	</section>
</main>

<?php 


include("includes/footer.php") ?>