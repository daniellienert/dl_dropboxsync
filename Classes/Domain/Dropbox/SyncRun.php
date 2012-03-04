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
class Tx_DlDropboxsync_Domain_Dropbox_SyncRun {


	/**
	 * @var Tx_DlDropboxsync_Domain_Model_SyncConfiguration
	 */
	protected $syncConfiguration;


	/**
	 * @var
	 */
	protected $runIdentifier;



	/**
	 * Sync run identifier
	 */
	public function initializeObject() {
		$this->runIdentifier = uniqid('dropboxSyncRun', true);
	}



	/**
	 * @return
	 */
	public function getRunIdentifier() {
		return $this->runIdentifier;
	}



	/**
	 * @param \Tx_DlDropboxsync_Domain_Model_SyncConfiguration $syncConfiguration
	 */
	public function setSyncConfiguration($syncConfiguration) {
		$this->syncConfiguration = $syncConfiguration;
	}


	/**
	 * @return \Tx_DlDropboxsync_Domain_Model_SyncConfiguration
	 */
	public function getSyncConfiguration() {
		return $this->syncConfiguration;
	}


	/**
	 * @return string
	 */
	public function getLocalPath() {
		return $this->syncConfiguration->getLocalPath();
	}


	/**
	 * @return string
	 */
	public function getRemotePath() {
		return $this->syncConfiguration->getRemotePath();
	}
}
?>