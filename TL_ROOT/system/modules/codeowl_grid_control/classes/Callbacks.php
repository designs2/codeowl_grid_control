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

namespace Codeowl;

class Callbacks extends \Backend
{
	// `-,-´ Add fields to palettes
	public function content_onload($dc) 
	{
		 $co_grid = \Config::get('co_grid_wizard_palette_ext');
		 $palettes  = $GLOBALS['TL_DCA'][$dc->table]['palettes'];
		 $exception = array('row_start','row_stop','col_stop','accordionStop','sliderStop','tab_ftc_start_inside','html');

		 foreach ($palettes as $p => $str) {
		 	if (in_array($p,$exception)){continue;}
		 	if ($p == 'list') {
		 		 $str 	   = str_replace("listitems","listitems,list_style_type",$str);	
		 	}
		 	$pallete_co    = str_replace("{type_legend}",$co_grid."{type_legend}",$str);
		 	$GLOBALS['TL_DCA'][$dc->table]['palettes'][$p] = $pallete_co;
		 }
	}

	// `-,-´ Add fields to palettes
	public function formfield_onload($dc) 
	{
		 $palettes = $GLOBALS['TL_DCA']['tl_form_field']['palettes'];
		 $exception = array('row_start','row_stop','col_stop','fieldsetfsStart','fieldsetfsStop','html','submit');
		 $need_no_labelstyle = array('checkbox', 'radio', 'upload', 'hidden','explanation','headline','captcha');
		 foreach ($palettes as $p => $str) {
		 	if (in_array($p,$exception)){continue;}
		 	if (in_array($p,$need_no_labelstyle)){
		 		$co_grid = "{ftc_legend},ftc_preset_id,ftc_preset_full,label_classes;";
		 	}else{
		 		$co_grid = "{ftc_legend},ftc_preset_id,ftc_preset_full,label_classes;{fix_legend},label_role,ftc_preset_id_label,ftc_preset_full_label,post_pre_fix;";
		 	}
		 	$pallete_co = str_replace("{type_legend}",$co_grid."{type_legend}",$str);
		 	$GLOBALS['TL_DCA']['tl_form_field']['palettes'][$p]=$pallete_co;
		 }
	}	
	
}
?>
