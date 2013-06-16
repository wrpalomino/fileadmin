<?php

/**
 * DocumentDetail form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentDetailForm extends BaseDocumentDetailForm
{
  private $mandatory_fields;
  
  public function configure()
  {
    $this->mandatory_fields = array('document_id');
    $this->widgetSchema['document_id'] = new sfWidgetFormInputHidden();
    
    $doc = $this->getOption('doc');
    if ($doc) {
      $func = 'loadDocDetTpl'.$doc;
      $this->$func($doc);
    }
    
    $document_detail_decorator = new DocumentFormSchemaFormatter($this->getWidgetSchema());
    $this->widgetSchema->addFormFormatter('DocumentDetailFormatter', $document_detail_decorator);
    $this->widgetSchema->setFormFormatterName('DocumentDetailFormatter');
  }
  
  public function loadDocDetTplLacofn($doc)
  {
    $fields = array('field1',   'field2',   'field3',   'field4',   'field5',
                    'field6',   'field7',   'field8',   'field9',   'field10');
    
    $this->useFields(array_merge($this->mandatory_fields, $fields));
    
    $yes_no_options = Doctrine::getTable('UserFile')->getYesNoNcOptions();
    $this->widgetSchema['field1'] = new sfWidgetFormChoice(array('choices' => $yes_no_options));
    $this->widgetSchema['field2'] = new sfWidgetFormChoice(array('choices' => $yes_no_options));
    $this->widgetSchema['field3'] = new sfWidgetFormChoice(array('choices' => $yes_no_options));
    $this->widgetSchema['field4'] = new sfWidgetFormChoice(array('choices' => $yes_no_options));
    $this->widgetSchema['field5'] = new sfWidgetFormChoice(array('choices' => $yes_no_options));
    $this->widgetSchema['field6'] = new sfWidgetFormChoice(array('choices' => $yes_no_options));
    $this->widgetSchema['field7'] = new sfWidgetFormChoice(array('choices' => $yes_no_options));
    $this->widgetSchema['field8'] = new sfWidgetFormChoice(array('choices' => $yes_no_options));
    $this->widgetSchema['field9'] = new sfWidgetFormChoice(array('choices' => $yes_no_options));
    $this->widgetSchema['field10'] = new sfWidgetFormChoice(array('choices' => $yes_no_options));
    
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field5']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field7']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field8']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field');
  }
  
  public function loadDocDetTplBafiti($doc)
  {
    $fields = array('field1',   'field2',   'field3',   'field4',   'field5');
    
    $this->useFields(array_merge($this->mandatory_fields, $fields));
    
    $this->widgetSchema['field3'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getBailApplicationOptions("time"),
        'expanded' => true
    ));
    $this->widgetSchema['field4'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getBailApplicationOptions("hearing_details"),
        'expanded' => true,
        'multiple' => true
    ));
    
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field5']->setAttribute('class', 'doc_field');
  }
  
  public function loadDocDetTplBaprre($doc)
  {
    $this->loadDocDetTplBafiti($doc);
  }
  
  
  public function loadDocDetTplRecofr($doc)
  {
    $fields = array('field1',   'field2',   'field3',   'field4',   'field5',
                    'field6',   'field7',   'field8',   'field9',   'field10');
    
    $this->useFields(array_merge($this->mandatory_fields, $fields));
    
    $yes_no = array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions(false, false), 'expanded' => true);
    $this->widgetSchema['field1'] = new sfWidgetFormChoice($yes_no);
    $this->widgetSchema['field2'] = new sfWidgetFormChoice($yes_no);
    $this->widgetSchema['field3'] = new sfWidgetFormChoice($yes_no);
    $this->widgetSchema['field4'] = new sfWidgetFormChoice($yes_no);
    $this->widgetSchema['field5'] = new sfWidgetFormChoice($yes_no);
    $this->widgetSchema['field6'] = new sfWidgetFormChoice($yes_no);
    $this->widgetSchema['field7'] = new sfWidgetFormChoice($yes_no);
    $this->widgetSchema['field8'] = new sfWidgetFormChoice($yes_no);
    $this->widgetSchema['field9'] = new sfWidgetFormChoice($yes_no);
    $this->widgetSchema['field10'] = new sfWidgetFormChoice($yes_no);
  }
  
  public function loadDocDetTplWitsum($doc)
  {
    $fields = array('field1',   'field2',   'field3',   'field4',   'field5',
                    'field6',   'field7');
    
    $this->useFields(array_merge($this->mandatory_fields, $fields));
   
    $this->widgetSchema['field1'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getWitnessSummonOptions(), 
        'expanded' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter'))
        ));
    
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field5']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field7']->setAttribute('class', 'doc_field');
  }
}
