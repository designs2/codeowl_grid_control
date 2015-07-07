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

class FormRowStart extends \Widget
{

	// `-,-´  Template
	protected $strTemplate = 'form_row_start';
	
	// `-,-´ Check the options if the field is mandatory
	public function validate()
	{
		return;
	}


	// `-,-´ Parse the template file and return it as string
	public function parse($arrAttributes=null)
	{
		$this->text = \String::toHtml5($this->text);
		
		return parent::parse($arrAttributes);
	}

	/**
	 * Generate the widget and return it as string
	 * @return string The widget markup
	 * @deprecated The logic has been moved into the template (see #6834)
	 */
	public function generate()
	{
		return $this->text;
	}
}

?>
