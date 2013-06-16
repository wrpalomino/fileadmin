<?php

// formatters works only in "non admin generator" calls for the forms.

class EmbeddedFormContainerSchemaFormatter extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "<tr><td>%field%%error%%help%%hidden_fields%</td></tr>\n",
    $errorRowFormat  = "\n%errors%\n",
    $helpFormat      = '<br />%help%',
    $errorListFormatInARow     = '<ul class="error_list">%errors%</ul>',
    $errorRowFormatInARow      = '<li>%error%</li>',
    $namedErrorRowFormatInARow = '<li>%name%: %error%</li>',
    $decoratorFormat = "\n %content%";
  
  protected $params = array();
  
  public function __construct(sfWidgetFormSchema $widgetSchema, /*sfValidatorSchema $validatorSchema,*/ $params = array())
  {
    //$this->validatorSchema = $validatorSchema;
    $this->params = $params;
    $this->setDecoratorFormat("<table>%content%</table>");
    
    parent::__construct($widgetSchema);
  }  
}
?>
