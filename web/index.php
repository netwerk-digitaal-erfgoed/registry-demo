<?php include("includes/header.php") ?>
<main>
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
         <h1 class="title--l">Datasetregister</h1>
		 <h2 class="title--m am-text-align--right">Voor alle erfgoeddatasets!</h2>
         <p><br></p>
		 <p><span class="initial"><svg class="rect"><rect class="svgInitial" width="100%" height="100%" style="stroke-width: 6; fill: transparent; stroke-dasharray: 360; stroke-dashoffset: 370;"></rect> </svg><span> H </span></span>et datasetregister geeft inzicht in de beschikbaarheid van datasets in het erfgoedveld en stimuleert daarmee het gebruik van deze datasets.</p>
      </div>
   </section>
   
	<section id="" class="m-flex c-module c-module--doorway p-t-space p-b-space m-theme-bg m-theme--teal" style="padding:0 20px">
		<div class="o-container o-container__medium">
			<div class="c-grid__row item-in-view p-b-half-space inview">
				<div class="all-1_2 tablet-portrait-1_2 phablet-1_1">
					<div style="color:#be2c00">Voor erfgoedinstellingen met datasets:</div>
					<a href="/viaurl.php"><span class="btn btn--arrow m-t-half-space btn--api"> Voeg een datasetbeschrijving toe <svg class="rect"> <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 0; stroke-dashoffset: 0;"></rect> </svg> <svg class="icon icon-arrow-right"> <use xlink:href="#icon-arrow-right"></use> </svg> </span></a>
				</div>
				<div class="all-1_2 tablet-portrait-1_2 phablet-1_1">
					<div style="color:#be2c00">Voor gebruikers van erfgoeddata:</div>
					<a href="/search.php"><span class="btn btn--arrow m-t-half-space btn--api"> Doorzoek <span id="datasetcount">alle</span> datasetbeschrijvingen <svg class="rect"> <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 0; stroke-dashoffset: 0;"></rect> </svg> <svg class="icon icon-arrow-right"> <use xlink:href="#icon-arrow-right"></use> </svg> </span></a>
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
                     <h3>Ben je actief met datasets bij een erfgoedinstelling?</h3>
                     <ul class="list--quicklinks">
                        <li><a href="/form.php">Maak een datasetbeschrijving</a></li>
                        <li><a href="/viaurl.php">Voeg een datasetbeschrijving toe</a></li>
						<li><a href="/faq-beheerders.php">Veelgestelde vragen door dataset beheerders</a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="all-1_3 phablet-1_1 item-in-view inview">
               <div class="c-grid__col m-text-align--center">
                  <div class="text m-t-half-space">
                     <h3>Ben je op zoek naar erfgoeddatasets?</h3>
                     <ul class="list--quicklinks">
                        <li><a target="datastory" href="https://demo.netwerkdigitaalerfgoed.nl/stories/hackalod/datasetregister/">Leer via de Data story hoe te zoeken</a></li>
                        <li><a target="triplestore" href="/search.php">Doorzoek alle datasetbeschrijvingen</a></li>
                        <li><a href="/faq-gebruikers.php">Veelgestelde vragen door dataset gebruikers</a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="all-1_3 phablet-1_1 item-in-view inview">
               <div class="c-grid__col m-text-align--center">
                  <div class="text m-t-half-space">
                     <h3>Ontwikkel je software voor erfgoedinstellingen?</h3>
                     <ul class="list--quicklinks">
                        <li><a target="triplestore" href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/">Eisen gesteld aan datasetbeschrijvingen</a></li>
                        <li><a href="/validate.php">Valideer een datasetbeschrijving</a></li>
                        <li><a target="datastory" href="https://register-demo.coret.org/apidoc.php">Documentatie van de API</a></li>
                        <li><a href="/faq-ontwikkelaars.php">Veelgestelde vragen door ontwikkelaars</a></li>
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
	var url = "https://triplestore.netwerkdigitaalerfgoed.nl/repositories/registry?query=SELECT%20(COUNT(%20DISTINCT%20%3Fdataset)%20as%20%3FpCount)%20WHERE%20%7B%20%3Fdataset%20a%20%3Chttp%3A%2F%2Fwww.w3.org%2Fns%2Fdcat%23Dataset%3E%20%7D";

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
	//console.log(response);
	try {
		results = JSON.parse(response);
		document.getElementById("datasetcount").innerHTML="<b>"+results.results.bindings[0].pCount.value+"</b>";
	} catch (err) {
		console.log(err);
	}
}

</script>

<?php include("includes/footer.php") ?>