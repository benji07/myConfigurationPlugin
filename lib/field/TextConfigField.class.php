<?php

class TextConfigField extends AbstractConfigField{
  
  protected $_widgetOptions = array('label');
  protected $_validatorOptions = array('required', 'trim');
  protected $_validatorMessages = array();
  
	public function configure(array $options){
		
		$this->addRequiredOption('label');
		
		$this->addOption('required',false);
		$this->addOption('trim', true);
		
	}
  
  public function getWidget(){
		
   return new sfWidgetFormInputText($this->getWidgetOptions()); 
  }
  
  public function getValidator(){
		
    return new sfValidatorString($this->getValidatorOptions(), $this->getValidatorMessages());
  }
}