<?php

abstract class AbstractConfigField{
  
  protected $options = array();
  protected $requiredOptions = array();
  
  protected $_widgetOptions = array();
  protected $_validatorOptions = array();
  protected $_validatorMessages = array();
  
  public function __construct(array $options = array()){
    $this->configure($options);

    $currentOptionKeys = array_keys($this->options);
    $optionKeys = array_keys($options);

    // check option names
    if ($diff = array_diff($optionKeys, array_merge($currentOptionKeys, $this->requiredOptions)))
    {
      throw new InvalidArgumentException(sprintf('%s does not support the following options: \'%s\'.', get_class($this), implode('\', \'', $diff)));
    }

    // check required options
    if ($diff = array_diff($this->requiredOptions, array_merge($currentOptionKeys, $optionKeys)))
    {
      throw new RuntimeException(sprintf('%s requires the following options: \'%s\'.', get_class($this), implode('\', \'', $diff)));
    }

    $this->options = array_merge($this->options, $options);
    
  }
  
  public function addRequiredOption($name)
  {
    $this->requiredOptions[] = $name;

    return $this;
  }

  public function getRequiredOptions()
  {
    return $this->requiredOptions;
  }

  public function addOption($name, $value = null)
  {
    $this->options[$name] = $value;

    return $this;
  }

  public function setOption($name, $value)
  {
    if (!in_array($name, array_merge(array_keys($this->options), $this->requiredOptions)))
    {
      throw new InvalidArgumentException(sprintf('%s does not support the following option: \'%s\'.', get_class($this), $name));
    }

    $this->options[$name] = $value;

    return $this;
  }

  public function getOption($name)
  {
    return isset($this->options[$name]) ? $this->options[$name] : null;
  }

  public function hasOption($name)
  {
    return array_key_exists($name, $this->options);
  }

  public function getOptions()
  {
    return $this->options;
  }

  public function setOptions($options)
  {
    $this->options = $options;

    return $this;
  }
  
  abstract function configure(array $options);
  
  abstract public function getWidget();
  
  abstract public function getValidator();

  public function getWidgetOptions(){
    $options = array();
    if(count($this->_widgetOptions)){
      foreach($this->_widgetOptions as $opt){
        if(isset($this->options[$opt])){
          $options[$opt] = $this->options[$opt];
        }
      }
    }
    return $options;
  }
  
  public function getValidatorOptions(){
    $options = array();
    if(count($this->_validatorOptions)){
      foreach($this->_validatorOptions as $opt){
        if(isset($this->options[$opt])){
          $options[$opt] = $this->options[$opt];
        }
      }
    }
    return $options;
  }
  
  
  public function getValidatorMessages(){
    $options = array();
    if(count($this->_validatorMessages)){
      foreach($this->_validatorMessages as $opt){
        if(isset($this->options[$opt])){
          $options[$opt] = $this->options[$opt];
        }
      }
    }
    return $options;
  }

}