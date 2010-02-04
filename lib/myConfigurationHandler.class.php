<?php

class myConfigurationHandler{
  
  
  protected $configCache = null;
  
  public function __construct(sfConfigCache $configCache)
  {
    $this->configCache = $configCache;
    $this->configCache->registerConfigHandler('config/params.yml', 'myParamsConfigHandler');
  }

  public function connect(sfEventDispatcher $dispatcher)
  {
    $dispatcher->connect('routing.load_configuration', array($this, 'updateDefaultConfig'));
  }
  
  public function updateDefaultConfig(sfEvent $event){
    // on doit mettre à jour sfConfig app depuis la base de données
    require_once $this->configCache->checkConfig('config/params.yml');
    
    foreach(myParamsConfig::$fields as $space => $conf){
      foreach($conf as $label => $c){
        sfConfig::set('app_'.$space.'_'.$label,isset($c['default'])?$c['default']:'');
      }
    }
    
    $data = Doctrine::getTable('Params')->createQuery('p')->fetchArray();
    if(count($data)){
      foreach($data as $d){
        if(isset(myParamsConfig::$fields[$d['space']][$d['name']])){
          
          $v = $d['value'];
          if(isset(myParamsConfig::$fields[$d['space']][$d['name']]['options']['multiple']) && myParamsConfig::$fields[$d['space']][$d['name']]['options']['multiple'] == true){
            $v = unserialize($v);
          }
          
          myParamsConfig::$fields[$d['space']][$d['name']]['default'] = $v;
          sfConfig::set('app_'.$d['space'].'_'.$d['name'],$v);
        }
      }
    }
  }
}