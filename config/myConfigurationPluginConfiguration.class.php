<?php

class myConfigurationPluginConfiguration extends sfPluginConfiguration{
  
  public function initialize(){
    
    if($this->configuration instanceof sfApplicationConfiguration){
      
      $enhancer = new myConfigurationHandler($this->configuration->getConfigCache());
      $enhancer->connect($this->dispatcher);
      
    }
  }
  
}