<?php

$orgdoc = new DOMDocument;
$orgdoc->loadXML("<root><element><child>Texte dans un fils</child></element></root>");

// Le noeud que nous voulons importer dans le nouveau document
$node = $orgdoc->getElementsByTagName("element")->item(0);


// Création du nouveau document
$newdoc = new DOMDocument;
$newdoc->formatOutput = true;

// Ajout de quelques balises
$newdoc->loadXML("<root><someelement>Texte dans un élément</someelement></root>");

echo "Le nouveau document avant d'y copier le noeud :\n";
echo "<pre>" . htmlentities($newdoc->saveXML()) . "</pre>\n";

// Importation du noeud, ainsi que tous ses files, dans le document
$node = $newdoc->importNode($node, true);
// Et on l'ajoute dans le le noeud racine "<root>"
$newdoc->documentElement->appendChild($node);

echo "\nLe nouveau document après y avoir copié les noeuds :\n";
echo "<pre>" . htmlentities($newdoc->saveXML()) . "</pre>\n";
?>