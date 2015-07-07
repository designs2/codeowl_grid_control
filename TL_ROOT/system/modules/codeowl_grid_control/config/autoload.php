<?php
/** 
 * Extension for Contao Open Source CMS
 *
 * Copyright (C) 2015 Monique Hahnefeld
 *
 * @package codeowl_grid_control
 * @author  Monique Hahnefeld <info@monique-hahnefeld.de>
 * @link    http://codeowl.org
 * @license LGPLv3
 *
 * `-,-´
 *	( )  codeowl.org
 *************************/


// `-,-´ Register the namespaces
ClassLoader::addNamespaces(array
(
	'Contao',
	'Codeowl',
));

// `-,-´ Register the classes
ClassLoader::addClasses(array
(
	// `-,-´ HOOKs
	'Codeowl\OutputGridVars' => 'system/modules/codeowl_grid_control/classes/OutputGridVars.php',
	'Codeowl\PrepareWidgets' => 'system/modules/codeowl_grid_control/classes/PrepareWidgets.php',
	'Codeowl\Callbacks' => 'system/modules/codeowl_grid_control/classes/Callbacks.php',
	// `-,-´ Elements row
	'Codeowl\ContentRowStart'  => 'system/modules/codeowl_grid_control/elements/row/ContentRowStart.php',
	'Codeowl\ContentRowStop'  => 'system/modules/codeowl_grid_control/elements/row/ContentRowStop.php',
	// `-,-´ Elements col
	'Codeowl\ContentColStart'  => 'system/modules/codeowl_grid_control/elements/col/ContentColStart.php',
	'Codeowl\ContentColStop'  => 'system/modules/codeowl_grid_control/elements/col/ContentColStop.php',
	
	// `-,-´ Form Elements FTC
	'Codeowl\FormRowStart'  => 'system/modules/codeowl_grid_control/forms/FormRowStart.php',
	'Codeowl\FormRowStop'  => 'system/modules/codeowl_grid_control/forms/FormRowStop.php',
			
));

// `-,-´ Register the templates
TemplateLoader::addFiles(array
(	
	// `-,-´ grid control only	
	'fe_page_gc' => 'system/modules/codeowl_grid_control/templates/frontend',
	// `-,-´ block
	'block_searchable_ftc' => 'system/modules/codeowl_grid_control/templates/block',
	'block_unsearchable_ftc' => 'system/modules/codeowl_grid_control/templates/block',
	// `-,-´ forms
	'form_ftc' => 'system/modules/codeowl_grid_control/templates/forms',
	// `-,-´ grid
	'ce_row_start' => 'system/modules/codeowl_grid_control/templates/row',
	'ce_row_stop' => 'system/modules/codeowl_grid_control/templates/row',
	'ce_col_start' => 'system/modules/codeowl_grid_control/templates/col',
	'ce_col_stop' => 'system/modules/codeowl_grid_control/templates/col',
	
	// `-,-´ content article
	'ce_teaser_ftc' => 'system/modules/codeowl_grid_control/templates/content',
	'ce_text_ftc' => 'system/modules/codeowl_grid_control/templates/content',
	'ce_list_ftc' => 'system/modules/codeowl_grid_control/templates/content',
	'ce_headline_ftc' => 'system/modules/codeowl_grid_control/templates/content',
	'ce_image_ftc' => 'system/modules/codeowl_grid_control/templates/media',
	// `-,-´ forms
	'form_select_ftc' => 'system/modules/codeowl_grid_control/templates/forms',
	'form_upload_ftc' => 'system/modules/codeowl_grid_control/templates/forms',
	'form_checkbox_ftc' => 'system/modules/codeowl_grid_control/templates/forms',
	'form_explanation_ftc' => 'system/modules/codeowl_grid_control/templates/forms',
	'form_fieldset_ftc' => 'system/modules/codeowl_grid_control/templates/forms',
	'form_headline_ftc' => 'system/modules/codeowl_grid_control/templates/forms',
	'form_password_ftc' => 'system/modules/codeowl_grid_control/templates/forms',
	'form_radio_ftc' => 'system/modules/codeowl_grid_control/templates/forms',
	'form_submit_ftc' => 'system/modules/codeowl_grid_control/templates/forms',
	'form_textarea_ftc' => 'system/modules/codeowl_grid_control/templates/forms',
	'form_textfield_ftc' => 'system/modules/codeowl_grid_control/templates/forms',
	'form_captcha_ftc' => 'system/modules/codeowl_grid_control/templates/forms',
	'form_message_ftc' => 'system/modules/codeowl_grid_control/templates/forms',
	// `-,-´ form grid
	'form_row_start' => 'system/modules/codeowl_grid_control/templates/forms',
	'form_row_stop' => 'system/modules/codeowl_grid_control/templates/forms',
));
