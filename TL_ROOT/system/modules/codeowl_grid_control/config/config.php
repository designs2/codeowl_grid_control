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

// `-,-´ Wrapper elements
array_insert($GLOBALS['TL_WRAPPERS']['start'],0, array
(
		'row_start',
		'col_start',
		//'fieldset'	
	)	
);

array_insert($GLOBALS['TL_WRAPPERS']['stop'],0, array
(
		'row_end',
		'row_stop',
		'col_stop',
	)
);

// `-,-´ Content elements
$CTEsize =count($GLOBALS['TL_CTE']);
array_insert($GLOBALS['TL_CTE'] ,$CTEsize, array
(	
		
	'ftc_row' => array
	(
		'row_start'        => 'ContentRowStart',
		'row_stop'        => 'ContentRowStop'
		
	),
	'ftc_col' => array
	(
		'col_start'        => 'ContentColStart',
		'col_stop'        => 'ContentColStop'
		
	)
));


// `-,-´ Front end form fields
  array_insert($GLOBALS['TL_FFL'], 2, array
  (
 	'row_start'    => 'FormRowStart',
 	'row_stop'    => 'FormRowStop',

 ));

if (TL_MODE =='FE') {

$GLOBALS['TL_HOOKS']['parseTemplate'][] 	= array('OutputGridVars', 'templates');
$GLOBALS['TL_HOOKS']['loadFormField'][] 	= array('OutputGridVars', 'formfieldtemplates');
}
$GLOBALS['TL_HOOKS']['getContentElement'][] = array('OutputGridVars', 'hybrid_elements');


?>