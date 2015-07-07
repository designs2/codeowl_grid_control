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
 *  ( )  codeowl.org
 *************************/
 
namespace Codeowl;

use Codeowl\OutputPresets as Output;

class OutputGridVars extends \Controller
{
       
  // `-,-´ Use Hook 'parseFrontendTemplate'
  public function templates($obj){   
    
         $template = $obj->getName();
         
          switch($template) {
              
              case 'fe_page':
              case 'fe_page_multitoggle': //custom
                    $obj->setName($template.'_gc');//gc = grid controll only
                    $obj->__get("layout")->__set("gridCSS",(array)$this->getGridArr($obj->layout));
              break;
              case 'form':
               $obj->setName($template.'_'.\Config::get('co_grid_prefix'));
               break;
              default:
          }
        
           // `-,-´ ContentElements
          if ($obj->__get('typePrefix')=='ce_'&&strpos($template,'ce_row_start')===FALSE) {
            
              $strClass = $this->findContentElement($obj->__get('type')); 
              
              if ($strClass!==NULL&&$strClass!='') {

                  $objModel = \ContentModel::findBy('id',$obj->__get('id'));
                  if ($objModel!==NULL) {
                      $objEl = new $strClass($objModel);
                      $objEl = $this->design_elements($objEl);
                      $obj->__set('ftc_classes',$objEl->ftc_classes);
                      $obj->__set('ftcID',$objEl->ftcID);
                      $obj->__set('data_attr',$this->splitArr($objEl->data_attr));
                     
                      $obj->__set('class',$objEl->ftc_classes);
                      $obj->__set('cssID',$objEl->ftcID);
                  }
                
              }
           }
          if (strpos($template,'ce_row_start')!==FALSE) {
           
                      $obj->__set('row_data_attr_ftc',$this->splitArr($obj->row_data_attr_ftc));
          }

           // `-,-´ Article
           if (strpos($template,'mod_article')!==FALSE){
                  $objModel = \ArticleModel::findBy('id',$obj->__get('id'));
                  if ($objModel!==NULL) {
                  
                      $objEl = new \ModuleArticle($objModel);
                      $objEl = $this->design_articles($objEl);
                      $obj->__set('class',''.$objEl->ftc_classes);
                      $obj->__set('cssID',$objEl->ftcID.' ');//.$objEl->data_attr.' '
                 
                  }
              
            } 

           // `-,-´ Module
           if ($obj->__get('typePrefix')=='mod_') {
            
              $strClass = \Module::findClass($obj->__get('type')); 
              if ($strClass!==NULL&&$strClass!='') {

                  $objModel = \ModuleModel::findBy('id',$obj->__get('id'));
                  if ($objModel!==NULL) {

                      $objEl = new $strClass($objModel);
                      $co_grid = $this->design_modules($objEl);
                       $obj->__set('class',$co_grid['class'].' '.$co_grid['co_grid_classes']);
                      // $obj->__set('cssID',$co_grid['ftcID'].' '.$co_grid['data_attr'].' ');
                      $obj->__set('ftc_classes',$co_grid['class'].' '.$co_grid['co_grid_classes']);
                      $obj->__set('ftcID',$co_grid['ftcID'].' ');
                      $obj->__set('ftc_data_attr',$co_grid['data_attr']);
                   }
              }
           }    

   }  
                      
  // `-,-´ Set content element vars
  public function design_elements($el){
         
        $el->cssID = (is_array($el->cssID))?$el->cssID : unserialize($el->cssID);
        
       // `-,-´ Check if preset_full is set 
       if(!is_array(unserialize($el->ftc_preset_full))){ 
            $akt_preset=array();
            $el->ftc_classes  = trim('ce_'.$el->type.' '.$el->cssID[1]);
            $el->ftcID        = ($el->cssID[0] !== '') ? ' id="' . trim($el->cssID[0]) . '"' : '';
            $el->data_attr    = $this->splitArr($el->data_attr_ftc);

           return $el;  
        }else{
            $akt_preset       = unserialize($el->ftc_preset_full); 
        }
       $co_grid_classes     = $this->getCssClasses($akt_preset,$el->ftc_preset_add_custom,$el->ftc_preset_custom);
       $el->ftc_classes     = trim('ce_'.$el->type.' '.$el->cssID[1]).' '.$co_grid_classes;
       $el->ftcID           = ($el->cssID[0] !== '') ? ' id="' . trim($el->cssID[0]) . '"' : '';
       $el->data_attr       = $this->splitArr($el->data_attr_ftc);

       return $el;
  }

  // `-,-´ Set article vars
  public function design_articles($objRow){   
      
        $objRow->cssID = (is_array($objRow->cssID))?$objRow->cssID : unserialize($objRow->cssID); 
        $objRow->ftcID = ($objRow->cssID[0] !== '') ? ' id="' . $objRow->cssID[0] . '"' : ' id="' . $objRow->alias . '"';
        
         // `-,-´ Check if preset_full is set 
        if(!is_array(unserialize($objRow->ftc_preset_full))){ 
           $akt_preset           = array();
           $objRow->ftc_classes  = trim('mod_article '.$objRow->cssID[1]);
           return $objRow;  
        }else{
           $akt_preset           = unserialize($objRow->ftc_preset_full);       
           $co_grid_classes      = $this->getCssClasses($akt_preset,$objRow->ftc_preset_add_custom,$objRow->ftc_preset_custom);
          //$objRow->data_attr = $this->splitArr($objRow->data_attr_ftc);
           $objRow->ftc_classes  = trim('mod_article '.$objRow->cssID[1]).' '.$co_grid_classes;
        }
      return $objRow; 
    
  } 
    
  // `-,-´ Set modules vars  
  public function design_modules($el){
               
        $co_grid = array();

        if ($elModel->type=='html') {
          return array();
        }
       
        $el->cssID = (is_array($el->cssID))?$el->cssID : unserialize($el->cssID);

        // `-,-´ Check if preset_full is set 
        if(!is_array(unserialize($el->ftc_preset_full))){ 
            $akt_preset=array();     
        }else{
            $akt_preset=unserialize($el->ftc_preset_full);
        }
          
        $co_grid['ftcID']                 = ($el->cssID[0] !== '') ? ' id="' . $el->cssID[0] . '"' : '';
        $co_grid['co_grid_classes']       = $this->getCssClasses($akt_preset,$el->ftc_preset_add_custom,$el->ftc_preset_custom);
        if ($el->data_attr_ftc!==NULL) {
          $co_grid['data_attr']           = $this->splitArr($el->data_attr_ftc);
        }
        $co_grid['class']                 = trim('mod_'.$el->type.' '.$el->cssID[1]);
        
        return $co_grid;
        
  }
          
   // `-,-´ Set form field vars       
  public function design_fields($el){
     
     $co_grid = array();
     
      // `-,-´ Check if preset_full is set 
      if(!is_array(unserialize($el->ftc_preset_full))){ 
        $akt_preset       = array();    
      }else{
        $akt_preset       = unserialize($el->ftc_preset_full);   
      }
      if(!is_array(unserialize($el->ftc_preset_full_label))){ 
        $akt_preset_label = array();   
      }else{
        $akt_preset_label = unserialize($el->ftc_preset_full_label);   
      }
    
      $co_grid['co_grid_classes']        = $this->getCssClasses($akt_preset,'',NULL);
      $co_grid['co_grid_classes_label']  = $this->getCssClasses($akt_preset_label,'',NULL);

      $co_grid['style_label'] = $this->splitArr($el->label_classes);  
      $co_grid['data_attr']   = $this->splitArr($el->data_attr_ftc);

      $co_grid['class']   = $el->class;

      switch($el->type) {

          case 'submit':
            $co_grid['button_classes'] = $this->splitArr($el->btn_styles).' '.$el->btn_size;
            break;
          case 'select':
            $co_grid['arrOptions'] = $el->options;
            break;
          case 'radio':
            $co_grid['arrOptions'] = $el->options;
          break;  
 
          default:
      }
   
     return $co_grid;
  }

   // `-,-´ Set vars to hybrid elements
  public function hybrid_elements($objRow, $strBuffer, $objElement)    {   
    

    if($objRow->type=='module'){
      
      $co_grid = $this->design_modules($objRow);
      $arrCSS = $objElement->__get('cssID');
      $arrCSS[1] = $arrCSS[1].' '.$co_grid['co_grid_classes'];
      $objElement->__set('class',$co_grid['class'].' '.$co_grid['co_grid_classes']);
      $objElement->__set('cssID',$arrCSS);

      $objElement->__set('ftc_classes',$co_grid['class'].' '.$co_grid['co_grid_classes']);
      $objElement->__set('ftcID',$co_grid['ftcID'].' ');
      $objElement->__set('ftc_data_attr',$co_grid['data_attr']);
      $NewBuffer = $objElement->generate();
      $strBuffer = (!$NewBuffer)?$strBuffer:$NewBuffer;
      $be_css = $objElement->__get('ftc_classes');
    }
    else if($objRow->type=='form') {
      $strClass = $this->findContentElement($objRow->type); 
      $objEl = new $strClass($objRow);
      $this->design_elements($objRow);
      $objEl->cssID = $objRow->cssID;
      $objEl->ftc_classes = $objRow->ftc_classes;
      $objEl->ftcID = $objRow->ftcID;
      $objEl->data_attr = $objRow->data_attr;
      $strBuffer = $objEl->generate();
      $be_css = $objEl->ftc_classes;
    }else{
      $this->design_elements($objRow);
      $be_css = $objRow->ftc_classes;
    }
   
    if (TL_MODE =='BE') {
      $be_css = (isset($be_css))?$be_css:'unknown';
      return $this->getGridStylePreview($objRow,$be_css,$strBuffer);//'<div style="background-color:#c2d679; opacity:0.8; padding:0.2em; cursor:help;" class="grid_control '.$be_css.'" title="CSS-SETTINGS: '.$be_css.'"">GRID CONTROL `-,-´</div>'.$strBuffer;
    }
     return $strBuffer;
  }

  // `-,-´ Set supported form field templates
  public function formfieldtemplates($objWidget, $formId, $arrData, $_this){

      $co_grid = $this->design_fields($objWidget);

      switch($objWidget->type) {
          case 'text':
          case 'email':
          case 'number':
          case 'tel':
          case 'url':
            $objWidget->__set('template','form_textfield_'.\Config::get('co_grid_prefix'));
            break;
          case 'select':
            $objWidget->__set('arrOptionsCustom',         $this->getOptionsSelect($co_grid['arrOptions']));  
            $objWidget->__set('template','form_'.$objWidget->type.'_'.\Config::get('co_grid_prefix'));
            break;
          case 'radio':
            $objWidget->__set('template','form_'.$objWidget->type.'_'.\Config::get('co_grid_prefix'));
            $objWidget->__set('arrOptionsCustom',         $this->getOptionsRadio($co_grid['arrOptions'], $objWidget->name));
            break;
          case 'submit':
            $objWidget->__set('btn_classes',        $co_grid['button_classes']);
            $objWidget->__set('template','form_'.$objWidget->type.'_'.\Config::get('co_grid_prefix'));
          break;

          case 'upload':
          case 'checkbox':
          case 'explanation':
          case 'fieldset':
          case 'headline':
          case 'password':   
          case 'textarea':   
          case 'captcha':
          case 'message':
            $objWidget->__set('template','form_'.$objWidget->type.'_'.\Config::get('co_grid_prefix'));
          break;
          default:
          
            break;
                     
      }
  
      if (NULL !== $co_grid['data_attr']) {
         $objWidget->__set('data_attr',       $co_grid['data_attr']);
      } 
      $objWidget->__set('class',              $co_grid['class']);
      $objWidget->__set('ftc_field_classes',  $co_grid['co_grid_classes']);
      $objWidget->__set('ftc_fix_classes',    $co_grid['co_grid_classes_label']);
      $objWidget->__set('label_style',        $co_grid['style_label']);

      return $objWidget;
  }

  // `-,-´ Get Options from Select
  public function getOptionsSelect($arr) {

        $arrOption = array();
        foreach ($arr as $arrOption)
        {
          if ($arrOption['group'])
          {
            if ($blnHasGroups)
            {
              $arrOptions[] = array
              (
                'type' => 'group_end'
              );
            }
     
            $arrOptions[] = array
            (
              'type'  => 'group_start',
              'label' => specialchars($arrOption['label'])
            );
     
            $blnHasGroups = true;
          }
          else
          {
            $arrOptions[] = array
            (
              'type'     => 'option',
              'value'    => $arrOption['value'],
              'selected' =>($arrOption['default'])? 'selected':'',
              'label'    => $arrOption['label'],
            );
          }
        }
     
        if ($blnHasGroups)
        {
          $arrOptions[] = array
          (
            'type' => 'group_end'
          );
        }
      return $arrOptions;
  }

  // `-,-´ Get Options from Radio
  public function getOptionsRadio($arr,$name)
  {
    $arrOptions = array();

    foreach ($arr as $i=>$arrOption)
    {
      $arrOptions[] = array
      (
        'name'       => $name,
        'id'         => $name. '_' . $i,
        'value'      => $arrOption['value'],
        'checked'    => ($arrOption['default'])? 'checked':'',
        'label'      => $arrOption['label']
      );
      
    }

    return $arrOptions;
  } 

  // `-,-´ for the backend style
  private function getGridStylePreview($el,$be_css,$strBuffer){

    $co_grid_arr      = array();
    $preset           = $el->ftc_preset_full;
    if ($el->ftc_preset_add_custom == '1') { 
      $preset         = $el->ftc_preset_custom; 
    }
   // `-,-´ Check if preset_full is set 
    if(!is_array(unserialize($preset))){ 
        $akt_preset   = array();     
    }else{
        $akt_preset   = unserialize($preset);
    }
    $co_grid_breakpoints            = explode(',', \Config::get('co_grid_breakpoints'));
    foreach ($co_grid_breakpoints as $key => $breakpoint) {
        // `-,-´ calculate the width in %
        $width                      = number_format((100/(\Config::get('co_grid_columns_size'))* $akt_preset[$breakpoint]),2, '.', '');
        if((float)$width !== 0.00){  
          $float_ftc                =($akt_preset['float_ftc']=='-')?'left':$akt_preset['float_ftc'];
          $co_grid_arr[$breakpoint] = '<div class="co_grid_'.$breakpoint.'" style="box-sizing:border-box;border-right:2px solid #ccc; background-color:rgba(255,255,255,0.'.(8-$key).'); margin-bottom:4px; width:'.$width.'%;float:'
          .$float_ftc.';" >'.$breakpoint.': '.$width.'% &nbsp;</div>';
        }
       
      }
      if (in_array($el->type, $GLOBALS['TL_WRAPPERS']['stop'])){
        return $strBuffer;
      }
       if (in_array($el->type, $GLOBALS['TL_WRAPPERS']['start'])) {
        return '<div style="background-color:#c2d679; box-sizing:border-box;width:100%; float:left; opacity:0.8; padding:0.2em; cursor:help; margin-bottom:.8rem;" class="grid_control '.$be_css.'" title="GRID CONTROL `-,-´"><div style="width:100%; float:left; margin-bottom:4px;">CSS-Klassen: '.$be_css.'</div>'.implode("\n\r", $co_grid_arr).'</div>'.$strBuffer;
      }
    return '<h3>'.deserialize($el->headline,true)['value'].'</h3><div style="background-color:#c2d679; box-sizing:border-box;width:100%; float:left; opacity:0.8; padding:0.2em; cursor:help; margin-bottom:.8rem;" class="grid_control '.$be_css.'" title="GRID CONTROL `-,-´"><div style="width:100%; float:left; margin-bottom:4px;">CSS-Klassen: '.$be_css.'</div>'.implode("\n\r", $co_grid_arr).'</div>'.$strBuffer;

  }

  // `-,-´ Get css classes
  private function getCssClasses($a,$b,$c){
    $Output = new Output;
    if ($a===NULL) {
      return '';
    }
    return $Output->getCssClassesAsString($a,$b,$c);
  }

  // `-,-´ Get split array();
  public function splitArr($a){
    $Output = new Output;
    if (NULL===$Output->splitArr($a)) {
      return '';
    }
    return $Output->splitArr($a);
  }

  // `-,-´ Set css classes into Layout
  public function getGridArr($objLayout){
        $GridClassesArr = array();
        $GridClassesArr["header"] = ($objLayout->__get("ftc_preset_full_rwh")  ===NULL)?'':$this->getCssClasses($objLayout->__get("ftc_preset_full_rwh"), '',array());
        $GridClassesArr["footer"] = ($objLayout->__get("ftc_preset_full_rwf")  ===NULL)?'':$this->getCssClasses($objLayout->__get("ftc_preset_full_rwf"), '',array());
        $GridClassesArr["main"]   = ($objLayout->__get("ftc_preset_full_main") ===NULL)?'':$this->getCssClasses($objLayout->__get("ftc_preset_full_main"),'',array());
        $GridClassesArr["left"]   = ($objLayout->__get("ftc_preset_full_cll")  ===NULL)?'':$this->getCssClasses($objLayout->__get("ftc_preset_full_cll"), '',array());
        $GridClassesArr["right"]  = ($objLayout->__get("ftc_preset_full_clr")  ===NULL)?'':$this->getCssClasses($objLayout->__get("ftc_preset_full_clr"), '',array());

        return $GridClassesArr;
  }
            
}
?>
