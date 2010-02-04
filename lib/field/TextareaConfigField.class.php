<?php

class TextareaConfigField extends TextConfigField{
  
  public function getWidget(){
    
   return new sfWidgetFormTextarea($this->getWidgetOptions()); 
  }
}