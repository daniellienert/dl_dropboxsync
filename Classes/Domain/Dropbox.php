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
class Tx_DlDropboxsync_Domain_Dropbox implements t3lib_Singleton {

	/**
	 * @var Dropbox_OAuth_PHP
	 */
	protected $oAuth;


	/**
	 * @var Dropbox_API
	 */
	protected $dropbox;


	/**
	 * @var bool is authenticated to dropbox?
	 */
	protected $isAuthenticated = FALSE;


	/**
	 * @var t3lib_Registry
	 */
	protected $registry;


	public function __construct() {
		$this->sessionStorageAdapter = Tx_PtExtbase_State_Session_Storage_SessionAdapter::getInstance();
		$this->registry = t3lib_div::makeInstance('t3lib_Registry');

		$this->initOAuth();
		$this->dropbox = new Dropbox_API($this->oAuth);
	}


	protected  function initOAuth() {
		$this->oAuth = new Dropbox_OAuth_PHP('xyr5aaaeko7l78v', 'gwdrjhgythr1pfx');

		$oAuthTokens = $this->registry->get('tx_dlDropbox', 'oauth_tokens');

		if(is_array($oAuthTokens) && array_key_exists('token_secret', $oAuthTokens) && $oAuthTokens['token_secret']) {
			$this->oAuth->setToken($oAuthTokens);
			$this->isAuthenticated = TRUE;
		}
	}


	/**
	  * Returns file and directory information
	  *
	  * @param string $path Path to receive information from
	  * @param bool $list When set to true, this method returns information from all files in a directory. When set to false it will only return infromation from the specified directory.
	  * @param string $hash If a hash is supplied, this method simply returns true if nothing has changed since the last request. Good for caching.
	  * @param int $fileLimit Maximum number of file-information to receive
	  * @param string $root Use this to override the default root path (sandbox/dropbox)
	  * @return array|true
	  */
	public function getMetaData($path, $list = true, $hash = null, $fileLimit = null, $root = null) {
		return $this->dropbox->getMetaData($path, $list, $hash, $fileLimit, $root);
	}


	/**
	 * Returns a file's contents
	 *
	 * @param string $path path
	 * @param string $root Use this to override the default root path (sandbox/dropbox)
	 * @return string
	 */
	public function getFile($path = '', $root = null) {
		return $this->dropbox->getFile($path, $root);
	}


	/**
	 * @return Dropbox_OAuth_PHP
	 */
	public function getOAuth() {
		return $this->oAuth;
	}

}
?>