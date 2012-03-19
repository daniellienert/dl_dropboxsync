<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Daniel Lienert <develop@lienert.cc>
 *  All rights reserved
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

class Tx_DlDropboxsync_Domain_Dropbox_SyncRun_SyncIn extends Tx_DlDropboxsync_Domain_Dropbox_SyncRun_AbstractSyncRun {



	/**
	 * @return Tx_DlDropboxsync_Domain_Dropbox_SyncRun_RunInfo
	 */
	public function startSync() {

		$this->runInfo->logStart($this->getRunIdentifier());

		$dbDirList = $this->getDBDirectoryList($this->syncConfig->getRemotePath());
		if($dbDirList !== FALSE) {

			foreach($dbDirList['contents'] as $dbDirEntry) {
				if($dbDirEntry['is_dir'] == FALSE) {
					$remotePath = $dbDirEntry['path'];

					$this->fileTracker->flagFileAsProcessedByRemoteFile($remotePath, $this->runIdentifier);

					if($this->fileTracker->isRemoteFileChanged($remotePath, $dbDirEntry['rev'])) {
						$this->downloadDBFileToDirectory($dbDirEntry);
					} else {
						$this->runInfo->logLocalFileUnchanged($remotePath);
					}
				}
			}

			$this->removeLocalFileNotInDropbox();

		}

		return $this->runInfo->getRunInfo();
	}


	/**
	 * Remove files that are not longer on dropbox
	 */
	protected function removeLocalFileNotInDropbox() {
		$this->persistenceManager->persistAll(); // We need to persist all to get the file meta data updated by this run.
		$filesToRemove = $this->fileTracker->getLocalFilesNotProcessedByRun($this->syncConfig, $this->runIdentifier);

		foreach($filesToRemove as $fileToRemove) { /** @var $fileToRemove Tx_DlDropboxsync_Domain_Model_FileMeta */
			if(file_exists($fileToRemove->getLocalPath())) {
				unlink($fileToRemove->getLocalPath());
				$this->runInfo->logLocalFileDeleted($fileToRemove->getLocalPath());
			}
		}
	}


	/**
	 * @param $dbDirEntry
	 */
	protected function downloadDBFileToDirectory($dbDirEntry) {
		$dbPathAndFileName = $dbDirEntry['path'];

		t3lib_div::mkdir_deep($this->getFileadminPath(), $this->syncConfig->getLocalPath());

		$dbFileName = basename($dbPathAndFileName);
		$localPathAndFileName = $this->getFileadminPath() . $this->syncConfig->getLocalPath() . '/' . $dbFileName;

		$fileContent = $this->dropbox->getFile($dbPathAndFileName);
		file_put_contents($localPathAndFileName, $fileContent);

		$this->fileTracker->updateFileMeta($localPathAndFileName, $dbDirEntry, $this->syncConfig, $this->runIdentifier);
		$this->runInfo->logLocalFileAdded($dbPathAndFileName, $localPathAndFileName);
	}
}
