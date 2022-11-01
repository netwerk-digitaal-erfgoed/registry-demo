<?php include("includes/header.php") ?>
<main>
   <div class="o-container o-container__small m-t-space">
      <h1><?= t('Veelgestelde vragen over het Datasetregister door dataset gebruikers bij erfgoedinstellingen en aggregators') ?></h1>
      <p><br></p>
      <h2><?= t('Welke datasets stelt het Datasetregister beschikbaar?') ?></h2>
      <p><?= t('Het Datasetregister stelt <b>geen</b> datasets ter beschikking. Datasets (in de vorm van datadump of API\'s) staan bij de bron (=de erfgoedinstelling) of op een open data platform waar de erfgoedinstelling gebruik van maakt.') ?></p>
      <p><?= t('Het Datasetregister levert op basis van zoekvragen URI\'s van datasetbeschrijvingen op, deze datasetbeschrijvingen bevatten verwijzingen naar de datasets.') ?></p>
      <h2><?= t('Welke datasetbeschrijvingen stelt het Datasetregister beschikbaar?') ?></h2>
      <p><?= t('Het Datasetregister stelt <b>geen</b> datasetbeschrijvingen ter beschikking. Datasetbeschrijvingen staan bij de bron (=de erfgoedinstelling) of op een open data platform waar de erfgoedinstelling gebruik van maakt.') ?></p>
      <p><?= t('OK, het Datasetregister bevat wel datasetbeschrijvingen, maar dit is puur als cache en om de datasetbeschrijvingen efficiënt te kunnen doorzoeken. Het Datasetregister levert op basis van zoekvragen URI\'s van datasetbeschrijvingen bij de bron op.') ?></p>
      <h2><?= t('Hoe kan ik de datasetbeschrijvingen doorzoeken?') ?></h2>
      <p><?= t('De datasetbeschrijvingen zijn via de web-GUI op het SPARQL-endpoint van de triplestore te doorzoeken. De datasetbeschrijvingen zijn opgeslagen op basis van het DCAT vocabulair.') ?></p>
      <h2><?= t('Wie maakt en beheert het Datasetregister?') ?></h2>
      <p><?= t('Het Datasetregister is gemaakt door de samenwerkende erfgoedinstellingen in het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a> en wordt beheerd en onderhouden door het <a href="https://www.nationaalarchief.nl/">Nationaal Archief</a>. Het Nationaal Archief staat in voor de werking en beschikbaarheid van het Datasetregister.') ?></p>
      <h2><?= t('Wat is de status van het Datasetregister?') ?></h2>
      <p><?= t('Het Datasetregister is klaar om verder gevuld te worden. De requirements, API en deze website zijn stabiel en worden op basis van feedback van gebruikers en leveranciers verfijnd.') ?></p>
      <h2><?= t('Kan ik het Datasetregister nu al gebruiken?') ?></h2>
      <p><?= t('Jazeker! De definitie van wat voor informatie er in de datasetbeschrijving opgenomen dient te worden ligt vast. Ook het mechanisme om datasetbeschrijvingen aan te melden en de opslag van datasetbeschrijvingen in een triplestore zijn operationeel. Als dataset beheerder kun je dus beginen met het beschrijven van de beschikbare datasets, bekijken waar de datasetbeschrijvingen kunnen worden gepubliceerd en deze aanmelden. Veelal betekent dit ook contact zoeken met uw software leverancier.') ?></p>
      <p><?= t('Als je een stap verder wilt gaan, dan kun je het Datasetregister in je collectiebeheersysteem implementeren zodat collectiebeheerders ermee aan de slag kunnen. Wij ondersteunen je hier graag bij.') ?></p>
      <h2><?= t('Ga je aan de slag?') ?></h2>
      <p><?= t('Ga je aan de slag met het publiceren van datasetbeschrijvingen en de API op het Datasetregister, laat het weten, zodat we je op de hoogte kunnen houden van ontwikkelingen, updates en beschikbaarheid.') ?></p>
      <h2><?= t('Meer weten?') ?></h2>
      <p><?= t('Heb je vragen en/of opmerkingen over de werking van het Datasetregister neem dan contact op met <a href="mailto:info@nationaalarchief.nl?subject=Datasetregister">info@nationaalarchief.nl</a>.') ?></p>
   </div>
   <p><br></p>
</main>
<?php include("includes/footer.php") ?>