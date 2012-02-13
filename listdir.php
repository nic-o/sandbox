<?php

// if ($handle = opendir('/Users/nico/Sites/layout.sophiemartin.com/120208/sites/default/files/images/import')) {
//     echo "Directory handle: $handle\n";
//     echo "Entries:\n";
// 
//     /* This is the correct way to loop over the directory. */
//     while (false !== ($entry = readdir($handle))) {
//         echo "$entry\n";
//     }
// 
//     /* This is the WRONG way to loop over the directory. */
//     while ($entry = readdir($handle)) {
//         echo "$entry\n";
//     }
// 
//     closedir($handle);
// }
define('IMPORT_FOLDER', '/Users/nico/Sites/layout.sophiemartin.com/120208/sites/default/files/images/import');
// if ($handle = opendir(IMPORT_FOLDER)) {
//   while (false !== ($entry = readdir($handle))) {
//     if (substr($entry, 0, 1) != "."  && is_dir(IMPORT_FOLDER . "/" . $entry)) {
// 
//             echo "$entry\n";
//         }
//     }
//     closedir($handle);
// }
function listdirs($dir) {
    static $alldirs = array();
    $dirs = glob($dir . '/*', GLOB_ONLYDIR);
    if (count($dirs) > 0) {
        foreach ($dirs as $d) $alldirs[] = $d;
    }
    foreach ($dirs as $dir) listdirs($dir);
    return $alldirs;
}
var_dump(listdirs(IMPORT_FOLDER));