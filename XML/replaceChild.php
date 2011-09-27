<?php
$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<anim>
 <frame1>
    <note>
    	<texte>texte de description</texte>
		<posXCible>50</posXCible>
		<posYCible>50</posYCible>
		<posXNote>-386</posXNote>
		<posYNote>-198</posYNote>
    </note>
    <note>
    	<texte>texte de description</texte>
		<posXCible>300</posXCible>
		<posYCible>36</posYCible>
		<posXNote>342</posXNote>
		<posYNote>-174</posYNote>
    </note>
    <note>
    	<texte>texte de description</texte>
		<posXCible>402</posXCible>
		<posYCible>108</posYCible>
		<posXNote>-322</posXNote>
		<posYNote>190</posYNote>
    </note>
  </frame1>
  <frame2>
	<note>
    	<texte>texte de description</texte>
		<posXCible>-400</posXCible>
		<posYCible>236</posYCible>
		<posXNote>100</posXNote>
		<posYNote>100</posYNote>
	</note>
  </frame2>
  <frame3>
    <note>
    	<texte>texte de description frames3</texte>
		<posXCible>232</posXCible>
		<posYCible>268</posYCible>
		<posXNote>-100</posXNote>
		<posYNote>0</posYNote>
    </note>
  </frame3>
</anim>";

$newFrame1 = "<frame1>
   <note>
   	<texte>New Note</texte>
		<posXCible>500</posXCible>
		<posYCible>500</posYCible>
		<posXNote>-400</posXNote>
		<posYNote>-200</posYNote>
   </note>
 </frame1>";

// Load the Old XML
$oldDom = new DomDocument();
$oldDom->loadXML($newFrame1);
$oldDom->preserveWhiteSpace = false;
$oldDom->formatOutput = true;
// nom de la frame a importer
$rootOldDom = $oldDom->documentElement->nodeName;

// Load the XML
$dom = new DomDocument;
$dom->loadXML($xml);
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;

// Display the old XML
echo "the Old XML:</ br>";
echo "<pre>" . htmlentities($dom->saveXML()) . "</pre>";

// Locate the old parent node
$xpath = new DOMXpath($dom);
// $nodelist = $xpath->query('/anim/frame1');
$nodelist = $xpath->query('/' . $dom->documentElement->tagName . '/' . $rootOldDom);
$oldnode = $nodelist->item(0);


// We then import and replace the new node:

// Load the $frame1 document fragment into the current document
$newnode = $dom->importNode($oldDom->documentElement, true);

// Replace
$oldnode->parentNode->replaceChild($newnode, $oldnode);

// Display the New XML
echo "<hr />";
echo "the New XML:</ br>";
echo "<pre>" . htmlentities($dom->saveXML()) . "</pre>";

?>