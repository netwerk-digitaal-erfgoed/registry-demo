<?php include("includes/header.php") ?>
<main>
   <div class="o-container o-container__small m-t-space">
      <h1><?= t('Veelgestelde vragen over het Datasetregister door ontwikkelaars die datasets willen vinden') ?></h1>
      <p><br></p>
      <h2><?= t('Op welke wijze kan ik het Datasetregister doorzoeken?')?></h2>
      <p><?= t('Het Datasetregister biedt toegang tot datasetbeschrijvingen van erfgoedinstellingen. Via een frequente crawl worden de datasetbeschrijvingen in schema.org/Dataset of DCAT opgehaald, getransformeerd naar DCAT en opgeslagen in een openbare triplestore. Deze triplestore - op basis van GraphDB - heeft een web-gui die is te bereiken via  <a href="https://qlever-ui.demo.netwerkdigitaalerfgoed.nl/datasetregister">https://qlever-ui.demo.netwerkdigitaalerfgoed.nl/datasetregister</a>.')?></p>
      <h2><?= t('Is er een API op het Datasetregister?')?></h2>
      <p><?= t('Ja, twee zelfs. Eén is gericht op de erfgoedinstellingen (en hun IT-leveranciers) en betreft vooral het valideren en aanmelden van datasetbeschrijvingen.')?></p>
      <p><?= t('De tweede API is gericht op ontwikkelaars die datasets willen vinden: het <strong>SPARQL-endpoint</strong> <a href="https://datasetregister.netwerkdigitaalerfgoed.nl/sparql">https://datasetregister.netwerkdigitaalerfgoed.nl/sparql</a>.')?></p>
      <h2><?= t('Wat voor data vind ik in het Datasetregister?')?></h2>
      <p><?= t('Het Datasetregister bevat geen datasets, wel bevat het datasetbeschrijvingen en deze bevatten referentie naar (distributies van) data. Dit kunnen bestanden/datadumps zijn (bijvoorbeeld gecomprimeerde XML, CSV, NT bestanden) of API\'s (bijvoorbeeld OAI-PMH, SPARQL, SRU). Wanneer een datasetbeschrijving bij de bron wordt opgehaald en gevalideerd, dan wordt deze in een eigen graaf opgeslagen op basis van <code>dcat:Dataset</code>. De URL van de graaf correspondeert met de IRI van de dataset. Datasetbeschrijvingen die worden geleverd op basis van schema.org - zoals geadviseerd in de <a href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/">Requirements for Datasets</a> - worden geconverteerd naar <a href="https://www.w3.org/TR/vocab-dcat-2/">DCAT</a>. Meer informatie hierover op de <a href="datamodel.php">datamodel-pagina</a>.')?></p>
      <p><?= t('Onderstaande afbeelding geeft de gelaagdheid aan van datasetbeschrijvingen:') ?></p>
      <p><img src="assets/datacatalog-dataset-distribution.svg" style="max-width:100%;margin:0 32px;"></p>
      <h2><?= t('Zijn er voorbeelden van SPARQL queries?')?></h2>
      <p><?= t('Eenvoudige voorbeelden van zoek queries vindt je op de <a href="search.php">Doorzoek</a> pagina. Dit is in wezen een SPARQL-generator die op basis van je zoekvraag een SPARQL-query maakt en afvuurt op de triplestore. Je vindt er ook een link om de gegenereerde SPARQL-query in de web-gui van de triplestore te openen.')?></p>
      <p><?= t('Een andere manier om gevoel te krijgen bij de mogelijkheden is de <a href="datastory.php">data story</a>. Alleen nog beschikbaar in het Nederlands, maar via de blauwwe pijl boven de resultaat tabellen tover je de SPARQL-query naar voren waarmee de gegevens voor tabel eronder zijn verkregen. Pas de query aan en je ziet gelijk het resultaat!')?></p>
      <h2><?= t('Wat mag ik met de data uit het Datasetregister?')?></h2>
      <p><?= t('Het gebruik van het SPARQL-endpoint staat open voor iedereen, zonder enige drempel. De datasetbeschrijvingen zelf worden door erfgoedinstellingen onder een open licentie beschikbaar gesteld. Je vindt dit terug in de verplichte property <code>schema:license</code>. De distributies binnen een dataset (dus de daadwerkelijke data) kunnen onderhevig zijn aan een meer restrictieve licentie.')?></p>
      <h2><?= t('Wie maakt en beheert het Datasetregister?') ?></h2>
      <p><?= t('Het Datasetregister is gemaakt door de samenwerkende erfgoedinstellingen in het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a> en wordt beheerd en onderhouden door het <a href="https://www.nationaalarchief.nl/">Nationaal Archief</a>. Het Nationaal Archief staat in voor de werking en beschikbaarheid van het Datasetregister.') ?></p>
      <h2><?= t('Wat is de status van het Datasetregister?') ?></h2>
      <p><?= t('Het Datasetregister is klaar om verder gevuld te worden. De requirements, API en deze website zijn stabiel en worden op basis van feedback van gebruikers en leveranciers verfijnd.') ?></p>
      <h2><?= t('Kan ik het Datasetregister nu al gebruiken?') ?></h2>
      <p><?= t('Jazeker! Het Datasetregister wordt nog doorontwikkeld en nog verder gevuld, maar nu al te gebruiken. We horen dan ook graag wat je ervan vindt. Bijvoorbeeld: zijn de zoekmogelijkheden toereikend? Is de API bruikbaar?') ?></p>
      <h2><?= t('Ga je aan de slag?') ?></h2>
      <p><?= t('Ga je aan de slag met het publiceren van datasetbeschrijvingen en de API op het Datasetregister, laat het weten, zodat we je op de hoogte kunnen houden van ontwikkelingen, updates en beschikbaarheid.') ?></p>
      <h2><?= t('Meer weten?') ?></h2>
      <p><?= t('Heb je vragen en/of opmerkingen over de werking van het Datasetregister neem dan contact op met <a href="mailto:info@nationaalarchief.nl?subject=Datasetregister">info@nationaalarchief.nl</a>.') ?></p>
      <p><br></p>
   </div>
</main>
<?php include("includes/footer.php") ?>
