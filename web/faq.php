<?php include("includes/header.php") ?>
<main>
   <section class="text m-t-space m-b-space m-theme--blue">
      <div class="o-container o-container__small m-t-space">
         <h1 class="title--l"><?= t('Veelgestelde vragen over het Datasetregister') ?></h1>
         <p><?= t('De veelgestelde vragen zijn opgedeeld per doelgroep') ?>:</p>
         <ul>
            <li><a href="faq-beheerders.php<?= l() ?>"><?= t('dataset beheerders bij erfgoedinstellingen') ?></a></li>
            <li><a href="faq-gebruikers.php<?= l() ?>"><?= t('dataset gebruikers bij erfgoedinstellingen en aggregators') ?></a></li>
            <li><a href="faq-ontwikkelaars.php<?= l() ?>"><?= t('ontwikkelaars van erfgoed software') ?></a></li>
            <li><a href="faq-developers.php<?= l() ?>"><?= t('ontwikkelaars die erfgoed datasets willen vinden') ?></a></li>
         </ul>
      </div>
   </section>
</main>
<?php include("includes/footer.php") ?>