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

 $fieldsSize = count($GLOBALS['TL_DCA']['tl_layout']['fields'])-1;
 $GLOBALS['TL_DCA']['tl_form']['fields']['tableless']['sql']=  "char(1) NOT NULL default '1'";

 
 

 
 ?>