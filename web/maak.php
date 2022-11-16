<?php 

include("includes/header.php");

?>
<main>
	<section class="text m-t-space m-b-space m-theme--blue">
		<div class="o-container o-container__small m-t-space">
			<h1 class="title--l"><?= t('Maak een datasetbeschrijving')?></h1>
			<h2 class="title--m"><?= t('Datasetbeschrijvingen uit uw (collectiebeheer)systeem')?></h2>
			<p><?= t('Het beschrijven van een dataset toont grote overeenkomsten met het beschrijven van een erfgoedcollectie. Het is dan ook logisch om ook de datasets in het collectiebeheersysteem te beheren. Dicht bij de bron, want vanuit hier worden veelal ook de datasets (als bestand of als API) beschikbaar gesteld. Online publicatie van de datasetbeschrijvingen is hierdoor vaak een eenvoudige en vooral geautomatiseerde stap. Vraag bij uw leverancier wat de mogelijkheden zijn om datasetbeschrijvingen te maken en te publiceren zodat ook uw datasets beter vindbaar worden.')?></p>
			<p><br></p>
			<h2 class="title--m"><?= t('Maak handmatig een datasetbeschrijving')?></h2>
			<p><?= t('Als uw leverancier (nog) geen mogelijkheden biedt om een datasetbeschrijving te maken, dan kunt u handmatig een datasetbeschrijving maken conform de <a href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/">requirements</a>. Als hulpmiddel is een invulformulier beschikbaar. Deze handmatige werkwijze staat los van een collectiebeheersysteem en is dus verre van ideaal.')?></p>
			<p><?= t('<strong>Let wel</strong>: het resultaat van het formulier is een datasetbeschrijving in JSON-LD, deze moet nog wel online worden gepubliceerd voordat het kan worden aangemeld bij het Datasetregister.')?></p>
			<a href="form.php<?= l() ?>"><span class="btn btn--arrow m-t-half-space"><?= t('Datasetbeschrijving formulier')?> <svg class="rect"> <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 0; stroke-dashoffset: 0;"></rect> </svg> <svg class="icon icon-arrow-right"> <use xlink:href="#icon-arrow-right"></use> </svg> </span></a>
		</div>
	</section>
</main>

<?php 


include("includes/footer.php") ?>