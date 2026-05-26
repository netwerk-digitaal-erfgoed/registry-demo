<?php

if(!isset($_GET["lang"]) && !_bot_detected()) {
   if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) && strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2))!="nl") {
      header('Location: /?lang=en', true, 302);
   }
}

include("includes/header.php") ?>
<main style="padding-top:70px">

	<section class="m-t-quarter-space" style="margin:0 0 30px 0">
		<div class="o-container o-container__medium p-t-space p-b-space c-hero b-homepanel">
			<h1 class="title--l m-text-align--center" style="text-shadow:1px 0px 0px white;"><?= t('Datasetregister') ?></h1>
			<h2 class="title--m m-text-align--center" style="text-shadow:1px 0px 0px white;"><?= t('Vind erfgoeddatasets op één plek') ?></h2>
			<p class=" m-text-align--center" style="text-shadow:1px 0px 0px white;"><?= t('In het Datasetregister zie je welke datasets er zijn en informatie over de inhoud.') ?></p>
		</div>
	</section>

	<section id="" class="m-flex c-module c-module--doorway p-t-space p-b-space">
		<div class="o-container o-container__medium m-theme-bg b-homepanel" style="padding:10px 0 10px 0!important;">
			<div class="c-grid__row item-in-view p-b-half-space inview" style="margin:0;padding:0;text-align:center">
				<div class="all-1_2 tablet-portrait-1_2 phablet-1_1" style="margin:0;padding:0;text-align:center">
					<a href="<?= languagePrefix() ?>/datasets"><span class="btn btn--arrow m-t-half-space btn--api"><?= t('Voor gebruikers van erfgoeddata') ?>:<br>
               <?= t('zoek in <span id="datasetcount">alle</span> datasetbeschrijvingen'); ?> 
               <svg class="rect"> <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 0; stroke-dashoffset: 0;"></rect> </svg> <svg class="icon icon-arrow-right"> <use xlink:href="#icon-arrow-right"></use> </svg> </span></a>
				</div>
				<div class="all-1_2 tablet-portrait-1_2 phablet-1_1">
					<a href="viaurl.php<?= l() ?>"><span class="btn btn--arrow m-t-half-space btn--api"><?= t('Voor erfgoedinstellingen met datasets') ?>:<br><?= t('Meld je dataset aan') ?> <svg class="rect"> <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 0; stroke-dashoffset: 0;"></rect> </svg> <svg class="icon icon-arrow-right"> <use xlink:href="#icon-arrow-right"></use> </svg> </span></a>
				</div>
			</div>
		</div>
	</section>

   <section id="" class="m-flex c-module c-module--icon-row m-t-space m-bg--light p-t-space p-b-space">
      <div class="o-container o-container__medium">
         <div class="c-grid__row item-in-view inview">
            <div class="all-1_3 phablet-1_1 item-in-view inview">
               <div class="c-grid__col m-text-align--center">
                  <div class="text m-t-half-space">
                     <h3><?= t('Zoek je erfgoeddatasets?') ?><br>&nbsp;</h3>
                     <ul class="list--quicklinks">
                        <li><a target="triplestore" href="zoek.php<?= l() ?>"><?= t('Doorzoek alle datasetbeschrijvingen') ?></a></li>
                        <li><a href="datastory.php<?= l() ?>"><?= t('Leer hoe je datasets vindt via Sparql') ?></a></li>
                        <li><a href="faq-gebruikers.php<?= l() ?>"><?= t('Veelgestelde vragen voor gebruikers') ?></a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="all-1_3 phablet-1_1 item-in-view inview">
               <div class="c-grid__col m-text-align--center">
                  <div class="text m-t-half-space">
                     <h3><?= t('Werk je bij een erfgoedorganisatie?') ?></h3>
                     <ul class="list--quicklinks">
                        <li><a href="https://netwerkdigitaalerfgoed.nl/datasetregister/"><?= t('Maak en publiceer je datasetbeschrijving') ?></a></li>
                        <li><a href="viaurl.php<?= l() ?>"><?= t('Meld je dataset aan') ?></a></li>
						<li><a href="faq-beheerders.php<?= l() ?>"><?= t('Veelgestelde vragen voor erfgoedorganisaties') ?></a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="all-1_3 phablet-1_1 item-in-view inview">
               <div class="c-grid__col m-text-align--center">
                  <div class="text m-t-half-space">
                     <h3><?= t('Ontwikkel je software voor erfgoeddata?') ?></h3>
                     <ul class="list--quicklinks">
                        <li><a href="https://docs.nde.nl/requirements-datasets/"><?= t('Technische eisen voor datasetbeschrijvingen') ?></a></li>
                        <li><a href="api/<?= l() ?>"><?= t('Gebruik de API\'s') ?></a></li>
                        <li><a href="https://docs.nde.nl/"><?= t('Verdiep je in alle technische documentatie') ?></a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => get_count());

function get_count() {
	var url = "https://datasetregister.netwerkdigitaalerfgoed.nl/sparql?query=PREFIX%20dcat%3A%20%3Chttp%3A%2F%2Fwww.w3.org%2Fns%2Fdcat%23%3E%0APREFIX%20schema%3A%20%3Chttps%3A%2F%2Fschema.org%2F%3E%0ASELECT%20%28COUNT%28DISTINCT%20%3Fdataset%29%20as%20%3Fcount%29%20WHERE%20%7B%20%3Fdataset%20a%20dcat%3ADataset%20%3B%20schema%3AsubjectOf%20%3FregistrationUrl%20.%20%3FregistrationUrl%20schema%3AadditionalType%20%3Chttps%3A%2F%2Fdata.netwerkdigitaalerfgoed.nl%2Fregistry%2Fvalid%3E%20.%20%7D";

	var xhr = new XMLHttpRequest();
	xhr.open("GET", url);

	xhr.setRequestHeader("Accept", "application/json");

	xhr.onreadystatechange = function () {
	   if (xhr.readyState === 4) {
		  if(xhr.status==200) {
			show_count(xhr.responseText);
		  }
	   }};

	xhr.send();
}

function show_count(response) {
	try {
		results = JSON.parse(response);
		document.getElementById("datasetcount").innerHTML="<b>"+results.results.bindings[0].count.value+"</b>";
	} catch (err) {
		console.log(err);
	}
}
</script>

<?php

include("includes/footer.php");

function _bot_detected() {

   return (
     isset($_SERVER['HTTP_USER_AGENT'])
     && preg_match('/bot|crawl|slurp|spider|mediapartners/i', $_SERVER['HTTP_USER_AGENT'])
   );
 }
