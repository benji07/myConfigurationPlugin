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
    
    if(!is_array($this->options['choices'])){
      $v = trim($this->options['choices'],'%');
      
      list($class, $property) = explode('::',$v);
      
      $choices = array();
      if(rtrim($property,'()') != $property){
        $choices = call_user_func(array($class, rtrim($property,'()')));
      }
      else{
        $rClass = new ReflectionClass($class);
        $choices = $rClass->getProperty(ltrim($property,'$'))->getValue();  
      }
      
      $this->options['choices'] = $choices;
    }
    
    
   return new sfWidgetFormChoice($this->getWidgetOptions()); 
  }
  
  public function getValidator(){
    
    $voptions = $this->getValidatorOptions();
    
    if(isset($voptions['choices'])){
      if(!is_array($this->options['choices'])){
        $choices = array();
        if(rtrim($property,'()') != $property){
          // call a static method to getting choices list
          $choices = call_user_func(array($class, rtrim($property,'()')));
        }
        else{
          // retreive a class property
          $rClass = new ReflectionClass($class);
          $choices = $rClass->getProperty(ltrim($property,'$'))->getValue();  
        }
      }
      $voptions['choices'] = array_keys($voptions['choices']);
    }
    
    return new sfValidatorChoice($voptions, $this->getValidatorMessages());
  }
}