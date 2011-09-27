<?php
// $file: write-log.php $timestamp: 2011/09/15 @ 22:47

function LogWhat($timestamp = NULL, $message = NULL) {
  if($timestamp == NULL) {
    $timestamp = time();
  }
  if($message == NULL) {
    $message = "";
  }
  $file = "./" . date("Ymd.Hi", $timestamp) . ".txt";
  if (file_exists($file)) { // Le fichier existe deja et on flush dedans
    $fp = fopen($file, 'a+') or die("can't open file");
    $previousContent = file_get_contents($file);
    $output = "===" . date("l, j F Y [h:i:s a]") . "==============================================\n";
    $output .= $message . "\n";
    $output .= $previousContent;
  } else { // Le fichier n'existe pas encore
    $fp = fopen($file, 'w') or die("can not create the Log File");
    $output = "===" . date("l, j F Y [h:i:s a]") . "==============================================\n";
    $output .= $message . "\n";
  }
  fwrite($fp, $output);
  fclose($fp);
  return $file;
}