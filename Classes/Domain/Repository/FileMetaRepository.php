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
class Tx_DlDropboxsync_Domain_Repository_FileMetaRepository extends Tx_Extbase_Persistence_Repository {


	/**
	 * @param $remotePath
	 * @param $remoteRev
	 * @return Tx_DlDropboxsync_Domain_Model_FileMeta
	 */
	public function findOneByRemotePathAndRev($remotePath, $remoteRev) {
		$query = $this->createQuery();
		$result = $query->matching(
			$query->logicalAnd(
				$query->equals('remote_path', $remotePath),
				$query->equals('rev', $remoteRev)
			)
		)->execute();

		return $result->current();
	}



	/**
	 * Get all file meta data covered by a given sync config but
	 * not updated by the given run identifier
	 *
	 * @param Tx_DlDropboxsync_Domain_Model_SyncConfiguration $syncConfig
	 * @param $runIdentifier
	 * @return array|Tx_Extbase_Persistence_QueryResultInterface
	 */
	public function findAllByConfigWithoutRunIdentifier(Tx_DlDropboxsync_Domain_Model_SyncConfiguration $syncConfig, $runIdentifier) {
		$query = $this->createQuery();

		return $query->matching(
			$query->logicalAnd(
				$query->equals('sync_configuration', $syncConfig),
				$query->logicalNot('last_touched_by_sync', $runIdentifier)
			)
		)->execute();
	}

}
?>