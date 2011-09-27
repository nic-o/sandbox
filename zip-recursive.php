<?php
// $file: untitled.php $timestamp: 2011/09/19 @ 13:47
$src = "/Users/nico/Sites/drupal/drupal-6.22/sites/default/files/untitled folder";
compress($src);


function recurse_zip($src,&$zip,$path_length) {
  $dir = opendir($src);
  while(false !== ( $file = readdir($dir)) ) {
    if (( $file != '.' ) && ( $file != '..' )) {
      if ( is_dir($src . '/' . $file) ) {
        recurse_zip($src . '/' . $file,$zip,$path_length);
      } else {
        $zip->addFile($src . '/' . $file,substr($src . '/' . $file,$path_length));
      }
    }
  }
  closedir($dir);
}
//Call this function with argument = absolute path of file or directory name.
function compress($src) {
  if(substr($src,-1) === '/') {
    // Si le $src se termine par un slash
    $src = substr($src,0,-1);
  }

  $arr_src = explode('/',$src);
  var_dump($arr_src);exit;
  $filename = end($arr_src);
  unset($arr_src[count($arr_src)-1]); // supression du dernier dossier
  $path_length = strlen(implode('/',$arr_src).'/');
  $f = explode('.',$filename);
  $filename=$f[0];
  $filename = (($filename=='') ? 'backup.zip' : $filename.'.zip');
  $zip = new ZipArchive;
  $res = $zip->open("/Users/nico/Desktop/" . $filename, ZipArchive::CREATE);
  if($res !== TRUE) {
    echo 'Error: Unable to create zip file';
    exit;
  }
  if(is_file($src)) {
    $zip->addFile($src,substr($src,$path_length));
  } else {
    if(!is_dir($src)) {
      $zip->close();
      @unlink($filename);
      echo 'Error: File not found';
      exit;
    }
    recurse_zip($src,$zip,$path_length);
  }
    $zip->close();
    // header("Location: $filename");
    // exit;
}