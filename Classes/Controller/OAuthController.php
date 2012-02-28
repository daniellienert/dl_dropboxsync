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
class Tx_DlDropboxsync_Controller_OAuthController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Dropbox_OAuth_PHP
	 */
	protected $oAuth;


	/**
	 * @var Dropbox_API
	 */
	protected $dropbox;


	/**
	 * @var Tx_PtExtbase_State_Session_Storage_SessionAdapter
	 */
	protected $sessionStorageAdapter;


	/**
	 * @var t3lib_Registry
	 */
	protected $registry;


	public function initializeAction() {

		$this->sessionStorageAdapter = Tx_PtExtbase_State_Session_Storage_SessionAdapter::getInstance();
		$this->registry = t3lib_div::makeInstance('t3lib_Registry');

		$this->oauth = new Dropbox_OAuth_PHP('xyr5aaaeko7l78v', 'gwdrjhgythr1pfx');
		$this->dropbox = new Dropbox_API($this->oauth);
	}


	/**
	 *  Get the authorization url and redirect to dropbox
	 */
	public function connectRequestAction() {

		$tokens = $this->oauth->getRequestToken();

		$this->sessionStorageAdapter->store('dropboxTokens', $tokens);
		$this->sessionStorageAdapter->store('dropBoxConnectInProgress', true);

		$callBackURL = $this->uriBuilder
					->reset()
					->setCreateAbsoluteUri(TRUE)
					->uriFor('connectResponse', NULL, 'OAuth');

		$authorizeURL = $this->oauth->getAuthorizeUrl(urldecode($callBackURL));

		$this->redirectToUri($authorizeURL);
	}



	/**
	 * Save the tokens to the registry
	 */
	public function connectResponseAction() {
		$oAuthTokens = $this->sessionStorageAdapter->read('dropboxTokens');
		$this->oauth->setToken($oAuthTokens);
		$oAuthTokens = $this->oauth->getAccessToken();

		if(is_array($oAuthTokens)) {
			$this->registry->set('tx_dlDropbox', 'oauth_tokens', $oAuthTokens);
			$this->view->assign('successfullyAuthenticated', true);
		}
	}


	/**
	 * Disconnect the dropbox by removing the oAuth secret from the registry
	 */
	public function disconnectDropboxAction() {
		$this->registry->remove('tx_dlDropbox','oauth_tokens');
		$this->flashMessageContainer->add('The dropbox was successfully disconnected.', 'Dropbox disconnected!', t3lib_FlashMessage::OK);
		$this->forward('show', 'Sync');
	}
}
?>