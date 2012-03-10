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
class Tx_DlDropboxsync_Domain_Model_SyncConfiguration extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * identifier
	 *
	 * @var string
	 */
	protected $identifier;

	/**
	 * description
	 *
	 * @var string
	 */
	protected $description;

	/**
	 * localPath
	 *
	 * @var string
	 */
	protected $localPath;

	/**
	 * remotePath
	 *
	 * @var string
	 */
	protected $remotePath;

	/**
	 * type
	 *
	 * @var string
	 */
	protected $syncType;

	/**
	 * lastSync
	 *
	 * @var DateTime
	 */
	protected $lastSync;

	/**
	 * Returns the identifier
	 *
	 * @return string $identifier
	 */
	public function getIdentifier() {
		return $this->identifier;
	}

	/**
	 * Sets the identifier
	 *
	 * @param string $identifier
	 * @return void
	 */
	public function setIdentifier($identifier) {
		$this->identifier = $identifier;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the localPath
	 *
	 * @return string $localPath
	 */
	public function getLocalPath() {
		return $this->localPath;
	}

	/**
	 * Sets the localPath
	 *
	 * @param string $localPath
	 * @return void
	 */
	public function setLocalPath($localPath) {
		$this->localPath = $localPath;
	}

	/**
	 * Returns the remotePath
	 *
	 * @return string $remotePath
	 */
	public function getRemotePath() {
		return $this->remotePath;
	}

	/**
	 * Sets the remotePath
	 *
	 * @param string $remotePath
	 * @return void
	 */
	public function setRemotePath($remotePath) {
		$this->remotePath = $remotePath;
	}


	/**
	 * Returns the lastSync
	 *
	 * @return DateTime $lastSync
	 */
	public function getLastSync() {
		return $this->lastSync;
	}

	/**
	 * Sets the lastSync
	 *
	 * @param DateTime $lastSync
	 * @return void
	 */
	public function setLastSync($lastSync) {
		$this->lastSync = $lastSync;
	}

	/**
	 * @param string $syncType
	 */
	public function setSyncType($syncType) {
		$this->syncType = $syncType;
	}

	/**
	 * @return string
	 */
	public function getSyncType() {
		return $this->syncType;
	}

}
?>