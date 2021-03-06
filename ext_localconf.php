<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010-2011 Michael Knoll <mimi@kaktusteam.de>, MKLV GbR
*            
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
 * Configuration file for YAG gallery
 * 
 * @author Michael Knoll <mimi@kaktusteam.de>
 * @author Daniel Lienert <daniel@lienert.cc>
 */

if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

	$TYPO3_CONF_VARS['SC_OPTIONS']['scheduler']['tasks']['Tx_DlDropboxsync_Scheduler_Synchronisation'] = array(
		'extension' => $_EXTKEY,
		'title' => 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/locallang.xml:tx_dldropboxsync_scheduler.name',
		'description' => 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/locallang.xml:tx_dldropboxsync_scheduler.description',
	);

?>