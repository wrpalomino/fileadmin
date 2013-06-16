<?php

// formatters works only in "non admin generator" calls for the forms.

class ExtendedFormSchemaFormatter extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "<td style='white-space: nowrap'>%field%%error%%help%%hidden_fields%</td>\n",
    $errorRowFormat  = "<td>\n%errors%</td>\n",
    $helpFormat      = '<br />%help%',
    $errorListFormatInARow     = '<ul class="error_list">%errors%</ul>',
    $errorRowFormatInARow      = '<li>%error%</li>',
    $namedErrorRowFormatInARow = '<li>%name%: %error%</li>',
    $decoratorFormat = "<table><tr>\n %content%</tr></table>";
  
  protected $params = array();
  protected $td_style = "style='white-space:nowrap; padding:0px 2px; spacing:0px; text-align:center; width:100px; margin:0px'";
  
  public function __construct(sfWidgetFormSchema $widgetSchema, /*sfValidatorSchema $validatorSchema,*/ $params = array())
  {
    //$this->validatorSchema = $validatorSchema;
    $this->params = $params;
    $this->setRowFormat("<td ".$this->td_style.">%field%%error%%help%%hidden_fields%</td>\n");
   
    $header_label = '';
    if ( (isset($this->params['header'])) && ($this->params['header']) ) {
      $header_label = '<tr>'.$this->buildHeader($widgetSchema).'</tr>';
    }
    $this->setDecoratorFormat("<table>".$header_label."<tr>\n %content%</tr></table>");
    
    parent::__construct($widgetSchema);
  }
  
  public function buildHeader($widgetSchema)
  {
    $header_label = '';
    foreach ($widgetSchema->getPositions() as $k => $v)  {
      if ($v != 'id') {
        $lb = $widgetSchema[$v]->getLabel();
        if ($lb == '')  $lb = ucwords(str_replace('_id', '', $v));
        if (strtolower($lb) != 'hidden')  $header_label.= "<td ".$this->td_style.">".$lb."</td>";
      }
    }
    
    if (!isset($this->params['no_delete'])) {
      $header_label.= "<td ".".$this->td_style.".">Delete</td>";
    }
    
    return $header_label;
  }
  
}
?>
