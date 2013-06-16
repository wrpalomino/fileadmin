/*!
 * jQuery Print Previw Plugin v1.0.1
 *
 * Copyright 2011, Tim Connell
 * Licensed under the GPL Version 2 license
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Date: Wed Jan 25 00:00:00 2012 -000
 */
 
(function($) { 
    
	// Initialization
	$.fn.printPreview = function() {
		this.each(function() {
			$(this).bind('click', function(e) {
			    e.preventDefault();
			    if (!$('#print-modal').length) {
			        $.printPreview.loadPrintPreview();
                                $.fixPrintModalContent();   // added by william
			    }
			});
		});
		return this;
	};
    
    // Private functions
    var mask, size, print_modal, print_controls, window_mode;
    $.printPreview = {
        loadPrintPreview: function(elayout_url, type, to, subject, attachment) {
          
            // added by William, 24/08/2012: to fix the preview template text areas' height
            fitTextAreasHeights();
            
            window_mode = type;
            if (type == 'email_attachment')  type = 'email';
          
            // Declare DOM objects
            print_modal = $('<div id="print-modal"></div>');
            
            if (typeof elayout_url !== 'undefined') {
              if (typeof type == 'undefined')       type = 'email';     // action type
              if (typeof to == 'undefined')         to = '';            // default value for whom document is sent
              if (typeof subject == 'undefined')    subject = '';       // default value for email subject
              if (typeof attachment == 'undefined') attachment = '';    // default file attachment
              
              if (attachment != '') attachment = '<div style="color:blue;margin:6px">Attached file: '+attachment+'</div>';
              
              if (type == "email") {
                print_controls = $('<div id="print-modal-controls">' + 
                                      '&nbsp;To:'+str_repeat('&nbsp;', 9)+'<input type="text" name="email_to" id="email_to" class="recipient" value="' + to + '" />&nbsp;<br/>' +
                                      '&nbsp;Subject: <input type="text" name="email_subject" id="email_subject" class="recipient" value="' + subject + '" />&nbsp;</br/>' +
                                      attachment +
                                      '<div>&nbsp;<textarea name="email_body" id="email_body" rows="5" /></textarea></div>' +
                                      '<a href="#" class="sendEmail" title="Send Email">Send</a>' +
                                      '<a href="#" class="close" title="Close preview">Close</a>').hide();
              }
              else {
                print_controls = $('<div id="print-modal-controls">' + 
                                      '<div class="notice">Please enter fax number in the format: 03xxxxxxxx</div>' +
                                      '&nbsp;To Fax #: <input type="text" name="fax_to" id="fax_to" class="recipient" value="' + to + '" />&nbsp;<br/>' +
                                      '<input type="hidden" name="email_subject" id="email_subject" value="' + subject + '" />' +
                                      '<a href="#" class="sendFax" title="Send Fax">Send Fax</a>' +
                                      '<a href="#" class="close" title="Close preview">Close</a>').hide();
              }
            }
            else {
                print_controls = $('<div id="print-modal-controls">' + 
                                      //'<a href="#" class="viewAsPdf" title="View as Pdf">View as Pdf</a>' +
                                      //'<a href="#" class="downloadAsPdf" title="Download as Pdf">Download as Pdf</a>' +
                                      '<a href="#" class="print" title="Print page">Print page</a>' +
                                      '<a href="#" class="close" title="Close print preview">Close</a>').hide();
            }
            var print_frame = $('<iframe id="print-modal-content" scrolling="no" border="0" frameborder="0" name="print-frame" />');

            // Raise print preview window from the dead, zooooooombies
            print_modal
                .hide()
                .append(print_controls)
                .append(print_frame)
                .appendTo('body');

            // The frame lives
            for (var i=0; i < window.frames.length; i++) {
                if (window.frames[i].name == "print-frame") {    
                    var print_frame_ref = window.frames[i].document;
                    break;
                }
            }
            print_frame_ref.open();
            print_frame_ref.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' +
                '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">' + 
                '<head><title>' + document.title + '</title>' +
                '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />' +
                '</head>' +
                '<body></body>' +
                '</html>');
            print_frame_ref.close();
            
            // Grab contents and apply stylesheet
            var $iframe_head = $('head link[media*=print], head link[media=all]').clone(),
                $iframe_body = $('body > *:not(#print-modal):not(script)').clone();
                
            $iframe_head.each(function() {
                $(this).attr('media', 'all');
            });
            
            if (window_mode != 'email_attachment') { // added by william, avoid copying the body and head content
              
              if (!$.browser.msie && !($.browser.version < 7) ) {
                  $('head', print_frame_ref).append($iframe_head);
                  $('body', print_frame_ref).append($iframe_body);
              }
              else {
                  $('body > *:not(#print-modal):not(script)').clone().each(function() {
                      $('body', print_frame_ref).append(this.outerHTML);
                  });
                  $('head link[media*=print], head link[media=all]').each(function() {
                      $('head', print_frame_ref).append($(this).clone().attr('media', 'all')[0].outerHTML);
                  });
              }
            }
            
            // Disable all links
            $('a', print_frame_ref).bind('click.printPreview', function(e) {
                e.preventDefault();
            });
            
            // Introduce print styles
            $('head').append('<style type="text/css">' +
                '@media print {' +
                    '/* -- Print Preview --*/' +
                    '#print-modal-mask,' +
                    '#print-modal {' +
                        'display: none !important;' +
                    '}' +
                '}' +
                '</style>'
            );

            // Load mask
            $.printPreview.loadMask();

            // Disable scrolling
            $('body').css({overflowY: 'hidden', height: '100%'});
            $('img', print_frame_ref).load(function() {
                print_frame.height($('body', print_frame.contents())[0].scrollHeight);
            });

            // Position modal            
            starting_position = $(window).height() + $(window).scrollTop();
            
            heightxx = (window_mode != 'email_attachment') ? '100%' : '';  // added by william, avoid scroll
            
            var css = {
                    top:         starting_position,
                    height:      heightxx,
                    overflowY:   'auto',
                    zIndex:      10000,
                    display:     'block'
                }
            print_modal
                .css(css)
                .animate({ top: $(window).scrollTop()}, 400, 'linear', function() {
                    print_controls.fadeIn('slow').focus();
                });
            print_frame.height($('body', print_frame.contents())[0].scrollHeight);

            // Bind closure
            $('a', print_controls).bind('click', function(e) {
                e.preventDefault();
                if ($(this).hasClass('print')) { 
                  verifyDocumentSaved('print'); // added by william, 17/05/2013: verify if document has been saved
                  window.print();
                }
                else if ( $(this).hasClass('sendEmail') || $(this).hasClass('sendFax') ||
                          $(this).hasClass('viewAsPdf') || $(this).hasClass('downloadAsPdf') ) {
                  if (typeof elayout_url !== 'undefined') {
                    
                    if ( $(this).hasClass('sendEmail') || $(this).hasClass('sendFax') ) {                      
                      var to_user = ($(this).hasClass('sendEmail')) ? $('#email_to').val() : $('#fax_to').val();
                      var email_bodyx = ($(this).hasClass('sendEmail')) ? $('#email_body').val() : "";
                      var email_subjectx = $('#email_subject').val();
                      
                      // validate email address or fax number which the document is going to be sent to
                      to_user = $.trim(to_user);
                      if (to_user == "") {
                        alert("Email address or Fax Number required!");
                        return false;
                      }
                      if ($(this).hasClass('sendEmail') && !isValidEmailAddress(to_user)) {
                        alert("Bad email format, please correct it");
                        return false;
                      }
                      /*if ($(this).hasClass('sendFax') && !isValidEmailAddress(to_user)) {
                        alert("Sorry, this is a beta version, email required instead of fax number");
                        return false;
                      }*/
                      
                      alert(type + " is being sending, please wait.");
                      $.post(elayout_url, { elayout: $('#email-layout').val(), email_to: to_user, email_body: email_bodyx, email_subject: email_subjectx}, function(data) {
                        //window.open(elayout_url);
                      })
                      .success(function(data) { alert(data); /*alert(type + " sent successfully!");*/ })
                      .error(function(data) { alert(data); /*alert("error sending the " + type + "!");*/ });
                    }
                    else {
                      var actionx = ($(this).hasClass('viewAsPdf')) ? "view" : "download";
                      $.post(elayout_url, { elayout: $('#email-layout').val(), action: actionx}, function (data) {
                        window.open(elayout_url);
                        /*with(win.document) {
                          /*open();
                          write(data);
                          close();
                        }*/
                      });
                    }
                  }
                  else {
                    alert('not implemented');
                  }
                }
                else { 
                  $.printPreview.distroyPrintPreview(); 
                }
            });
           
    	},
    	
    	distroyPrintPreview: function() {
    	    print_controls.fadeOut(100);
    	    print_modal.animate({ top: $(window).scrollTop() - $(window).height(), opacity: 1}, 400, 'linear', function(){
    	        print_modal.remove();
    	        $('body').css({overflowY: 'auto', height: 'auto'});
    	    });
    	    mask.fadeOut('slow', function()  {
    			mask.remove();
    		});				

    		$(document).unbind("keydown.printPreview.mask");
    		mask.unbind("click.printPreview.mask");
    		$(window).unbind("resize.printPreview.mask");
	    },
	    
    	/* -- Mask Functions --*/
	    loadMask: function() {
	        size = $.printPreview.sizeUpMask();
            mask = $('<div id="print-modal-mask" />').appendTo($('body'));
    	    mask.css({				
    			position:           'absolute', 
    			top:                0, 
    			left:               0,
    			width:              size[0],
    			height:             size[1],
    			display:            'none',
    			opacity:            0,					 		
    			zIndex:             9999,
    			backgroundColor:    '#000'
    		});
	
    		mask.css({display: 'block'}).fadeTo('400', 0.75);
    		
            $(window).bind("resize..printPreview.mask", function() {
				$.printPreview.updateMaskSize();
			});
			
			mask.bind("click.printPreview.mask", function(e)  {
				$.printPreview.distroyPrintPreview();
			});
			
			$(document).bind("keydown.printPreview.mask", function(e) {
			    if (e.keyCode == 27) {  $.printPreview.distroyPrintPreview(); }
			});
        },
    
        sizeUpMask: function() {
            if ($.browser.msie) {
            	// if there are no scrollbars then use window.height
            	var d = $(document).height(), w = $(window).height();
            	return [
            		window.innerWidth || 				// ie7+
            		document.documentElement.clientWidth || 	// ie6  
            		document.body.clientWidth,                      // ie6 quirks mode
            		d - w < 20 ? w : d
            	];
            } else { return [$(document).width(), $(document).height()]; }
        },
    
        updateMaskSize: function() {
    		var size = $.printPreview.sizeUpMask();
    		mask.css({width: size[0], height: size[1]});
        }
    }
})(jQuery);