<?php
/**
 * Avatar for Contao Open Source CMS
 *
 * Copyright (C) 2013 Kirsten Roschanski
 * Copyright (C) 2013 Tristan Lins <http://bit3.de>
 *
 * @package    Avatar
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * Add palette to tl_module
 */

$GLOBALS['TL_DCA']['tl_module']['palettes']['ergebnisdienst'] = '{title_legend},name,headline,type;{config_legend},ergebnisdienst_saison,ergebnisdienst_staffel;{protected_legend:hide},protected;{expert_legend:hide},cssID,align,space';

$GLOBALS['TL_DCA']['tl_module']['fields']['ergebnisdienst_saison'] = array
(
	'label'                    => &$GLOBALS['TL_LANG']['tl_module']['ergebnisdienst_saison'],
	'exclude'                  => true,
	'inputType'                => 'select',
	'options_callback'         => array('tl_module_ergebnisdienst', 'getSaison'),
	'reference'                => &$GLOBALS['TL_LANG']['tl_ergebnisdienst'],
	'eval'                     => array
	(
		'tl_class'             => 'w50',
		'mandatory'            => true,
		'includeBlankOption'   => true, 
		'submitOnChange'       => true, 
		'allowHtml'            => true, 
		'chosen'               => true
	),
	'sql'                      => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['ergebnisdienst_staffel'] = array
(
	'label'                    => &$GLOBALS['TL_LANG']['tl_module']['ergebnisdienst_staffel'],
	'exclude'                  => true,
	'inputType'                => 'select',
	'options_callback'         => array('tl_module_ergebnisdienst', 'getStaffeln'),
	'reference'                => &$GLOBALS['TL_LANG']['tl_ergebnisdienst'],
	'eval'                     => array
	(
		'tl_class'             => 'w50',
		'mandatory'            => false,
		'includeBlankOption'   => true, 
		'allowHtml'            => true, 
		'chosen'               => true
	),
	'sql'                      => "int(10) unsigned NOT NULL default '0'"
);

/**
 * Class tl_module_fhcounter
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2014
 * @author     Leo Feyer <https://contao.org>
 * @package    Calendar
 */
class tl_module_ergebnisdienst extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function getSaison()
	{
		// Heim-Spieler in Options-Array laden
		$objSaison = $this->Database->prepare("SELECT id, title, published FROM tl_ergebnisdienst ORDER BY toYear DESC")
		                            ->execute();
		$array = array();
		
		while($objSaison->next())
		{
			if($objSaison->published) $array[$objSaison->id] = $objSaison->title;
			else $array[$objSaison->id] = '<i>' . $objSaison->title . '</i> [unveröffentlicht]';
		}

		return $array;
	}

	public function getStaffeln(Datacontainer $dc)
	{
		$array = array();

		//echo "<pre>";
		//print_r($dc);
		//echo "</pre>";
		
		if($dc->activeRecord->ergebnisdienst_saison)
		{
			// Heim-Spieler in Options-Array laden
			$objStaffel = $this->Database->prepare("SELECT id, title, published FROM tl_ergebnisdienst_staffeln WHERE pid=? ORDER BY league AND title ASC")
										->execute($dc->activeRecord->ergebnisdienst_saison);
			while($objStaffel->next())
			{
				if($objStaffel->published) $array[$objStaffel->id] = $objStaffel->title;
				else $array[$objStaffel->id] = '<i>' . $objStaffel->title . '</i> [unveröffentlicht]';
			}
		}

		return $array;
	}

}
