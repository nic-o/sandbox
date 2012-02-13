<?php
// $file: strip-html.php $timestamp: 2011/09/28 @ 21:03
$xmlString = "<root><note><texte>Note <strong>1</strong></texte></note><note><texte>Note <strong>2</strong></texte></note></root>";

// $dom = new DOMDocument;
// $fragment = $dom->createDocumentFragment();
// $fragment->appendXML($xmlString);
// $dom->appendChild($fragment);
// echo $dom->saveXML($dom->documentElement);

$xml = new DOMDocument();
$xml->loadXML($xmlString);
$root = $xml->documentElement;
foreach($root->getElementsByTagName('note') as $note) {
  foreach($note->childNodes as $child) {
    if($child->tagName == 'texte') {
      // echo $child->firstChild->nodeValue . "\n";
      echo DOMinnerHTML($child); 
    }
  }
}
// echo $xml->saveXML($xml->documentElement);

function DOMinnerHTML($element) { 
  $innerHTML = ""; 
  $children = $element->childNodes; 
  foreach ($children as $child) { 
    $tmp_dom = new DOMDocument(); 
    $tmp_dom->appendChild($tmp_dom->importNode($child, true)); 
    $innerHTML .= trim($tmp_dom->saveHTML()); 
  } 
  return $innerHTML; 
}