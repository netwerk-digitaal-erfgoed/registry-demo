<?php include("includes/header.php") ?>
<main>
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
         <h1 class="title--l">Uitleg van de dataconcepten</h1>
         			

		<h2>Datasetbeschrijving</h2>
		<p>Wanneer de datasetbeschrijving bij de bron wordt opgehaald en gevalideerd, dan wordt deze in een eigen graaf opgeslagen op basis van <code>dcat:Dataset</code>. De URL van de graaf correspondeert met de IRI van de dataset.</p>
		<p>Datasetbeschrijvingen die worden geleverd op basis van schema.org - zoals geadviseerd in de <a href="https://netwerk-digitaal-erfgoed.github.io/requirements-datasets/">Requirements for Datasets</a> - worden geconverteerd naar DCAT.</p>

		<p>Onderstaande tabel geeft de eigenschappen weer die in een datasetbeschrijving kunnen voorkomen:</p>
				
		<table class="properties">
		<thead>
		<tr>
		<th>Eigenschap</th>
		<th>Beschrijving</th>
		<th>Gebaseerd op</th>
		</tr>
		</thead>
		<tbody>
		<tr>
		<td><a href="http://purl.org/dc/terms/title" rel="nofollow"><code>dct:title</code></a></td>
		<td>Dataset title.</td>
		<td><a href="https://schema.org/name" rel="nofollow"><code>schema:name</code></a></td>
		</tr>
		<tr>
		<td><a href="http://purl.org/dc/terms/alternative" rel="nofollow"><code>dct:alternative</code></a></td>
		<td>Dataset alternate title.</td>
		<td><a href="https://schema.org/alternateName" rel="nofollow"><code>schema:alternateName</code></a></td>
		</tr>
		<tr>
		<td><a href="http://purl.org/dc/terms/identifier" rel="nofollow"><code>dct:identifier</code></a></td>
		<td>Dataset identifier.</td>
		<td><a href="https://schema.org/identifier" rel="nofollow"><code>schema:identifier</code></a></td>
		</tr>
		<tr>
		<td><a href="http://purl.org/dc/terms/Beschrijving" rel="nofollow"><code>dct:Beschrijving</code></a></td>
		<td>Dataset Beschrijving.</td>
		<td><a href="https://schema.org/Beschrijving" rel="nofollow"><code>schema:Beschrijving</code></a></td>
		</tr>
		<tr>
		<td><a href="http://purl.org/dc/terms/license" rel="nofollow"><code>dct:license</code></a></td>
		<td>Dataset license.</td>
		<td><a href="https://schema.org/license" rel="nofollow"><code>schema:license</code></a></td>
		</tr>
		<tr>
		<td><a href="http://purl.org/dc/terms/language" rel="nofollow"><code>dct:language</code></a></td>
		<td>Language(s) in which the dataset is available.</td>
		<td><a href="https://schema.org/inLanguage" rel="nofollow"><code>schema:inLanguage</code></a></td>
		</tr>
		<tr>
		<td><a href="https://www.w3.org/TR/vocab-dcat-3/#Eigenschap:resource_keyword" rel="nofollow"><code>dcat:keyword</code></a></td>
		<td>Keywords or tags that describe the dataset.</td>
		<td><a href="https://schema.org/keywords" rel="nofollow"><code>schema:keywords</code></a></td>
		</tr>
		<tr>
		<td><a href="https://www.w3.org/TR/vocab-dcat-3/#Eigenschap:resource_landing_page" rel="nofollow"><code>dcat:landingPage</code></a></td>
		<td>Keywords or tags that describe the dataset.</td>
		<td><a href="https://schema.org/mainEntityOfPage" rel="nofollow"><code>schema:mainEntityOfPage</code></a></td>
		</tr>
		<tr>
		<td><a href="http://purl.org/dc/terms/source" rel="nofollow"><code>dct:source</code></a></td>
		<td>URL(s) of datasets the dataset is Gebaseerd op.</td>
		<td><a href="https://schema.org/isBasedOn" rel="nofollow"><code>schema:isBasedOn</code></a></td>
		</tr>
		<tr>
		<td><a href="http://purl.org/dc/terms/created" rel="nofollow"><code>dct:created</code></a></td>
		<td>Dataset creation date.</td>
		<td><a href="https://schema.org/dateCreated" rel="nofollow"><code>schema:dateCreated</code></a></td>
		</tr>
		<tr>
		<td><a href="http://purl.org/dc/terms/issued" rel="nofollow"><code>dct:issued</code></a></td>
		<td>Dataset publication date.</td>
		<td><a href="https://schema.org/datePublished" rel="nofollow"><code>schema:datePublished</code></a></td>
		</tr>
		<tr>
		<td><a href="http://purl.org/dc/terms/modified" rel="nofollow"><code>dct:modified</code></a></td>
		<td>Dataset last modification date.</td>
		<td><a href="https://schema.org/dateModifed" rel="nofollow"><code>schema:dateModified</code></a></td>
		</tr>
		<tr>
		<td><a href="https://www.w3.org/2002/07/owl#versionInfo" rel="nofollow"><code>owl:versionInfo</code></a></td>
		<td>Dataset version</td>
		<td><a href="https://schema.org/version" rel="nofollow"><code>schema:version</code></a></td>
		</tr>
		<tr>
		<td><a href="http://purl.org/dc/terms/creator" rel="nofollow"><code>dct:creator</code></a></td>
		<td>Dataset <a href="#foaforganization">creator</a>.</td>
		<td><a href="https://schema.org/creator" rel="nofollow"><code>schema:creator</code></a></td>
		</tr>
		<tr>
		<td><a href="http://purl.org/dc/terms/publisher" rel="nofollow"><code>dct:publisher</code></a></td>
		<td>Dataset <a href="#foaforganization">publisher</a>.</td>
		<td><a href="https://schema.org/publisher" rel="nofollow"><code>schema:publisher</code></a></td>
		</tr>
		<tr>
		<td><a href="https://www.w3.org/TR/vocab-dcat-3/#Eigenschap:dataset_distribution" rel="nofollow"><code>dcat:distribution</code></a></td>
		<td>Dataset <a href="#dcatdistribution">distributions</a>.</td>
		<td><a href="https://schema.org/distribution" rel="nofollow"><code>schema:distribution</code></a></td>
		</tr>
		</tbody>
		</table>


		<p><br></p><h3 id="foaforganization">Organisaties</h2>

		<p>Elke datasetbeschrijving heeft een <code>dct:publisher</code> en optioneel ook een of meer <code>dct:creator</code>s.</p> Een <code>dct:publisher</code> is de organisatie die de dataset publiceert. Een <code>dct:creator</code> is de organisatie die de dataset (oorsponkelijk) heeft gemaakt.</p>
		
		<p>Organisatie hebben als type <code>foaf:Organization</code> en naast een IRI ook onderstaande eigenschappen:</p>

		<table class="properties">
		<thead>
		<tr>
		<th>Eigenschap</th>
		<th>Beschrijving</th>
		<th>Gebaseerd op</th>
		</tr>
		</thead>
		<tbody>
		<tr>
		<td><a href="http://xmlns.com/foaf/0.1/name" rel="nofollow"><code>foaf:name</code></a></td>
		<td>Organization name.</td>
		<td><a href="https://schema.org/name" rel="nofollow"><code>schema:name</code></a></td>
		</tr>
		</tbody>
		</table>

		<p><br></p><h3 id="dcatdistribution">Distributies</h2>

		<p>Een datasetbeschrijving kan een of meerdere distributies bevatten. Een distributie geeft de wijze aan waarop de dataset kan worden opgehaald (als het om een bestand/datadump gaat) of bevraagd (als het op een API gaat, zoals OAI-PMH, SPARQL, enz.).</p>

		<p>Onderstaande tabel geeft de eigenschappen weer die in een distributie kunnen voorkomen:</p>
						
		<table class="properties">
		<thead>
		<tr>
		<th>Eigenschap</th>
		<th>Beschrijving</th>
		<th>Gebaseerd op</th>
		</tr>
		</thead>
		<tbody>
		<tr>
		<td><a href="https://www.w3.org/TR/vocab-dcat-3/" rel="nofollow"><code>dcat:accessUrl</code></a></td>
		<td>Distribution URL.</td>
		<td><a href="https://schema.org/contentUrl" rel="nofollow"><code>schema:contentUrl</code></a></td>
		</tr>
		<tr>
		<td><a href="https://www.w3.org/TR/vocab-dcat-3/" rel="nofollow"><code>dcat:mediaType</code></a></td>
		<td>Distribution’s IANA media type.</td>
		<td><a href="https://schema.org/fileFormat" rel="nofollow"><code>schema:fileFormat</code></a></td>
		</tr>
		<tr>
		<td><a href="http://purl.org/dc/terms/format" rel="nofollow"><code>dct:format</code></a></td>
		<td>Distribution content type (e.g. <code>text/turtle</code>).</td>
		<td><a href="https://schema.org/encodingFormat" rel="nofollow"><code>schema:encodingFormat</code></a></td>
		</tr>
		<tr>
		<td><a href="http://purl.org/dc/terms/issued" rel="nofollow"><code>dct:issued</code></a></td>
		<td>Distribution publication date.</td>
		<td><a href="https://schema.org/datePublished" rel="nofollow"><code>schema:datePublished</code></a></td>
		</tr>
		<tr>
		<td><a href="http://purl.org/dc/terms/issued" rel="nofollow"><code>dct:modified</code></a></td>
		<td>Distribution last modification date.</td>
		<td><a href="https://schema.org/dateModified" rel="nofollow"><code>schema:dateModified</code></a></td>
		</tr>
		<tr>
		<td><a href="http://purl.org/dc/terms/Beschrijving" rel="nofollow"><code>dct:Beschrijving</code></a></td>
		<td>Distribution Beschrijving.</td>
		<td><a href="https://schema.org/Beschrijving" rel="nofollow"><code>schema:Beschrijving</code></a></td>
		</tr>
		<tr>
		<td><a href="http://purl.org/dc/terms/language" rel="nofollow"><code>dct:language</code></a></td>
		<td>Distribution language.</td>
		<td><a href="https://schema.org/inLanguage" rel="nofollow"><code>schema:inLanguage</code></a></td>
		</tr>
		<tr>
		<td><a href="http://purl.org/dc/terms/license" rel="nofollow"><code>dct:license</code></a></td>
		<td>Distribution license.</td>
		<td><a href="https://schema.org/license" rel="nofollow"><code>schema:license</code></a></td>
		</tr>
		<tr>
		<td><a href="http://purl.org/dc/terms/title" rel="nofollow"><code>dct:title</code></a></td>
		<td>Distribution title.</td>
		<td><a href="https://schema.org/name" rel="nofollow"><code>schema:name</code></a></td>
		</tr>
		<tr>
		<td><a href="https://www.w3.org/TR/vocab-dcat-3/" rel="nofollow"><code>dcat:byteSize</code></a></td>
		<td>Distribution’s download size in bytes.</td>
		<td><a href="https://schema.org/contentSize" rel="nofollow"><code>schema:contentSize</code></a></td>
		</tr>
		</tbody>
		</table>


      </div>
   </section>
</main>
<?php include("includes/footer.php") ?>