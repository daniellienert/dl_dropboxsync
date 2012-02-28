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
 * Test case for class Tx_DlDropboxsync_Domain_Model_SyncConfiguration.
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
class Tx_DlDropboxsync_Domain_Model_SyncConfigurationTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_DlDropboxsync_Domain_Model_SyncConfiguration
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_DlDropboxsync_Domain_Model_SyncConfiguration();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getIdentifierReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setIdentifierForStringSetsIdentifier() { 
		$this->fixture->setIdentifier('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getIdentifier()
		);
	}
	
	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() { 
		$this->fixture->setDescription('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDescription()
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
	public function getTypeReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getType()
		);
	}

	/**
	 * @test
	 */
	public function setTypeForIntegerSetsType() { 
		$this->fixture->setType(12);

		$this->assertSame(
			12,
			$this->fixture->getType()
		);
	}
	
	/**
	 * @test
	 */
	public function getLastSyncReturnsInitialValueForDateTime() { }

	/**
	 * @test
	 */
	public function setLastSyncForDateTimeSetsLastSync() { }
	
}
?>