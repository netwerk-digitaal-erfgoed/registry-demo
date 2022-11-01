<?php include("includes/header.php") ?>
<main>
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
         <h1 class="title--l"><?= t('Datasetregister API specificatie') ?></h1>
         <p class="text-left"><?= t('De Datasetregister API is bedoeld om online pagina\'s met datasetbeschrijving aan te melden en te valideren. De API beschrijving is op basis van een Open API specification beschikbaar via <a href="https://datasetregister.netwerkdigitaalerfgoed.nl/api/static/index.html" target="_blank">Swagger UI</a>.') ?></p>
         <h3><?= t('Voorbeeld aanmelding URL van pagina met datasetbeschrijving via API met Curl') ?></h3>
         <xmp>curl 'https://datasetregister.netwerkdigitaalerfgoed.nl/api/datasets' \
            -H 'link: <http://www.w3.org/ns/ldp#RDFSource>; rel="type",<http://www.w3.org/ns/ldp#Resource>; rel="type"' \
            -H 'content-type: application/ld+json' \
            --data-binary '{"@id":"https://demo.netwerkdigitaalerfgoed.nl/datasets/kb/2.html"}'
         </xmp>
         <p><br/></p>
         <h3><?= t('Voorbeeld validatie datasetbeschrijving via API met Curl') ?></h3>
         <xmp>curl -i -X PUT 'https://datasetregister.netwerkdigitaalerfgoed.nl/api/datasets/validate' \
            -H 'link: <http://www.w3.org/ns/ldp#RDFSource>; rel="type",<http://www.w3.org/ns/ldp#Resource>; rel="type"' \
            -H 'content-type: application/ld+json' \
            --data-binary '{"@id":"https://demo.netwerkdigitaalerfgoed.nl/datasets/kb/2.html"}'
         </xmp>
      </div>
   </section>
</main>
<?php include("includes/footer.php") ?>