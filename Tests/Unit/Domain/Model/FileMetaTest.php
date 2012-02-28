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

/**
 * Test case for class Tx_DlDropboxsync_Domain_Model_FileMeta.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Dropbox Sync
 *
 * @author Daniel Lienert <daniel@lienert.cc>
 */
class Tx_DlDropboxsync_Domain_Model_FileMetaTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_DlDropboxsync_Domain_Model_FileMeta
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_DlDropboxsync_Domain_Model_FileMeta();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getMimeTypeReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setMimeTypeForStringSetsMimeType() { 
		$this->fixture->setMimeType('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getMimeType()
		);
	}
	
	/**
	 * @test
	 */
	public function getModifiedReturnsInitialValueForInt() { }

	/**
	 * @test
	 */
	public function setModifiedForIntSetsModified() { }
	
	/**
	 * @test
	 */
	public function getRemotePathReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setRemotePathForStringSetsRemotePath() { 
		$this->fixture->setRemotePath('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getRemotePath()
		);
	}
	
	/**
	 * @test
	 */
	public function getRevReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setRevForStringSetsRev() { 
		$this->fixture->setRev('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getRev()
		);
	}
	
	/**
	 * @test
	 */
	public function getBytesReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setBytesForStringSetsBytes() { 
		$this->fixture->setBytes('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getBytes()
		);
	}
	
	/**
	 * @test
	 */
	public function getLastSynchedReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setLastSynchedForStringSetsLastSynched() { 
		$this->fixture->setLastSynched('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getLastSynched()
		);
	}
	
	/**
	 * @test
	 */
	public function getLocalPathReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setLocalPathForStringSetsLocalPath() { 
		$this->fixture->setLocalPath('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getLocalPath()
		);
	}
	
	/**
	 * @test
	 */
	public function getLocalHashReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setLocalHashForStringSetsLocalHash() { 
		$this->fixture->setLocalHash('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getLocalHash()
		);
	}
	
	/**
	 * @test
	 */
	public function getSyncConfigurationReturnsInitialValueForTx_DlDropboxsync_Domain_Model_SyncConfiguration() { }

	/**
	 * @test
	 */
	public function setSyncConfigurationForTx_DlDropboxsync_Domain_Model_SyncConfigurationSetsSyncConfiguration() { }
	
}
?>