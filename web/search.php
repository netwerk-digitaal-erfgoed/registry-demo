<?php include("includes/search.php"); include("includes/header.php"); 

if (isset($_GET["o"]) && filter_var($_GET["o"], FILTER_VALIDATE_URL)) {
	$o=$_GET["o"];
}

?>
<link rel="stylesheet" href="/assets/search.20211105.css" type="text/css" media="all">
<main>
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
         <h1 class="title--l">Doorzoek alle datasetbeschrijvingen</h1>
         <p>Door erfgoedinstellingen aangemelde datasetbeschrijvingen worden opgeslagen in een openbare <a target="triplestore" href="https://triplestore.netwerkdigitaalerfgoed.nl/">triplestore</a> op basis van het DCAT <a href="datamodel.php">datamodel</a>. Via de <a target="datastory" href="https://demo.netwerkdigitaalerfgoed.nl/stories/hackalod/datasetregister/">Data Stories</a> leer je hoe te zoeken middels SPARQL. Deze pagina toont een zoekinterface op het datasetregister. Ook is dit een hulpmiddel voor het maken van SPARQL queries om de datasetbeschrijvingen te doorzoeken.</p>
      </div>
   </section>
   <section id="" class="m-t-quarter-space m-theme-bg m-theme--teal search-div">
      <div class="o-container no-container__small">
         <div class="row">
            <div class="column">
               <label id="searchTermLabel">Zoekwoord</label>
               <input aria-labelledby="searchTermLabel" class="form-control" value="" type="search" id="searchTerm" onkeyup="updateSparql()">
               <br><br>
               <label>Doorzoek</label>
               <p><label class="doorzoek"><input class="choice" type="checkbox" checked name="searchIn[]" id="dct_title" value="dct:title"> Naam</label>
                  <label class="doorzoek"><input class="choice" type="checkbox" name="searchIn[]" id="dct_description" value="dct:description"> Omschrijving</label>
                  <label class="doorzoek"><input class="choice" type="checkbox" name="searchIn[]" id="dcat_keyword" value="dcat:keyword"> Steekwoorden</label>
              </p>
               <br>
               <label id="publisher_listLabel">Uitgever</label>
               <select aria-labelledby="publisher_listLabel" class="form-control" id="publisher_list" name="publisher">
                  <option value="">Alle organisaties</option>
                  <?php
                     $publishers=getPublishers();
                     foreach ($publishers as $publisher_uri => $publisher_name) {
                     	echo '<option ';
						if (isset($o) && $publisher_uri==$o) { echo 'selected '; }
                     	echo 'value="'.htmlentities($publisher_uri).'">'.str_replace(" ","&nbsp;",htmlentities($publisher_name))."</option>";
                     }
                     ?>
               </select>
               <br>- of -<br>
               <label id="creator_listLabel">Maker</label>
               <select aria-labelledby="creator_listLabel" class="form-control" id="creator_list"  name="creator">
                  <option value="">Alle organisaties</option>
                  <?php
                     $creators=getCreators();
                     foreach ($creators as $creator_uri => $creator_name) {
                     	echo '<option ';
						if (isset($o) && $creator_uri==$o) { echo 'selected '; }
						echo 'value="'.htmlentities($creator_uri).'">'.str_replace(" ","&nbsp;",htmlentities($creator_name))."</option>";
                     }
                     ?>
               </select>
            </div>
            <div class="column2">
               <label>Formaat</label>
               <div class="formatcheckboxes">
                  <?php
                     $formats=getFormats();
                     foreach ($formats as $format_name) {
                     	echo '<label>';
                     	echo '<input class="choice" type="checkbox" name="format[]" value="'.htmlentities($format_name).'">';
                     	echo '&nbsp;&nbsp;'.htmlentities($format_name);
                     	echo '</label>';
                     }
                     ?>
               </div>
               <p class="choices"><a href="#" onclick="return set_lod_choices()">Selecteer Linked Data formaten</a><span class="mobile-hidden"> | <a href="#" onclick="return clear_formats()">Verwijder selectie(s)</a></span></p>
               <span class="btn btn--arrow m-t-half-space btn--api" style="display:block" onclick="searchDatasets()">
                  Zoek datasets
                  <svg class="rect">
                     <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 586; stroke-dashoffset: 586;"></rect>
                  </svg>
                  <svg class="icon icon-arrow-right">
                     <use xlink:href="#icon-arrow-right"></use>
                  </svg>
               </span>
            </div>
         </div>
      </div>
   </section>
   <section class="text m-t-space m-b-space">
      <div class="o-container o-container__small m-t-space">
	     <p><a style="float:right" onclick="return searchTriplestore()" href="#">Neem onderstaande SPARQL mee naar de triplestore</a></p>
		 <h2 id="sparql">SPARQL</h2>
         <xmp id="sparql-query">
         </xmp>
         <p id="copy-status" style="float:right">Klik de SPARQL om deze te kopieren.</p>
         <div id="searchresults" style="display:none">
            <h2>Zoekresultaten (<span id="countdatasets">0</span>)</h2>
            <ul id="datasets"></ul>
         </div>
      </div>
   </section>
</main>
<script type="text/javascript" src="/assets/search.20220905.js"></script>
<?php include("includes/footer.php") ?>