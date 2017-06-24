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
 * Table tl_ergebnisdienst_staffeln
 */
$GLOBALS['TL_DCA']['tl_ergebnisdienst_staffeln'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_ergebnisdienst',
		'ctable'                      => 'tl_ergebnisdienst_mannschaften',
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid' => 'index',
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('title ASC'),
			'headerFields'            => array('title'),
			'panelLayout'             => 'filter;sort,search,limit',
			'child_record_callback'   => array('tl_ergebnisdienst_staffeln', 'listStaffeln'),  
			'disableGrouping'         => true
		),
		'label' => array
		(
			'format'                  => '%s',
			//'group_callback'          => array('tl_ergebnisdienst_staffeln', 'groupFormat')
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
				'label'               => &$GLOBALS['TL_LANG']['tl_ergebnisdienst_staffeln']['edit'],
				'href'                => 'table=tl_ergebnisdienst_mannschaften',
				'icon'                => 'edit.gif'
			),
			'editHeader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_ergebnisdienst_staffeln']['editHeader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
				'button_callback'     => array('tl_ergebnisdienst_staffeln', 'generateEditheaderButton')
			), 
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_ergebnisdienst_staffeln']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif',
				'button_callback'     => array('tl_ergebnisdienst_staffeln', 'generateCopyButton')
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_ergebnisdienst_staffeln']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif',
				'button_callback'     => array('tl_ergebnisdienst_staffeln', 'generateCutButton')
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_ergebnisdienst_staffeln']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
				'button_callback'     => array('tl_ergebnisdienst_staffeln', 'generateDeleteButton')
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_ergebnisdienst_staffeln']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_ergebnisdienst_staffeln', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_ergebnisdienst_staffeln']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif',
				'button_callback'     => array('tl_ergebnisdienst_staffeln', 'generateShowButton')
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{title_legend},title;{settings_legend},up,down,pointsWin,pointsDraw,boards,modus;{publish_legend},published'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'foreignKey'              => 'tl_ergebnisdienst.title',
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'belongsTo', 'load'=>'eager')
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_ergebnisdienst_staffeln']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => true, 
				'maxlength'           => 255, 
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'up' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_ergebnisdienst_staffeln']['up'],
			'exclude'                 => true,
			'search'                  => true,
			'default'                 => 1,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'maxlength'           => 1,
				'tl_class'            => 'w50',
				'rgxp'                => 'digit'
			),
			'load_callback'           => array
			(
				array('tl_ergebnisdienst_staffeln', 'getNumber')
			),
			'save_callback' => array
			(
				array('tl_ergebnisdienst_staffeln', 'putNumber')
			),
			'sql'                     => "int(1) unsigned NOT NULL default '0'"
		), 
		'down' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_ergebnisdienst_staffeln']['down'],
			'exclude'                 => true,
			'search'                  => true,
			'default'                 => 2,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'maxlength'           => 1,
				'tl_class'            => 'w50',
				'rgxp'                => 'digit'
			),
			'load_callback'           => array
			(
				array('tl_ergebnisdienst_staffeln', 'getNumber')
			),
			'save_callback' => array
			(
				array('tl_ergebnisdienst_staffeln', 'putNumber')
			),
			'sql'                     => "int(1) unsigned NOT NULL default '0'"
		), 
		'pointsWin' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_ergebnisdienst_staffeln']['pointsWin'],
			'exclude'                 => true,
			'search'                  => true,
			'default'                 => 2,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'maxlength'           => 1,
				'tl_class'            => 'w50',
				'rgxp'                => 'digit'
			),
			'load_callback'           => array
			(
				array('tl_ergebnisdienst_staffeln', 'getNumber')
			),
			'save_callback' => array
			(
				array('tl_ergebnisdienst_staffeln', 'putNumber')
			),
			'sql'                     => "int(1) unsigned NOT NULL default '0'"
		), 
		'pointsDraw' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_ergebnisdienst_staffeln']['pointsDraw'],
			'exclude'                 => true,
			'search'                  => true,
			'default'                 => 1,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'maxlength'           => 1,
				'tl_class'            => 'w50',
				'rgxp'                => 'digit'
			),
			'load_callback'           => array
			(
				array('tl_ergebnisdienst_staffeln', 'getNumber')
			),
			'save_callback' => array
			(
				array('tl_ergebnisdienst_staffeln', 'putNumber')
			),
			'sql'                     => "int(1) unsigned NOT NULL default '0'"
		), 
		'boards' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_ergebnisdienst_staffeln']['boards'],
			'exclude'                 => true,
			'search'                  => false,
			'default'                 => 8,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'maxlength'           => 2,
				'tl_class'            => 'w50',
				'rgxp'                => 'digit'
			),
			'load_callback'           => array
			(
				array('tl_ergebnisdienst_staffeln', 'getNumber')
			),
			'save_callback' => array
			(
				array('tl_ergebnisdienst_staffeln', 'putNumber')
			),
			'sql'                     => "int(2) unsigned NOT NULL default '0'"
		), 
		'modus' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_ergebnisdienst_staffeln']['modus'],
			'exclude'                 => true,
			'filter'                  => false,
			'inputType'               => 'select',
			'options'                 => $GLOBALS['TL_LANG']['tl_ergebnisdienst_staffeln']['modis'], 
			'eval'                    => array
			(
				'doNotCopy'           => true,
				'tl_class'            => 'long clr',
			),
			'sql'                     => "char(5) NOT NULL default ''"
		), 
		// Staffel ver�ffentlicht
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_ergebnisdienst_staffeln']['published'],
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
 * Class tl_ergebnisdienst_staffeln
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2014
 * @author     Leo Feyer <https://contao.org>
 * @package    News
 */
class tl_ergebnisdienst_staffeln extends Backend
{

	var $nummer = 0;
	
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	/**
	 * Berechtigungen zum Bearbeiten der Tabelle tl_ergebnisdienst pr�fen
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
		echo "ergebnisdienst_saisonrechte\n"; print_r($this->User->ergebnisdienst_saisonrechte);
		echo "ergebnisdienst_ligen\n"; print_r($this->User->ergebnisdienst_ligen);
		echo "ergebnisdienst_ligenrechte\n"; print_r($this->User->ergebnisdienst_ligenrechte);
		echo "</pre>";

		if(!$this->User->hasAccess('create', 'ergebnisdienst_ligenrechte'))
		{
			// Hinzuf�gen-Button entfernen
			$GLOBALS['TL_DCA']['tl_ergebnisdienst_staffeln']['config']['closed'] = true;
		}

		// Alle nicht zugewiesenen Datens�tze entfernen
		if(!is_array($this->User->ergebnisdienst_ligen) || empty($this->User->ergebnisdienst_ligen))
		{
			$root = array(0); // Erlaubte Datens�tze: keine
		}
		else
		{
			$root = $this->User->ergebnisdienst_ligen; // Erlaubte Ligen-ID's �bernehmen
		}
		$GLOBALS['TL_DCA']['tl_ergebnisdienst_staffeln']['list']['sorting']['root'] = $root;

		// Aktuelle Aktion pr�fen
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
			case 'deleteAll': // Mehrere l�schen
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
		// Rechtepr�fung f�r Bearbeitung der Saison-Einstellung
		// 1) Admin?
		// 2) Benutzer/Benutzergruppe: Irgendein Feld in tl_ergebnisdienst erlaubt? 
 		// Pr�fung $this->User->hasAccess('editheader', 'ergebnisdienst_saisonrechte') wegen 2) unn�tig
 		return ($this->User->isAdmin || count(preg_grep('/^tl_ergebnisdienst_staffeln::/', $this->User->alexf)) > 0) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
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
		return ($this->User->isAdmin || $this->User->hasAccess('copy', 'ergebnisdienst_ligenrechte')) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
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
	public function generateCutButton($row, $href, $label, $title, $icon, $attributes)
	{
		return ($this->User->isAdmin || $this->User->hasAccess('cut', 'ergebnisdienst_ligenrechte')) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
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
		return ($this->User->isAdmin || $this->User->hasAccess('delete', 'ergebnisdienst_ligenrechte')) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
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
		return ($this->User->isAdmin || $this->User->hasAccess('show', 'ergebnisdienst_ligenrechte')) ? '<a onclick="Backend.openModalIframe({\'width\':768,\'title\':\'Details anzeigen\',\'url\':this.href});return false" href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'&amp;popup=1" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml('system/modules/ergebnisdienst/assets/images/show_.gif').' ';
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
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_ergebnisdienst_staffeln::published', 'alexf'))
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
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_ergebnisdienst_staffeln::published', 'alexf'))
		{
			$this->log('Not enough permissions to show/hide record ID "'.$intId.'"', 'tl_ergebnisdienst_staffeln toggleVisibility', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		$this->createInitialVersion('tl_ergebnisdienst_staffeln', $intId);

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_ergebnisdienst_staffeln']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_ergebnisdienst_staffeln']['fields']['published']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnPublished = $this->$callback[0]->$callback[1]($blnPublished, $this);
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_ergebnisdienst_staffeln SET tstamp=". time() .", published='" . ($blnPublished ? '' : '1') . "' WHERE id=?")
			->execute($intId);
		$this->createNewVersion('tl_ergebnisdienst_staffeln', $intId);
	}

	/**
	 * Return the link picker wizard
	 * @param \DataContainer
	 * @return string
	 */
	public function pagePicker(DataContainer $dc)
	{
		return ' <a href="contao/page.php?do=' . Input::get('do') . '&amp;table=' . $dc->table . '&amp;field=' . $dc->field . '&amp;value=' . str_replace(array('{{link_url::', '}}'), '', $dc->value) . '" title="' . specialchars($GLOBALS['TL_LANG']['MSC']['pagepicker']) . '" onclick="Backend.getScrollOffset();Backend.openModalSelector({\'width\':765,\'title\':\'' . specialchars(str_replace("'", "\\'", $GLOBALS['TL_LANG']['MOD']['page'][0])) . '\',\'url\':this.href,\'id\':\'' . $dc->field . '\',\'tag\':\'ctrl_'. $dc->field . ((Input::get('act') == 'editAll') ? '_' . $dc->id : '') . '\',\'self\':this});return false">' . Image::getHtml('pickpage.gif', $GLOBALS['TL_LANG']['MSC']['pagepicker'], 'style="vertical-align:top;cursor:pointer"') . '</a>';
	}

	public function listStaffeln($arrRow)
	{
		$temp = '<div class="tl_content_left">'.$arrRow['title'];
		return $temp.'</div>';
	}
  
	/**
	 * Zahl aus Datenbank umwandeln
	 * @param mixed
	 * @return mixed
	 */
	public function getNumber($varValue)
	{
		if($varValue == 0) return '';
		else return $varValue;
	}

	/**
	 * Zahl f�r Datenbank umwandeln
	 * @param mixed
	 * @return mixed
	 */
	public function putNumber($varValue)
	{
		return $varValue + 0;
	}

	/**
	 * Label in Liste formatieren
	 * @param mixed
	 * @return mixed
	 */
	public function groupFormat($group, $sortingMode, $firstOrderBy, $row, $dc)
	{
		return $group . '. Liga';
	}  
}
