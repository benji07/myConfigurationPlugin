<?php

class myParamsForm extends BaseForm{
  
  
  protected $_fields = array();
  
  public function setup(){
    
    $fields = myParamsConfig::$fields;
    
    foreach($fields as $space => $f){
      
      $this->embedForm($space, new sfForm());
      foreach($f as $name => $field){
        
        $this->addField($space, $name, $field);
        
      }
    }
    
    $this->widgetSchema->setNameFormat('params[%s]');
    
    $this->setDefaults(myParamsConfig::getFieldsDefaultValue());
  }
  
  public function save(){
    
    $values = $this->getValues();
    Doctrine::getTable('Params')->createQuery('p')->delete()->execute();
    
    foreach($values as $space => $vs){
      foreach($vs as $name => $v){
        $p = new Params();
        $p->space = $space;
        $p->name = $name;
        if(is_array($v)){
          $v = serialize($v);
        }
        $p->value = $v;
        $p->save();
      }
    }
  }
  
  public function addField($space, $name, $options = array()){
    
    $type = isset($options['type'])?strtolower($options['type']):'text';

		$class = sfInflector::classify($type).'ConfigField';
    
		if(class_exists($class)){
		  if(!isset($options['options']['label'])){
		    $options['options']['label'] = sfInflector::humanize($name);
		  }
		  $this->_fields[$space][$name] = new $class($options['options']);
		  
		  $this->widgetSchema[$space][$name] = $this->_fields[$space][$name]->getWidget();
		  $this->validatorSchema[$space][$name] = $this->_fields[$space][$name]->getValidator();
		}
		else{
      throw new InvalidArgumentException('This field type doesn\'t, you need to create a classe named '.$class);
    }   
  }
}