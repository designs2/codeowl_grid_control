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
 
$GLOBALS['TL_DCA']['tl_form_field']['config']['onload_callback'][] = array('Codeowl\Callbacks','formfield_onload');
   
$fieldsSize		= count($GLOBALS['TL_DCA']['tl_form_field']['fields'])-1;
$palettesSize	= count($palettes)-1;
$default 		= '{type_legend},type;';
$expert 		='{template_legend:hide},customTpl;{expert_legend:hide},class;';


 $GLOBALS['TL_DCA']['tl_form_field']['palettes']['row_start']		= $default.'{row_legend},is_collapse;{template_legend:hide},customTpl';
 $GLOBALS['TL_DCA']['tl_form_field']['palettes']['row_stop']		= $default.'{template_legend:hide},customTpl';
 $GLOBALS['TL_DCA']['tl_form_field']['palettes']['submit']			= '{type_legend},type,slabel;{button_legend}, btn_styles,btn_size,label_role;{image_legend:hide},imageSubmit;{expert_legend:hide},class,accesskey,tabindex;{template_legend:hide},customTpl'; 
 $GLOBALS['TL_DCA']['tl_form_field']['palettes']['fieldsetfsStart'] = '{ftc_legend},ftc_preset_id,ftc_preset_full;'.$default.'{fconfig_legend},fsType,label;'.$expert;
  
 $fieldsSize=count($GLOBALS['TL_DCA']['tl_form_field']['fields'])-1;
	  
 array_insert($GLOBALS['TL_DCA']['tl_form_field']['fields'], $fieldsSize, array
 (
			'ftc_preset_id' => array
				(
					'label'                   => &$GLOBALS['TL_LANG']['MSC']['ftc_preset_id'],
					'default'                 => '-',
					'exclude'                 => true,
					 'sorting' 				  => true,
					'filter'                  => true,
					'inputType'               => 'PresetsSelectWizard',
						//'inputType'               => 'select',
					'options_callback'        => array('PresetsModel', 'getPresets'),
					'load_callback'			  => array(array('PresetsModel', 'getSelectedPreset')),
					'save_callback'		  	  => array(array('PresetsModel', 'getSelectedPreset')),
					'eval'                    => array('helpwizard'=>false, 'chosen'=>true, 'submitOnChange'=>true, 'tl_class'=>'long clr m12'),
					'sql'                     => "varchar(255) NOT NULL default '-'",
					'combined'				  =>'ftc_preset_full'
				),
			'ftc_preset_full' => array
				(
					'label'                   => &$GLOBALS['TL_LANG']['MSC']['ftc_preset_full'],
					'exclude'                 => true,
					'inputType'               => 'hidden',
					'eval'               	  => array('hideInput'=>	true, 'doNotShow' =>true),
					'sql'                     => "text NULL"
				),
			'ftc_preset_id_label' => array
				(
					'label'                   => &$GLOBALS['TL_LANG']['MSC']['ftc_preset_id_label'],
					'default'                 => '-',
					'exclude'                 => true,
					 'sorting' 				  => true,
					'filter'                  => true,
					'inputType'               => 'PresetsSelectWizard',
					'options_callback'        => array('PresetsModel', 'getPresets'),
					'load_callback'			  => array(array('PresetsModel', 'getSelectedPreset')),
					'save_callback'		  	  => array(array('PresetsModel', 'getSelectedPreset')),
					'eval'                    => array('helpwizard'=>false, 'chosen'=>true, 'submitOnChange'=>true, 'tl_class'=>'long clr m12'),
					'sql'                     => "varchar(255) NOT NULL default '-'",
					'combined'				  => 'ftc_preset_full_label'
				),
			'ftc_preset_full_label' 		  => array
				(
					'label'                   => &$GLOBALS['TL_LANG']['tl_form_field']['ftc_preset_full_label'],
					'exclude'                 => true,
					'inputType'               => 'hidden',
					'eval'               	  => array('hideInput'=>	true, 'doNotShow' =>true),
					'sql'                     => "text NULL"
				),
		   		
		   // `-,-´ ftc post or prefix
		   'post_pre_fix' => array
		   		(
		   			'label'                   => &$GLOBALS['TL_LANG']['tl_form_field']['post_pre_fix'],
		   			'exclude'                 => true,
		   			'inputType'               => 'text',
		   			'eval'                    => array('tl_class'=>'w50 '),
		   			'sql'                     => "varchar(255) NOT NULL default ''"
		   		),
		   // `-,-´ Buttons settings
		   'btn_size' => array
		      		(
		      			'label'                   => &$GLOBALS['TL_LANG']['tl_form_field']['btn_size'],
		      			'default'                 => '',
		      			'options'				  => array(' ','tiny','small','large'),
		      			'exclude'                 => true,
		      			'inputType'               => 'select',
		      			'reference'               => &$GLOBALS['TL_LANG']['tl_form_field']['btn_size_options'],
		      			'eval'                    => array('helpwizard'=>false, 'chosen'=>false, 'submitOnChange'=>false, 'tl_class'=>'w50'),
		      			'sql'                     => "varchar(255) NOT NULL default ''"
		      		),
	     	'btn_styles' => array
	        		(
	        			'label'                   => &$GLOBALS['TL_LANG']['tl_form_field']['btn_styles'],
	        			'default'                 => '',
	        			'options'				  => array(' ','alert','success','secondary','radius','round','disabled','expand'),
	        			'exclude'                 => true,
	        			
	        			'inputType'               => 'select',
	        			'reference'               => &$GLOBALS['TL_LANG']['tl_form_field']['btn_styles_options'],
	        			'eval'                    => array('multiple'=>true,'helpwizard'=>false, 'chosen'=>false, 'submitOnChange'=>false, 'tl_class'=>'w50 m12'),
	        			'sql'                     => "varchar(255) NOT NULL default ''"
	        		),
		   	
		  	// `-,-´ ftc label
		 
		   	// `-,-´ ftc row			
		   	'is_collapse' => array
		   	(
		   		'label'                   => &$GLOBALS['TL_LANG']['tl_form_field']['is_collapse'],
		   		'exclude'                 => true,
		   		'inputType'               => 'checkbox',
		   		'eval'                    => array('submitOnChange'=>true),
		   		'sql'                     => "char(1) NOT NULL default ''"
		   	),
		   	'label_role' => array
		   			(
		   				'label'                   => &$GLOBALS['TL_LANG']['tl_form_field']['label_role'],
		   				'default'                 => ' ',
		   				'options'				  => array(' ','prefix','postfix'),
		   				'inputType'               => 'select',
		   				'reference'               => &$GLOBALS['TL_LANG']['tl_form_field']['label_role_options'],
		   				'eval'                    => array('helpwizard'=>false, 'chosen'=>false, 'submitOnChange'=>false, 'tl_class'=>'w50'),
		   				'sql'                     => "varchar(255) NOT NULL default ''"
		   	),
		   	'label_classes' => array
		   			(
		   				'label'                   => &$GLOBALS['TL_LANG']['tl_form_field']['label_classes'],
		   				'default'                 => 'no-style',
		   				'options'				  => array(' ','no-style','alert','success','secondary','radius','round'),
		   				'inputType'               => 'select',
		   				'reference'               => &$GLOBALS['TL_LANG']['tl_form_field']['label_classes_options'],
		   				'eval'                    => array('multiple'=>true,'helpwizard'=>false, 'chosen'=>false, 'submitOnChange'=>false, 'tl_class'=>'w50'),
		   				'sql'                     => "varchar(255) NOT NULL default 'no-style'"
		   	)	   
));
	  
	  
 $GLOBALS['TL_DCA']['tl_form_field']['list']['sorting']['child_record_callback'] = array('tl_co_form_field', 'listFormFields');
	  
	  
	  
class tl_co_form_field extends \tl_form_field
{	  
	  
	  
	  
  	// `-,-´  Add the type of input field
  	public function listFormFields($arrRow){
	  		$arrRow['required'] 		= $arrRow['mandatory'];
	  		$key 						= $arrRow['invisible'] ? 'unpublished' : 'published';
	  		$headline					= unserialize($arrRow['headline']);
	  		$cssType					= '';
	  		$no_preview					= false;
	  		if (in_array($arrRow['type'], $GLOBALS['TL_WRAPPERS']['start'])){
	  			$no_preview				= true;
	  		}
	  		else if (in_array($arrRow['type'], $GLOBALS['TL_WRAPPERS']['stop'])) {
	  			$no_preview				= true;
	  		} 
	  		else if  (in_array($arrRow['type'], $GLOBALS['TL_WRAPPERS']['separator'])) {
	  			$no_preview				= true;
	  		}
	  			  		
	  		$cssID 						= unserialize($arrRow['cssID']);
	  		$CssClass 					= $cssType.' form_'.$arrRow['type'].' '.$CssID[1].' '.$arrRow['small_ftc'].' '.$arrRow['large_ftc'].' '.$arrRow['float_ftc'].' '.$this->splitArr($arrRow['align_ftc']).' ';
	  		
	  		$strType 				   .= '<div class="cte_type ' . $key . $CssClass.'">' . $GLOBALS['TL_LANG']['FFL'][$arrRow['type']][0] . ($arrRow['name'] ? ' (' . $arrRow['name'] . ')' : '') . '</div>';
	  		
	  		if ($no_preview!==true) {
	  			$strType 			   .= '<div class="limit_height' . (!Config::get('doNotCollapse') ? ' h32' : '') . '">';

		  		$strClass  				= $GLOBALS['TL_FFL'][$arrRow['type']];
		  
		  		if (!class_exists($strClass))
		  		{
		  			return '';
		  		}
		  
		  		$objWidget = new $strClass($arrRow);
		  		$strWidget = $objWidget->parse();
		  		$strWidget = preg_replace('/ name="[^"]+"/i', '', $strWidget);
		  		$strWidget = str_replace(array(' type="submit"', ' autofocus', ' required'), array(' type="button"', '', ''), $strWidget);
		  
		  		if ($objWidget instanceof \FormHidden)
		  		{
		  			return $strType . "\n" . $objWidget->value . "\n</div>\n";
		  		}
		  
		  		return $strType . '
				  <table class="tl_form_field_preview">
				  '.$strWidget.'</table>
				  </div>' . "\n";
	  
	 		 }
	 		 else{
	 		 	return $strType . '' . "\n";
	 		 }
	  }

	  // `-,-´ helper
	  public function splitArr($arr){
	  	$str='';
	  	if ($arr==''||!is_array(unserialize($arr))) { return; }
	  	foreach (unserialize($arr) as $class) {
	  		$str.=' '.$class;
	  	}
	  	return $str;
	  }  
}
?>