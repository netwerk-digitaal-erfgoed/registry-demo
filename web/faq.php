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
			<h1 class="display-4 text-center">FAQ</h1>
			<p class="lead text-center">Veelgestelde vragen over het Datasetregister</p>
			
			<div class="content">
			
				<p>In deze FAQ geven we antwoorden op veelgestelde vragen over het Datasetregister. We hebben de vragen opgedeeld per doelgroep:</p>
				<ul>
				<li><a href="#datasetbeheerders">datasetbeheerders</a> (bij erfgoedinstellingen)</li>
				<li><a href="#datasetgebruikers">datasetgebruikers</a> (bij erfgoedinstellingen en aggregators)</li>
				<li><a href="#ontwikkelaars">ontwikkelaars van erfgoedsoftware</a>
				</ul>
				
				<p><br></p>
				
				<h2 id="datasetbeheerders" class="display-5">Voor datasetbeheerders</h2>
				
				<h3 class="display-5">Wat is een dataset?</h3>
				<p>Een dataset (of gegevensverzameling) is een verzameling van gegevens (data of metadata). In de context van erfgoedinstellingen kun je hierbij denken aan de data van/over erfgoedobjecten, zoals een catalogus, een set museumobjecten of een collectie van archieven of nadere toegangen. Deze (meta)data wordt veelal in een archiefbeheer- of collectieregistratiesysteem beheerd en in de een of andere vorm via de eigen website toegankelijk gemaakt aan haar gebruikers. De data kan ook worden gedeeld voor hergebruik, door een dienstenportaal of aggregator. Het systeem van de erfgoedinstelling dient hiervoor de data via een datadump (export) of API beschikbaar te stellen.</p>

				<h3 class="display-5">Wat is een datasetbeschrijving?</h3>
				<p>Een dataset dient zelf ook weer voorzien te worden van metadata. De beschrijving is dus data over de dataset.</p>

				<h3 class="display-5">Waarom is een datasetbeschrijving belangrijk?</h3>
				<p>Net als erfgoedcollecties is het van belang dat datasets ook vindbaar zijn. Een rijke datasetbeschrijving op een standaard wijze helpt bij het vindbaar maken van de dataset. De datasetbeschrijvingen, mits vormgegeven in een standaard formaat, zijn niet alleen "voer" voor het Datasetregister. Ook zoekmachines zoals Google herkennen datasetbeschrijvingen en maken deze onder andere doorzoekbaar via <a href="https://datasetsearch.research.google.com/">Dataset Search</a>. Hoe beter datasets zijn beschreven en deze beschrijvingen vindbaar zijn, hoe beter hergebruikers de datasets kunnen vinden en daarmee gebruiken en wellicht ook koppelen.</p>

				<h3 class="display-5">Welke informatie bevat een datasetbeschrijving?</h3>
				<p>Een datasetbeschrijving bevat informatie die de dataset beschrijft, zoals een identificatie (URI), een naam, een inhoudsbeschrijving, een licentie, een taal en een data-eigenaar (de maker). Aanvullend op de verplichte informatie elementen kan er informatie worden gegeven over de creatiedatum, publicatiedatum, versie, contact informatie, dekking qua plaats/gebied en tijd/periode, steekwoorden en genre.</p>
				<p>De dataset kan op verschillende manieren aangeboden worden, dit wordt de distributie genoemd. Het kan een datadump zijn die gedownload kan worden in een of ander formaat of een API die bevraagbaar is, bijvoorbeeld een SPARQL endpoint. De informatie over distributies bestaat uit een URL, een formaat en soort, en optioneel een licentie, omschrijving, taal, publicatiedatum, wijzigingsdatum en bestandsgrootte.</p>
				<p>Een set van datasetbeschrijvingen wordt een datasetcatalogus genoemd. Het geeft een totaal overzicht van de beschikbare datasets van een organisatie.</p>

				<h3 class="display-5">Waar wordt een datasetbeschrijving gepubliceerd?</h3>
				<p>Net als het publiceren van de dataset is het aan de erfgoedinstelling om de datasetbeschrijving te publiceren. Informatie, leesbaar voor mens en machine, dient online beschikbaar te worden gemaakt.</p>

				<h3 class="display-5">Hoe kan ik mijn datasetbeschrijving controleren?</h3>
				<p>Via de REST API kan de datasetbeschrijving worden gecontroleerd of deze voldoet aan de <a href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/">Requirements for Datasets</a>.</p>
				<p>Je kunt de datasetbeschrijving ook controleren met behulp van de algemenere <a href="https://validator.schema.org/">Schema Markup Validator</a>. Geef hier de URL op van de (online) pagina waarin de datasetbeschrijving is opgenomen of plak een codefragment om de test uit te voeren.</p>

				<h3 class="display-5">Wat is het Datasetregister?</h3>
				<p>Het doel van het Datasetregister is om inzicht te krijgen in erfgoeddatasets. Erfgoedinstellingen worden aangemoedigd om datasets aan te bieden vanuit hun systeem, deze datasets te beschrijven en online te publiceren en om de URL's van datasetbeschrijvingen aan te melden bij het Datasetregister. Het Datasetregister haalt de datasetbeschrijvingen op waardoor er een totaalbeeld ontstaat van wat beschikbaar is.</p>

				<h3 class="display-5">Hoe kan ik een datasetbeschrijving aanmelden bij het Datasetregister?</h3>
				<p>Idealiter vindt de aanmelding van een datasetbeschrijving (automatisch) plaats via het eigen beheersysteem.</p>
				<p>Een URL van een datasetbeschrijving (die dus door de erfgoedinstelling is gepubliceerd) kan bij het Datasetregister worden aangemeld. Na aanmelding zal het Datasetregister de datasetbeschrijving controleren en ophalen. Het Datasetregister zal dit frequent herhalen om wijzigingen of verwijderingen op te merken om het Datasetregister hiermee bij te werken.</p>
				<p>Voor erfgoedinstellingen die nog niet in staat zijn om een datasetbeschrijving vanuit het eigen systeem te genereren biedt het Netwerk Digitaal Erfgoed een <a href="#TODO">formulier aan voor het maken van een datasetbeschrijving</a>. Het resultaat is een stuk JSON-LD die op de eigen website of ander platform gepubliceerd kan worden.</p>

				<h3 class="display-5">Hoe kan ik het Datasetregister uitproberen?</h3>
				<p>Via deze website, een demonstrator voor de Datasetregister API, kun je datasetbeschrijvingen aanmelden en doorzoeken. Deze demonstrator maakt gebruik van de <a href="https://datasetregister.netwerkdigitaalerfgoed.nl/api/">REST API</a>, die je ook direct kunt aanspreken.</p>

				<h3 class="display-5">Wie maakt en beheert het Datasetregister?</h3>
				<p>Het Datasetregister wordt gemaakt en beheerd door de samenwerkende erfgoedinstellingen in het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a>. De instellingen staan in voor de werking en beschikbaarheid van het Datasetregister.</p>

				<h3 class="display-5">Wat is de status van het Datasetregister?</h3>
				<p>Het Datasetregister is klaar om gevuld te worden. De requirements, API en deze website zijn stabiel en worden op basis van feedback van gebruikers en leveranciers verfijnd.</p>

				<h3 class="display-5">Kan ik al aan de slag met datasetbeschrijvingen maken?</h3>
				<p>Jazeker! De definitie van wat voor informatie er in de datasetbeschrijving opgenomen dient te worden ligt vast. Oook het mechanisme om datasetbeschrijvingen aan te melden en de opslag van datasetbeschrijvingen in een triplestore zijn operationeel. Als dataset beheerder kun je dus beginen met het beschrijven van de beschikbare datasets, bekijken waar de datasetbeschrijvingen kunnen worden gepubliceerd en deze aanmelden. Veelal betekent dit ook contact zoeken met uw software leverancier.</p>
				<p>Via een formulier kun je handmatig een datasetbeschrijving maken. Hiermee krijg je een idee over welke informatie benodigd <i>en</i>voorhanden is binnen systeem en organisatie. Vanuit het oogpunt van onderhoud is een oplossing vanuit uw systeem duurzamer.</p>
				<p>Als je de datasetbeschrijvingen al online publiceert, dan zullen zoekmachines zoals Google's <a href="https://datasetsearch.research.google.com/">Dataset Search</a>de datasets wellicht al oppikken!</p>
				<p>We horen ook graag wat je ervan vindt. Bijvoorbeeld: is duidelijk welke informatie in de datasetbeschrijving thuishoort? Is duidelijk hoe je de datasetbeschrijvingen gevuld krijgt, qua proces en qua gebruikte software?</p>

				<h3 class="display-5">Ga je aan de slag?</h3>
				<p>Ga je aan de slag met het publiceren van datasetbeschrijvingen en de API op het Datasetregister, laat het weten, zodat we je op de hoogte kunnen houden van ontwikkelingen, updates en beschikbaarheid.</p>
				
				<p><br></p>
				
				<h2 id="datasetgebruikers" class="display-5">Voor datasetgebruikers</h2>
				
				<h3 class="display-5">Welke datasets stelt het Datasetregister beschikbaar?</h3>
				<p>Het Datasetregister stelt <b>geen</b>datasets ter beschikking. Datasets (in de vorm van datadump of API's) staan bij de bron (=de erfgoedinstelling) of op een open data platform waar de erfgoedinstelling gebruik van maakt.</p>
				<p>Het Datasetregister levert op basis van zoekvragen URI's van datasetbeschrijvingen op, deze datasetbeschrijvingen bevatten verwijzingen naar de datasets.</p>

				<h3 class="display-5">Welke datasetbeschrijvingen stelt het Datasetregister beschikbaar?</h3>
				<p>Het Datasetregister stelt <b>geen</b>datasetbeschrijvingen ter beschikking. Datasetbeschrijvingen staan bij de bron (=de erfgoedinstelling) of op een open data platform waar de erfgoedinstelling gebruik van maakt.</p>
				<p>OK, het Datasetregister bevat wel datasetbeschrijvingen, maar dit is puur als cache en om de datasetbeschrijvingen efficiënt te kunnen doorzoeken. Het Datasetregister levert op basis van zoekvragen URI's van datasetbeschrijvingen bij de bron op.</p>

				<h3 class="display-5">Hoe kan ik de datasetbeschrijvingen doorzoeken?</h3>
				<p>De datasetbeschrijvingen zijn via de web-GUI op het SPARQL-endpoint van de triplestore te doorzoeken. De datasetbeschrijvingen zijn opgeslagen op basis van het DCAT vocabulair.</p>

				<h3 class="display-5">Wie maakt en beheert het Datasetregister?</h3>
				<p>Het Datasetregister wordt gemaakt en beheerd door de samenwerkende erfgoedinstellingen in het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a>. De instellingen staan in voor de werking en beschikbaarheid van het Datasetregister.</p>

				<h3 class="display-5">Wat is de status van het Datasetregister?</h3>
				<p>Het Datasetregister is klaar om gevuld te worden. De requirements, API en deze website zijn stabiel en worden op basis van feedback van gebruikers en leveranciers verfijnd.</p>

				<h3 class="display-5">Kan ik het Datasetregister nu al gebruiken?</h3>
				<p>Jazeker! De definitie van wat voor informatie er in de datasetbeschrijving opgenomen dient te worden ligt vast. Oook het mechanisme om datasetbeschrijvingen aan te melden en de opslag van datasetbeschrijvingen in een triplestore zijn operationeel. Als dataset beheerder kun je dus beginen met het beschrijven van de beschikbare datasets, bekijken waar de datasetbeschrijvingen kunnen worden gepubliceerd en deze aanmelden. Veelal betekent dit ook contact zoeken met uw software leverancier.</p>
				<p>Als je een stap verder wilt gaan, dan kun je het Datasetregister in je collectiebeheersysteem implementeren zodat collectiebeheerders ermee aan de slag kunnen. Wij ondersteunen je hier graag bij.</p>

				<h3 class="display-5">Ga je aan de slag?</h3>
				<p>Ga je aan de slag met het publiceren van datasetbeschrijvingen en de API op het Datasetregister, laat het weten, zodat we je op de hoogte kunnen houden van ontwikkelingen, updates en beschikbaarheid.</p>
							
				<p><br></p>
				
				<h2 id="ontwikkelaars" class="display-5">Voor ontwikkelaars van erfgoedsoftware </h2>

				<h3 class="display-5">Waarom zijn machine-leesbare datasetbeschrijvingen belangrijk?</h3>
				<p>Om machines de datasetbeschrijvingen te laten begrijpen is het van belang dat deze niet alleen leesbaar is voor de mens, maar ook voor de machine. Standaarden als <a href="https://schema.org/Dataset">schema.org/Dataset</a>helpen om de semantiek van de datasetbeschrijvingen vast te leggen. Als er rijke informatie worden geboden verbeterd de vindbaarheid.</p>

				<h3 class="display-5">Welke informatie bevat een datasetbeschrijving?</h3>
				<p>De informatie die verplicht en aanbevolen is - op basis van <a href="https://schema.org/Dataset">schema.org/Dataset</a>- staat beschreven in een <a href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/">requirements document</a>.</p>
				<p>Onderstaande afbeelding geeft de gelaagdheid aan van datasetbeschrijvingen:</p>
				<p><img src="static/datacatalog-dataset-distribution.svg" style="max-width:100%;margin:0 32px"></p>

				<h3 class="display-5">Op welke wijze dienen datasetbeschrijvingen gepubliceerd te worden?</h3>
				<p>Inhoudelijk dient de dataset beschrijving te voldoen aan een standaard als <a href="https://schema.org/Dataset">schema.org/Dataset</a>(en later DCAT). Qua weergave, ook wel serialisatie genoemd, zijn er verschillende mogelijkheden:</p>
				<ul>
				<li>opgenomen in een HTML als <a href="https://schema.org/docs/gs.html">microdata</a>of <a href="https://www.w3.org/TR/xhtml-rdfa-primer/">RDFa</a>; </li>
				<li>als &lt;script type="application/ld+json"&gt; blok met <a href="https://json-ld.org/">JSON-LD</a>een HTML pagina (aan serverkant ingevoegd of via Javascript aan client-zijde geïnjecteerd); </li>
				<li>als los RDF resource.</li>
				</ul>
				<p>De meeste (geautomatiseerde) gebruiker verwachten de datasetbeschrijving "ge-embed" in de HTML painga. Spiders van zoekmachines zoals Google volgen gelinkte JSON-LD bestanden <b>niet</b>. Ook, via Javascript geïnjecteerde JSON-LD wordt door de meeste spiders niet opgemerkt. Er zijn meer serialisaties van RDF, zoals RDF/XML en Turtle. Spiders van zoekmachines als Google ondersteunen alleen microdata, RDFa en JSON-LD (deze laatste vorm wordt door Google geadviseerd). Omdat vindbaarheid een belangrijk aspect is wordt het gebruik van inline JSON-LD geadviseerd. Echter, dit laat onverlet dat dataset beschrijvingen <b>ook</b>in andere serialisatieformaten of via een aparte resource (op basis van content negotiation) worden gepubliceerd.</p>
				<p>Het Datasetregister ondersteunt ook datacatalogs. Deze set van datasets geeft in één keer informatie over alle beschikbare datasets van een organisatie.</p>

				<h3 class="display-5">Welke functies biedt het Datasetregister?</h3>
				<p>Het Datasetregister biedt, naast een "Admin console" voor de beheerders van het Datasetregister, een tweetal toegangen: een REST API en een SPARL endpoint.</p>

				<h3 class="display-5">Hoe kan een dataset aangemeld worden bij het Datasetregister?</h3>
				<p>Via de REST API kan een URL worden aangemeld van een pagina waar een datasetbeschrijving wordt gepubliceerd, een directe URL van een RDF bestand met datasetbeschrijving of een URL van een datacatalog.</p>
				<p>Via deze website kun je via de browser een URL van een datasetbechrijving of datacatalogus aanmelden, hierbij wordt er gebruik gemaakt van de REST API.</p>

				<h3 class="display-5">Kan iedereen een datasetbeschrijving toevoegen aan het Datasetregister?
				</h3>
				<p>Het aanmelden van datasets via de REST API werkt op basis van een <a href="https://triplestore.netwerkdigitaalerfgoed.nl/resource?uri=https:%2F%2Fdata.netwerkdigitaalerfgoed.nl%2Fregistry%2Fallowed_domain_names&role=context" target="_blank">lijst van toegestane domeinen</a>. Datasetbechrijvingen (en datacatalogi) die afkomstig zijn van domeinen op deze lijst worden toegevoegd.</p>
				<p>Ontbreekt er een domeinnaam van een erfgoedinstelling of leverancier, neem dan contact op.</p>

				<h3 class="display-5">Hoe kan een datasetbeschrijving gecontroleerd worden?</h3>
				<p>Via de REST API kan de datasetbeschrijving van een datasetbeschrijving worden gecontroleerd op de <a href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/">Requirements for Datasets</a>.</p>
				<p>Je kunt de datasetbeschrijving ook controleren met behulp van de algemenere <a href="https://validator.schema.org/">Schema Markup Validator</a>. Geef hier de URL op van de (online) pagina waarin de datasetbeschrijving is opgenomen of plak een codefragment om de test uit te voeren.</p>

				<h3 class="display-5">Hoe werkt het Datasetregister, technisch?</h3>
				<p>Het Datasetregister beoogt een verwijzer naar datasets te worden. Hiertoe crawlt het Datasetregister de URL's van aangemelde pagina's met datasetbeschrijvingen.</p>
				<p>De datasetbeschrijvingen worden gevalideerd en na conversie opgeslagen in een triplestore.</p>
				<p>Onderstaand ontwerp toont de <i>high-level</i>componenten:</p>
				<p><img src="static/design.png" style="max-width:100%;margin:0 32px"></p>

				<h3 class="display-5">Hoe kan ik het Datasetregister uitproberen?</h3>
				<p>Via deze website kun je datasetbeschrijvingen aanmelden en doorzoeken.</p>

				<h3 class="display-5">Hoe kan ik de API van het Datasetregister aanspreken?</h3>
				<p>De URL van de Datasetregister API is https://datasetregister.netwerkdigitaalerfgoed.nl/api/</p>
				<p>In de <a href="https://github.com/netwerk-digitaal-erfgoed/registry-poc/blob/master/api-4.md">beschrijving van de API</a>vind je informatie over het endpoint.</p>

				<h3 class="display-5">Hoe kan ik vanuit mijn collectiebeheersysteem gebruikmaken van het Datasetregister? </h3>
				<p>Het gebruik van de API staat open voor alle erfgoedinstellingen en hun leveranciers.</p>

				<h3 class="display-5">Wie maakt en beheert het Datasetregister?</h3>
				<p>Het Datasetregister wordt gemaakt en beheerd door de samenwerkende erfgoedinstellingen in het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a>. De instellingen staan in voor de werking en beschikbaarheid van het Datasetregister.</p>

				<h3 class="display-5">Wat is de status van het Datasetregister?</h3>
				<p>Het Datasetregister is klaar om gevuld te worden. De requirements, API en deze website zijn stabiel en worden op basis van feedback van gebruikers en leveranciers verfijnd.</p>

				<h3 class="display-5">Kan ik het Datasetregister nu al gebruiken?</h3>
				<p>Jazeker! Het Datasetregister is weliswaar nog in ontwikkeling, maar nu al te gebruiken. We horen dan ook graag wat je ervan vindt. Bijvoorbeeld: zijn de zoekmogelijkheden toereikend? Is de API bruikbaar?</p>
				<p>Als je een stap verder wilt gaan, dan kun je het Datasetregister in je collectiebeheersysteem implementeren zodat collectiebeheerders ermee aan de slag kunnen. Wij ondersteunen je hier graag bij.</p>

				<h3 class="display-5">Ga je aan de slag?</h3>
				<p>Ga je aan de slag met het publiceren van datasetbeschrijvingen en de API op het Datasetregister, laat het weten, zodat we je op de hoogte kunnen houden van ontwikkelingen, updates en beschikbaarheid.</p>
				
			</div>
		</div>

        <footer class="text-muted border-top">
            <div class="container">
                <p>Een initiatief van het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a></p>
            </div>
        </footer>

    </body>
</html>