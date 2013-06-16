<div class="doc_settings">
  <script language="javascript" src="<?php echo $sf_user->getBaseUrl().'js/calendar/calendar.js' ?>"></script>
  <!--<link href="/web/js/calendar/calendar.css" rel="stylesheet" type="text/css">-->
  <b>Document Date:</b><br/>
  <?php
    $myCalendar = new tc_calendar("date2");
    $myCalendar->setIcon($sf_user->getBaseUrl()."js/calendar/images/iconCalendar.gif");
    $myCalendar->setDate(date('d'), date('m'), date('Y'));
    $myCalendar->setPath($sf_user->getBaseUrl()."js/calendar/");
    $myCalendar->setYearInterval(2000, 2020);
    $myCalendar->dateAllow('2008-05-13', '2015-03-01', false);
    $myCalendar->startMonday(true);
    //$myCalendar->disabledDay("Sat");
    //$myCalendar->disabledDay("sun");
    $myCalendar->writeScript();
  ?>
  <div align="right"><input type="button" name="button3" id="button3" value="Change date" onClick="changeDocumentDate(this.form);"></div>
</div>