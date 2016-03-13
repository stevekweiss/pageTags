<?php
include("HtmlProcessor.php");

$url = $_REQUEST["url"];

// Fetch the web page
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);

// Return an error if the request failed
if ($output == false) {
    echo json_encode(array('success' => false, 'error' => 'Failed to fetch url ' . $url));
    return;
}

$html = new HtmlProcessor($output);
$html->process();
$tags = $html->getTags();

// Display the tags in a table.  I debated whether to keep this in the PHP or have the Javascript do it to
// separate the display from the data.  But I left it here.
$result = '<table class="pure-table"><tr>';
$i=0;
foreach ($tags as $tag => $count) {
    $result .= "<td><span class=\"highlight\">$tag</span> <span class=\"count\">($count)</span> </td>";
    $i++;
    if ($i == 8) {
        $result .= "</tr><tr>";
        $i = 0;
    }
}
while ($i < 8) {
    $result .= "<td/>";
    $i++;
}
$result .= '</tr></table> <p/>';

// Send the table and the modified page contents as the response
$result .= '<div class="output">' . $html->getOutput() . '</div>';
echo json_encode(array('success' => true, 'result' => $result));
?>