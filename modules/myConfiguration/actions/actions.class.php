<?php

class myConfigurationActions extends sfActions{
  
  
  public function executeIndex(sfWebRequest $request){
    
    $this->fields = myParamsConfig::$fields;
    
    $this->form = new myParamsForm();
    
    if($request->getMethod() === sfRequest::POST){
      
      $this->form->bind($request->getParameter($this->form->getName()));
      if($this->form->isValid()){
        
        $this->form->save();
        
        $this->getUser()->setFlash('notice','Your applications settings has been updated');
        
        $this->redirect('myConfiguration/index');
      }
    }
  }
}