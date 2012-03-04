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
class Tx_DlDropboxsync_Domain_Dropbox_FileTracker implements t3lib_Singleton {


	/**
	 * fileMetaRepository
	 *
	 * @var Tx_DlDropboxsync_Domain_Repository_FileMetaRepository
	 */
	protected $fileMetaRepository;


	/**
	 * injectFileMetaRepository
	 *
	 * @param Tx_DlDropboxsync_Domain_Repository_FileMetaRepository $fileMetaRepository
	 * @return void
	 */
	public function injectFileMetaRepository(Tx_DlDropboxsync_Domain_Repository_FileMetaRepository $fileMetaRepository) {
		$this->fileMetaRepository = $fileMetaRepository;
	}



	/**
	 * @param $remoteFilePath
	 * @param Tx_DlDropboxsync_Domain_Dropbox_SyncRun $syncRun
	 */
	public function flagFileAsProcessedByRemoteFile($remoteFilePath, Tx_DlDropboxsync_Domain_Dropbox_SyncRun $syncRun) {
		$fileMeta = $this->fileMetaRepository->findOneByRemotePath($remoteFilePath); /** @var $fileMeta Tx_DlDropboxsync_Domain_Model_FileMeta */
		$this->flagFileMetaAsProcessed($fileMeta, $syncRun);
	}


	/**
	 * @param $localFilePath
	 * @param Tx_DlDropboxsync_Domain_Dropbox_SyncRun $syncRun
	 */
	public function flagFileAsProcessedByLocalFile($localFilePath, Tx_DlDropboxsync_Domain_Dropbox_SyncRun $syncRun) {
		$fileMeta = $this->fileMetaRepository->findOneByLocalPath($localFilePath);
		$this->flagFileMetaAsProcessed($fileMeta, $syncRun);
	}


	/**
	 * @param Tx_DlDropboxsync_Domain_Model_FileMeta $fileMeta
	 * @param Tx_DlDropboxsync_Domain_Dropbox_SyncRun $syncRun
	 */
	protected function flagFileMetaAsProcessed(Tx_DlDropboxsync_Domain_Model_FileMeta $fileMeta = NULL, Tx_DlDropboxsync_Domain_Dropbox_SyncRun $syncRun) {
		if($fileMeta instanceof Tx_DlDropboxsync_Domain_Model_FileMeta) {
			$fileMeta->setLastTouchedBySync($syncRun->getRunIdentifier());
			$this->fileMetaRepository->update($fileMeta);
		}
	}


	/**
	 * @param $remoteFilePath
	 * @param $remoteFileRev
	 * @return bool
	 */
	public function isRemoteFileChanged($remoteFilePath, $remoteFileRev) {
		$fileMeta = $this->fileMetaRepository->findOneByRemotePathAndRev($remoteFilePath, $remoteFileRev);
		if($fileMeta instanceof Tx_DlDropboxsync_Domain_Model_FileMeta) {
			return false;
		}
		return true;
	}



	public function isLocalFileChanged($localFilePath) {

	}


	/**
	 * Add or update the file meta entry of a synchronized file
	 *
	 * @param $localFilePath
	 * @param $remoteFileArray
	 * @param $syncRun Tx_DlDropboxsync_Domain_Dropbox_SyncRun
	 */
	public function updateFileMeta($localFilePath, $remoteFileArray, Tx_DlDropboxsync_Domain_Dropbox_SyncRun $syncRun) {
		$fileMeta = $this->fileMetaRepository->findOneByLocalPath($localFilePath);

		if(!$fileMeta) {
			$fileMeta = new Tx_DlDropboxsync_Domain_Model_FileMeta();
			$create = TRUE;
		}

		$fileMeta->setBytes($remoteFileArray['bytes']);
		$fileMeta->setLastSynced(time());
		$fileMeta->setMimeType($remoteFileArray['mime_type']);
		$fileMeta->setModified($remoteFileArray['modified']);
		$fileMeta->setRev($remoteFileArray['rev']);
		$fileMeta->setRemotePath($remoteFileArray['path']);
		$fileMeta->setSyncConfiguration($syncRun->getSyncConfiguration());
		$fileMeta->setLastSynced($syncRun->getRunIdentifier());

		$fileMeta->setLocalPath($localFilePath);
		$fileMeta->setLocalHash($this->getHashOfLocalFile($localFilePath));

		if($create) {
			$this->fileMetaRepository->add($fileMeta);
		} else {
			$this->fileMetaRepository->update($fileMeta);
		}
	}


	/**
	 * @param $localFilePath string
	 * @return string
	 */
	protected function getHashOfLocalFile($localFilePath) {
		return md5_file($localFilePath);
	}

}
?>