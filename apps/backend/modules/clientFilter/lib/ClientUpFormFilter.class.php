<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ClientUpFormFilter extends sfGuardUserFormFilter
{
  public function configure()
  {
    //parent::configure();
    
    $opts = array('with_empty' => false);
    $atts = array('style' => "width:200px");
    $atts2 = array('style' => "width:260px");
    
    // use this in filters with embedded filter forms to avoid security vaidation
    $this->disableLocalCSRFProtection();
    
    $this->useFields(array('last_name', 'first_name'));
    $this->getWidget('last_name')->setOption('with_empty', false);
    $this->getWidget('first_name')->setOption('with_empty', false);
    $this->getWidget('last_name')->setAttributes($atts2);
    $this->getWidget('first_name')->setAttributes($atts);
    
    //$uFileFormFilter = new UserFileFormFilter();
    //$uFileFormFilter->useFields(array('number'));
    //$this->mergeForm($uFileFormFilter);
    //$cAppearFormFilter = new CourtDateFormFilter();
    //$cAppearFormFilter->useFields(array('court_id', 'date', 'listing_id'));
    //$cAppearFormFilter->setWidget('court_id', new sfWidgetFormFilterInput(array('with_empty' => false)));
    //$cAppearFormFilter->setWidget('date', new sfWidgetFormFilterInput(array('with_empty' => false)));
    //$cAppearFormFilter->setWidget('listing_id', new sfWidgetFormFilterInput(array('with_empty' => false)));
    //$this->mergeForm($cAppearFormFilter);
    //$chargeFormFilter = new ChargeFormFilter();
    //$chargeFormFilter->useFields(array('charge'));
    //$this->mergeForm($chargeFormFilter);
 
    $this->widgetSchema['number'] = new sfWidgetFormFilterInput($opts, $atts);
    $this->widgetSchema['court'] = new sfWidgetFormFilterInput($opts, $atts2);
    $this->widgetSchema['date'] = new sfWidgetFormFilterInput($opts, $atts);
    $this->widgetSchema['listing'] = new sfWidgetFormFilterInput($opts, $atts);
    $this->widgetSchema['charge'] = new sfWidgetFormFilterInput($opts, $atts2);
    $this->widgetSchema['informant'] = new sfWidgetFormFilterInput($opts, $atts);
    $this->widgetSchema['solicitor'] = new sfWidgetFormFilterInput($opts, $atts);
        
    $this->validatorSchema['number'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['court'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['date'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['listing'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['charge'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['informant'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['solicitor'] = new sfValidatorPass(array('required' => false));
  
    $this->widgetSchema->setNameFormat('client_up_form_filters[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    
    /*$this->validatorSchema->setPreValidator(
      new sfValidatorCallback(array('callback' => array($this, 'formatValues')))
    );*/
  }
  
  
  /*public function formatValues($validator, $values)
  {
    if ($values['date']['text'] != '') { 
      $myDateTime = DateTime::createFromFormat('d-m-Y', $values['date']['text']);
      $values['date'] = array('text' => $myDateTime->format('Y-m-d'));
      
      // throw an error bound to the date field
      //$error = new sfValidatorError($validator, 'Verifying date');
      //throw new sfValidatorErrorSchema($validator, array('date' => $error));
    }
    return $values;
  }*/
  
  
  public function render($attributes = array()) 
  {
    $original_render = parent::render($attributes);
    
    $result = '';
    $columns = 3;
    $cont = 0;
    
    $arr = explode('</tr>', str_replace('<tr>', '', $original_render));
    
    foreach ($arr  as $k => $v) {
      if ($cont == 0) $result .= '<tr>';
      elseif ($cont % $columns == 0)  $result .= '</tr><tr>';
      $result .= $v;
      ++$cont;
    }
    
    if ($result != '') {
      --$cont;
      while ($cont % $columns != 0) {
        $result .= '<td></td>';
        ++$cont;
      }
      $result = '<table id="top_filter">'.$result.'</tr></table>';
      $original_render = $result;
    }

    return $original_render;
  }
}

?>
