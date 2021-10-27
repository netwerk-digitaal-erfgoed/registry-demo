<?php 
	include("includes/search2.php");
	include("includes/header.php");
?>

<link rel="stylesheet" href="/assets/search2.20211028.css" type="text/css" media="all">
 
<main>
	<section class="m-t-quarter-space">
		<div class="o-container o-container__medium p-t-space p-b-space c-hero">
			
			<h1 class="title--l">Doorzoek alle datasetbeschrijvingen</h1>
	 
			<div class="m-theme-bg m-theme--teal search-div">
				<div class="row">
					<div class="column">
						<h4>Zoekwoord</h4>
						<input class="form-control" value="" type="search" id="searchTerm">
					</div>
					<div class="column2">
					
					<span class="btn btn--arrow m-t-half-space btn--api" onclick="searchDatasets()">
						Zoek datasets
						<svg class="rect">
						   <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 586; stroke-dashoffset: 586;"></rect>
						</svg>
						<svg class="icon icon-arrow-right">
						   <use xlink:href="#icon-arrow-right"></use>
						</svg>
					 </span>

						<span style="float:right" class="btn btn--arrow m-t-half-space btn--api" onclick="searchTriplestore()">
							Zoeken in triplestore
							<svg class="rect">
							   <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 586; stroke-dashoffset: 586;"></rect>
							</svg>
							<svg class="icon icon-arrow-right">
							   <use xlink:href="#icon-arrow-right"></use>
							</svg>
						 </span>
	
					</div>
				</div>
				<p><br></p>

				<div class="row "> 
					<div class="column">

						<h4>Doorzoek</h4>
						<p><label><input class="choice" type="checkbox" checked name="searchIn[]" value="dct:title"> Naam</label>&nbsp;&nbsp;&nbsp;
						<label><input class="choice" type="checkbox" name="searchIn[]" value="dct:description"> Omschrijving</label>&nbsp;&nbsp;&nbsp;
						<label><input class="choice" type="checkbox" name="searchIn[]" value="dcat:keyword"> Steekwoorden</label></p>
						
						<br>
						
						<h4>Uitgever</h4>
						<select class="form-control" id="publisher_list" name="publisher">
							<option value="">Alle organisaties</option>
							<?php
									$publishers=getPublishers();
									foreach ($publishers as $publisher_uri => $publisher_name) {
										echo '<option value="'.htmlentities($publisher_uri).'">'.str_replace(" ","&nbsp;",htmlentities($publisher_name))."</option>";
									}
							?>
						</select>
						<br>- of -<br>
						<h4>Maker</h4>
						<select class="form-control" id="creator_list"  name="creator">
							<option value="">Alle organisaties</option>
							<?php
								$creators=getCreators();
								foreach ($creators as $creator_uri => $creator_name) {
									echo '<option value="'.htmlentities($creator_uri).'">'.str_replace(" ","&nbsp;",htmlentities($creator_name))."</option>";
								}
							?>
						</select>
					</div>
					<div class="column2">

						<h4>Formaat</h4>
						<div class="formatcheckboxes">
							<?php
								$formats=getFormats();
								foreach ($formats as $format_name) {
									echo '<label>';
									echo '<input class="choice" type="checkbox" name="format[]" value="'.htmlentities($format_name).'">';
									echo '&nbsp;&nbsp;'.htmlentities($format_name);
									echo '</label><br>';
								}
							?>
						</div>
						<p class="choices"><a href="#" onclick="return set_lod_choices()">Selecteer Linked Data formaten</a> | <a href="#" onclick="return clear_formats()">Verwijder selectie(s)</a></p>
					</div>
				</div>
			</div>

			<div id="searchresults" style="display:none">
				<p><br><p>
				<h2>Zoekresultaten (<span id="countdatasets">0</span>)</h2>
				<ol id="datasets"></ol>
			</div>

		</div>
	</section>
</main>

<script type="text/javascript" src="/assets/search2.20211028.js"></script>
<?php 
	include("includes/footer.php") 
?>