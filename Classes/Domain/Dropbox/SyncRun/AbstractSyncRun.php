<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Daniel Lienert <develop@lienert.cc>
 *  All rights reserved
 *
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

class Tx_DlDropboxsync_Domain_Dropbox_SyncRun_AbstractSyncRun {

	/**
	 * @var Tx_Extbase_Persistence_Manager
	 */
	protected $persistenceManager;


	/**
	 * @var Tx_DlDropboxsync_Domain_Dropbox_FileTracker
	 */
	protected $fileTracker;


	/**
	 * @var Tx_DlDropboxsync_Domain_Dropbox_Dropbox
	 */
	protected $dropbox;


	/**
	 * @var Tx_DlDropboxsync_Domain_Model_SyncConfiguration
	 */
	protected $syncConfig;


	/**
	 * @var Tx_DlDropboxsync_Domain_Dropbox_SyncRun_RunInfo
	 */
	protected $runInfo;


	/**
	 * @var string
	 */
	protected $runIdentifier;


	/**
	 * @param Tx_DlDropboxsync_Domain_Dropbox_Dropbox $dropbox
	 */
	public function injectDropbox(Tx_DlDropboxsync_Domain_Dropbox_Dropbox $dropbox) {
		$this->dropbox = $dropbox;
	}


	/**
	 * @param Tx_DlDropboxsync_Domain_Dropbox_FileTracker $fileTracker
	 */
	public function injectFileTracker(Tx_DlDropboxsync_Domain_Dropbox_FileTracker $fileTracker) {
		$this->fileTracker = $fileTracker;
	}


	/**
	 * @param Tx_Extbase_Persistence_Manager $persistenceManager
	 */
	public function injectPersistenceManager(Tx_Extbase_Persistence_Manager $persistenceManager) {
		$this->persistenceManager = $persistenceManager;
	}


	/**
	 * @param Tx_DlDropboxsync_Domain_Dropbox_SyncRun_RunInfo $runInfo
	 */
	public function injectRunInfo(Tx_DlDropboxsync_Domain_Dropbox_SyncRun_RunInfo $runInfo) {
		$this->runInfo = $runInfo;
	}


	/**
	 * @param Tx_DlDropboxsync_Domain_Model_SyncConfiguration $syncConfig
	 * @return Tx_DlDropboxsync_Domain_Dropbox_SyncRun_AbstractSyncRun
	 */
	public function setSyncConfiguration(Tx_DlDropboxsync_Domain_Model_SyncConfiguration $syncConfig) {
		$this->syncConfig = $syncConfig;
		return $this;
	}


	/**
	 * Set sync run identifier
	 */
	public function initializeObject() {
		$this->runIdentifier = uniqid('dropboxSyncRun', true);
	}


	/**
	 * @return string
	 */
	public function getRunIdentifier() {
		return $this->runIdentifier;
	}


	/**
	 * Start the synchronisation
	 */
	public function startSync() {}



	/**
	 * @return string
	 */
	protected function getFileadminPath() {
		return PATH_site . 'fileadmin/';
	}


	/**
	 * @param $remotePath
	 * @return array|bool|true
	 */
	protected function getDBDirectoryList($remotePath) {
		try {
			$list = $this->dropbox->getMetaData($remotePath);
		} catch (Exception $e) {
			if ($e instanceof Dropbox_Exception_NotFound) {
				$this->flashMessageContainer->add('Folder ' . $remotePath . ' not found in your dropbox.');
			}

			return FALSE;
		}

		return $list;
	}

}
