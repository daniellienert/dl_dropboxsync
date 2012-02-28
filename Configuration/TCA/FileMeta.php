<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_dldropboxsync_domain_model_filemeta'] = array(
	'ctrl' => $TCA['tx_dldropboxsync_domain_model_filemeta']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, mime_type, modified, remote_path, rev, bytes, last_synched, local_hash, sync_configuration',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, mime_type, modified, remote_path, rev, bytes, last_synched, local_hash, sync_configuration,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_dldropboxsync_domain_model_filemeta',
				'foreign_table_where' => 'AND tx_dldropboxsync_domain_model_filemeta.pid=###CURRENT_PID### AND tx_dldropboxsync_domain_model_filemeta.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'mime_type' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_dropboxsync/Resources/Private/Language/locallang_db.xml:tx_dldropboxsync_domain_model_filemeta.mime_type',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'modified' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_dropboxsync/Resources/Private/Language/locallang_db.xml:tx_dldropboxsync_domain_model_filemeta.modified',
			'config' => array(
				'type' => 'input',
				'size' => 6,
				'eval' => 'timesec',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'remote_path' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_dropboxsync/Resources/Private/Language/locallang_db.xml:tx_dldropboxsync_domain_model_filemeta.remote_path',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'rev' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_dropboxsync/Resources/Private/Language/locallang_db.xml:tx_dldropboxsync_domain_model_filemeta.rev',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'bytes' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_dropboxsync/Resources/Private/Language/locallang_db.xml:tx_dldropboxsync_domain_model_filemeta.bytes',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'last_synched' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_dropboxsync/Resources/Private/Language/locallang_db.xml:tx_dldropboxsync_domain_model_filemeta.last_synched',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'local_hash' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_dropboxsync/Resources/Private/Language/locallang_db.xml:tx_dldropboxsync_domain_model_filemeta.local_hash',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'sync_configuration' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_dropboxsync/Resources/Private/Language/locallang_db.xml:tx_dldropboxsync_domain_model_filemeta.sync_configuration',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_dldropboxsync_domain_model_syncconfiguration',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapse' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
	),
);

?>