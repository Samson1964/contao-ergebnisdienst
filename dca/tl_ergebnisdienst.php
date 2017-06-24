<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package News
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Table tl_ergebnisdienst
 */
$GLOBALS['TL_DCA']['tl_ergebnisdienst'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_ergebnisdienst_staffeln'),
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id'    => 'primary',
			)
		),
		'onload_callback' => array
		(
			array('tl_ergebnisdienst', 'checkPermission')
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 2,
			'fields'                  => array('toYear', 'fromYear'),
			'flag'                    => 12,
			'panelLayout'             => 'filter;sort,search,limit'
		),
		'label' => array
		(
			'fields'                  => array('title', 'fromYear', 'toYear'),
			'showColumns'             => true,
			'format'                  => '%s'
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_ergebnisdienst']['edit'],
				'href'                => 'table=tl_ergebnisdienst_staffeln',
				'icon'                => 'edit.gif',
			),
			'editHeader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_ergebnisdienst']['editHeader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
				'button_callback'     => array('tl_ergebnisdienst', 'generateEditheaderButton')
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_ergebnisdienst']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif',
				'button_callback'     => array('tl_ergebnisdienst', 'generateCopyButton')
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_ergebnisdienst']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
				'button_callback'     => array('tl_ergebnisdienst', 'generateDeleteButton')
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_ergebnisdienst']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_ergebnisdienst', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_ergebnisdienst']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif',
				'button_callback'     => array('tl_ergebnisdienst', 'generateShowButton')
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{title_legend},title;{year_legend},fromYear,toYear;{publish_legend},published'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_ergebnisdienst']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => true,
				'tl_class'            => 'w50',
				'maxlength'           => 255
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'fromYear' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_ergebnisdienst']['fromYear'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => true,
				'maxlength'           => 4,
				'tl_class'            => 'w50',
				'rgxp'                => 'digit'
			),
			'load_callback'           => array
			(
				array('tl_ergebnisdienst', 'getYear')
			),
			'save_callback' => array
			(
				array('tl_ergebnisdienst', 'putYear')
			),
			'sql'                     => "int(4) unsigned NOT NULL default '0'"
		),
		'toYear' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_ergebnisdienst']['toYear'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => true,
				'maxlength'           => 4,
				'tl_class'            => 'w50',
				'rgxp'                => 'digit'
			),
			'load_callback'           => array
			(
				array('tl_ergebnisdienst', 'getYear')
			),
			'save_callback' => array
			(
				array('tl_ergebnisdienst', 'putYear')
			),
			'sql'                     => "int(4) unsigned NOT NULL default '0'"
		),
		// Saison veröffentlicht
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_ergebnisdienst']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'inputType'               => 'checkbox',
			'eval'                    => array
			(
				'doNotCopy'           => true
			),
			'sql'                     => "char(1) NOT NULL default ''"
		),
	)
);


/**
 * Class tl_ergebnisdienst
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2014
 * @author     Leo Feyer <https://contao.org>
 * @package    News
 */
class tl_ergebnisdienst extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	/**
	 * Berechtigungen zum Bearbeiten der Tabelle tl_ergebnisdienst prüfen
	 */
	public function checkPermission()
	{

		if($this->User->isAdmin)
		{
			// Admin darf alles
			return;
		}
		
		echo "<pre>";
		echo "ergebnisdienst_saisons\n"; print_r($this->User->ergebnisdienst_saisons);
		echo "ergebnisdienst_rechte\n"; print_r($this->User->ergebnisdienst_rechte);
		echo "ergebnisdienst_ligen\n"; print_r($this->User->ergebnisdienst_ligen);
		echo "</pre>";

		if(!$this->User->hasAccess('create', 'ergebnisdienst_saisonrechte'))
		{
			// Hinzufügen-Button entfernen
			$GLOBALS['TL_DCA']['tl_ergebnisdienst']['config']['closed'] = true;
		}

		// Alle nicht zugewiesenen Datensätze entfernen
		if(!is_array($this->User->ergebnisdienst_saisons) || empty($this->User->ergebnisdienst_saisons))
		{
			$root = array(0); // Erlaubte Datensätze: keine
		}
		else
		{
			$root = $this->User->ergebnisdienst_saisons; // Erlaubte Saison-ID's übernehmen
		}
		$GLOBALS['TL_DCA']['tl_ergebnisdienst']['list']['sorting']['root'] = $root;

		// Aktuelle Aktion prüfen
		switch (Input::get('act'))
		{
			case 'create': // Datensatz anlegen
				if (!strlen(Input::get('pid')) || !in_array(Input::get('pid'), $root))
				{
					$this->log('Not enough permissions to create news items in season ID "'.Input::get('pid').'"', __METHOD__, TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}
				break; 

			case 'select': // Immer erlaubt
				break; 

			case 'cut':
			case 'copy':
				if (!in_array(Input::get('pid'), $root))
				{
					$this->log('Not enough permissions to '.Input::get('act').' league ID "'.$id.'" to season ID "'.Input::get('pid').'"', __METHOD__, TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}
				break; 
				
			case 'show': // Infobox
				if(!$this->User->hasAccess('show', 'ergebnisdienst_saisonrechte'))
				{
					$this->log('Not enough permissions to '.Input::get('act').' to season ID "'.Input::get('id').'"', __METHOD__, TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}
				break;

			case 'edit': // Editheader
		 		if(count(preg_grep('/^tl_ergebnisdienst::/', $this->User->alexf)) == 0)
				{
					$this->log('Not enough permissions to '.Input::get('act').' Ergebnisdienst', __METHOD__, TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}
				break; 

			case 'editAll': // Mehrere bearbeiten
			case 'deleteAll': // Mehrere löschen
			case 'overrideAll':
				$session = $this->Session->getData();
				if (Input::get('act') == 'deleteAll' && !$this->User->hasAccess('delete', 'ergebnisdienst_saisons'))
				{
					$session['CURRENT']['IDS'] = array();
				}
				else
				{
					$session['CURRENT']['IDS'] = array_intersect($session['CURRENT']['IDS'], $root);
				}
				$this->Session->setData($session);
				break; 

			default: // Zugriff verweigern bei jeder anderen Aktion
				if (strlen(Input::get('act')))
				{
					$this->log('Not enough permissions to '.Input::get('act').' Ergebnisdienst', __METHOD__, TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}
				break; 
		}

	}

	/**
	 * Return the edit header button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function generateEditheaderButton($row, $href, $label, $title, $icon, $attributes)
	{
		// Rechteprüfung für Bearbeitung der Saison-Einstellung
		// 1) Admin?
		// 2) Benutzer/Benutzergruppe: Irgendein Feld in tl_ergebnisdienst erlaubt? 
 		// Prüfung $this->User->hasAccess('editheader', 'ergebnisdienst_saisonrechte') wegen 2) unnötig
 		return ($this->User->isAdmin || count(preg_grep('/^tl_ergebnisdienst::/', $this->User->alexf)) > 0) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
	}

 /**
	 * Return the copy archive button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function generateCopyButton($row, $href, $label, $title, $icon, $attributes)
	{
		return ($this->User->isAdmin || $this->User->hasAccess('copy', 'ergebnisdienst_saisonrechte')) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
	}


	/**
	 * Return the delete archive button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function generateDeleteButton($row, $href, $label, $title, $icon, $attributes)
	{
		return ($this->User->isAdmin || $this->User->hasAccess('delete', 'ergebnisdienst_saisonrechte')) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
	}


	/**
	 * Return the show button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function generateShowButton($row, $href, $label, $title, $icon, $attributes)
	{
		return ($this->User->isAdmin || $this->User->hasAccess('show', 'ergebnisdienst_saisonrechte')) ? '<a onclick="Backend.openModalIframe({\'width\':768,\'title\':\'Details anzeigen\',\'url\':this.href});return false" href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'&amp;popup=1" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml('system/modules/ergebnisdienst/assets/images/show_.gif').' ';
	}

	/**
	 * Return the "toggle visibility" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		$this->import('BackendUser', 'User');
		
		if (strlen($this->Input->get('tid')))
		{
			$this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 0));
			$this->redirect($this->getReferer());
		}
		
		// Check permissions AFTER checking the tid, so hacking attempts are logged
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_ergebnisdienst::published', 'alexf'))
		{
			return '';
		}
		
		$href .= '&amp;id='.$this->Input->get('id').'&amp;tid='.$row['id'].'&amp;state='.$row[''];
		
		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}
		
		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}

	/**
	 * Disable/enable a user group
	 * @param integer
	 * @param boolean
	 */
	public function toggleVisibility($intId, $blnPublished)
	{
		// Check permissions to publish
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_ergebnisdienst::published', 'alexf'))
		{
			$this->log('Not enough permissions to show/hide record ID "'.$intId.'"', 'tl_ergebnisdienst toggleVisibility', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		$this->createInitialVersion('tl_ergebnisdienst', $intId);

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_ergebnisdienst']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_ergebnisdienst']['fields']['published']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnPublished = $this->$callback[0]->$callback[1]($blnPublished, $this);
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_ergebnisdienst SET tstamp=". time() .", published='" . ($blnPublished ? '' : '1') . "' WHERE id=?")
			->execute($intId);
		$this->createNewVersion('tl_ergebnisdienst', $intId);
	}

	/**
	 * Jahreswert aus Datenbank umwandeln
	 * @param mixed
	 * @return mixed
	 */
	public function getYear($varValue)
	{
		if($varValue == 0) return '';
		else return $varValue;
	}

	/**
	 * Jahreswert für Datenbank umwandeln
	 * @param mixed
	 * @return mixed
	 */
	public function putYear($varValue)
	{
		return $varValue + 0;
	}

	public function getLigastatus($saison_id)
	{
		static $geladen, $ligarechte;

		if(!$geladen)
		{
			$geladen = true;
			$ligarechte = array();
			$objLigen = \Database::getInstance()->prepare("SELECT * FROM tl_ergebnisdienst_staffeln")
			                                    ->execute();
			if($objLigen->numRows)
			{
				while($objLigen->next())
				{
					$ligarechte[$objLigen->id] = $objLigen->pid;
				}
			}
		}

		// Prüfen ob die Saison-ID in den Ligarechten vorkommt
		foreach($this->User->ergebnisdienst_ligen as $liga)
		{
			if($ligarechte[$liga] == $saison_id) return true;
		}

		return false;

	}
}
