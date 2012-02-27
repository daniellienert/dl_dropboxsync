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
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_DlDropboxsync_Controller_SyncController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * syncRepository
	 *
	 * @var Tx_DlDropboxsync_Domain_Repository_SyncRepository
	 */
	protected $syncRepository;

	/**
	 * injectSyncRepository
	 *
	 * @param Tx_DlDropboxsync_Domain_Repository_SyncRepository $syncRepository
	 * @return void
	 */
	public function injectSyncRepository(Tx_DlDropboxsync_Domain_Repository_SyncRepository $syncRepository) {
		$this->syncRepository = $syncRepository;
	}

	/**
	 * action show
	 *
	 * @param $sync
	 * @return void
	 */
	public function showAction(Tx_DlDropboxsync_Domain_Model_Sync $sync) {
		$this->view->assign('sync', $sync);
	}

	/**
	 * action new
	 *
	 * @param $newSync
	 * @dontvalidate $newSync
	 * @return void
	 */
	public function newAction(Tx_DlDropboxsync_Domain_Model_Sync $newSync = NULL) {
		$this->view->assign('newSync', $newSync);
	}

	/**
	 * action create
	 *
	 * @param $newSync
	 * @return void
	 */
	public function createAction(Tx_DlDropboxsync_Domain_Model_Sync $newSync) {
		$this->syncRepository->add($newSync);
		$this->flashMessageContainer->add('Your new Sync was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $sync
	 * @return void
	 */
	public function editAction(Tx_DlDropboxsync_Domain_Model_Sync $sync) {
		$this->view->assign('sync', $sync);
	}

	/**
	 * action update
	 *
	 * @param $sync
	 * @return void
	 */
	public function updateAction(Tx_DlDropboxsync_Domain_Model_Sync $sync) {
		$this->syncRepository->update($sync);
		$this->flashMessageContainer->add('Your Sync was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $sync
	 * @return void
	 */
	public function deleteAction(Tx_DlDropboxsync_Domain_Model_Sync $sync) {
		$this->syncRepository->remove($sync);
		$this->flashMessageContainer->add('Your Sync was removed.');
		$this->redirect('list');
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$syncs = $this->syncRepository->findAll();
		$this->view->assign('syncs', $syncs);
	}

}
?>