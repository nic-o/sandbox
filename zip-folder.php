<?php
// $file: compress-folder.txt $timestamp: 2011/09/15 @ 23:01
// http://fr.php.net/manual/fr/book.zip.php
// http://www.siteduzero.com/tutoriel-3-159134-les-fonctions-zip-en-php.html
// On instancie la class
$zip = new ZipArchive();
      
if(is_dir('upload/')) {
  // On teste si le dossier existe car sinon le script produira des erreurs
	if($zip->open('Archive.zip', ZipArchive::CREATE) == TRUE) {
	  // Ouverture de l'archive réussie  

	  // Récupération des fichiers
	  $fichiers = scandir('upload/');
	  // On enleve . et .. qui représente le dossier courant et le dossier parent
	  unset($fichiers[0], $fichiers[1]);
	  
	  foreach($fichiers as $f) {
	    // On ajoute chaque fichier à l'archive en spécifiant l'argument optionnel
	    // pour ne pas créer de dossier dans l'archive
	    if(!$zip->addFile('upload/'.$f, $f)) {
	      echo 'Impossible d&#039;ajouter &quot;'.$f.'&quot;.<br/>';
	    }
	  }
	
	  // On ferme l'archive
	  $zip->close();
	
	  // On peut ensuite si on veut comme dans le tuto de DHKold proposer le téléchargement
	  header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
	  header('Content-Disposition: attachment; filename="Archive.zip"'); //Nom du fichier
	  header('Content-Length: '.filesize('Archive.zip')); //Taille du fichier
	  
	  readfile('Archive.zip');
	} else {
	  // Erreur lors de l'ouverture
	  // On peut rajouter pour gérer les différentes erreurs
	  echo 'Erreur, impossible de créer l&#039;archive.';
	}
} else {
  // Possibilite de créer le dossier avec mkdir()
  echo 'Le dossier &quot;upload/&quot; n\'existe pas.';
}