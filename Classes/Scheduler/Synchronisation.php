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
class Tx_DlDropboxsync_Scheduler_Synchronisation extends tx_scheduler_Task {

	/**
	 * @var Tx_Extbase_Object_ObjectManagerInterface
	 */
	protected $objectManager;

	/**
	 * This is the main method that is called when a task is executed
	 * It MUST be implemented by all classes inheriting from this one
	 * Note that there is no error handling, errors and failures are expected
	 * to be handled and logged by the client implementations.
	 * Should return TRUE on successful execution, FALSE on error.
	 *
	 * @return boolean Returns TRUE on successful execution, FALSE on error
	 */
	public function execute() {
		$this->setupFramework();

		$dropboxSync = $this->objectManager->get('Tx_DlDropboxsync_Domain_Dropbox_DropboxSync');
		$dropboxSync->syncAll();

		return true;
	}


	/**
	 * @return void
	 */
	protected function setupFramework() {

		$configuration = array(
			'extensionName' => 'DlDropboxSync',
			'pluginName' => 'tx_dldropboxsync_dbs'
		);

		$bootstrap = t3lib_div::makeInstance('Tx_Extbase_Core_Bootstrap');
		$bootstrap->initialize($configuration);

		$this->objectManager = t3lib_div::makeInstance('Tx_Extbase_Object_ObjectManager');
	}
}
?>