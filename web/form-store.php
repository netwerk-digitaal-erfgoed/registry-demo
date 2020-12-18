<?php

/* JSON-LD opslaan (alleen als valide JSON) */

$datasetdescriptionstring=$_POST["datasetdescription"];

$datasetdescription=json_decode($datasetdescriptionstring,true);
if($datasetdescription!==NULL) {	
	$guid=GUID();
	$file="/datasetdescriptions/".$guid.".json";
	file_put_contents($file,$datasetdescriptionstring);

	$datacatalogfile="/datasetdescriptions/index.json";
	$datacatalog=json_decode(file_get_contents($datacatalogfile),true);
	array_push($datacatalog,array("guid"=>$guid,"identifier"=>$datasetdescription["identifier"],"name"=>$datasetdescription["name"]));
	file_put_contents($datacatalogfile,json_encode($datacatalog));

	error_log("json, data stored as $guid.json");
	header("Location: .");
	
} else {
	error_log("invalid json, data not stored");
	header("Location: form.php");
}
exit;


function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}