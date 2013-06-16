<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<style>
  table.fileUserCourtDateFee td {
    white-space: nowrap;
    padding: 2px 2px;
  }
  
  table.fileUserFeeAgreement td {
    white-space: nowrap;
    padding: 2px 8px;
  }

  .ufcdf_division {
    width: 100%;
    border-top: solid 2px #257EB7;
  }

  td.ufcdf_fee {
    background-color: #ddd;
  }
</style>

<?php if ($helper->fileFee_code == "FAG"): ?>

  <div class="sf_admin_form">

    <?php //if ( isset($form['FileFeeAgreements']) && (count($form['FileFeeAgreements']) > 0) ): ?>
      
      <?php echo form_tag_for($form, '@user_file_fileFee') ?>
      <?php echo $form->renderHiddenFields(false) ?>
      <?php if ($form->hasGlobalErrors()) echo $form->renderGlobalErrors() ?>
  
      <table class="fileUserFeeAgreement">
      <?php echo $form['number']->renderRow();?>
      <tr>
        <td colspan="2">
          <br/>
          <table>
          <tr>  
            <td>
              <p><?php $helper->getSectionLink('agreements', 'falsod') ?></p>
              <?php echo $form['lump_sum_one_day'] ?>
              
            </td>
            <td>
              <p><?php $helper->getSectionLink('agreements', 'falsmd') ?></p>
              <?php echo $form['lump_sum_more_than_one_day'] ?>
            </td>
            <td>
              <p><?php $helper->getSectionLink('agreements', 'fascfe') ?></p>
              <?php echo $form['schedule_fees'] ?>
            </td>
          </tr>
          <tr>
            <td><?php $helper->getSectionLink('agreements', 'falsod') ?><br/>(If firm do restraining orders etc)</td>
            <td><?php $helper->getSectionLink('agreements', 'falsmd') ?><br/>(If firm do restraining orders etc)</td>
            <td>
              <?php $helper->getSectionLink('agreements', 'fascfe') ?><br/>(If firm do restraining orders etc)
              <br/><br/>
              <ul id="section_links">
                <li><?php $helper->getSectionLink('agreements', 'fagecl') ?></li>
                <li><?php $helper->getSectionLink('agreements', 'falscl') ?></li>
              </ul>
            </td>
          </tr>
          </table>
        </td>
      </tr>
      <tr><td><input type="submit" value="<?php echo __('Save', null, 'sf_guard') ?>" /></td></tr>
      </table>
    
    <?php //else: ?>

      <?php  //$sf_user->setFlash('custom_info', 'This file does not have any fee agreement defined, please define court date first', false); ?>

    <?php //endif; ?>
    </form>
    
  </div>

<?php else: ?>

  <?php $item_header = "<tr><th>Date</th><th>Court</th><th>Listing</th><th>VLA? *</th><th>Paid</th><th>Still Needs Invoicing</th></tr>"; ?>
  <div class="sf_admin_form">

    <?php if ( isset($form['FileCourtDates']) && (count($form['FileCourtDates']) > 0) ): ?>

      <?php echo form_tag_for($form, '@user_file_fileFee') ?>
      <?php echo $form->renderHiddenFields(false) ?>
      <?php if ($form->hasGlobalErrors()): ?><?php echo $form->renderGlobalErrors() ?><?php endif; ?>
    
      <?php 
        // added by William, 22/05/2013: show all the errors, including field-bound errors
        foreach($form->getWidgetSchema()->getPositions() as $widgetName) echo $form[$widgetName]->renderError()
      ?>

      <table class="fileUserCourtDateFee">
      <?php echo $form['number']->renderRow();?>
      <tr><td colspan="6">.</td></tr>
      
      <?php echo $item_header?>
      <?php foreach($form['FileCourtDates'] as $court_date): ?>
      
      <tr>
        <td>
          <?php echo $court_date['date'] ?><br/>
          <b>Appearing By Whom</b><br/>
          <?php echo $court_date['appearing_id'] ?>
        </td>
        <td>
          <?php echo $court_date['court_id'] ?><br/>
          <b>Barrister</b><br/>
          <?php echo $court_date['barrister_id'] ?>
        </td>
        <td>
          <?php echo $court_date['listing_id'] ?><br/>
          Funding Status Comment
        </td>
        <td>
          <?php echo $court_date['Fee']['vla'] ?>
        </td>
        <td>
          <?php echo $court_date['Fee']['paid'] ?>
        </td>
        <td>
          <?php echo $court_date['Fee']['need_invoicing'] ?>
        </td>
      </tr>
      <tr><td colspan="6" class="ufcdf_fee">Fees</td></tr>
      <tr>
        <td colspan="6">
          <table>
          <?php 
            $fdt_arr = Fee::getFeeTypes('array');
            foreach ($fdt_arr as $fdt_id) echo $court_date['Fee'][$fdt_id]->renderRow();
          ?>  
          <?php /*echo $court_date['Fee']['solicitor_claim']->renderRow(); ? >
          <?php echo $court_date['Fee']['invoiced']->renderRow(); ? >
          <?php echo $court_date['Fee']['received']->renderRow(); ? >
          <?php echo $court_date['Fee']['paid.']->renderRow(); */ ?>
          </table>
        </td>
      </tr>
      <tr><td colspan="6"><hr class="ufcdf_division" /></td></tr>

      <?php endforeach; ?>

      <tr><td><input type="submit" value="<?php echo __('Save', null, 'sf_guard') ?>" /></td></tr>
      </table>

    <?php else: ?>

      <?php  $sf_user->setFlash('custom_info', 'This file does not have any court dates defined, please define court date first', false); ?>

    <?php endif; ?>
    </form>

  </div>
  
<?php endif; ?>
