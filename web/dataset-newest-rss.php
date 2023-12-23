<?php 

include("includes/search.php");
include("includes/language.php");

header('Content-Type: application/rss+xml; charset=utf-8');
echo "<"."?xml version=\"1.0\" encoding='UTF-8'?".">\n";

echo '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">';
echo '<channel>';
echo '<title>'.t('Datasetregister').'</title>';
echo '<link>https://'.$_SERVER['HTTP_HOST'].'/</link>';
echo '<language>';
if(isset($_GET["lang"]) && $_GET["lang"]=="en") { echo "en"; } else { echo "nl"; }
echo '</language>';
echo '<description>'.t('De meest recent toegevoegde datasets aan het NDE Datasetregister').'</description>';
echo '<pubDate>'.date("r").'</pubDate>'."\n";
echo '<image>'."\n";
echo '<url>https://'.$_SERVER['HTTP_HOST'].'/assets/beeldmerk-social-small.jpg</url>'."\n";
echo '<title>'.t('Datasetregister').'</title>'."\n";
echo '<link>https://'.$_SERVER['HTTP_HOST'].'/</link>'."\n";
echo '</image>'."\n";
echo '<atom:link href="https://'.$_SERVER['HTTP_HOST'].'/dataset-newest-rss.php" rel="self" type="application/rss+xml" />'."\n";
		
$newests=getNewest();

foreach($newests as $newest) {
	print '<item>';
	print '<title>'.$newest["title"].' ('.$newest["publisherName"].')</title>';
	$url='https://'.$_SERVER['HTTP_HOST'].'/show.php?';
	if(isset($_GET["lang"]) && $_GET["lang"]=="en") { $url.='lang=en&'; }
	$url.='uri='.urlencode($newest["dataset"]);
	print '<link>'.$url.'</link>';
	print '<guid>'.$url.'</guid>';
	print '<pubDate>'.date('r', strtotime($newest["postedDate"])).'</pubDate>';
	print '</item>';
}

echo '</channel>';
echo '</rss>';