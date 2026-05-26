<?php include("includes/header.php") ?>
<main>
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
         <h1><?= t('Veelgestelde vragen voor gebruikers van erfgoeddata') ?></h1>
         <p><br></p>
         <h2><?= t('Op welke wijze kan ik het Datasetregister doorzoeken?') ?></h2>
         <p><?= t('Wil je datasets eenvoudig verkennen, dan kun je gebruikmaken van de publiekswebsite van het Datasetregister met een <a href="datasets">zoekfunctie</a> en filters. Voor technisch gebruik kun je de onderliggende triplestore raadplegen. Deze is beschikbaar via een webinterface: <a href="https://qlever.netwerkdigitaalerfgoed.nl/datasetregister">https://qlever.netwerkdigitaalerfgoed.nl/datasetregister</a>') ?></p>
         <h2><?= t('Zijn er voorbeelden van SPARQL-queries?') ?></h2>
         <p><?= t('Ja. Op de pagina <a href="datasets">Doorzoek</a> vind je eenvoudige voorbeelden van zoekqueries. Deze pagina werkt als een SPARQL-generator: op basis van je zoekvraag wordt automatisch een query opgebouwd en uitgevoerd op de triplestore. Je kunt de gegenereerde query ook direct openen in de webinterface om deze verder aan te passen.') ?></p>
         <p><?= t('Wil je meer inzicht in de mogelijkheden van het Sparl-endpoint en de triple store, bekijk dan de datastory. Deze is momenteel alleen beschikbaar in het Nederlands, maar geeft wel goed inzicht in hoe queries zijn opgebouwd. Via de blauwe pijl boven de resultatentabellen kun je de onderliggende SPARQL-query bekijken. Pas je deze aan, dan zie je direct het effect op de resultaten.') ?></p>
         <h2><?= t('Wat voor data vind ik in het Datasetregister?') ?></h2>
         <p><?= t('In het Datasetregister vind je geen datasets zelf, maar datasetbeschrijvingen. Deze beschrijvingen verwijzen naar de daadwerkelijke datasets, de distributies. Die distributies kunnen verschillende vormen hebben, zoals bestanden of datadumps, bijvoorbeeld XML, CSV of RDF, maar ook API’s zoals OAI-PMH, SPARQL of SRU. Wanneer een datasetbeschrijving wordt opgehaald bij de bron, wordt deze gevalideerd en opgeslagen in een eigen graaf op basis van DCAT:dataset. De URL van deze graaf correspondeert met de IRI van de dataset. Beschrijvingen die zijn aangeleverd volgens schema.org/Dataset worden daarbij automatisch geconverteerd naar DCAT. Meer informatie over dit datamodel vind je op de <a href="https://docs.nde.nl/services/dataset-register/data-model/">datamodelpagina</a>. Onderstaande afbeelding laat zien hoe datasetbeschrijvingen en data zich tot elkaar verhouden.') ?></p>
         <p><img src="assets/datacatalog-dataset-distribution.svg" style="max-width:100%;margin:0 32px;"></p>
         <h2><?= t('Welke voorwaarden gelden voor het gebruik van datasets?') ?></h2>
         <p><?= t('Het gebruik van het SPARQL-endpoint en website van het Datasetregister is vrij toegankelijk voor iedereen. Je kunt de datasetbeschrijvingen dus zonder drempels doorzoeken.') ?></p>
         <p><?= t('De datasetbeschrijvingen worden door erfgoedorganisaties meestal onder een open licentie beschikbaar gesteld, vaak CC0. Deze licentie vind je terug in de verplichte property schema:license. Gebruik data alleen volgens de aangegeven licentievoorwaarden. Let op: de licentie geldt voor de metadata van de datasets. De onderliggende collectieobjecten kunnen onder een andere en soms meer restrictieve licentie vallen.') ?></p>
      </div>
   </section>
</main>
<?php include("includes/footer.php") ?>