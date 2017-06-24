<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 */

/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
    'Samson',
)); 

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	//'SaisonView'    => 'system/modules/ergebnisdienst/classes/SaisonView.php',
	'Samson\Ergebnisdienst\Funktionen'    => 'system/modules/ergebnisdienst/include/Funktionen.php',
));

/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_ergebnisdienst'                  => 'system/modules/ergebnisdienst/templates',
	'ergebnisdienst_view'                => 'system/modules/ergebnisdienst/templates',
)); 
