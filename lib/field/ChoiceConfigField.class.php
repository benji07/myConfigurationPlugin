<?php

class ChoiceConfigField extends AbstractConfigField{
  
  protected $_widgetOptions = array('label', 'choices', 'multiple', 'expanded');
  protected $_validatorOptions = array('choices', 'required', 'multiple');
  protected $_validatorMessages = array();
  
  public function configure(array $options){
    
    $this->addRequiredOption('label');
    
    $this->addRequiredOption('choices');
    
    $this->addOption('multiple',false);
    $this->addOption('expanded',false);
    $this->addOption('required',false);
    
    
  }
  
  public function getWidget(){
    
   return new sfWidgetFormChoice($this->getWidgetOptions()); 
  }
  
  public function getValidator(){
    
    $voptions = $this->getValidatorOptions();
    
    if(isset($voptions['choices'])){
      $voptions['choices'] = array_keys($voptions['choices']);
    }
    
    return new sfValidatorChoice($voptions, $this->getValidatorMessages());
  }
}