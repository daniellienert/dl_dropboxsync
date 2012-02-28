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
 * @package dl_dropboxsync
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_DlDropboxsync_Controller_SyncConfigurationController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * syncConfigurationRepository
	 *
	 * @var Tx_DlDropboxsync_Domain_Repository_SyncConfigurationRepository
	 */
	protected $syncConfigurationRepository;

	/**
	 * injectSyncConfigurationRepository
	 *
	 * @param Tx_DlDropboxsync_Domain_Repository_SyncConfigurationRepository $syncConfigurationRepository
	 * @return void
	 */
	public function injectSyncConfigurationRepository(Tx_DlDropboxsync_Domain_Repository_SyncConfigurationRepository $syncConfigurationRepository) {
		$this->syncConfigurationRepository = $syncConfigurationRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$syncConfigurations = $this->syncConfigurationRepository->findAll();
		$this->view->assign('syncConfigurations', $syncConfigurations);
	}

	/**
	 * action show
	 *
	 * @param $syncConfiguration
	 * @return void
	 */
	public function showAction(Tx_DlDropboxsync_Domain_Model_SyncConfiguration $syncConfiguration) {
		$this->view->assign('syncConfiguration', $syncConfiguration);
	}

	/**
	 * action new
	 *
	 * @param $newSyncConfiguration
	 * @dontvalidate $newSyncConfiguration
	 * @return void
	 */
	public function newAction(Tx_DlDropboxsync_Domain_Model_SyncConfiguration $newSyncConfiguration = NULL) {
		$this->view->assign('newSyncConfiguration', $newSyncConfiguration);
	}

	/**
	 * action create
	 *
	 * @param $newSyncConfiguration
	 * @return void
	 */
	public function createAction(Tx_DlDropboxsync_Domain_Model_SyncConfiguration $newSyncConfiguration) {
		$this->syncConfigurationRepository->add($newSyncConfiguration);
		$this->flashMessageContainer->add('Your new SyncConfiguration was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $syncConfiguration
	 * @return void
	 */
	public function editAction(Tx_DlDropboxsync_Domain_Model_SyncConfiguration $syncConfiguration) {
		$this->view->assign('syncConfiguration', $syncConfiguration);
	}

	/**
	 * action update
	 *
	 * @param $syncConfiguration
	 * @return void
	 */
	public function updateAction(Tx_DlDropboxsync_Domain_Model_SyncConfiguration $syncConfiguration) {
		$this->syncConfigurationRepository->update($syncConfiguration);
		$this->flashMessageContainer->add('Your SyncConfiguration was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $syncConfiguration
	 * @return void
	 */
	public function deleteAction(Tx_DlDropboxsync_Domain_Model_SyncConfiguration $syncConfiguration) {
		$this->syncConfigurationRepository->remove($syncConfiguration);
		$this->flashMessageContainer->add('Your SyncConfiguration was removed.');
		$this->redirect('list');
	}

}
?>