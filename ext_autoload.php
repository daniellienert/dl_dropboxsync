<?php
// This class contains information about classes to be registered in autoload for testing

$dldbPath = t3lib_extMgm::extPath('dl_dropboxsync');
return array(
	'dropbox_oauth_php' => $dldbPath . 'Classes/Dropbox/src/Dropbox/OAuth/PHP.php',
	'dropbox_oauth' => $dldbPath . 'Classes/Dropbox/src/Dropbox/OAuth.php',
	'dropbox_api' => $dldbPath . 'Classes/Dropbox/src/Dropbox/API.php',

	'dropbox_exception' => $dldbPath . 'Classes/Dropbox/src/Dropbox/Exception.php',
	'dropbox_exception_notfound' => $dldbPath . 'Classes/Dropbox/src/Dropbox/Exception/NotFound.php',
	'dropbox_exception_forbidden' => $dldbPath . 'Classes/Dropbox/src/Dropbox/Exception/Forbidden.php',
	'dropbox_exception_overquota' => $dldbPath . 'Classes/Dropbox/src/Dropbox/Exception/OverQuota.php',
	'dropbox_exception_requesttoken' => $dldbPath . 'Classes/Dropbox/src/Dropbox/Exception/RequestToken.php',
);
?>