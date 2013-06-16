<style media="screen">
  div.doc_container {
    width: 640px;
    padding: 5px 5px 0px 10px;
    margin: 0px;
    float: left;
    line-height: 140%;
    display: block !important;
    
    /*default font for the documents*/
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
    height: 100px;
    float: right;
    text-align: right;
    padding: 0px 5px;
    font: inherit;
  }
  
  div.doc_section {
    clear: both;
    width: 100%;
    padding: 5px 0px 0px 0px;
    margin: 0px;
    text-align: justify;
    font: inherit;
  }
  
  div.doc_footer {
    width: 100%;
    padding: 5px 0px 0px 0px;
    margin: 0px;
    font: inherit;
  }
  
  input.doc_field_short, input.doc_field_short_important {
    border: 1px dashed #aaa;
    width: 100px !important;
  }
  
  input.doc_field, input.doc_field_important {
    border: 1px dashed #aaa;
    width: 200px !important;
  }
  
  input.doc_field_long, input.doc_field_long_important {
    border: 1px dashed #aaa;
    width: 300px !important;
  }
  
  input.doc_field_numeric {
    border: 1px dashed #aaa;
    width: 100px;
    text-align: right;
  }
  
  textarea.doc_field {
    border: 1px dashed #aaa;
    width: 140px;
    font: inherit;
  }
  
  textarea.doc_field_long {
    border: 1px dashed #aaa;
    width: 100% !important;
    font: inherit;
  }
  
  p.final_greetings {
    padding: 15px 5px;
  }
  
  p {
    margin-top: 10px;
  }
  
  p.warning {
    width: 100%;
    color: red;
    font-size: 18px;
    text-align: center;
    margin: 10px;
  }
  
  p.subtitle {
    margin-top: 10px;
    margin-bottom: 4px;
    font: inherit;
    font-weight: bolder !important;
  }
  
  table.fax td.label {
    border: 0px;
    padding: 5px;
    margin: 0px;
    width: 10% !important;
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
    width: 300px;
    height: 114px;
    border: 0px;
  }
  
  img.magistrate_court_img {
    width: 140px;
    height: 140px;
    border: 0px;
  }
  
  img.fax_img {
    width: 100%;
    height: 70px;
    border: 0px;
  }
  
  img.legalAidLogo {
    width: 134px;
    height: 95px;
    border: 0px;
  }

  li {
    margin-bottom: 10px;
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
    padding-top: 2px;
    padding-bottom: 2px;
  }

  /* take it from the deafult form plugin */
  #sf_admin_container .radio_list, #sf_admin_container .checkbox_list {
    margin: 0;
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
    box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05);
    border-radius: 3px;
    display: inline-block;
    position: relative;
    width: 3px !important;
    height: 12px;
  }

  .regular-checkbox + label:active, .regular-checkbox:checked + label:active {
    box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1);
  }

  .regular-checkbox:checked + label {
    background-color: #e9ecee;
    border: 1px solid #adb8c0;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1);
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
  }
  
  .important {
    text-decoration: underline;
    font: inherit;
    font-weight: bolder !important;
  }
  
  .hidden {
    max-width: 580px;
    display: none;
  }
  
  .dotted {
    border-style: dotted !important;
  }
  
  .underline {
    text-decoration: underline;
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
    font-size: 10px !important;
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
  
  /****************************************** Non printable elements *************************************/
  div.doc_buttons {
    float: left;
    width: 75px;
    padding: 0px 2px;
    height: 500px;
    display: block;
    /*border: 1px solid;*/
  }
  
  div.doc_settings {
    float: left;
    border: solid 1px;
    display: table;
    display: block;
    margin-bottom: 10px;
  }
  
  table.doc_settings td {
    border: 0px;
    padding: 2px 8px;
    margin: 0px;
  }
  
  button {
    width: 70px;
  }
 
  /* not working
  input[type=submit] { 
    width: 70px;
  }*/
  
  div.faxCover {
    margin: 0px;
    padding: 0px;
    width: 640px;
    display: none !important;
    /*display: visible !important;*/
    font: 14px Arial, "Helvetica Neue", Helvetica, sans-serif;
  }
  
  /******************* to fix the height of text areas *****************/
  .noscroll {
    overflow: hidden;
  }
  
  .printHelperSpan {
    display: none;
    font: inherit;
    white-space: nowrap;
  }
  
  .dynamicTextSpan {
    /*display: none;*/ /* does not work, gives width = 0 in javascript*/
    margin-left: -1000px;
    white-space: nowrap;
    visibility: hidden;
  }
  
  .printHelper {
    display: none;
    font: inherit;
    padding: 0px; /* padding: 5px; */ /*min-height: 50px;*/
    overflow: hidden;
    white-space: pre-wrap;
    /*word-wrap: break-word;*/
  }
  
</style>

