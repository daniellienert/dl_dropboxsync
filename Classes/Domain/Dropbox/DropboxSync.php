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
	 * Injects the flash messages container
	 *
	 * @param Tx_Extbase_MVC_Controller_FlashMessages $flashMessageContainer
	 * @return void
	 */
	public function injectFlashMessageContainer(Tx_Extbase_MVC_Controller_FlashMessages $flashMessageContainer) {
		$this->flashMessageContainer = $flashMessageContainer;
	}


	/**
	* @param Tx_DlDropboxsync_Domain_Repository_SyncConfigurationRepository $syncConfigurationRepository
	*/
	public function injectSyncConfigurationRepository(Tx_DlDropboxsync_Domain_Repository_SyncConfigurationRepository $syncConfigurationRepository) {
		$this->syncConfigurationRepository = $syncConfigurationRepository;
	}



	public function syncAll() {

		$syncConfigs = $this->syncConfigurationRepository->findAll();

		foreach($syncConfigs as $syncConfig) { /** @var $syncConfig Tx_DlDropboxsync_Domain_Model_SyncConfiguration  */

			if($syncConfig->getSyncType() == 'in') {
				$syncRun = $this->objectManager->get('Tx_DlDropboxsync_Domain_Dropbox_SyncRun_SyncIn'); /** @var $syncRun Tx_DlDropboxsync_Domain_Dropbox_SyncRun_SyncIn */
			} else {
				$syncRun = $this->objectManager->get('Tx_DlDropboxsync_Domain_Dropbox_SyncRun_SyncOut'); /** @var $syncRun Tx_DlDropboxsync_Domain_Dropbox_SyncRun_SyncOut */
			}

			$syncRun->setSyncConfiguration($syncConfig)->startSync();
			$this->syncConfigurationRepository->update($syncConfig);
		}
	}


}
