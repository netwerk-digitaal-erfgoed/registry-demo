<?php 

include("includes/search.php"); 
include("includes/header.php"); 

?>

<main>
  <section class="text m-t-space m-b-space m-theme--blue">
    <div class="o-container o-container__small m-t-space">
      <h1 class="title--l"><?= t('Recent aangemelde databeschrijvingen') ?></h1>
	  <p><?= t('Onderstaande lijst toont de').' '.SHOW_NEWEST.' '.t('meest recent aangemelde datasetbeschrijvingen via de <a href="viaurl.php">Meld aan</a> pagina of de <a href="https://datasetregister.netwerkdigitaalerfgoed.nl/api/static/index.html">Dataset Register API</a>.') ?> <?= t('Deze lijst is ook beschikbaar als <a href="dataset-newest-rss.php">RSS feed</a>.') ?></p>
	  <p><br></p>
      <ul id="newest_list"></ul>
    </div>
  </section>
   
   <section class="text m-t-space m-b-space">
     <div class="o-container o-container__small m-t-space">
       <a href="search.php<?= l() ?>"><span class="btn btn--arrow m-t-half-space"><?= t('Doorzoek het Dataset Register') ?> <svg class="rect"> <rect class="svgrect" width="100%" height="100%" style="stroke-width: 3; fill: transparent; stroke-dasharray: 578; stroke-dashoffset: 578;"></rect> </svg> <svg class="icon icon-arrow-right"> <use xlink:href="#icon-arrow-right"></use> </svg> </span></a>
     </div>
   </section>
</main>
<script>

async function fetchData(url) {
  try {
    const response = await fetch(url);
    const jsonData = await response.json();
    return jsonData;
  } catch (error) {
    console.error('Error fetching data:', error);
  }
}

fetchData('get-list.php?list=newest').then(data => {
    const ul = document.getElementById("newest_list");
	ul.innerHTML = "";
  
    for (const key in data) {
      const li = document.createElement('li');
      li.setAttribute("class", "linkprop");
      var link = document.createElement("a");
      var linkText = document.createTextNode(data[key].title);
      link.setAttribute("href", "show.php?<?php if(isset($_GET["lang"]) && $_GET["lang"]=="en") { echo "lang=en&"; } ?>uri="+encodeURIComponent(data[key].dataset));
	  link.setAttribute("title", "<?= t('Aangemeld op') ?> "+data[key].postedDate.substr(8,2)+"-"+data[key].postedDate.substr(5,2)+"-"+data[key].postedDate.substr(0,4)+" ("+data[key].postedDate.substr(11,5)+")");
      link.appendChild(linkText);
      li.appendChild(link);
      li.appendChild(document.createTextNode(" ("+data[key].publisherName+")"));
      ul.appendChild(li);
    }
  });

</script>
<?php include("includes/footer.php") ?>