// this code is execute at window load or page ready
$(document).ready(function() {  
  
  // to select between judge and magistrate according to court type (child shadowbox window)
  if (top != self) {
    if ( (parent.top.$('#court_date_court_id').length) && ($('#sf_guard_user_groups_list').length) ) {
      var idx = parent.top.$('#court_date_court_id').val();
      $.post('checkCourtType', {id: idx}, function(data) {
        //alert(data);
        $("#sf_guard_user_groups_list option:contains(" + data + ")").attr('selected', 'selected');
      });
    }
  }
  
  // enable email action in lists
  $('.sf_admin_action_email').find('a').click(function(e) {
    arrx = this.href.split('/');
    route = (arrx[arrx.length-3]) ? arrx[arrx.length-3]+'/'+arrx[arrx.length-1]+'?id='+arrx[arrx.length-2] : null;
    
    if (route) {  
      file = subject = '';
      file = $(this).closest("tr").find('.sf_admin_list_td_document_file').find('a').text();
      subject = $.trim($(this).closest("tr").find('.sf_admin_list_td_description').text());
      
      $.printPreview.loadPrintPreview(route, 'email_attachment', '', subject, file);
      $('#email-layout').val('');
    }
    return false;
  });
  
  // disabled the href from tabs
  $('.tabHref').click(function(e) {e.preventDefault();});
  
  // for file module: load client data
  if ($("#user_file_client_id").length) {    
    var lastValue;
    $("#user_file_client_id").bind("click", function(e) {
      lastValue = $(this).val();
    }).bind("change", function(e) {

      var reload_lnk = changeHref();
      if ($("#user_file_id").val()) {
        if (confirm("Do you really want to load this client info?")) {
          parent.window.location.href = reload_lnk;
        }
        /*var change_confirmation = confirm("Do you really want to change the client for this file\nThis is not advisable because the clien\'t data must be changed manually too!");
        if (!change_confirmation) {
          $(this).val(lastValue);
        }*/
      }
      else {
        parent.window.location.href = reload_lnk;
      }
    });
  }
  
  // for informant module: create email from badge number
  if ($("#sf_guard_user_badge_number").length) {
    $("#sf_guard_user_badge_number").blur(function() {
      if ($(this).attr("value") != "") {
        $("#sf_guard_user_email_address").css({'color': "#666", 'background-color': 'yellow'});
        $("#sf_guard_user_email_address").val("vp"+$(this).attr("value")+"@police.vic.gov.au");
      }
    });
  }
  
  
  // sort all dropdowns that request it
  $(".sortMe").each(function() {
    var selectedValue = $(this).val();  // Keep track of the selected option.
 
    // Sort all the options by text. I could easily sort these by val.
    $(this).html($("option", $(this)).sort(function(a, b) {
      return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
    }));
    $(this).val(selectedValue);     // Select one option.
  });
 
});


// toggle search form
function toggle() 
{
  var ele = document.getElementById("searchForm");
  if (ele.style.display == "block") {
    ele.style.display = "none";
    $("#filters_txt").text(' Search');
  }
  else {
    ele.style.display = "block";
    $("#filters_txt").text(' Hide Search');
  }
}


// toggle tabs for form with multiple tabs (file) 
function show_tab(tab)
{
  var num_tabs = document.getElementById('num_tabs').value;
  
  for (var k=1; k<=num_tabs; k++) {
    tab_div = document.getElementById('tab_'+k);
    tab_selected = document.getElementById('tab_selected_'+k);
    if (tab_div != null) {
      if (k == tab)  {
        tab_div.style.display = "block";
        tab_selected.className = "activeje";
        //alert('diplaying tab number'+k);
      }
      else {
        tab_div.style.display = "none";
        tab_selected.className = "";
      }
    }
  }

}


// to fix the print preview problem with shadowbox
function RefreshParent()
{
  parent.location.reload();
  //window.location.reload();
}


function openBox($rel_path, width, height, use_base_path)
{
  width = typeof width !== 'undefined' ? width : 1050;
  height = typeof height !== 'undefined' ? height : 650;
  use_base_path = typeof use_base_path !== 'undefined' ? use_base_path : true;
  var base_root = (use_base_path) ? SF_BASE_URL : '';
  Shadowbox.open({content: base_root+$rel_path, width: width, height: height, player:'iframe'});
}


$.urlParam = function(name)
{
  var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
  return (results) ? results[1] : null;
}


function selectOpenBox(module_str, select_object)
{
  var module_arr = module_str.split('?');
  var module = module_arr[0];
  var code_str = (module_arr[1]) ? '&'+module_arr[1] : '';
  
  var selected_val = $("#"+select_object).val();
  var action = (selected_val != '') ? selected_val+'/edit' : 'new';
  openBox(module+'/'+action+'?shbx=1&sel_obj='+select_object+'&module='+module+code_str, 850, 600);
}

function appendSelect(obj_id, module)
{
  if (obj_id != '') {
    var val = '';var txt = '';
    switch (module) {
      case 'informant':
      case 'prosecutor':
      case 'client':
      case 'user':
      case 'judge':
      case 'clerk':
      case 'barrister':
        val = $("#sf_guard_user_id").val();
        txt = $("#sf_guard_user_last_name").val();
        if ($("#sf_guard_user_first_name").length) txt = $("#sf_guard_user_first_name").val()+' '+txt;
        break;
      case 'prosecution':
      case 'agency':
        val = $("#agency_id").val();
        txt = $("#agency_name").val();
        break;
      default:
        val = $("#"+module+"_id").val();
        txt = $("#"+module+"_name").val();
        break;
    }
    var selected_value = parent.top.$("#"+obj_id+" option:selected").val();
    
    // only add if the object is new
    if (selected_value != val) {
      parent.top.$("#"+obj_id).append('<option value="'+val+'" selected="selected">'+txt+'</option>');
      
      if (module == 'client') {  // update the load client details link 
        var reload_lnk = changeHref('parent', val);
        
        parent.window.location.href = reload_lnk;
      }
    }
    
  }
}


// change uset id in the load client details link
function changeHref(window, arg1)
{
  window = typeof window !== 'undefined' ? window : '';
  arg1 = typeof arg1 !== 'undefined' ? arg1 : '';
  
  if (arg1 == '') {
    if (window == 'parent') {
      arg1 = parent.top.$('#user_file_client_id').val();
    }
    else {
      arg1 = $('#user_file_client_id').val();
    }
    if (!arg1) arg1 = 0;
  }

  if (window == 'parent') {
    href = parent.top.$('#client_load').attr('href');
    new_href = href.replace(/user_id=([0-9]+)/gi, 'user_id='+arg1); 
    parent.top.$('#client_load').attr('href', new_href);
  }
  else {
    href = $('#client_load').attr('href');
    new_href = href.replace(/user_id=([0-9]+)/gi, 'user_id='+arg1); 
    $('#client_load').attr('href', new_href);
  }
  
  return new_href;
}

function updateLoadUserDataHref()
{
  var arg1 = $('#user_file_client_id').val();
  //alert (arg1);
  href = $('#client_load').attr('href');
  new_href = href.replace(/user_id=([0-9]+)/gi, 'user_id='+arg1);
  $('#client_load').attr('href', new_href);
}


function briefrequest(num, doc)
{
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; //January is 0!
  var yyyy = today.getFullYear();
  
  $("#brief_request"+num+"_day").val(dd);
  $("#brief_request"+num+"_month").val(mm);
  $("#brief_request"+num+"_year").val(yyyy);
  
  openBox('document/new?doc='+doc);
}

function loadFromDropBoxToTextArea(thisx, textarea_id)
{
  var select_id = $(thisx).attr('id');
  //alert($('#'+select_id+' option:selected').text());
  $('#'+textarea_id).val($.trim($('#'+select_id+' option:selected').text()));
  
  if ($('#'+textarea_id).val() != '') {
    $('#'+textarea_id).css("display", "block");
  }
  else {
    $('#'+textarea_id).css("display", "none");
  }
}

function changeDocumentDate(form)
{
  /*var m_names = new Array("January", "February", "March", "April", "May", "June", 
  "July", "August", "September", "October", "November", "December");
  
  var selected_date = (form.date2.value);
  var arr = selected_date.split('-');
  var new_formated_date = arr[2]+' '+m_names[(arr[1]-1)]+' '+arr[0];
  
  var date_span1 = $('#document_date');
  var date_span2 = $('#document_date2');
  if (date_span1.length) date_span1.text(new_formated_date);
  if (date_span2.length) date_span2.text(new_formated_date);*/
   
  var assigned = false; 
  $('.document_date').each(function() {
    var formatx = $(this).attr('title'); // define vars because is not possible use $(this) inside the $.get
    var datex = form.date2.value;
    var elem = $(this);
    $.get('reFormatDate', {date: datex, format: formatx}, function (data) {
      if (!assigned) {
        arr = $('#document_code').val().split('-');
        arr[2] = data.adate;
        $('#document_code').val(arr.join('-'));
        assigned = true;
        // set the doc_date field too
        $('#document_doc_date').val(data.sdate);
      }
      elem.text(data.fdate);
    }, "json");
  });
  
  
  
}


function displayDataMainFilter(data)
{
  //alert (data);  //var id = $.evalJSON(data).id;
  if (data != '') {
    var obj = $.parseJSON(data); //$.evalJSON(data);
    
    if (obj) {
      $.each(obj, function (key, value) {
        if ($('#client_up_form_filters_'+key).length > 0) $('#client_up_form_filters_'+key).val(value);
      });
    }
  }
}


/************** resize iframe ***************************/
// Tell the parent iframe what height the iframe needs to be
function parentIframeResize()
{
  var height = $.getDocHeight()+20;
  parent.resizeIframe(height, window.frameElement.id);
}

// Resize iframe to full height
function resizeIframe(height, frameid)
{
  // "+60" is a general rule of thumb to allow for differences in IE & and FF height reporting, can be adjusted as required
  document.getElementById(frameid).height = parseInt(height); //+60;
}

$.getDocHeight = function()
{
  return Math.max(
    $(document).height(), 
    $(window).height(), 
    document.documentElement.clientHeight  // For opera
  );
};


/********************* to resize textareas and text boxes accoring their content *********************/
$.dynamicText = function() 
{
  var original_height = [];
  $("textarea").each(function() 
  {
    var txt = $('#'+this.id);                             // get the textarea element
    var content = null;

    var hiddenDiv0 = $(document.createElement('div'));    // create the div helpers for printing
    hiddenDiv0.attr("id", this.id+'_div');
    txt.after(hiddenDiv0);                                // added after the textarea

    // give textarea and print helper class
    hiddenDiv0.attr("class", txt.attr("class"));   
    hiddenDiv0.addClass('printHelper');
    hiddenDiv0.width(txt.width());

    txt.addClass('noscroll');                             // remove the scroll 
    original_height[this.id] = txt.height();              // save the original height for textareas

    content = txt.val();
    content = content.replace(/\n/g, '<br/>');
    hiddenDiv0.html(content);
    height = (hiddenDiv0.height() > original_height[this.id]) ? hiddenDiv0.height() : original_height[this.id];
    txt.css('height', height);

    txt.bind('focus', function() 
    {
      hiddenDiv0.css("height", "");        // reset the div's height before measuring again
    });

    txt.bind('keyup', function() 
    {
      content = txt.val();
      content = content.replace(/\n/g, '<br/>');
      hiddenDiv0.html(content);
      height = (hiddenDiv0.height() > original_height[this.id]) ? hiddenDiv0.height() : original_height[this.id];
      txt.css('height', height);
    })

  });
  
  var original_width = [];
  $("input:text").each(function() 
  {
    if (this.id) {
      var input = $('#'+this.id); 
      var content0 = null;

      //var hiddenSpan0 = $(document.createElement('span'));    // create the span helpers for printing NOT NECESSARY!
      var dinamicTextSpan = $(document.createElement('span'));    // create the span for dynamic text

      //hiddenSpan0.attr("id", this.id+'_span');
      dinamicTextSpan.attr("id", this.id+'_dt_span');

      //input.after(hiddenSpan0);
      $('body').after(dinamicTextSpan);     // hide the spans

      //give input text and print helper class
      //hiddenSpan0.attr("class", input.attr("class"));
      dinamicTextSpan.attr("class", input.attr("class"));
      dinamicTextSpan.addClass('dynamicTextSpan');
      //hiddenSpan0.width(input.width());
      dinamicTextSpan.attr('style','width:'+input.width()+'px !important');   // override the original elements important
      dinamicTextSpan.css('font',input.css('font'));                          // ensure to use the right font style

      original_width[this.id] = input.width();              // save the original width for text boxes

      content0 = input.val();
      //hiddenSpan0.html(content0);
      dinamicTextSpan.text(content0);

      width = (dinamicTextSpan.width() > original_width[this.id]) ? dinamicTextSpan.width() : original_width[this.id];

      //hiddenSpan0.addClass('printHelperSpan');

      //input.css('width', width);
      input.attr('style', 'width:'+width+'px !important');   // override the original elements important

      input.bind('keyup', function() 
      {
        content0 = input.val();
        //hiddenSpan0.html(content0);
        dinamicTextSpan.text(content0);

        width = (dinamicTextSpan.width() > original_width[this.id]) ? dinamicTextSpan.width() : original_width[this.id];

        //input.css('width', width);
        input.attr('style', 'width:'+width+'px !important');  // override the original elements important
      })
    }
    
  });
  
  
};

/*** replace the predefined selected option with the user selection ***/
$(window).load(function() 
{
  $('select.doc_field').each(function() { 
    $(this).change( function() {
      $('option:selected', this).attr('selected','selected').siblings().removeAttr('selected');
      $('option:selected', this).replaceWith($('<option value="'+$(this).val()+'" selected="selected">'+$('option:selected', this).text()+'</option>'));
    });
  });
});


/********************* fixing some css for the email's layout *************************/
$.fixPrintModalContent = function() 
{
  $('#print-modal-content').contents().find('select.doc_field').each(function() {
    selectSpan = $(document.createElement('span'));
    selectSpan.attr("class", $(this).attr("class"));
    //selectSpan.addClass('dynamicTextSpan');
    selectSpan.css('font',$(this).css('font'));
    selectSpan.text($(this).children("option").filter(":selected").text());  //get real selected text
    selectSpan.width($(this).width());
    $(this).replaceWith(selectSpan);
  });

  $('#print-modal-content').contents().find("form :input").attr("readonly", "readonly");
  
  // added by William, 07/05/2013: to create doc files
  $('#print-modal-content').contents().find("form :input[type=text]").replaceWith(function() {
   return '<span class='+$(this).attr("class")+'>'+$(this).val()+'</span>';
  });
  
  
  $('#print-modal-content').contents().find("div.doc_settings").remove();
  $('#print-modal-content').contents().find("div.doc_buttons").remove();
  
  $('#print-modal-content').contents().find("textarea").remove(); // texareas are display:none for printing
  $('#print-modal-content').contents().find("div.notice").remove();  
  $('#print-modal-content').contents().find("div.error").remove();
  
  // fix all the radio buttons and checkboxes
  $('#print-modal-content').contents().find("form :input[type=radio]").each(function() {
    if ($(this).is(':checked'))  {
      $(this).replaceWith($('<input type="radio" checked="checked" value="'+$(this).val()+'" name="'+$(this).attr('name')+'" id="'+$(this).attr('id')+'" />'));
    }
  });
  $('#print-modal-content').contents().find("form :input[type=checkbox]").each(function() {
    if ($(this).is(':checked'))  {
      $(this).replaceWith($('<input type="radio" checked="checked" value="'+$(this).val()+'" name="'+$(this).attr('name')+'" id="'+$(this).attr('id')+'" />'));
    }
  });
    
  // convert relative url to full url to display documents in other locations
  var base_url = $(location).attr('protocol') + "//" + $(location).attr('host');
  if ($(location).attr('host') == 'localhost') base_url = PRO_BASE_URL;   // to use in localhost only
  $('#print-modal-content').contents().find("img").each(function() {
    $(this).attr("src", base_url+$(this).attr("src").replace("fileadmin/", ""));
  });
  $('#print-modal-content').contents().find("link").each(function() {
    $(this).attr("href", base_url+$(this).attr("href").replace("fileadmin/", ""));
  });
  
  $('#print-modal-content').contents().find("#sb-container").remove();
  
  $('#print-modal-content').contents().find("hover").remove();
  
  $('#print-modal-content').contents().find(".etaButton").remove();
};


function fitTextAreasHeights()
{
  // comment by William, 20/11/2012: set helper div's height to original textarea's height in case this is smaller
  $('.printHelper').each(function() 
  {
    if (this.id) {
      var input = $('#'+this.id.replace('_div', ''));
      var div = $('#'+this.id);
      height = (div.height() > input.height()) ? div.height() : input.height()
      div.css('height', height);
      //input.css('display', 'none');   // must be done in style sheet for print!!!
    }
  });
}

function printPage()
{ 
  var selected = $('#doc_settings_table input:checkbox:checked').map(function(i,el){return el.value;}).get(); 
  selected = jQuery.grep(selected, function(value) {  // remove empty values
    return value != '';
  });
  var count = selected.length;
  
  var doc = $.urlParam('doc');
  var doc_url = window.location.href;
  
  // first remove all the fax covers 
  $('.faxCover').remove();
  $('.pg_brk_after_faxCover').remove();
  
  $.when(fitTextAreasHeights()).done(function () {
    $.each(selected, function(index, value) {  
      if (value != '') {
        url = doc_url.replace('doc='+doc, 'doc='+value);      //alert (url);

        page_braker = $(document.createElement('div'));
        $('#sf_admin_form_doc').append(page_braker);
        page_braker.addClass('pg_brk_after_faxCover');

        hiddenDivx = $(document.createElement('div'));
        hiddenDivx.attr("id", '#faxcover_'+value);
        $('#sf_admin_form_doc').append(hiddenDivx);
        hiddenDivx.addClass('faxCover');
        //hiddenDivx.addClass('doc_container');
        hiddenDivx.load(url+" #doc_container", function() {
          if (!--count) {
            verifyDocumentSaved('print');  // added by william, 17/05/2013: verify if document has been saved
            window.print();
          }
        });
      }
    });
    if (selected.length == 0) {
      verifyDocumentSaved('print');  // added by william, 17/05/2013: verify if document has been saved
      window.print();
    }
  });
  
  return false;
}


function htmlspecialchars_decode (string, quote_style) {
    // Convert special HTML entities back to characters  
    // 
    // version: 1109.2015
    // discuss at: http://phpjs.org/functions/htmlspecialchars_decode
    // +   original by: Mirek Slugen
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: Mateusz "loonquawl" Zalega
    // +      input by: ReverseSyntax
    // +      input by: Slawomir Kaniecki
    // +      input by: Scott Cariss
    // +      input by: Francois
    // +   bugfixed by: Onno Marsman
    // +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // +      input by: Ratheous
    // +      input by: Mailfaker (http://www.weedem.fr/)
    // +      reimplemented by: Brett Zamir (http://brett-zamir.me)
    // +    bugfixed by: Brett Zamir (http://brett-zamir.me)
    // *     example 1: htmlspecialchars_decode("<p>this -&gt; &quot;</p>", 'ENT_NOQUOTES');
    // *     returns 1: '<p>this -> &quot;</p>'
    // *     example 2: htmlspecialchars_decode("&amp;quot;");
    // *     returns 2: '&quot;'
    var optTemp = 0,
        i = 0,
        noquotes = false;
    if (typeof quote_style === 'undefined') {
        quote_style = 2;
    }
    string = string.toString().replace(/&lt;/g, '<').replace(/&gt;/g, '>');
    var OPTS = {
        'ENT_NOQUOTES': 0,
        'ENT_HTML_QUOTE_SINGLE': 1,
        'ENT_HTML_QUOTE_DOUBLE': 2,
        'ENT_COMPAT': 2,
        'ENT_QUOTES': 3,
        'ENT_IGNORE': 4
    };
    if (quote_style === 0) {
        noquotes = true;
    }
    if (typeof quote_style !== 'number') { // Allow for a single string or an array of string flags
        quote_style = [].concat(quote_style);
        for (i = 0; i < quote_style.length; i++) {
            // Resolve string input to bitwise e.g. 'PATHINFO_EXTENSION' becomes 4
            if (OPTS[quote_style[i]] === 0) {
                noquotes = true;
            } else if (OPTS[quote_style[i]]) {
                optTemp = optTemp | OPTS[quote_style[i]];
            }
        }
        quote_style = optTemp;
    }
    if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
        string = string.replace(/&#0*39;/g, "'"); // PHP doesn't currently escape if more than one 0, but it should
        // string = string.replace(/&apos;|&#x0*27;/g, "'"); // This would also be useful here, but not a part of PHP
    }
    if (!noquotes) {
        string = string.replace(/&quot;/g, '"');
    }
    // Put this in last place to avoid escape being double-decoded
    string = string.replace(/&amp;/g, '&');
 
    return string;
}


function limitText(limitField, /*, limitCount,*/ limitNum) 
{
  if (limitField.value.length > limitNum) {
    limitField.value = limitField.value.substring(0, limitNum);
  } 
  /*else {
    limitCount.value = limitNum - limitField.value.length;
  }*/
}


function isValidEmailAddress(emailAddress) 
{
  var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
  return pattern.test(emailAddress);
};


function loadSMSTemplate(elem, url)
{
  var idx = $("#"+elem.id).val();
  //alert(idx);
  
  if (idx != "") {
    $.post(url, {id: idx}, function(data) {
      if ($('#short_message_message').length) {
        $('#short_message_message').val(data);
      }
    });
  }
}


/* disable backspace except for textareas and input fields */
$(document).keydown(function(e) 
{
  var nodeName = e.target.nodeName.toLowerCase();

  if (e.which === 8) {
    if ( (nodeName === 'input' && (e.target.type === 'text' || e.target.type === 'password')) || 
          nodeName === 'textarea' ) {
        // do nothing
    } 
    else {
      e.preventDefault();
    }
  }
});


/* Basically the below function matches each date part and uses the Date constructor, 
 * to build a date object, note that the months argument needs to be 0-based (0=Jan, 1=Feb,...11=Dec).
*/
function parseDate(input) 
{
  var parts = input.match(/(\d+)/g);
  return new Date(parts[0], parts[1]-1, parts[2]);
}

function reformatDate(new_format, datex)
{
  if ( (datex != '')&&(!ValidateDate(datex)) ) {
    datex = $.datepicker.formatDate(new_format, parseDate(datex));
  }
  return datex;
}

// used "mm/dd/yyyy" or "mm-dd-yyyy" format
function ValidateDate(dtValue)
{
  var dtRegex = new RegExp(/\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/);
  return dtRegex.test(dtValue);
}


function str_repeat(input, multiplier) 
{  
  var ret = "";
  for (var i = 0; i < multiplier; i++) {
    ret += input;
  }
  return ret;
}


$.fn.cloneForm = function(withDataAndEvents) {
  var cln = $(this).clone(withDataAndEvents);
  $(this).find(':input').each(function(){
    if ($(this).attr('id') != '') {
      cln.find("#"+$(this).attr('id')).replaceWith($(this).cloneField(true));
    }
  });
  return jQuery(cln);
};


$.fn.cloneField = function(withDataAndEvents) {
  var clones = [];
  this.each(function(){
    var cln = $(this).clone(withDataAndEvents);
    cln.val($(this).val());
    clones.push(cln.get(0));
  });
  return jQuery(clones); 
}; 


$.fn.checkDocumentChange = function(windowjQuery) {
  var changed = false;  
  $(this).find(':input').each(function () {
    if ($(this).attr('id') != '') {
      //alert($(this).attr('id')+' initial: '+windowjQuery.data($(this)[0], 'initialValue')+', new: '+$(this).val());
      if (windowjQuery.data($(this)[0], 'initialValue') != $(this).val()){ 
        changed = true;
        return;
      }
    }
  });
  return changed;
}

var timer_autosave, ajax_autosave, ajax_save;  // global vars

function verifyDocumentSavedSB()
{
  var form = $('#sb-player').contents().find('#documentform');
  
  if (form.length) {  // check if it is the document shadowbox
    // request change only if changes in the form
    if (form.checkDocumentChange($('#sb-player')[0].contentWindow.$)) verifyDocumentSaved("iframe");
    
    // clear buffer before closing shadowbox
    if (timer_autosave) clearTimeout(timer_autosave);   // cancel any pending ajax call
    if (ajax_autosave)  ajax_autosave.abort();          // kill autosave if running
    var arr3 = form.attr('action').split("document");
    $.get(arr3[0]+"document/clearbuffer?_clb=1", {}, function(data) {}).success(function(data) {}).error(function(data) {});
  }
  //alert("closing");
}


// check if this is a buffer document to define if it is from a previous saved document or for a new one
$.loadBuffer = function() {
  if ($('#document_description').val() == 'buffer')  {
    var buffer_id = $('#document_id').val();
    var doc_id = $('#document_name').val();
    var faction = $('#documentform').attr('action');
    $('#document_name').val('');
    $('#document_description').val('');

    if (doc_id != '') {  // from saved document
      $('#document_id').val(doc_id);
      $('#documentform').attr('action', faction.replace("/"+buffer_id, "/"+doc_id));
    }
    else {  // for new document
      $('#document_id').val('');
      $('#documentform').find('input:hidden[name="sf_method"]').remove();
      var arr2 = faction.split("document");
      var arr3 = $('#document_code').val().split('-');
      var doc_type = (arr3[1]) ? arr3[1] : '';
      $('#documentform').attr('action', arr2[0]+"document?doc="+doc_type);
    }
  }
};

// added by William, 17/05/2013: verify if current document has been saved
function verifyDocumentSaved(action_type, buffer_id)
{
  buffer_id = typeof buffer_id !== 'undefined' ? buffer_id : 0;
  action_type = typeof action_type !== 'undefined' ? action_type : "";
  var new_doc = false;
  var save = true;            // always save
  
  var form0 = $('#documentform');
  
  if (action_type == 'iframe') {  // call the ajax from outside the iframe (document window)
    action_type = '';
    form0 = $('#sb-player').contents().find('#documentform');
  }
  
  if ( (form0.find('#document_id').val() == '') && (action_type != "buffer") ) {
    new_doc = true;
    save = confirm("The current document has not been saved.\nDo you want to save it?");
  }
  
  var action = form0.attr('action');
  if (save) {    
    var formx = form0;
    
    if (action_type != "buffer") {
      if (action_type != "") {
        var org_val = form0.find('#document_description').val();
        if (org_val.indexOf(action_type) == -1) {  // record the button action if it is not been saved
          if (org_val != "") org_val+= "/";
          formx.find('#document_description').val(org_val+action_type);
        }
      }
    }
    else {
      formx = form0.cloneForm(true); // clone the form to modify the id and other values if necessary
      formx.find("#document_description").val("buffer");  // this will be a buffer document record
      var arr2 = action.split("document");
      
      if (buffer_id > 0) {  // there is a buffer record so update it
        formx.find("#document_id").val(buffer_id);
        action = arr2[0]+"document/"+buffer_id+"?shbx=1";  // update saving link for the buffer record
        if (form0.find('#document_id').val() == '') {  // the form is for new action => apdate it to update action
          formx.append('<input type="hidden" name="sf_method" value="put">');
        }
      }
      else {  // no buffer record, so crete it
        action = arr2[0]+"document";  // create a link for new action
      }
    }
    
    // add no re-direct and no-render flag for "symfony saving". ONLY if it has not been added it yet
    if (action.indexOf("_nrd=1") == -1) {
      action+= (action.indexOf("?") > -1) ? "&_nrd=1" : "?_nrd=1";
    }
        
    //$(document).ajaxStop(function () {  // waits until other ajax calls are done to continue ($.active == 0)   
      ajax_save = $.post(action, formx.serialize(), function(data) {
        //window.open(elayout_url);
      })
      .success(function(data) {
        var data_arr = data.split("%|%");
        data = data_arr[1]; // avoid getting not required string
        
        if (new_doc) {  // only add dinamically to adapt new form to update form; autosave NEVER do this
          var arr = action.split("?");
          form0.find('#document_id').val(data);
          form0.find("#documentform").attr("action", arr[0]+"/"+data+"?shbx=1");
          form0.find('#documentform').append('<input type="hidden" name="sf_method" value="put">');
          alert('Document was saved successfully!');
        }
        if (action_type == "buffer") {  // send a new auto saving in 20 seconds, only if previous succeed
          //alert("autosaved conpleted"+" buffer: "+buffer_id+", data: "+data);
          timer_autosave = setTimeout(function() { verifyDocumentSaved(action_type, data); }, 20000);
        }
      })
      .error(function(data) { 
        var msg = (action_type != "buffer") ? "Error saving document, try using save button!" : "Auto-saving error\nContact technical support!";
        //alert(msg);
      });
      
      if (action_type == "buffer") ajax_autosave = ajax_save;
    //});
    
  }
}


/********************************************************************************************************/
/*************************************** FORM EXTRA VALIDATION ******************************************/
/********************************************************************************************************/

function updateRelatedFiles(form, event)
{
  if ($('#sf_guard_user_id').val() != "") {  // it is not new!
    alert('The non-closed related User Files to this client will be updated!');
  }
  return true;
}

function linkObjectToFile(form, event, obj, file_id)
{
  event.preventDefault();
  $.confirm({
    'title'   : 'Confirm Dialog',
    'message' : 'Do you want to link this ' + obj + ' to the current File (id:' + file_id + ')?',
    'buttons' : {
      'Yes' : {
        'class'	: 'blue',
        'action': function(){
          if ($('#sf_guard_user_link_to_file').length) $('#sf_guard_user_link_to_file').val(file_id);
          form.submit();
        }
      },
      'No'  : {
        'class'	: 'gray',
        'action': function(){ 
          form.submit(); 
        }
      }
    }
  });
  
  // old way
  /*var link = confirm("Do you want to link this "+obj+" to the current File (id:"+file_id+")?");
  if (link) {
    //alert('test only by now!');
    if ($('#sf_guard_user_link_to_file').length) $('#sf_guard_user_link_to_file').val(file_id);
  }
  return true; */
}

function validateFile()
{
  if ( ($('#user_file_id').val() != "") && ($('#user_file_status_id').val() != "38") ) {  // it is not new!
    alert('The Client data will be updated for the client and non-closed related User Files!');
  }
  return validateCourtDates('user_file_new_FileCourtDates', 'user_file_id');
}


function validateCourtDate()
{
  /*pass_older = true;
  
  // check only if date class exists & if the form is for a new user file
  if ( ($('.validateYear').length) && ($('#court_date_id').val() == "") )  {   
    current_date = $.now(); //$.datepicker.formatDate("yy/m/d", new Date());
    
    $('.validateYear').each(function() { 
      id = $(this).attr('id');
      if (id.indexOf('date_day') >= 0) {
        day = $(this).val();
        month = $('#court_date_date_month').val();
        year = $('#court_date_date_year').val();
        if (day != "" || month != "" || year != "") {
          datex = new Date(year+'/'+month+'/'+day).getTime();
          //alert(current_date+' -> '+datex);
          if (current_date > datex) {
            pass_older = false;
            return false; // break the each loop
          }
        }
      }
    });
    
    if (pass_older == false) {
      pass_older = confirm("Court date) is older than today, Do you want to proceed anyway");
    }
  }
  
  return pass_older;*/
  
  return validateCourtDates('court_date', 'court_date_id');
}

function validateCourtDates(id_prefix, obj_id)
{
  pass_older = true;
  
  // check only if date class exists & if the form is for a new user file
  if ( ($('.validateYear').length) && ($('#'+obj_id).val() == "") )  {   
    current_date = $.now(); //$.datepicker.formatDate("yy/m/d", new Date());
    
    $('.validateYear').each(function() { 
      id = $(this).attr('id');
      if (id.indexOf('date_day') >= 0) {
        
        var counter = id.replace(id_prefix, '');
        counter = counter.replace('date_day', '');  // get string: '_0_' (many) / '_' (one)
        //var counter = id.match(/[0-9]+/g);
        
        if (counter) {
          day = $(this).val();
          //month = $('#user_file_new_FileCourtDates_'+counter+'_date_month').val();
          //year = $('#user_file_new_FileCourtDates_'+counter+'_date_year').val();
          month = $('#'+id_prefix+counter+'date_month').val();
          year = $('#'+id_prefix+counter+'date_year').val();
          
          if (day != "" || month != "" || year != "") {
            datex = new Date(year+'/'+month+'/'+day).getTime();
            //alert(current_date+' -> '+datex);
            if (current_date > datex) {
              pass_older = false;
              return false; // break the each loop
            }
          }
        }
      }
      /*$(this).change( function() {});*/
    });
    
    if (pass_older == false) {
      pass_older = confirm("Court date(s) is(are) older than today, Do you want to proceed anyway");
    }
  }
  
  return pass_older;
}


$.setAttributes = function(row) 
{ 
  obj = row.find('.itemValue');
  if (obj) {
    id = row.find('.itemValue').attr('id');
    if (id) {
      value = id.match(/[0-9]+/g);
      value = parseInt(value) + 1;
      $('#'+id).val(value);
    }
  }
}

$.loadingPopUp = function(msg) 
{
  var defMsg = 'Please wait while processing your request';
  
  msg = typeof msg !== 'undefined' ? msg : defMsg;
  Shadowbox.open({
    content:    '<div id="sb-loading-inner"><span> '+msg+'</span></div>',
    player:     "html",
    height:     100,
    width:      400
  });
}


function popMessage(obj)
{
  // for brief
  if ($(obj).val() == 3) alert("Has the brief been scanned into the database?");
}

function paginate(page)
{
  $('#page0').val(page);
  $('#client_filter').submit();
}


/************************************************************************************************************/
/******************************************** NOT USED FUNCTIONS ********************************************/
/************************************************************************************************************/

function changeSecondaryCodeLabel(obj, str)
{
  labelx = obj.options[obj.selectedIndex].text;
  start = labelx.indexOf('(')+1;
  end = labelx.indexOf(')', start);
  doc_type = labelx.substr(start, end-start);
  
  varx = 'app_document_' + doc_type + '_secondary_code_custom_label';
  
  arr = str.split('&and&');
  
  for(i=0; i<arr.length; i++) {
    if (arr[i].indexOf(varx) > -1) {
      arr2 = arr[i].split('&is&');
      $('label[for="document_secondary_code"]').html(arr2[1]);
      break;
    }
  }
}
