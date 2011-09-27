<?php

$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<anim>
 <frame1>
    <note>
    	<texte>Note 1</texte>
		<posXCible>50</posXCible>
		<posYCible>50</posYCible>
		<posXNote>-386</posXNote>
		<posYNote>-198</posYNote>
    </note>
    <note>
    	<texte>Note 2</texte>
		<posXCible>300</posXCible>
		<posYCible>36</posYCible>
		<posXNote>342</posXNote>
		<posYNote>-174</posYNote>
    </note>
  </frame1>
</anim>";

$doc = new DomDocument();
$doc->loadXML($xml);
$test = $doc->getElementsByTagName('frame1');

print_r($test);

?>