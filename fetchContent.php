<?php
include("HtmlProcessor.php");
$url = $_REQUEST["url"];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'http://www.cornell.edu');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);

$html = new HtmlProcessor($output);
$html->process();
echo $html->getOutput();
?>