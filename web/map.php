<?php include("includes/header.php");

$list="orglocs_publishers";
if (isset($_GET["list"])) {
	if ($_GET["list"]=="orglocs_creators") {
		$list="orglocs_creators";
	} elseif ($_GET["list"]=="orglocs_publishers_creators") {
		$list="orglocs_publishers_creators";
	}
}

?>
<!--
sdo:locations per organisation (publisher/creator) from graph https://demo.netwerkdigitaalerfgoed.nl/registry/organization_locations
via some search/openrefine handwork collected in https://docs.google.com/spreadsheets/d/1HOC2ij_YKPpXc7WrkyNlOFeAiJweWIlimYky7-dhy6g/edit?gid=0#gid=0
-->

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<style>
#map {
  height: 800px;
}
.tooltip-content {
  max-width: 250px;
  font-size:1.6em;
  overflow: clip;
}
.tooltip-close {
  float:right;
  margin: 2px;
  width:2em;
  padding: 2px 6px;
  background: #ccc;
  border-radius: 4px;
  text-align: center;
  cursor: pointer;
}
.placename {
  font-size:1.2em;
  font-weight:700;
  margin-right:40px;
}
#listSelect {
	display:inline;
	width:unset;
	font-size:0.8em;
	font-weight:500;
}
</style>


<main>
	<section class="text m-t-space m-b-space">
		<div class="o-container o-container__small m-t-space">
			<h1 class="title--l">Op de kaart: <select id="listSelect" name="list"><option <?= $list=="orglocs_publishers"?'selected':'' ?> value="orglocs_publishers">Uitgevers van datasets</option><option <?= ($list=="orglocs_creators")?'selected':'' ?> value="orglocs_creators">Makers van datasets</option><option <?= $list=="orglocs_publishers_creators"?'selected':'' ?> value="orglocs_publishers_creators">Uitgevers en makers van datasets</option></select></h1>
		</div>
	</section>
</main>
<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>

document.getElementById("listSelect").addEventListener("change", function () {
	const selectedValue = this.value;
	const url = new URL(window.location.href);
	url.searchParams.set("list", selectedValue);
	window.location.href = url.toString();
});

let openTooltipMarker = null; // track marker with open tooltip

// Fetch external dataset
fetch('get-list.php?list=<?= $list ?>')
	.then(response => response.json())
	.then(data => {
	// Group data by lat/lng
	const grouped = {};
	data.forEach(d => {
	  const lat = parseFloat(d.latitude);
	  const lng = parseFloat(d.longitude);
	  if (isNaN(lat) || isNaN(lng)) return; // skip invalid coords
	  const key = lat + "," + lng;

	  if (!grouped[key]) {
		grouped[key] = { 
		  lat: lat, 
		  lng: lng, 
		  place: d.organisation_placename, 
		  geonames: d.geonames, 
		  orgs: [] 
		};
	  }

	  // check if organisation already exists
	  const existing = grouped[key].orgs.find(o => o.name === d.organisation_name);
	  
	  if (existing) {
		// append new URI if it's not already included
		if (!existing.uri.split("|").includes(d.organisation_uri)) {
		  existing.uri += "|" + d.organisation_uri;
		}
	  } else {
		// add new organisation
		grouped[key].orgs.push({
		  name: d.organisation_name,
		  uri: d.organisation_uri
		});
	  }
	});

	// Initialize map
	const map = L.map('map').setView([52, 5], 8);

	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	  maxZoom: 19,
	  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);

	// Add markers with size depending on count
	Object.values(grouped).forEach(g => {
	  const count = g.orgs.length;
	  const radius = 8 + count * 3; // scale marker size

	  const marker = L.circleMarker([g.lat, g.lng], {
		radius: radius,
		fillColor: "#bf2c00",
		color: "#fff",
		weight: 1,
		opacity: 1,
		fillOpacity: 0.6
	  }).addTo(map);

	  // Create HTML for tooltip
	  var orgLinks = '';
	  g.orgs.forEach(o => {
<?php
	if ($list=="orglocs_publishers" || $list=="orglocs_creators") { 	
		echo "search=btoa('{\"";
		if ($list=="orglocs_publishers") {
			echo "p";
		} else {
			echo "c";
		}
		echo "\":\"'+o.uri+'\",\"t\":\"\"}');\n";
		echo "orgLinks+='<li><a href=\"search.php#'+search+'\" target=\"_blank\">'+o.name+'</a></li>';\n";
	} else {
		echo "orgLinks+=`<li><a href=\"\${o.uri}\" target=\"_blank\">\${o.name}</a></li>`;\n";
	}
?>
	  });
	  const tooltipContent = `
		<div class="tooltip-content">
		  <div class="tooltip-close">X</div>
		  <b><!--a class="placename" href="${g.geonames}" target="geonames"-->${g.place}<!--/a--></b>
		  <ul>${orgLinks}</ul>
		</div>`;

	  marker.on('click', () => {
		// Close any open tooltip first
		if (openTooltipMarker) {
		  map.closeTooltip(openTooltipMarker.getTooltip());
		  openTooltipMarker = null;
		}

		marker.bindTooltip(tooltipContent, {
		  permanent: true,
		  direction: "top",
		  interactive: true,
		  sticky: false
		}).openTooltip();

		openTooltipMarker = marker;

		// Attach close handler specifically for this marker's tooltip
		setTimeout(() => {
		  const tooltipNode = marker.getTooltip().getElement();
		  const closeBtn = tooltipNode ? tooltipNode.querySelector('.tooltip-close') : null;
		  if (closeBtn) {
			closeBtn.onclick = () => {
			  map.closeTooltip(marker.getTooltip());
			  if (openTooltipMarker === marker) {
				openTooltipMarker = null;
			  }
			};
		  }
		}, 50);
	  });
	});
  });
</script>

<?php include("includes/footer.php") ?>