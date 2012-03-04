<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010-2011 punkt.de GmbH - Karlsruhe, Germany - http://www.punkt.de
 *  Authors: Daniel Lienert
 *  All rights reserved
 *
 *  For further information: http://extlist.punkt.de <extlist@punkt.de>
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

class Tx_DlDropboxsync_Domain_Dropbox_DropboxSync {

	/**
	 * syncConfigurationRepository
	 *
	 * @var Tx_DlDropboxsync_Domain_Repository_SyncConfigurationRepository
	 */
	protected $syncConfigurationRepository;


	/**
	 * @var Tx_DlDropboxsync_Domain_Dropbox_Dropbox
	 */
	protected $dropbox;


	/**
	 * @var Tx_DlDropboxsync_Domain_Dropbox_FileTracker
	 */
	protected $fileTracker;


	/**
	 * The flash messages. Use $this->flashMessageContainer->add(...) to add a new Flash message.
	 *
	 * @var Tx_Extbase_MVC_Controller_FlashMessages
	 * @api
	 */
	protected $flashMessageContainer;


	/**
	 * @var Tx_Extbase_Object_ObjectManager
	 */
	protected $objectManager;


	/**
	 * @param Tx_Extbase_Object_ObjectManager $objectManager
	 */
	public function injectObjectManager(Tx_Extbase_Object_ObjectManager $objectManager) {
		$this->objectManager = $objectManager;
	}


	/**
	 * @param Tx_DlDropboxsync_Domain_Dropbox_Dropbox $dropbox
	 */
	public function injectDropbox(Tx_DlDropboxsync_Domain_Dropbox_Dropbox $dropbox) {
		$this->dropbox = $dropbox;
	}


	/**
	 * Injects the flash messages container
	 *
	 * @param Tx_Extbase_MVC_Controller_FlashMessages $flashMessageContainer
	 * @return void
	 */
	public function injectFlashMessageContainer(Tx_Extbase_MVC_Controller_FlashMessages $flashMessageContainer) {
		$this->flashMessageContainer = $flashMessageContainer;
	}


	/**
	 * injectSyncRepository
	 *
	 * @param Tx_DlDropboxsync_Domain_Repository_SyncConfigurationRepository $syncRepository
	 * @return void
	 */
	public function injectSyncConfigurationRepository(Tx_DlDropboxsync_Domain_Repository_SyncConfigurationRepository $syncConfigurationRepository) {
		$this->syncConfigurationRepository = $syncConfigurationRepository;
	}



	/**
	 * @param Tx_DlDropboxsync_Domain_Dropbox_FileTracker $fileTracker
	 */
	public function injectFileTracker(Tx_DlDropboxsync_Domain_Dropbox_FileTracker $fileTracker) {
		$this->fileTracker = $fileTracker;
	}



	public function syncAll() {

		$syncConfigs = $this->syncConfigurationRepository->findAll();

		foreach($syncConfigs as $syncConfig) { /** @var $syncConfig Tx_DlDropboxsync_Domain_Model_SyncConfiguration  */
			$syncRun = $this->buildSyncRun($syncConfig);
			$this->syncRemoteToLocal($syncRun);

			$syncConfig->setLastSync(new DateTime());
			$this->syncConfigurationRepository->update($syncConfig);
		}
	}



	/**
	 * @param Tx_DlDropboxsync_Domain_Model_SyncConfiguration $syncConfiguration
	 * @return Tx_DlDropboxsync_Domain_Dropbox_SyncRun
	 */
	protected function buildSyncRun(Tx_DlDropboxsync_Domain_Model_SyncConfiguration $syncConfiguration) {
		$syncRun = $this->objectManager->get('Tx_DlDropboxsync_Domain_Dropbox_SyncRun'); /** @var $syncRun Tx_DlDropboxsync_Domain_Dropbox_SyncRun */
		$syncRun->setSyncConfiguration($syncConfiguration);

		return $syncRun;
	}



	/**
	 * @param $remotePath
	 * @param $localPath
	 * @param bool $recursive
	 */
	protected function syncRemoteToLocal(Tx_DlDropboxsync_Domain_Dropbox_SyncRun $syncRun, $recursive = FALSE) {

		$dbDirList = $this->getDBDirectoryList($syncRun->getSyncConfiguration()->getRemotePath());
		if($dbDirList !== FALSE) {

			foreach($dbDirList['contents'] as $dbDirEntry) {
				if($dbDirEntry['is_dir'] == FALSE) {
					$remotePath = $dbDirEntry['path'];

					$this->fileTracker->flagFileAsProcessedByRemoteFile($remotePath, $syncRun);

					if($this->fileTracker->isRemoteFileChanged($remotePath, $dbDirEntry['rev'])) {
						$this->downloadDBFileToDirectory($syncRun, $dbDirEntry);
						error_log('Downloaded ' . $remotePath . ' to ' . $syncRun->getLocalPath());
					} else {
						error_log('Skiped ' . $$remotePath . ' because we already have the newest file.');
					}

				}
			}
		}
	}


	protected function downloadDBFileToDirectory(Tx_DlDropboxsync_Domain_Dropbox_SyncRun $syncRun, $dbDirEntry) {
		$dbPathAndFileName = $dbDirEntry['path'];

		t3lib_div::mkdir_deep($this->getFileadminPath(), $syncRun->getLocalPath());
		
		$dbFileName = basename($dbPathAndFileName); 
		$localPathAndFileName = $this->getFileadminPath() . $syncRun->getLocalPath() . '/' . $dbFileName;

		$fileContent = $this->dropbox->getFile($dbPathAndFileName);
		file_put_contents($localPathAndFileName, $fileContent);

		$this->fileTracker->updateFileMeta($localPathAndFileName, $dbDirEntry, $syncRun);
	}


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
			if($e instanceof Dropbox_Exception_NotFound) {
				$this->flashMessageContainer->add('Folder ' . $remotePath . ' not found in your dropbox.');
			}

			return FALSE;
		}

		return $list;
	}

}
