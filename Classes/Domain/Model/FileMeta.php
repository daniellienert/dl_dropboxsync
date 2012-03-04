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
class Tx_DlDropboxsync_Domain_Model_FileMeta extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * mimeType
	 *
	 * @var string
	 */
	protected $mimeType;

	/**
	 * modified
	 *
	 * @var int
	 */
	protected $modified;

	/**
	 * remotePath
	 *
	 * @var string
	 */
	protected $remotePath;

	/**
	 * rev
	 *
	 * @var string
	 */
	protected $rev;

	/**
	 * bytes
	 *
	 * @var string
	 */
	protected $bytes;

	/**
	 * lastSynced
	 *
	 * @var string
	 */
	protected $lastSynced;

	/**
	 * localPath
	 *
	 * @var string
	 */
	protected $localPath;

	/**
	 * localHash
	 *
	 * @var string
	 */
	protected $localHash;

	/**
	 * syncConfiguration
	 *
	 * @var Tx_DlDropboxsync_Domain_Model_SyncConfiguration
	 */
	protected $syncConfiguration;


	/**
	 * This set to the current sync run uuid. It is
	 * used to identify not touched files which
	 * have to be deleted.
	 *
	 * @var string
	 */
	protected $lastTouchedBySync;


	/**
	 * Returns the mimeType
	 *
	 * @return string $mimeType
	 */
	public function getMimeType() {
		return $this->mimeType;
	}

	/**
	 * Sets the mimeType
	 *
	 * @param string $mimeType
	 * @return void
	 */
	public function setMimeType($mimeType) {
		$this->mimeType = $mimeType;
	}

	/**
	 * Returns the modified
	 *
	 * @return int $modified
	 */
	public function getModified() {
		return $this->modified;
	}

	/**
	 * Sets the modified
	 *
	 * @param int $modified
	 * @return void
	 */
	public function setModified($modified) {
		$this->modified = $modified;
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
	 * Returns the rev
	 *
	 * @return string $rev
	 */
	public function getRev() {
		return $this->rev;
	}

	/**
	 * Sets the rev
	 *
	 * @param string $rev
	 * @return void
	 */
	public function setRev($rev) {
		$this->rev = $rev;
	}

	/**
	 * Returns the bytes
	 *
	 * @return string $bytes
	 */
	public function getBytes() {
		return $this->bytes;
	}

	/**
	 * Sets the bytes
	 *
	 * @param string $bytes
	 * @return void
	 */
	public function setBytes($bytes) {
		$this->bytes = $bytes;
	}

	/**
	 * Returns the lastSynced
	 *
	 * @return string $lastSynced
	 */
	public function getLastSynced() {
		return $this->lastSynced;
	}

	/**
	 * Sets the lastSynced
	 *
	 * @param string $lastSynced
	 * @return void
	 */
	public function setLastSynced($lastSynced) {
		$this->lastSynced = $lastSynced;
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
	 * Returns the localHash
	 *
	 * @return string $localHash
	 */
	public function getLocalHash() {
		return $this->localHash;
	}

	/**
	 * Sets the localHash
	 *
	 * @param string $localHash
	 * @return void
	 */
	public function setLocalHash($localHash) {
		$this->localHash = $localHash;
	}

	/**
	 * Returns the syncConfiguration
	 *
	 * @return Tx_DlDropboxsync_Domain_Model_SyncConfiguration $syncConfiguration
	 */
	public function getSyncConfiguration() {
		return $this->syncConfiguration;
	}

	/**
	 * Sets the syncConfiguration
	 *
	 * @param Tx_DlDropboxsync_Domain_Model_SyncConfiguration $syncConfiguration
	 * @return void
	 */
	public function setSyncConfiguration(Tx_DlDropboxsync_Domain_Model_SyncConfiguration $syncConfiguration) {
		$this->syncConfiguration = $syncConfiguration;
	}

	/**
	 * @param string $lastTouchedBySync
	 */
	public function setLastTouchedBySync($lastTouchedBySync) {
		$this->lastTouchedBySync = $lastTouchedBySync;
	}

	/**
	 * @return string
	 */
	public function getLastTouchedBySync() {
		return $this->lastTouchedBySync;
	}

}
?>