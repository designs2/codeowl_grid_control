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

$co_grid = Config::get('co_grid_wizard_palette');
 
 
 $palettes = $GLOBALS['TL_DCA']['tl_article']['palettes']['default'];
 array_push($GLOBALS['TL_DCA']['tl_article']['palettes']['__selector__'],'ftc_preset_add_custom');
 $GLOBALS['TL_DCA']['tl_article']['subpalettes']['ftc_preset_add_custom'] = 'ftc_preset_custom';
 $pallete_co = str_replace("{teaser_legend:hide}",$co_grid."{teaser_legend:hide}",$palettes);//,add_ftc_settings
 $fieldsSize = count($GLOBALS['TL_DCA']['tl_article']['fields'])-1;

 
$GLOBALS['TL_DCA']['tl_article']['palettes']['default'] = $pallete_co;
if ($wizardFields===NULL) {
	$wizardFields = new \Codeowl\DCA;
	$wizardFields->insert_wizard_fields('tl_article'); 
}
	  
?>