<?php include("includes/header.php") ?>
<main>
   <div class="o-container o-container__small m-t-space">
      <h1><?= t('Veelgestelde vragen over het Datasetregister door ontwikkelaars van erfgoed software') ?></h1>
      <p><br></p>
      <h2><?= t('Waarom zijn machine-leesbare datasetbeschrijvingen belangrijk?') ?></h2>
      <p><?= t('Om machines de datasetbeschrijvingen te laten begrijpen is het van belang dat deze niet alleen leesbaar is voor de mens, maar ook voor de machine. Standaarden als <a href="https://schema.org/Dataset">schema.org/Dataset</a> helpen om de semantiek van de datasetbeschrijvingen vast te leggen. Als er rijke informatie worden geboden verbeterd de vindbaarheid.') ?></p>
      <h2><?= t('Welke informatie bevat een datasetbeschrijving?') ?></h2>
      <p><?= t('De informatie die verplicht en aanbevolen is - op basis van <a href="https://schema.org/Dataset">schema.org/Dataset</a> - staat beschreven in een <a href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/">requirements document</a>.') ?></p>
      <p><?= t('Onderstaande afbeelding geeft de gelaagdheid aan van datasetbeschrijvingen:') ?></p>
      <p><img src="assets/datacatalog-dataset-distribution.svg" style="max-width:100%;margin:0 32px;"></p>
      <h2><?= t('Op welke wijze dienen datasetbeschrijvingen gepubliceerd te worden?') ?></h2>
      <p><?= t('Inhoudelijk dient de dataset beschrijving te voldoen aan een standaard als <a href="https://schema.org/Dataset">schema.org/Dataset</a> (en later DCAT). Qua weergave, ook wel serialisatie genoemd, zijn er verschillende mogelijkheden:') ?></p>
      <ul>
      <li><?= t('opgenomen in een HTML als <a href="https://schema.org/docs/gs.html">microdata</a> of <a href="https://www.w3.org/TR/xhtml-rdfa-primer/">RDFa</a>;') ?></li>
      <li><?= t('als &lt;script type="application/ld+json"&gt; blok met <a href="https://json-ld.org/">JSON-LD</a> een HTML pagina (aan serverkant ingevoegd of via Javascript aan client-zijde geïnjecteerd);') ?></li>
      <li><?= t('als los RDF resource.') ?></li>
      </ul>
      <p><?= t('De meeste (geautomatiseerde) gebruiker verwachten de datasetbeschrijving "ge-embed" in de HTML painga. Spiders van zoekmachines zoals Google volgen gelinkte JSON-LD bestanden <b>niet</b>. Ook, via Javascript geïnjecteerde JSON-LD wordt door de meeste spiders niet opgemerkt. Er zijn meer serialisaties van RDF, zoals RDF/XML en Turtle. Spiders van zoekmachines als Google ondersteunen alleen microdata, RDFa en JSON-LD (deze laatste vorm wordt door Google geadviseerd). Omdat vindbaarheid een belangrijk aspect is wordt het gebruik van inline JSON-LD geadviseerd. Echter, dit laat onverlet dat dataset beschrijvingen <b>ook</b> in andere serialisatieformaten of via een aparte resource (op basis van content negotiation) worden gepubliceerd.') ?></p>
      <p><?= t('Het Datasetregister ondersteunt ook datacatalogs. Deze set van datasets geeft in één keer informatie over alle beschikbare datasets van een organisatie.') ?></p>
      <h2><?= t('Welke functies biedt het Datasetregister?') ?></h2>
      <p><?= t('Het Datasetregister biedt, naast website, een tweetal toegangen: een REST API en een SPARL endpoint.') ?></p>
      <h2><?= t('Hoe kan een dataset aangemeld worden bij het Datasetregister?') ?></h2>
      <p><?= t('Via de REST API kan een URL worden aangemeld van een pagina waar een datasetbeschrijving wordt gepubliceerd, een directe URL van een RDF bestand met datasetbeschrijving of een URL van een datacatalog.') ?></p>
      <p><?= t('Via deze website kun je via de browser een URL van een datasetbechrijving of datacatalogus aanmelden, hierbij wordt er gebruik gemaakt van de REST API.') ?></p>
      <h2 id="allowed_domain_names"><?= t('Kan iedereen een datasetbeschrijving toevoegen aan het Datasetregister?') ?></h2>
      <p><?= t('Het aanmelden van datasets via de REST API werkt op basis van een <a href="https://triplestore.netwerkdigitaalerfgoed.nl/resource?uri=https:%2F%2Fdata.netwerkdigitaalerfgoed.nl%2Fregistry%2Fallowed_domain_names&amp;role=context" target="_blank">lijst van toegestane domeinen</a>. Datasetbechrijvingen (en datacatalogi) die afkomstig zijn van domeinen op deze lijst worden toegevoegd.') ?></p>
      <p><?= t('Ontbreekt er een domeinnaam van een erfgoedinstelling of leverancier, neem dan contact op.') ?></p>
      <h2><?= t('Hoe kan een datasetbeschrijving gecontroleerd worden?') ?></h2>
      <p><?= t('Via de REST API kan de datasetbeschrijving van een datasetbeschrijving worden gecontroleerd op de <a href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/">Requirements for Datasets</a>.') ?></p>
      <p><?= t('Je kunt de datasetbeschrijving ook controleren met behulp van de algemenere <a href="https://validator.schema.org/">Schema Markup Validator</a>. Geef hier de URL op van de (online) pagina waarin de datasetbeschrijving is opgenomen of plak een codefragment om de test uit te voeren.') ?></p>
      <h2><?= t('Hoe werkt het Datasetregister, technisch?') ?></h2>
      <p><?= t('Het Datasetregister beoogt een verwijzer naar datasets te worden. Hiertoe crawlt het Datasetregister de URL\'s van aangemelde pagina\'s met datasetbeschrijvingen.') ?></p>
      <p><?= t('De datasetbeschrijvingen worden gevalideerd en na conversie opgeslagen in een triplestore.') ?></p>
      <p><?= t('Onderstaand ontwerp toont de <i>high-level</i> componenten:') ?></p>
      <p><img src="assets/design.png" style="max-width:100%;margin:0 32px;"></p>
      <h2><?= t('Hoe kan ik het Datasetregister uitproberen?') ?></h2>
      <p><?= t('Via deze website kun je datasetbeschrijvingen aanmelden en doorzoeken.') ?></p>
      <h2><?= t('Hoe kan ik de API van het Datasetregister aanspreken?') ?></h2>
      <p><?= t('De URL van de Datasetregister API is https://datasetregister.netwerkdigitaalerfgoed.nl/api/') ?></p>
      <p><?= t('In de <a href="https://github.com/netwerk-digitaal-erfgoed/registry-poc/blob/master/api-4.md">beschrijving van de API</a> vind je informatie over het endpoint.') ?></p>
      <h2><?= t('Hoe kan ik vanuit mijn collectiebeheersysteem gebruikmaken van het Datasetregister?') ?></h2>
      <p><?= t('Het gebruik van de API staat open voor alle erfgoedinstellingen en hun leveranciers.') ?></p>
      <h2><?= t('Wie maakt en beheert het Datasetregister?') ?></h2>
      <p><?= t('Het Datasetregister is gemaakt door de samenwerkende erfgoedinstellingen in het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a> en wordt beheerd en onderhouden door het <a href="https://www.nationaalarchief.nl/">Nationaal Archief</a>. Het Nationaal Archief staat in voor de werking en beschikbaarheid van het Datasetregister.') ?></p>
      <h2><?= t('Wat is de status van het Datasetregister?') ?></h2>
      <p><?= t('Het Datasetregister is klaar om verder gevuld te worden. De requirements, API en deze website zijn stabiel en worden op basis van feedback van gebruikers en leveranciers verfijnd.') ?></p>
      <h2><?= t('Kan ik het Datasetregister nu al gebruiken?') ?></h2>
      <p><?= t('Jazeker! Het Datasetregister wordt nog doorontwikkeld en nog verder gevuld, maar nu al te gebruiken. We horen dan ook graag wat je ervan vindt. Bijvoorbeeld: zijn de zoekmogelijkheden toereikend? Is de API bruikbaar?') ?></p>
      <p><?= t('Als je een stap verder wilt gaan, dan kun je het Datasetregister in je collectiebeheersysteem implementeren zodat collectiebeheerders ermee aan de slag kunnen. Wij ondersteunen je hier graag bij.') ?></p>
      <h2><?= t('Ga je aan de slag?') ?></h2>
      <p><?= t('Ga je aan de slag met het publiceren van datasetbeschrijvingen en de API op het Datasetregister, laat het weten, zodat we je op de hoogte kunnen houden van ontwikkelingen, updates en beschikbaarheid.') ?></p>
      <h2><?= t('Meer weten?') ?></h2>
      <p><?= t('Heb je vragen en/of opmerkingen over de werking van het Datasetregister neem dan contact op met <a href="mailto:info@nationaalarchief.nl?subject=Datasetregister">info@nationaalarchief.nl</a>.') ?></p>

   </div>
   <p><br></p>
</main>
<?php include("includes/footer.php") ?>