<?php include("includes/header.php") ?>
<main>
	<section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
         <h1><?= t('Veelgestelde vragen voor erfgoedorganisaties') ?></h1>
         <p><br></p>
         <h2><?= t('Wat is een dataset?') ?></h2>
         <p><?= t('Een dataset is een verzameling gestructureerde beschrijvingen van erfgoeditems. Dat kunnen fysieke objecten zijn, zoals schilderijen of archiefstukken, maar ook personen, gebeurtenissen, plaatsen of digitale objecten zoals foto’s en audiovisueel materiaal.') ?></p>
         <p><?= t('Een dataset bevat metadata, dit is de informatie over de erfgoeditems. Daarin staat bijvoorbeeld wie de maker is, uit welk jaar een object komt en wat het onderwerp is. Vaak staat er ook een verwijzing naar de plek waar het object digitaal te bekijken of fysiek te vinden is. Deze metadata wordt meestal vastgelegd in een collectie-informatiesysteem. Sommige erfgoedorganisaties beheren hun metadata echter op een andere manier, bijvoorbeeld in een Excelbestand of een eigen database. Door deze informatie als dataset te publiceren, maakt de organisatie deze voor iedereen beschikbaar.') ?></p>
         <h2><?= t('Wat is een datasetbeschrijving?') ?></h2>
         <p><?= t('Een datasetbeschrijving beschrijft de dataset als geheel. Er staat bijvoorbeeld in wat de titel is, welke informatie de dataset bevat en welke erfgoedorganisatie deze beheert. Ook bevat de beschrijving een verwijzing naar de plek waar de dataset beschikbaar is, meestal via een link.') ?></p>
         <h2><?= t('Welke informatie staat er in een datasetbeschrijving?') ?></h2>
         <p><?= t('Een datasetbeschrijving bevat informatie over inhoud, herkomst, beschikbaarheid en gebruik van een dataset. Denk aan gegevens zoals titel, beschrijving, licentie, erfgoedorganisatie van wie de dataset is en de URL van de dataset.') ?></p>
         <h2><?= t('Hoeveel datasetbeschrijvingen mag ik in het datasetregister zetten?') ?></h2>
         <p><?= t('Er is geen maximum. Je bepaalt als erfgoedorganisatie bepaalt zelf hoeveel datasetbeschrijvingen je publiceert. Je kunt bijvoorbeeld één datasetbeschrijving publiceren voor een volledige collectie, of meerdere datasetbeschrijvingen voor afzonderlijke deelcollecties of typen erfgoed.') ?></p>
         <h2><?= t('Waar staat mijn dataset?') ?></h2>
         <p><?= t('De dataset staat bij de organisatie die de data beheert, bijvoorbeeld in het collectie-informatiesysteem. De.datasetbeschrijving verwijst naar deze locatie via een URL. Je.dataset zelf staat dus niet in het Datasetregister.') ?></p>
         <h2><?= t('Hoe maak ik een datasetbeschrijving?') ?></h2>
         <p><?= t('Je maakt een datasetbeschrijving via je collectie-informatiesysteem of via een online formulier. Lees meer op de pagina Datasetbeschrijving maken.') ?></p>
         <h2><?= t('Mijn erfgoedorganisatie heeft alleen een fysieke collectie. Kan ik hier een datasetbeschrijving van maken?') ?></h2>
         <p><?= t('Ja. Een datasetbeschrijving kan gaan over fysieke collecties, zoals schilderijen, papieren archieven of museumobjecten, maar ook over digitale bronnen, zoals podcasts, video-interviews of gescande documenten.') ?></p>
         <h2><?= t('Welke licentie moet ik gebruiken?') ?></h2>
         <p><?= t('In het Netwerk Digitaal Erfgoed is een open licentie het uitgangspunt. De licentie geldt voor de metadata van de dataset, niet voor de individuele collectieobjecten binnen de dataset. De voorkeur gaat uit naar CC0. Kies alleen een andere licentie als juridische of privacyredenen dat nodig maken. Ook al is je metadata onder voorwaarden toegankelijk, publiceer dan toch een datasetbeschrijving. Zo is voor iedereen zichtbaar dat de dataset bestaat en onder welke voorwaarden deze toegankelijk is.') ?></p>
         <h2><?= t('Hoe kan ik een datasetbeschrijving publiceren als mijn collectie-informatiesysteem of website dit niet ondersteunt?') ?></h2>
         <p><?= t('Ja, neem contact op via de <a href="contact.php">contactpagina</a>.') ?></p>
         <h2><?= t('Hoe meld ik een datasetbeschrijving aan?') ?></h2>
         <p><?= t('Veel NDE-compatibele collectie-informatiesystemen kunnen datasetbeschrijvingen voor je aanmelden. Kan jouw systeem dit nog niet? Neem contact op met je leverancier. Heb je nog geen NDE-compatibel systeem? Dan meld je de registratie-URL handmatig aan via het <a href="viaurl.php">online aanmeldformulier</a>.') ?></p>
         <h2><?= t('Hoe snel na aanmelding verschijnt mijn datasetbeschrijving in het Datasetregister?') ?></h2>
         <p><?= t('Na een succesvolle aanmelding wordt een datasetbeschrijving binnen 24 uur opgenomen in het Datasetregister.') ?></p>
         <h2><?= t('De datasetbeschrijving die ik heb aangemeld verschijnt niet in het Datasetregister. Wat moet ik doen?') ?></h2>
         <p><?= t('Controleer eerst of alle verplichte velden zijn ingevuld en of de URL van de datasetbeschrijving goed bereikbaar is en geen foutmelding geeft. Je kunt daarna de URL van de datasetbeschrijving invoeren op de <a href="validate">controlepagina</a> om te zien of er problemen zijn met de datasetbeschrijving. Kom je er niet uit? Een <a href="https://netwerkdigitaalerfgoed.nl/datawerkplaatsen/">datawerkplaats</a> kijkt mee en helpt om de fout te vinden en op te lossen.') ?></p>
         <h2><?= t('Hoe wijzig ik mijn datasetbeschrijving?') ?></h2>
         <p><?= t('Wijzigingen voer je door in je eigen systeem. Het Datasetregister leest de beschrijving daarna automatisch in en verwerkt de wijziging binnen 24 uur. Apart doorgeven is niet nodig.') ?></p>
         <h2><?= t('Hoe verwijder ik een datasetbeschrijving?') ?></h2>
         <p><?= t('Verwijder de datasetbeschrijving op de plek waar deze is gepubliceerd, bijvoorbeeld in je collectie-informatiesysteem. Het Datasetregister kan de beschrijving dan niet meer inlezen en markeert deze automatisch als gearchiveerd. De beschrijving blijft wel nog zichtbaar in het archief van het Datasetregister. Voor permanente verwijdering: neem contact op via de <a href="contact.php">contactpagina</a>.') ?></p>
         <h2><?= t('Wanneer is mijn datasetbeschrijving voor het laatst ingelezen door het Datasetregister?') ?></h2>
         <p><?= t('Onder het kopje Registratie in de datasetbeschrijving staat het veld Laatst gelezen. Die datum laat zien wanneer het Datasetregister de URL van je datasetbeschrijving voor het laatst automatisch heeft ingelezen.') ?></p>
         <h2><?= t('Mijn erfgoedorganisatie heeft nog geen linked open data. Mag mijn datasetbeschrijving wel in het Datasetregister?') ?></h2>
         <p><?= t('Ja. Het aanbieden van data als linked open data is geen voorwaarde voor opname in het Datasetregister. Een dataset kan op verschillende manieren beschikbaar worden gesteld. Dat kan bijvoorbeeld ook een API zijn of een downloadbestand zoals CSV.') ?></p>\
      </div>
   </section>
</main>
<?php include("includes/footer.php") ?>