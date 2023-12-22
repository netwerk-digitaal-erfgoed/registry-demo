<?php

include("includes/search.php");

if (isset($_GET["list"])) {
	if ($_GET["list"]=="publishers") {
		$list=getPublishers();
	} elseif ($_GET["list"]=="creators") {
		$list=getCreators();
	} elseif ($_GET["list"]=="formats") {
		$list=getFormats();
	} else {
		exit;
	}

	# client cache 2 hours
	$now = time();
	$generatedAt = gmdate('D, d M Y H:i:s T', $now);
	$lastModified = gmdate('D, d M Y 00:00:00 T', $now);
	$expiresAt = gmdate('D, d M Y H:i:s T', strtotime($lastModified) + 2*3600); # 2 hours
	header('Last-modified: ' . $lastModified);
	header('Cache-control: max-age=' . strtotime($expiresAt) - strtotime($generatedAt));

	# cors
	$http_origin = $_SERVER['HTTP_ORIGIN'];
	if (strpos($http_origin,"datasetregister) !== false) {
		header("Access-Control-Allow-Origin: $http_origin");
	}

	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($list);
}
