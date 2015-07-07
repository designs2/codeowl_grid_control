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

if ($wizardFields===NULL) {
	$wizardFields = new \Codeowl\DCA;
	$wizardFields->insert_wizard_fields('tl_content'); 
}
$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = array('Codeowl\Callbacks','content_onload');

$fieldsSize=count($GLOBALS['TL_DCA']['tl_content']['fields'])-1;
$palettesSize=count($palettes)-1;
$default = '{type_legend},type,headline;';
$expert ='{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';


// `-,-´ add palettes for contentelements
array_insert($GLOBALS['TL_DCA']['tl_content']['palettes'], $palettesSize, array
(
	'row_start'        => '{type_legend},type,headline,cssID,row_data_attr_ftc',
	'row_stop'         => '{type_legend},type;'.$expert,

	'col_start'        => '{type_legend},type,headline;'.$expert,
	'col_stop'         => '{type_legend},type;'.$expert,
  
));
  
  // `-,-´ selector
  array_insert($GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'] ,1,array('ftc_preset_add_custom')); 
  // `-,-´ add subpalletes
  $subpalettes = $GLOBALS['TL_DCA']['tl_content']['subpalettes'];
  $subpalettesSize=count($subpalettes)-1;
  // `-,-´ add palettes for contentelements
  array_insert($GLOBALS['TL_DCA']['tl_content']['subpalettes'], $subpalettesSize, array
  (
  	'ftc_preset_add_custom' =>'ftc_preset_custom',  
  ));
  
  
  array_insert($GLOBALS['TL_DCA']['tl_content']['fields'], $fieldsSize, array
	(
	   'data_attr_ftc' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_content']['data_attr_ftc'],
			'default'                 => '',
			'options'=>array(' ','data-equalizer-watch'),
			'exclude'                 => true,
			
			'inputType'               => 'select',
			'reference'               => &$GLOBALS['TL_LANG']['tl_content']['data_attr_ftc_options'],
			'eval'                    => array('multiple'=>true,'helpwizard'=>false, 'chosen'=>false, 'submitOnChange'=>false, 'tl_class'=>'w50 m12'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'row_data_attr_ftc' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_content']['row_data_attr_ftc'],
			'default'                 => '',
			'options'=>array(' ','data-equalizer'),
			'exclude'                 => true,

			'inputType'               => 'select',
			'reference'               => &$GLOBALS['TL_LANG']['tl_content']['row_data_attr_ftc_options'],
			'eval'                    => array('multiple'=>true,'helpwizard'=>false, 'chosen'=>false, 'submitOnChange'=>false, 'tl_class'=>'w50 m12'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		)
   
  ));
	  
?>