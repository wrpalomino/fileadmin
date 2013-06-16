<?php

// formatters works only in "non admin generator" calls for the forms.

class DocumentFormSchemaFormatter extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "%field%%error%%help%%hidden_fields%",
    $errorRowFormat  = "\n%errors%\n",
    $helpFormat      = '<br />%help%',
    $errorListFormatInARow     = '<ul class="error_list">%errors%</ul>',
    $errorRowFormatInARow      = '<li>%error%</li>',
    $namedErrorRowFormatInARow = '<li>%name%: %error%</li>',
    $decoratorFormat = "%content%";
  
  protected $params = array();
  
  public function __construct(sfWidgetFormSchema $widgetSchema, /*sfValidatorSchema $validatorSchema,*/ $params = array())
  {
    //$this->validatorSchema = $validatorSchema;
    $this->params = $params;
   
    //$header_label = $this->buildHeader($widgetSchema);
    //$this->setDecoratorFormat("<table><tr>".$header_label."</tr><tr>\n %content%</tr></table>");
    
    parent::__construct($widgetSchema);
  }
  
  /*public function buildHeader($widgetSchema)
  {
    $header_label = '';
    foreach ($widgetSchema->getPositions() as $k => $v)  {
      if ($v != 'id') {
        $lb = $widgetSchema[$v]->getLabel();
        if ($lb == '') $lb = ucwords(str_replace('_id', '', $v));
        $header_label.= "<td style='white-space: nowrap'>".$lb."</td>";
      }
    }
    $header_label.= "<td>Delete</td>";
    
    return $header_label;
  }*/
  
}
?>
