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

class Tx_DlDropboxsync_Domain_Dropbox_SyncRun_RunInfo {


	/**
	 * @var string
	 */
	protected $runIdentifier;

	/**
	 * @var int
	 */
	protected $runStartDate;


	/**
	 * @var array
	 */
	protected $localFiles;



	public function logStart($runIdentifier) {
		$this->runStartDate = time();
		$this->runIdentifier = $runIdentifier;
	}


	/**
	 * @param $remoteFile
	 * @param $localFile
	 */
	public function logLocalFileAdded($remoteFile, $localFile) {
		$this->localFiles['added'][] = array(
			'remote' => $remoteFile,
			'local' => $localFile
		);
	}


	/**
	 * @param $localFile
	 */
	public function logLocalFileDeleted($localFile) {
		$this->localFiles['deleted'][] = $localFile;
	}


	/**
	 * @param $localFile
	 */
	public function logLocalFileUnchanged($localFile) {
		$this->localFiles['unchanged'][] = $localFile;
	}


	/**
	 * @return array
	 */
	public function getRunInfo() {
		$runInfo = array(
			'runIdentifier' => $this->runIdentifier,
			'startTime' => $this->runStartDate,
			'endTime' => time(),
			'localFiles' => $this->localFiles
		);

		return $runInfo;
	}

}
