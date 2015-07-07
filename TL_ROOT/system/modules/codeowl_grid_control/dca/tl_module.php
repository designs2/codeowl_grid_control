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
$default = '{title_legend},name,headline,type;';
$expert ='{template_legend:hide},navigationTpl,customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';


// `-,-´ selector
array_insert($GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'] ,1,array('ftc_preset_add_custom'));//'top_bar',
 
// `-,-´ subpalettes
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['ftc_preset_add_custom']='ftc_preset_custom';


$palettes = $GLOBALS['TL_DCA']['tl_module']['palettes'];
foreach ($palettes as $p => $str) {
	 $pallete_co = str_replace("{title_legend}",$co_grid."{title_legend}",$str);
	 $GLOBALS['TL_DCA']['tl_module']['palettes'][$p]=$pallete_co;
}

if ($wizardFields===NULL) {
	$wizardFields = new \Codeowl\DCA;
	$wizardFields->insert_wizard_fields('tl_module'); 
}


?>