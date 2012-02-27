<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}



if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	Tx_Extbase_Utility_Extension::registerModule(
		$_EXTKEY,
		'tools',	 // Make module a submodule of 'tools'
		'dbs',	// Submodule key
		'',						// Position
		array(
			'Sync' => 'show',
			'OAuth' => 'connectRequest, connectResponse',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_dbs.xml',
		)
	);

}


t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Dropbox Sync');


t3lib_extMgm::addLLrefForTCAdescr('tx_dldropboxsync_domain_model_sync', 'EXT:dl_dropboxsync/Resources/Private/Language/locallang_csh_tx_dldropboxsync_domain_model_sync.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_dldropboxsync_domain_model_sync');
$TCA['tx_dldropboxsync_domain_model_sync'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:dl_dropboxsync/Resources/Private/Language/locallang_db.xml:tx_dldropboxsync_domain_model_sync',
		'label' => 'uid',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Sync.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_dldropboxsync_domain_model_sync.gif'
	),
);

?>