<?php
include("HtmlProcessor.php");
$url = $_REQUEST["url"];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);

if ($output == false) {
    echo json_encode(array('success' => false, 'error' => 'Failed to fetch url ' . $url));
    return;
}

$html = new HtmlProcessor($output);
$html->process();
$tags = $html->getTags();
$result = '<table><tr>';
$i=0;
foreach ($tags as $tag => $count) {
    $result .= "<td class=\"highlight\">$tag</td><td>$count</td>";
    $i++;
    if ($i == 6) {
        $result .= "</tr><tr>";
        $i = 0;
    }
}
$result .= '</tr></table>';

$result .= $html->getOutput();
echo $result;
?>