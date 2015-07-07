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
 
 $paletteMain='{ftc_legend},ftc_preset_id_main,ftc_preset_full_main;';
 
 $palettes = $GLOBALS['TL_DCA']['tl_layout']['palettes']['default'];
 $palettes_ftc = str_replace("{title_legend}",$paletteMain."{title_legend}",$palettes);
 $GLOBALS['TL_DCA']['tl_layout']['palettes']['default'] = $palettes_ftc;
 
 $fieldsSize=count($GLOBALS['TL_DCA']['tl_layout']['fields'])-1;

// `-,-´ header,left,main,right,footer
// `-,-´ nur header
$GLOBALS['TL_DCA']['tl_layout']['subpalettes']['rows_2rwh']='ftc_preset_id_rwh,ftc_preset_full_rwh';
// `-,-´ nur footer
$GLOBALS['TL_DCA']['tl_layout']['subpalettes']['rows_2rwf']='ftc_preset_id_rwf,ftc_preset_full_rwf';
// `-,-´ header+footer
$GLOBALS['TL_DCA']['tl_layout']['subpalettes']['rows_3rw']='ftc_preset_id_rwh,ftc_preset_full_rwh,ftc_preset_id_rwf,ftc_preset_full_rwf';
// `-,-´ left
$GLOBALS['TL_DCA']['tl_layout']['subpalettes']['cols_2cll']='ftc_preset_id_cll,ftc_preset_full_cll';
// `-,-´ right
$GLOBALS['TL_DCA']['tl_layout']['subpalettes']['cols_2clr']='ftc_preset_id_clr,ftc_preset_full_clr';
// `-,-´ left+right
$GLOBALS['TL_DCA']['tl_layout']['subpalettes']['cols_3cl']='ftc_preset_id_cll,ftc_preset_full_cll,ftc_preset_id_clr,ftc_preset_full_clr';
//$GLOBALS['TL_DCA']['tl_layout']['subpalettes']['addFoundation']='FoundationJS,FTC_JS';


	  
	array_insert($GLOBALS['TL_DCA']['tl_layout']['fields'], $fieldsSize, array
	(
	// `-,-´ header
	'ftc_preset_id_rwh' => array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['ftc_preset_id_rwh'],
		'default'                 => '-',
		'exclude'                 => true,
		 'sorting' 				  => true,
		'filter'                  => true,
		'inputType'               => 'PresetsSelectWizard',	
		'options_callback'        => array('PresetsModel', 'getPresets'),
		'load_callback'			  => array(array('PresetsModel', 'getSelectedPreset')),
		'onsubmit_callback'		  => array(array('PresetsModel', 'getSelectedPreset')),
		'eval'                    => array('helpwizard'=>false, 'chosen'=>true, 'submitOnChange'=>true, 'tl_class'=>'clr long m12'),
		'sql'                     => "varchar(255) NOT NULL default '-'",
		'combined'				  => 'ftc_preset_full_rwh'
	),
	'ftc_preset_full_rwh' => array
	(
		'label'                   => &$GLOBALS['TL_LANG']['MSC']['ftc_preset_full'],

		'exclude'                 => true,
		'inputType'               => 'hidden',
		'eval'               => array('hideInput'=>	true, 'doNotShow' =>true),
		'sql'                     => "text NULL"
	),	   		
	// `-,-´ footer
   'ftc_preset_id_rwf' => array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['ftc_preset_id_rwf'],
		'default'                 => '-',
		'exclude'                 => true,
		 'sorting' 				  => true,
		'filter'                  => true,
		'inputType'               => 'PresetsSelectWizard',	
		'options_callback'        => array('PresetsModel', 'getPresets'),
		'load_callback'			  => array(array('PresetsModel', 'getSelectedPreset')),
		'onsubmit_callback'		  => array(array('PresetsModel', 'getSelectedPreset')),
		'eval'                    => array('helpwizard'=>false, 'chosen'=>true, 'submitOnChange'=>true, 'tl_class'=>'clr long m12'),
		'sql'                     => "varchar(255) NOT NULL default '-'",
		'combined'				  => 'ftc_preset_full_rwf'
	),
	'ftc_preset_full_rwf' => array
	(
		'label'                   => &$GLOBALS['TL_LANG']['MSC']['ftc_preset_full'],

		'exclude'                 => true,
		'inputType'               => 'hidden',
		'eval'               => array('hideInput'=>	true, 'doNotShow' =>true),
		'sql'                     => "text NULL"
	),	   			   		
	// `-,-´ end header+footer	  		   				   		
	// `-,-´ left
   	'ftc_preset_id_cll' => array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['ftc_preset_id_cll'],
		'default'                 => '-',
		'exclude'                 => true,
		 'sorting' 				  => true,
		'filter'                  => true,
		'inputType'               => 'PresetsSelectWizard',	
		'options_callback'        => array('PresetsModel', 'getPresets'),
		'load_callback'			  => array(array('PresetsModel', 'getSelectedPreset')),
		'onsubmit_callback'		  => array(array('PresetsModel', 'getSelectedPreset')),
		'eval'                    => array('helpwizard'=>false, 'chosen'=>true, 'submitOnChange'=>true, 'tl_class'=>'clr long m12'),
		'sql'                     => "varchar(255) NOT NULL default '-'",
		'combined'				  => 'ftc_preset_full_cll'
	),
	'ftc_preset_full_cll' => array
	(
		'label'                   => &$GLOBALS['TL_LANG']['MSC']['ftc_preset_full'],

		'exclude'                 => true,
		'inputType'               => 'hidden',
		'eval'               => array('hideInput'=>	true, 'doNotShow' =>true),
		'sql'                     => "text NULL"
	),
   	// `-,-´ right
   	'ftc_preset_id_clr' => array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['ftc_preset_id_clr'],
		'default'                 => '-',
		'exclude'                 => true,
		 'sorting' 				  => true,
		'filter'                  => true,
		'inputType'               => 'PresetsSelectWizard',	
		'options_callback'        => array('PresetsModel', 'getPresets'),
		'load_callback'			  => array(array('PresetsModel', 'getSelectedPreset')),
		'onsubmit_callback'		  => array(array('PresetsModel', 'getSelectedPreset')),
		'eval'                    => array('helpwizard'=>false, 'chosen'=>true, 'submitOnChange'=>true, 'tl_class'=>'clr long m12'),
		'sql'                     => "varchar(255) NOT NULL default '-'",
		'combined'				  => 'ftc_preset_full_clr'
	),
	'ftc_preset_full_clr' => array
	(
		'label'                   => &$GLOBALS['TL_LANG']['MSC']['ftc_preset_full'],

		'exclude'                 => true,
		'inputType'               => 'hidden',
		'eval'               => array('hideInput'=>	true, 'doNotShow' =>true),
		'sql'                     => "text NULL"
	),
   	// `-,-´ end left+right
		    
    // `-,-´ main
    'ftc_preset_id_main' => array
	(
		'label'                   => &$GLOBALS['TL_LANG']['MSC']['ftc_preset_id'],
		'default'                 => '-',
		'exclude'                 => true,
		 'sorting' 				  => true,
		'filter'                  => true,
		'inputType'               => 'PresetsSelectWizard',	
		'options_callback'        => array('PresetsModel', 'getPresets'),
		'load_callback'			  => array(array('PresetsModel', 'getSelectedPreset')),
		'onsubmit_callback'		  => array(array('PresetsModel', 'getSelectedPreset')),
		'eval'                    => array('helpwizard'=>false, 'chosen'=>true, 'submitOnChange'=>true, 'tl_class'=>'clr long m12'),
		'sql'                     => "varchar(255) NOT NULL default '-'",
		'combined'				  => 'ftc_preset_full_main'
	),
	'ftc_preset_full_main' => array
	(
		'label'                   => &$GLOBALS['TL_LANG']['MSC']['ftc_preset_full'],
		'exclude'                 => true,
		'inputType'               => 'hidden',
		'eval'               => array('hideInput'=>	true, 'doNotShow' =>true),
		'sql'                     => "text NULL"
	)

));
	 // $GLOBALS['TL_DCA']['tl_layout']['fields']['framework']['options'] = array('tinymce.css');

	 	  
//	  <!-- Google CDN jQuery with local fallback if offline -->
//	  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
//	  <script>window.jQuery || document.write('<script src="fileadmin/templates/js/libs/jquery-1.7.2.min.js"><\/script>')</script>
	  
 
?>