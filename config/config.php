<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @package   bdf
 * @author    Frank Hoppe
 * @license   GNU/LGPL
 * @copyright Frank Hoppe 2014
 */

/**
 * Backend-Bereich DSB anlegen, wenn noch nicht vorhanden
 */
if(!$GLOBALS['BE_MOD']['dsb']) 
{
	$dsb = array(
		'dsb' => array()
	);
	array_insert($GLOBALS['BE_MOD'], 0, $dsb);
}

$GLOBALS['BE_MOD']['dsb']['ergebnisdienst'] = array
(
	'tables'         => array
	(
		'tl_ergebnisdienst', 
		'tl_ergebnisdienst_staffeln',
		'tl_ergebnisdienst_mannschaften',
		'tl_ergebnisdienst_spieler',
		'tl_ergebnisdienst_paarungen'
	),
	'icon'           => 'system/modules/ergebnisdienst/assets/images/icon.png',
);

/**
 * Frontend-Module
 */
$GLOBALS['FE_MOD']['schach']['ergebnisdienst'] = 'SaisonView';  

/**
 * Add permissions
 */
$GLOBALS['TL_PERMISSIONS'][] = 'ergebnisdienst_saisons'; // Erlaubte Saisons
$GLOBALS['TL_PERMISSIONS'][] = 'ergebnisdienst_saisonrechte'; // Saisonrechte
$GLOBALS['TL_PERMISSIONS'][] = 'ergebnisdienst_ligen'; // Erlaubte Ligen
