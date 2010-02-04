<?php

class YesNoConfigField extends ChoiceConfigField{
  
  
  public function configure(array $options){
    
    parent::configure($options);
    
    $this->setOption('choices', array(1 => 'Oui',0 => 'Non'));
    $this->setOption('expanded',true);
  }
}