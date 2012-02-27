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

class Tx_DlDropbox_Domain_DropboxSync {

	/**
	 * syncRepository
	 *
	 * @var Tx_DlDropbox_Domain_Repository_SyncRepository
	 */
	protected $syncRepository;


	/**
	 * @var Tx_DlDropbox_Domain_Dropbox
	 */
	protected $dropbox;


	/**
	 * @param Tx_DlDropbox_Domain_Dropbox $dropbox
	 */
	public function injectDropbox(Tx_DlDropbox_Domain_Dropbox $dropbox) {
		$this->dropbox = $dropbox;
	}


	/**
	 * injectSyncRepository
	 *
	 * @param Tx_DlDropbox_Domain_Repository_SyncRepository $syncRepository
	 * @return void
	 */
	public function injectSyncRepository(Tx_DlDropbox_Domain_Repository_SyncRepository $syncRepository) {
		$this->syncRepository = $syncRepository;
	}



	public function syncAll() {
		$syncConfigs = $this->syncRepository->findAll();

		foreach($syncConfigs as $syncConfig) { /** @var $syncConfig  */

		}
	}


	/**
	 * @param $remotePath
	 * @param $localPath
	 * @param bool $recursive
	 */
	protected function syncRemoteToLocal($remotePath, $localPath, $recursive = FALSE) {

	}

}
