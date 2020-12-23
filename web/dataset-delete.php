<?php

if (isset($_GET["guid"]) && preg_match('/^[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/', $_GET["guid"])) {
	$guid=$_GET["guid"];
	$datasetdescriptionfile="../datasetdescriptions/".$guid.".json";
	if (file_exists($datasetdescriptionfile)) {
		error_log("INFO: deleting $datasetdescriptionfile");
		unlink($datasetdescriptionfile);
		
		$datacatalogfile="../datasetdescriptions/index.json";
		$datacatalog=json_decode(file_get_contents($datacatalogfile),true);
		$newdatacatalog=array();
		error_log("INFO: removing $guid from $datacatalogfile");
		foreach($datacatalog as $dataset) {
			if ($dataset["guid"]!=$guid) {
				array_push($newdatacatalog,$dataset);
			}
		}
		file_put_contents($datacatalogfile,json_encode($newdatacatalog));
	} else {
		error_log("ERROR: $datasetdescriptionfile doesn't exist");
	}		
} else {
	error_log("ERROR: invalid or missing guid");
}
header("Location: list.php");
exit;