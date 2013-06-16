<?php if (!isset($helper->court_title)) $helper->court_title = "" ?>
<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div class="centered">
      <?php echo image_tag('magistrate_court_victoria.jpg', array('alt' => 'Magistrate Court', 'class' => 'magistrate_court_img')); ?>
      <p class="subtitle">NOTICE OF APPEAL TO THE MAGISTRATES’ COURT PURSUANT TO SECTION 51<br/>OF THE ROAD SAFETY ACT</p>
    </div>
  </div>
  <div class="doc_section">
    
    <div style="float:left"><?php echo $form['field2']->renderRow() ?></div>
    <div style="float:right">Court Reference: <?php echo $form['field3']->renderRow() ?></div>
    <div class="clear"></div>
    
    <br/>
    <table class="fax">
    <tr><td class="label">APPELLANT:</td><td class="field"><?php echo $form['field4']->renderRow() ?></td></tr>
    <tr><td class="label">ADDRESS:</td><td class="field"><?php echo $form['field5']->renderRow() ?></td></tr>
    <tr><td class="label">RESPONDENT:</td><td class="field"><?php echo $form['field15']->renderRow() ?></td></tr>
    <tr><td class="label">ADDRESS:</td><td class="field"><?php echo $form['field11']->renderRow() ?></td></tr>
    </table>
    <br/>
    
    <p>
      A charge was made against me on <?php echo $form['field10']->renderRow() ?> (date) by 
      <?php echo $form['field6']->renderRow() ?> a Member of the Police Force / an Officer of Vic Roads, 
      who gave me notice pursuant to Section 51(1) of the Road Safety Act 1986 at 
      <?php echo $form['field12']->renderRow() ?> on <?php echo $form['field13']->renderRow() ?> 
    </p>
    <p>
      I request the Magistrates’ Court to cancel the notice so that I can continue to drive pending the 
      determination of the charges by the Magistrates’ Court as the following exceptional circumstances exist:
      <?php echo $form['field17']->renderRow() ?>
    </p>
    
    <p>
      Take notice that I intend to apply to the Magistrates’ Court of Victoria at 
      <?php echo $form['field14']->renderRow() ?>for an order under Section 51(11) of the Road Safety Act 1986.
    </p>
    
    <br/><br/><br/>
    <div style="float:left">Dated: <?php $form->getDocumentDate("d F Y")?></div>
    <div style="float:right" class="centered">______________________________<br/>Appellant</div>
    <div class="clear"></div>

    <br/>
    <div class="with_border">
      THIS APPEAL WILL BE HEARD BY THE MAGISTRATES’ COURT OF VICTORIA AT<br/>
      <?php echo $form['field14']->renderRow() ?> ON <?php echo $form['field8']->renderRow() ?> 
      AT <?php echo $form['field16']->renderRow() ?> AM/PM
    </div>
    
    <br/><br/><br/>
    <div style="float:left">Filed: <?php echo $form['field9']->renderRow() ?></div>
    <div style="float:right" class="centered">______________________________<br/>Registrar</div>
    <div class="clear"></div>
    
  </div>
  <div class="doc_footer"></div>
</div>