<?php include("includes/header.php") ?>
<main>
   <div class="o-container o-container__small m-t-space">
      <h1><?= t('Veelgestelde vragen over het Datasetregister door dataset beheerders bij erfgoedinstellingen') ?></h1>
      <p><br></p>
      <h2><?= t('Wat is een dataset?')?></h2>
      <p><?= t('Een dataset (of gegevensverzameling) is een verzameling van gegevens (data of metadata). In de context van erfgoedinstellingen kun je hierbij denken aan de data van/over erfgoedobjecten, zoals een catalogus, een set museumobjecten of een collectie van archieven of nadere toegangen. Deze (meta)data wordt veelal in een archiefbeheer- of collectieregistratiesysteem beheerd en in de een of andere vorm via de eigen website toegankelijk gemaakt aan haar gebruikers. De data kan ook worden gedeeld voor hergebruik, door een dienstenportaal of aggregator. Het systeem van de erfgoedinstelling dient hiervoor de data via een datadump (export) of API beschikbaar te stellen.')?></p>
      <h2><?= t('Wat is een datasetbeschrijving?')?></h2>
      <p><?= t('Een dataset dient zelf ook weer voorzien te worden van metadata. De beschrijving is dus data over de dataset.')?></p>
      <h2><?= t('Waarom is een datasetbeschrijving belangrijk?')?></h2>
      <p><?= t('Net als erfgoedcollecties is het van belang dat datasets ook vindbaar zijn. Een rijke datasetbeschrijving op een standaard wijze helpt bij het vindbaar maken van de dataset. De datasetbeschrijvingen, mits vormgegeven in een standaard formaat, zijn niet alleen "voer" voor het Datasetregister. Ook zoekmachines zoals Google herkennen datasetbeschrijvingen en maken deze onder andere doorzoekbaar via <a href="https://datasetsearch.research.google.com/">Dataset Search</a>. Hoe beter datasets zijn beschreven en deze beschrijvingen vindbaar zijn, hoe beter hergebruikers de datasets kunnen vinden en daarmee gebruiken en wellicht ook koppelen.')?></p>
      <h2><?= t('Welke informatie bevat een datasetbeschrijving?')?></h2>
      <p><?= t('Een datasetbeschrijving bevat informatie die de dataset beschrijft, zoals een identificatie (URI), een naam, een inhoudsbeschrijving, een licentie, een taal en een data-eigenaar (de maker). Aanvullend op de verplichte informatie elementen kan er informatie worden gegeven over de creatiedatum, publicatiedatum, versie, contact informatie, dekking qua plaats/gebied en tijd/periode, steekwoorden en genre.')?></p>
      <p><?= t('De dataset kan op verschillende manieren aangeboden worden, dit wordt de distributie genoemd. Het kan een datadump zijn die gedownload kan worden in een of ander formaat of een API die bevraagbaar is, bijvoorbeeld een SPARQL endpoint. De informatie over distributies bestaat uit een URL, een formaat en soort, en optioneel een licentie, omschrijving, taal, publicatiedatum, wijzigingsdatum en bestandsgrootte.')?></p>
      <p><?= t('Een set van datasetbeschrijvingen wordt een datasetcatalogus genoemd. Het geeft een totaal overzicht van de beschikbare datasets van een organisatie.')?></p>
      <h2><?= t('Waar wordt een datasetbeschrijving gepubliceerd?')?></h2>
      <p><?= t('Net als het publiceren van de dataset is het aan de erfgoedinstelling om de datasetbeschrijving te publiceren. Informatie, leesbaar voor mens en machine, dient online beschikbaar te worden gemaakt.')?></p>
	   <p><?= t('Als het publiceren niet via de eigen infrastructuur zoals CMS lukt, dan kan er gebruik worden gemaakt van de "publication service" <a href="https://github.com/netwerk-digitaal-erfgoed/dataset-register-entries">Dataset Register entries</a> via Github.')?></p>
      <h2><?= t('Hoe kan ik mijn datasetbeschrijving controleren?')?></h2>
      <p><?= t('Via de REST API kan de datasetbeschrijving worden gecontroleerd of deze voldoet aan de <a href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/">Requirements for Datasets</a>.')?></p>
      <p><?= t('Je kunt de datasetbeschrijving ook controleren met behulp van de algemenere <a href="https://validator.schema.org/">Schema Markup Validator</a>. Geef hier de URL op van de (online) pagina waarin de datasetbeschrijving is opgenomen of plak een codefragment om de test uit te voeren.')?></p>
      <h2><?= t('Wat is het Datasetregister?')?></h2>
      <p><?= t('Het doel van het Datasetregister is om inzicht te krijgen in erfgoeddatasets. Erfgoedinstellingen worden aangemoedigd om datasets aan te bieden vanuit hun systeem, deze datasets te beschrijven en online te publiceren en om de URL\'s van datasetbeschrijvingen aan te melden bij het Datasetregister. Het Datasetregister haalt de datasetbeschrijvingen op waardoor er een totaalbeeld ontstaat van wat beschikbaar is.')?></p>
      <h2><?= t('Hoe kan ik een datasetbeschrijving aanmelden bij het Datasetregister?')?></h2>
      <p><?= t('Idealiter vindt de aanmelding van een datasetbeschrijving (automatisch) plaats via het eigen beheersysteem.')?></p>
      <p><?= t('Een URL van een datasetbeschrijving (die dus door de erfgoedinstelling is gepubliceerd) kan bij het Datasetregister worden aangemeld. Na aanmelding zal het Datasetregister de datasetbeschrijving controleren en ophalen. Het Datasetregister zal dit frequent herhalen om wijzigingen of verwijderingen op te merken om het Datasetregister hiermee bij te werken.')?></p>
      <p><?= t('Voor erfgoedinstellingen die nog niet in staat zijn om een datasetbeschrijving vanuit het eigen systeem te genereren biedt het Netwerk Digitaal Erfgoed een <a href="/form.php">formulier aan voor het maken van een datasetbeschrijving</a>. Het resultaat is een stuk JSON-LD die op de eigen website of ander platform gepubliceerd kan worden.')?></p>
      <h2><?= t('Hoe kan ik het Datasetregister uitproberen?')?></h2>
      <p><?= t('Via deze website, een demonstrator voor de Datasetregister API, kun je datasetbeschrijvingen aanmelden en doorzoeken. Deze demonstrator maakt gebruik van de <a href="https://datasetregister.netwerkdigitaalerfgoed.nl/api/">REST API</a>, die je ook direct kunt aanspreken.')?></p>
      <h2><?= t('Wie maakt en beheert het Datasetregister?')?></h2>
      <p><?= t('Het Datasetregister is gemaakt door de samenwerkende erfgoedinstellingen in het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a> en wordt beheerd en onderhouden door het <a href="https://www.nationaalarchief.nl/">Nationaal Archief</a>. Het Nationaal Archief staat in voor de werking en beschikbaarheid van het Datasetregister.')?></p>
      <h2><?= t('Wat is de status van het Datasetregister?')?></h2>
      <p><?= t('Het Datasetregister is klaar om verder gevuld te worden. De requirements, API en deze website zijn stabiel en worden op basis van feedback van gebruikers en leveranciers verfijnd.')?></p>
      <h2><?= t('Kan ik al aan de slag met datasetbeschrijvingen maken?')?></h2>
      <p><?= t('Jazeker! De definitie van wat voor informatie er in de datasetbeschrijving opgenomen dient te worden ligt vast. Oook het mechanisme om datasetbeschrijvingen aan te melden en de opslag van datasetbeschrijvingen in een triplestore zijn operationeel. Als dataset beheerder kun je dus beginen met het beschrijven van de beschikbare datasets, bekijken waar de datasetbeschrijvingen kunnen worden gepubliceerd en deze aanmelden. Veelal betekent dit ook contact zoeken met uw software leverancier.')?></p>
      <p><?= t('Via een formulier kun je handmatig een datasetbeschrijving maken. Hiermee krijg je een idee over welke informatie benodigd <i>en</i> voorhanden is binnen systeem en organisatie. Vanuit het oogpunt van onderhoud is een oplossing vanuit uw systeem duurzamer.')?></p>
      <p><?= t('Als je de datasetbeschrijvingen al online publiceert, dan zullen zoekmachines zoals Google\'s <a href="https://datasetsearch.research.google.com/">Dataset Search</a> de datasets wellicht al oppikken!')?></p>
      <p><?= t('We horen ook graag wat je ervan vindt. Bijvoorbeeld: is duidelijk welke informatie in de datasetbeschrijving thuishoort? Is duidelijk hoe je de datasetbeschrijvingen gevuld krijgt, qua proces en qua gebruikte software?')?></p>
      <h2><?= t('Ga je aan de slag?')?></h2>
      <p><?= t('Ga je aan de slag met het publiceren van datasetbeschrijvingen en de API op het Datasetregister, laat het weten, zodat we je op de hoogte kunnen houden van ontwikkelingen, updates en beschikbaarheid.')?></p>
	   <h2><?= t('Meer weten?')?></h2>
      <p><?= t('Heb je vragen en/of opmerkingen over de werking van het Datasetregister neem dan contact op met <a href="mailto:info@nationaalarchief.nl?subject=Datasetregister">info@nationaalarchief.nl</a>.')?></p>
   </div>
   <p><br></p>
</main>
<?php include("includes/footer.php") ?>