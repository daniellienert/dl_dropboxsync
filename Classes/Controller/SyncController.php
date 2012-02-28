<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Daniel Lienert <daniel@lienert.cc>, Daniel Lienert
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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


/**
 *
 *
 * @package dl_dropbox
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_DlDropboxsync_Controller_SyncController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * syncConfigurationRepository
	 *
	 * @var Tx_DlDropboxsync_Domain_Repository_SyncConfigurationRepository
	 */
	protected $syncConfigurationRepository;

	/**
	 * @var Tx_PtExtbase_State_Session_Storage_SessionAdapter
	 */
	protected $sessionStorageAdapter;


	/**
	 * injectSyncRepository
	 *
	 * @param Tx_DlDropboxsync_Domain_Repository_SyncConfigurationRepository $syncRepository
	 * @return void
	 */
	public function injectSyncConfigurationRepository(Tx_DlDropboxsync_Domain_Repository_SyncConfigurationRepository $syncConfigurationRepository) {
		$this->syncConfigurationRepository = $syncConfigurationRepository;
	}


	public function initializeAction() {
		$this->sessionStorageAdapter = Tx_PtExtbase_State_Session_Storage_SessionAdapter::getInstance();
	}



	/**
	 * action show
	 *
	 * @return void
	 */
	public function showAction() {
		/** It seems dropbox ignores the callBackUrl parameters, so the  default controller / action is called */
		if($this->sessionStorageAdapter->read('dropBoxConnectInProgress')) {
			$this->sessionStorageAdapter->delete('dropBoxConnectInProgress');
			$this->forward('connectResponse', 'OAuth');
		}

		/*
		$dropbox = $this->objectManager->get('Tx_DlDropbox_Domain_Dropbox');
		$info = $dropbox->getMetaData();

		$this->view->assign('info', $info['contents']);
		*/

		$syncs = $this->syncConfigurationRepository->findAll();
		$this->view->assign('syncs', $syncs);
	}

	/**
	 * action new
	 *
	 * @param $newSync
	 * @dontvalidate $newSync
	 * @return void
	 */
	public function newAction(Tx_DlDropboxsync_Domain_Model_SyncConfiguration $newSync = NULL) {
		$this->view->assign('newSync', $newSync);
	}

	/**
	 * action create
	 *
	 * @param $newSync
	 * @return void
	 */
	public function createAction(Tx_DlDropboxsync_Domain_Model_SyncConfiguration $newSync) {
		$this->syncConfigurationRepository->add($newSync);
		$this->flashMessageContainer->add('Your new Sync was created.');
		$this->redirect('show');
	}

	/**
	 * action edit
	 *
	 * @param $sync
	 * @return void
	 */
	public function editAction(Tx_DlDropboxsync_Domain_Model_SyncConfiguration $sync) {
		$this->view->assign('sync', $sync);
	}

	/**
	 * action update
	 *
	 * @param $sync
	 * @return void
	 */
	public function updateAction(Tx_DlDropboxsync_Domain_Model_SyncConfiguration $sync) {
		$this->syncConfigurationRepository->update($sync);
		$this->flashMessageContainer->add('Your Sync was updated.');
		$this->redirect('show');
	}

	/**
	 * action delete
	 *
	 * @param $sync
	 * @return void
	 */
	public function deleteAction(Tx_DlDropboxsync_Domain_Model_SyncConfiguration $sync) {
		$this->syncConfigurationRepository->remove($sync);
		$this->flashMessageContainer->add('Your Sync was removed.');
		$this->redirect('show');
	}



	/**
	 * Syncs all defined folders
	 */
	public function syncAllAction() {
		$dropboxSync = $this->objectManager->get('Tx_DlDropboxsync_Domain_DropboxSync');
		$dropboxSync->syncAll();

	}

}
?>