<?php
// This class contains information about classes to be registered in autoload for testing

$dldbPath = t3lib_extMgm::extPath('dl_dropbox');
return array(
    'dropbox_oauth_php' => $dldbPath . 'Classes/Dropbox/src/Dropbox/OAuth/PHP.php',
    'dropbox_oauth' => $dldbPath . 'Classes/Dropbox/src/Dropbox/OAuth.php',
    'dropbox_exception' => $dldbPath . 'Classes/Dropbox/src/Dropbox/Exception.php',
    'dropbox_api' => $dldbPath . 'Classes/Dropbox/src/Dropbox/API.php',

);
?>