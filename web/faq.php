<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <link rel="icon" href="favicon.ico" />
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
			<p class="lead text-center">Veelgestelde vragen over het Register</p>
			
			<div class="content">
			
				<p>In deze FAQ geven we antwoorden op veelgestelde vragen over het Register. We hebben de vragen opgedeeld per doelgroep:</p>
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
				<p>Net als erfgoedcollecties is het van belang dat datasets ook vindbaar zijn. Een rijke datasetbeschrijving op een standaard wijze helpt bij het vindbaar aken van de dataset. De datasetbeschrijvingen, mits vormgegeven in een standaard formaat, zijn niet alleen "voer" voor het Register. Ook zoekmachines zoals Google herkennen datasetbeschrijvingen en maken deze onder andere doorzoekbaar via <a href="https://datasetsearch.research.google.com/">Dataset Search</a>. Hoe beter datasets zijn beschreven en deze beschrijvingen vindbaar zijn, hoe beter hergebruikers de datasets kunnen vinden en daarmee wellicht ook gebruiken.</p>
				
				<h3 class="display-5">Welke informatie bevat een datasetbeschrijving?</h3>
				<p>Een datasetbeschrijving bevat informatie die de dataset beschrijft, zoals een identificatie (URI), een naam, een inhoudsbeschrijving, een licentie, een taal, een data-eigenaar en een verstrekker. Aanvullend op de verplichte informatie elementen kan er informatie worden gegeven over de creatiedatum, publicatiedatum, versie, contact informatie, dekking qua plaats/gebied en tijd/periode en tags en genre.</p>
				<p>De dataset kan op verschillende manieren aangeboden worden, dit wordt de distributie genoemd. Het kan een datadump zijn die gedownload kan worden in een of ander formaat of een API die bevraagbaar is. De informatie over distributies bestaat uit een URL, een formaat en soort, en optioneel een licentie, omschrijving, taal, publicatiedatum, wijzigingsdatum en bestandsgrootte.</p>
				<p>Een set van datasetbeschrijvingen wordt een datasetcatalogus genoemd.</p>
				
				<h3 class="display-5">Waar wordt een datasetbeschrijving gepubliceerd?</h3>
				<p>Net als het publiceren van de dataset is het aan de erfgoedinstelling om de datasetbeschrijving te publiceren. Informatie, leesbaar voor mens en machine, dient online beschikbaar te worden gemaakt.</p>
								
				<h3 class="display-5">Hoe kan ik mijn datasetbeschrijving controleren?</h3>
				<p>Je kunt de datasetbeschrijving controleren met behulp van Google's <a href="https://search.google.com/structured-data/testing-tool/u/0/?hl=nl">Tool voor gestructureerde gegevenstests</a>. Geef hier de URL op van de (online) pagina waarin de datasetbeschrijving is opgenomen of plak een codefragment om de test uit te voeren.</p>
				
				<h3 class="display-5">Wat is het Register?</h3>
				<p>Het doel van het Register is om inzicht te krijgen in erfgoeddatasets. Erfgoedinstellingen worden aangemoedigd om datasets aan te bieden vanuit hun systeem, deze datasets te beschrijven en online te publiceren en om deze URL's van datasetbeschrijvingen aan te melden bij het Register. Het Register haalt de datasetbeschrijvingen op waardoor de erfgoeddatasets doorzoekbaar gemaakt kan worden.</p>
				
				<h3 class="display-5">Hoe kan ik een datasetbeschrijving aanmelden bij het Register?</h3>
				<p>Idealiter vindt de aanmelding van een datasetbeschrijving (automatisch) plaats via het eigen beheersysteem (vandaar ook de sectie voor <a href="#ontwikkelaars">ontwikkelaars van erfgoedsoftware</a>).</p>
				<p>Een URL van een datasetbeschrijving (die dus door de erfgoedinstelling is gepubliceerd) kan bij het Register worden aangemeld. Na aanmelding zal het Register de datasetbeschrijving controleren en ophalen. Het Register zal dit frequent herhalen om wijzigingen of verwijderingen op te merken om het Register hiermee bij te werken.</p>
				<p>Voor erfgoedinstellingen die nog niet in staat zijn om een datasetbeschrijving vanuit het eigen systeem te genereren biedt het NDE een <a href="form.php">formulier aan voor een datasetbeschrijving</a>. Het resultaat is een stuk JSON-LD die op de eigen website gepubliceerd kan worden. Als dit laatste niet tot de mogelijkheden behoren dan kan het JSON-LD opgeslagen worden in het tijdelijk test-register. Let wel: tijdelijk, dit is dus geen duurzame oplossing (het mogelijk maken dat je als erfgoedinstelling zelf de datasetbeschrijving kunt publiceren, liefst vanuit het beheersysteem, is de duurzame oplossing).</p>
				
				<h3 class="display-5">Hoe kan ik het Register uitproberen?</h3>
				<p>Via de <a href=".">demonstrator</a> kun je datasetbeschrijvingen aanmelden en doorzoeken. Deze demonstrator maakt gebruik van de API, die je ook direct kunt aanspreken.</p>
				
				<h3 class="display-5">Wie maakt en beheert het Register?</h3>
				<p>Het Register wordt gemaakt en beheerd door de samenwerkende erfgoedinstellingen in het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a>. De instellingen staan in voor de werking en beschikbaarheid van het Register.</p>
				
				<h3 class="display-5">Wat is de status van het Register?</h3>
				<p>Het Register is in ontwikkeling. Het ontwerp van het Register, waaronder de requirements voor datasetbeschrijvingen alsmede de beschrijving van de API hebben, zijn gerealiseerd in een prototype en demonstrator. De huidige versie is geschikt om breed gebruikt te worden door instellingen en in collectiebeheersystemen.</p>
				
				<h3 class="display-5">Kan ik al aan de slag met datasetbeschrijvingen maken?</h3>
				<p>Jazeker! Het Register is weliswaar nog in ontwikkeling, de definitie van wat voor informatie er in de datasetbeschrijving opgenomen dient te worden staat al. Als dataset beheerder kun je al inventariseren waar de datasetbeschrijving wordt opgeslagen en waar deze wordt gepubliceerd. Veelal betekent dit ook contact zoeken met uw software leverancier.</p>
				<p>Via een formulier kun je al handmatig een datasetbeschrijving maken. Hiermee krijg je een idee over welke informatie benodigd <i>en</i> voorhanden is binnen systeem en organisatie.</p>
				<p>Als je de datasetbeschrijvingen al online publiceert, dan zullen zoekmachines zoals Google's <a href="https://datasetsearch.research.google.com/">Dataset Search</a> de datasets wellicht al oppikken!</p>
				<p>We horen ook graag wat je ervan vindt. Bijvoorbeeld: is duidelijk welke informatie in de datasetbeschrijving thuishoort? Is duidelijk hoe je de dataset bechrijvingen gevuld krijgt, qua proces en qua met usearch.google.com/structured-data/testing-tool/u/0/?hl=nlw software?</p>
				
				<h3 class="display-5">Ik heb een vraag. Met wie kan ik contact opnemen?</h3>
				<p>Met <a href="mailto:bob.coret@netwerkdigitaalerfgoed.nl">Bob Coret</a>, projectleider bij het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a>.</p>
				<p>Ga je aan de slag met het publiceren van datasetbeschrijvingen en de API op het Register, laat het weten, zodat we je op de hoogte kunnen houden van ontwikkelingen, updates en beschikbaarheid.</p>
				
				<p><br></p>
				
				<h2 id="datasetgebruikers" class="display-5">Voor datasetgebruikers</h2>
				
				<h3 class="display-5">Welke datasets stelt het Register beschikbaar?</h3>
				<p>Het Register stelt <b>geen</b> datasets ter beschikking. Datasets (in de vorm van datadump of API's) staan bij de bron (=de erfgoedinstelling) of op een open data platform waar de erfgoedinstelling gebruik van maakt.</p>
				<p>Het Register levert op basis van zoekvragen URI's van datasetbeschrijvingen op, deze datasetbeschrijvingen bevatten verwijzingen naar de datasets.</p>

				<h3 class="display-5">Welke datasetbeschrijvingen stelt het Register beschikbaar?</h3>
				<p>Het Register stelt <b>geen</b> datasetbeschrijvingen ter beschikking. Datasetbeschrijvingen staan bij de bron (=de erfgoedinstelling) of op een open data platform waar de erfgoedinstelling gebruik van maakt.</p>
				<p>OK, het Register bevat wel datasetbeschrijvingen, maar dit is puur als cache en om de datasetbeschrijvingen efficiënt te kunnen doorzoeken. Het Register levert op basis van zoekvragen URI's van datasetbeschrijvingen bij de bron op.</p>
				<p>Als een tijdelijk voorziening kunnen via het formulier gemaakte datasetbeschrijvingen opgeslagen worden. Dit is echter niet bedoeld als duurzame oplossing, puur om te testen.</p>

				<h3 class="display-5">Hoe kan ik de datasetbeschrijvingen doorzoeken?</h3>
				<p>Via de <a href=".">demonstrator</a> kunnen de datasetbeschrijvingen doorzocht worden. Hiertoe wordt de REST API gebruikt (in de toekomst). Ook is de web-GUI het het SPARQL-endpoint van de triplestore beschikbaar om de datasetbeschrijvingen te doorzoeken.</p>
			
				<h3 class="display-5">Wie maakt en beheert het Register?</h3>
				<p>Het Register wordt gemaakt en beheerd door de samenwerkende erfgoedinstellingen in het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a>. De instellingen staan in voor de werking en beschikbaarheid van het Register.</p>
				
				<h3 class="display-5">Wat is de status van het Register?</h3>
				<p>Het Register is in ontwikkeling. Het ontwerp van het Register, waaronder de requirements voor datasetbeschrijvingen alsmede de beschrijving van de API hebben, zijn gerealiseerd in een prototype en demonstrator. De huidige versie is geschikt om breed gebruikt te worden door instellingen en in collectiebeheersystemen.</p>
				
				<h3 class="display-5">Kan ik het Register nu al gebruiken?</h3>
				<p>Jazeker! Het Register is weliswaar nog in ontwikkeling, maar nu al te gebruiken. We horen dan ook graag wat je ervan vindt. Bijvoorbeeld: zijn de zoekmogelijkheden toereikend? Is de API bruikbaar?</p>
				<p>Als je een stap verder wilt gaan, dan kun je het Register in je collectiebeheersysteem implementeren zodat collectiebeheerders ermee aan de slag kunnen. Wij ondersteunen je hier graag bij.</p>

				<h3 class="display-5">Ik heb een vraag. Met wie kan ik contact opnemen?</h3>
				<p>Met <a href="mailto:bob.coret@netwerkdigitaalerfgoed.nl">Bob Coret</a>, projectleider bij het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a>.</p>
				<p>Ga je aan de slag met het publiceren van datasetbeschrijvingen en de API op het Register, laat het weten, zodat we je op de hoogte kunnen houden van ontwikkelingen, updates en beschikbaarheid.</p>
							
				<p><br></p>
				
				<h2 id="ontwikkelaars" class="display-5">Voor ontwikkelaars van erfgoedsoftware </h2>

				<h3 class="display-5">Waarom zijn machine-leesbare datasetbeschrijvingen belangrijk?</h3>
				<p>Om machines de datasetbeschrijvingen te laten begrijpen is het van belang dat deze niet alleen leesbaar is voor de mens, maar ook voor de machine. Standaarden als <a href="https://schema.org/Dataset">schema.org/Dataset</a> helpen om de semantiek van de datasetbeschrijvingen vast te leggen. Als er rijke informatie worden geboden verbeterd de vindbaarheid.</p>

				<h3 class="display-5">Welke informatie bevat een datasetbeschrijving?</h3>
				<p>De informatie die verplicht en aanbevolen is - op basis van <a href="https://schema.org/Dataset">schema.org/Dataset</a> - staat beschreven in een <a href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/">requirements document</a>.</p>
				<p>Onderstaande afbeelding geeft de gelaagdheid aan van datasetbeschrijvingen:</p>
				<p><img src="static/datacatalog-dataset-distribution.svg" style="max-width:100%;margin:0 32px"></p>

				<h3 class="display-5">Op welke wijze dienen datasetbeschrijvingen gepubliceerd te worden?</h3>
				<p>Inhoudelijk dient de dataset beschrijving te voldoen aan een standaard als  <a href="https://schema.org/Dataset">schema.org/Dataset</a> (en later DCAT). Qua weergave, ook wel serialisatie genoemd, zijn er verschillende mogelijkheden:</p>
				<ul>
				<li>opgenomen in een HTML als <a href="https://schema.org/docs/gs.html">microdata</a> of <a href="https://www.w3.org/TR/xhtml-rdfa-primer/">RDFa</a>;</li>
				<li>als &lt;script type="application/ld+json"&gt; blok met <a href="https://json-ld.org/">JSON-LD</a> een HTML pagina (aan serverkant ingevoegd of via Javascript aan client-zijnde geïnjecteerd);</li>
				<li>als los RDF resource.</li>
				</ul>
				
				<p>De meeste (geautomatiseerde) gebruiker verwachten de datasetbeschrijving "ge-embed" in de HTML painga. Spiders van zoekmachines zoals Google volgen gelinkte JSON-LD bestanden <b>niet</b>. Ook, via Javascript geïnjecteerde JSON-LD wordt door de meeste spiders niet opgemerkt. Er zijn meer serialisaties van RDF, zoals RDF/XML en Turtle. Spiders van zoekmachines als Google ondersteunen alleen microdata, RDFa en JSON-LD (deze laatste vorm wordt door Google geadviseerd). Omdat vindbaarheid een belangrijk aspect is wordt het gebruik van inline JSON-LD geadviseerd. Echter, dit laat onverlet dat dataset beschrijvingen <b>ook</b> in andere serialisatieformaten of via een aparte resource (op basis van content negotiation) worden gepubliceerd.</p>
				<p>In de toekomst gaat het Register ook datacatalogs ondersteunen. Deze set van datasets geeft in één keer informatie over alle beschikbare datasets van een organisatie.</p>
				
				<h3 class="display-5">Welke functies biedt het Register?</h3>
				<p>Het Register biedt, naast een "Admin console" voor de beheerders van het Register, een tweetal toegangen: een REST API en een SPARL endpoint.</p>
				
				<h3 class="display-5">Hoe kan een dataset aangemeld worden bij het Register?</h3>
				<p>Via de REST API kan een URL worden aangemeld van een pagina waar een datasetbeschrijving wordt gepubliceerd, een directe URL van een RDF bestand met datasetbeschrijving of een URL van een datacatalog.<p>
				<p>Via de <a href="aanmelden.php">demonstrator</a> kun via de browser een URL aangemeld worden, deze demonstrator maakt gebruik van de REST API.</p>

				<h3 class="display-5"><a id="allowed_domain_names"></a>Kan iedereen een datasetbeschrijving toevoegen aan het register?</h3>
				<p>Het aanmelden van datasets via de REST API werkt op basis van een <a href="https://triplestore.netwerkdigitaalerfgoed.nl/resource?uri=https:%2F%2Fdata.netwerkdigitaalerfgoed.nl%2Fregistry%2Fallowed_domain_names&role=context" target="_blank">lijst van toegestane domeinen</a>. Datasetbechrijvingen (en datacatalogi) die afkomstig zijn van domeinen op deze lijst worden toegevoegd.</p>
				<p>Ontbreekt er een domeinnaam van een erfgoedinstelling of leverancier, <a href="#contact">meld dit dan</a>.</p> 
				
				<h3 class="display-5">Hoe kan een datasetbeschrijving gecontroleerd worden?</h3>
				<p>Via de REST API kan de datasetbeschrijving van een datasetbeschrijving worden gecontroleerd.<p>
				<p>Je kunt de datasetbeschrijving controleren met behulp van Google's <a href="https://search.google.com/structured-data/testing-tool/u/0/?hl=nl">Tool voor gestructureerde gegevenstests</a>. Geef hier de URL op van de (online) pagina waarin de datasetbeschrijving is opgenomen of plak een codefragments om de test uit te voeren.</p>
				
				<h3 class="display-5">Hoe werkt het Register, technisch?</h3>
				<p>Het Register beoogt een verwijzer naar datasets te worden. Hiertoe crawlt het Register de URL's van aangemelde pagina's met datasetbeschrijvingen.</p>
				<p>De datasetbeschrijvingen worden gevalideerd - in eerste instantie <a href="https://schema.org/Dataset">schema.org/Dataset</a> - en na conversie opgeslagen in een triplestore.</p>
				<p>Onderstaand ontwerp toont de <i>high-level</i> componenten:</p>
				
				<p><img src="static/design.png" style="max-width:100%;margin:0 32px"></p>
	
				<h3 class="display-5">Hoe kan ik het Register uitproberen?</h3>
				<p>Via de <a href=".">demonstrator</a> kun je datasetbeschrijvingen aanmelden en doorzoeken.</p>
				
				<h3 class="display-5">Hoe kan ik de API van het Register aanspreken?</h3>
				<p>De URL van de Register API is https://demo.netwerkdigitaalerfgoed.nl/register-api/</p>
				<p>In de <a href="https://github.com/netwerk-digitaal-erfgoed/registry-poc/blob/master/api-4.md">beschrijving van de API</a> vind je informatie over de endpoints.</p>
				
				<h3 class="display-5">Hoe kan ik vanuit mijn collectiebeheersysteem gebruikmaken van het Register?</h3>
				<p>Het gebruik van de API staat open voor alle erfgoedinstellingen en hun leveranciers.</p>
				
				<h3 class="display-5">Wie maakt en beheert het Register?</h3>
				<p>Het Register wordt gemaakt en beheerd door de samenwerkende erfgoedinstellingen in het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a>. De instellingen staan in voor de werking en beschikbaarheid van het Register.</p>
				
				<h3 class="display-5">Wat is de status van het Register?</h3>
				<p>Het Register is in ontwikkeling. Het ontwerp van het Register, waaronder de requirements voor datasetbeschrijvingen alsmede de beschrijving van de API hebben, zijn gerealiseerd in een prototype en demonstrator. De huidige versie is geschikt om breed gebruikt te worden door instellingen en in collectiebeheersystemen.</p>
				
				<h3 class="display-5">Kan ik het Register nu al gebruiken?</h3>
				<p>Jazeker! Het Register is weliswaar nog in ontwikkeling, maar nu al te gebruiken. We horen dan ook graag wat je ervan vindt. Bijvoorbeeld: zijn de zoekmogelijkheden toereikend? Is de API bruikbaar?</p>
				<p>Als je een stap verder wilt gaan, dan kun je het Register in je collectiebeheersysteem implementeren zodat collectiebeheerders ermee aan de slag kunnen. Wij ondersteunen je hier graag bij.</p>

				<h3 class="display-5" id="contact">Ik heb een vraag. Met wie kan ik contact opnemen?</h3>
				<p>Met <a href="mailto:bob.coret@netwerkdigitaalerfgoed.nl">Bob Coret</a>, projectleider bij het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a>.</p>
				<p>Ga je aan de slag met het publiceren van datasetbeschrijvingen en de API op het Register, laat het weten, zodat we je op de hoogte kunnen houden van ontwikkelingen, updates en beschikbaarheid.</p>
				
			</div>
		</div>

        <footer class="text-muted border-top">
            <div class="container">
                <p>Een initiatief van het <a href="https://www.netwerkdigitaalerfgoed.nl/">Netwerk Digitaal Erfgoed</a></p>
            </div>
        </footer>

    </body>
</html>