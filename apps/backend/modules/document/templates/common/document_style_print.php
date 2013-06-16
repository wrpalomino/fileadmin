<?php /************************************************************************************************************/
/**********************************************  PRINTABLE STYLES  ************************************************/
/***************************************************************************************************************/ ?>
<?php /*if (!isset($preview)) $preview = false; ? >
<style media="<?php if ($preview): ?>screen<?php else: ?>print<?php endif; ?>" */ ?>

<style media="print">  
  div.doc_container {
    width: 100% !important;
    padding: 5px 5px 0px 15px;
    margin: 0px;
    /*float: left; /*avoid this to allow page brake in the print view */
    line-height: 140%;
    display: block !important;
    height: 100% !important;
    min-height: 100% !important;
    font: 14px Arial, "Helvetica Neue", Helvetica, sans-serif;
  }
  
  div.doc_header {
    width: 46%;
    height: 100px;
    float: left;
    font: inherit;
  }
  
  div.doc_logo {
    width: 50%;
    height: 140px;
    float: right;
    text-align: right;
    padding: 0px 25px 0px 0px;
    font: inherit;
  }
  
  div.doc_section {
    clear: both;
    width: 95% !important;
    padding: 5px 0px 0px 0px;
    text-align: justify;
    font: inherit;
  }
  
  div.doc_footer {
    width: 95% !important;
    vertical-align: bottom !important;
    font-size: 10px;
  }
  
  select.doc_field {
    border: none;
    -webkit-appearance: none;
    font: inherit;
  }
  
  input.doc_field {
    min-width: 200px;
    border: none;
    font: inherit;
  }
  
  input.doc_field_important {
    min-width: 200px;
    border: none;
    font: inherit;
    text-decoration: underline;
    font-weight: bold;
  }
  
  input.doc_field_long {
    min-width: 300px; /* !important;*/
    border: none;
    /*outline: none;*/
    font: inherit;
  }
  
  input.doc_field_short {
    min-width: 100px; /*!important;*/
    border: none;
    /*outline: none;*/
    font: inherit;
  }
  
  input.doc_field_short_important {
    min-width: 100px; /*!important;*/
    border: none;
    font: inherit;
    text-decoration: underline;
    font-weight: bold;
  }
  
  input.doc_field_long_important {
    min-width: 300px; /*!important;*/
    border: none;
    font: inherit;
    text-decoration: underline;
    font-weight: bold;
  }
  
  input.doc_field_numeric {
    min-width: 100px;
    border: none;
    font: inherit;
    /*text-align: right;*/
  }
  
  select.doc_field {
    font: inherit;
  }
  
  textarea.doc_field {
    width: 320px;
    border: none;
    font: inherit;
    line-height: 140%;
    resize:none;
    
    /*the div prinHelper will display the text; therefore, hide the textarea*/
    display: none;
  }
  
  textarea.doc_field_long {
    width: 100% !important;
    border: none;
    font: inherit;
    line-height: 140%;
    resize:none;
    
    /*the div prinHelper will display the text; therefore, hide the textarea*/
    display: none;
  }
  
  p.final_greetings {
    padding: 15px 5px;
    font: inherit;
  }
  
  p {
    margin-top: 10px;
    font: inherit;
  }
  
  p.warning {
    width: 100%;
    color: red;
    font-size: 18px;
    text-align: center;
    margin: 10px;
    font: inherit;
  }
  
  p.subtitle {
    margin-top: 10px;
    margin-bottom: 4px;
    font-weight: bolder !important;
    font: inherit;
  }
  
  table.fax td.label {
    border: 0px;
    padding: 5px;
    margin: 0px;
    width: 10% !important;
    font-weight: bold;
    font: inherit;
  }
  
  table.fax td.field {
    border: 0px;
    padding: 5px;
    margin: 0px;
    width: 40%;
    font: inherit;
  }
  
  table.fax {
    width: 100% !important;
    font: inherit;
    margin: 0px;
  }
  
  table.fax td {
    font: inherit;
  }
    
  img.logo_img {
    width: 360px;
    height: 136px;
    border: 0px;
  }
  
  img.magistrate_court_img {
    width: 140px;
    height: 140px;
    border: 0px;
  }
    
  img.fax_img {
    width: 100%;
    height: 76px;
    border: 0px;
  }
  
  img.legalAidLogo {
    width: 134px;
    height: 95px;
    border: 0px;
  }
   
  li {
    margin-bottom: 8px;
    line-height: 110%;
  }
  
  ul.compact, ol.compact {
    margin-top: 0px;
    margin-bottom: 0px;
  }

  ul.compact li, ol.compact li {
    margin: 0px;
    padding: 2px 0px;
  }
  
  ul.nested li {
    margin-left: 10px !important;
  }
  
  #lower-alpha li {
    list-style-type:lower-alpha;
  }

  #lower-roman li {
    list-style-type:lower-roman;
  }
  
  hr.division {
    width: 100%;
    display: block; 
    height: 2px;
    border: 0;
    border-top: 2px solid black;
    margin: 0px;
    padding: 0px;
  }
  
  div.clear {
    clear: both !important;
  }
  
  div.single_page {
    page-break-after: always;
    page-break-inside: avoid;
  }
  
  /* fix the display of checkboxes and radio boxes */
  table.choice_checks td {
    padding: 2px 0px;
  }
  
  table.compact {
    margin: 0px;
    padding: 0px;
    border-collapse: collapse;
  }

  table.compact td {
    /*no parameters, odd but necessary*/
  }

  /* take it from the deafult form plugin */
  #sf_admin_container .radio_list, #sf_admin_container .checkbox_list {
    margin: 0;
    padding: 0;
  }

  #sf_admin_container .radio_list li, #sf_admin_container .checkbox_list li {
    list-style: none;
    display: inline;
  }

  /* show radio boxes as checkboxes */
  table.choice_checks td input, #sf_admin_container .radio_list li input {
  /* added by William: to display always as checkbox, all major browser & +IE 10 */
  -webkit-appearance: checkbox;
  -moz-appearance: checkbox;
  -ms-appearance: checkbox;     /* not currently supported */
  -o-appearance: checkbox;      /* not currently supported */
  }

  /* to give give checkboxes a smooth display */
  .regular-checkbox {
    display: none;
  }

  .regular-checkbox + label {
    background-color: #fafafa;
    border: 1px solid #cacece;
    /*box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05);*/
    border-radius: 3px;
    display: inline-block;
    position: relative;
    width: 14px !important;
    height: 14px;
  }

  .regular-checkbox + label:active, .regular-checkbox:checked + label:active {
    /*box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1);*/
  }

  .regular-checkbox:checked + label {
    background-color: #e9ecee;
    border: 1px solid #adb8c0;
    /*box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1);*/
    color: #99a1a7;
  }

  .regular-checkbox:checked + label:after {
    content: '\2714';
    font-size: 14px;
    position: absolute;
    top: 0px;
    left: 3px;
    color: #99a1a7;
  }
  
  /************************************ Common styles for many elements **********************************/
  .pg_brk_after, .pg_brk_after_faxCover {
    page-break-after: always !important;
    page-break-inside: avoid;
    /*height: 1px;*/
  }
  
  .with_border {
    border: 2px solid #333333 !important;
  }
  
  .largest_font {
    font: inherit;
    font-size: 24px !important;
  }
  
  .larger_font {
    font: inherit;
    font-size: 18px !important;
  }
  
  .smaller_font {
    font: inherit;
    font-size: 12px !important;
  }
  
  .centered {
    text-align: center;
  }
  
  .right {
    text-align: right !important;
  }
  
  .fourth {
    width: 23% !important;
  }
  
  .third {
    width: 33% !important;
  }
  
  .half {
    width: 49% !important;
  }
  
  .three_fourth {
    width: 73% !important;
  }
  
  .full {
    width: 98% !important;
  }
  
  .important {
    font-weight: bold;
    text-decoration: underline;
    font: inherit;
  }
  
  .hidden {
    display: none;
  }
  
  .dotted {
    border-style: dotted !important;
  }
  
  .underline {
    text-decoration: underline;
  }
  
  /******************************** Non printable elements *************************************/
  div.doc_buttons {
     display: none;
  }
  
  div.doc_settings {
    display: none;
  }
  
  /* remove the shadowbox 'loading' word */
  #sb-loading {
    display: none !important;
  }
  
  div.faxCover {
    margin: 0px;
    padding: 0px;
    width: 100% !important;
    display: block;
    overflow: visible;
    font: 14px Arial, "Helvetica Neue", Helvetica, sans-serif;
  }
  
  /******************* to fix the height of text areas *****************/
  .noscroll {
    overflow: hidden;
  }
  
  .printHelperSpan {
    display: inline;
    font: inherit;
    white-space: nowrap;
  }
  
  .dynamicTextSpan {
    display: none;
  }
  
  .printHelper { 
    display: block;
    overflow: visible;
    font: inherit;
    padding: 0px;  /* padding: 5px; */  /*min-height: 50px;*/
    white-space: pre-wrap;
    word-wrap: break-word;
  }
  
</style>