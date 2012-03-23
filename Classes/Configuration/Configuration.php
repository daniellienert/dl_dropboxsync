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

class Tx_DlDropboxsync_Configuration_Configuration implements t3lib_Singleton {

	/**
	 * @var string
	 */
	protected $dropboxConsumerSecret = '';


	/**
	 * @var string
	 */
	protected $dropboxConsumerKey = '';


	public function initializeObject() {
		$this->settings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['dl_dropboxsync']);
		$this->init();
	}


	/**
	 * Init the configuration
	 */
	protected function init() {
		$this->setRequiredValue('dropboxConsumerKey', 'No dropbox consumer key set. Please set this value in the extension installation dialog');
		$this->setRequiredValue('dropboxConsumerSecret', 'No dropbox consumer secret set. Please set this value in the extension installation dialog');
	}



	/**
	 * Checks if the tsKey exists in the settings and throw an exception with the given method if not
	 *
	 * @param string $tsKey with the value to copy to the internal property
	 * @param string_type $errorMessageIfNotExists
	 * @param string $internalPropertyName optional property name if it is deiferent from the tsKey
	 * @throws Exception
	 */
	protected function setRequiredValue($tsKey, $errorMessageIfNotExists, $internalPropertyName = NULL) {
		if (is_array($this->settings) && !array_key_exists($tsKey, $this->settings)
			|| (is_array($this->settings[$tsKey]) && empty($this->settings[$tsKey]))
			|| (!is_array($this->settings[$tsKey]) && (strlen(trim($this->settings[$tsKey])) === 0))) {
			Throw new Exception($errorMessageIfNotExists);
		}

		$property = $internalPropertyName ? $internalPropertyName : $tsKey;
		$this->$property = $this->settings[$tsKey];
	}


	/**
	 * @return string
	 */
	public function getDropboxConsumerKey() {
		return $this->dropboxConsumerKey;
	}

	/**
	 * @return string
	 */
	public function getDropboxConsumerSecret() {
		return $this->dropboxConsumerSecret;
	}


}
