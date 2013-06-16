<?php use_helper('I18N', 'Date') ?>
<?php include_partial(sfContext::getInstance()->getModuleName().'/assets') ?>

<div id="sf_admin_container">
  <table id="layout2">
  <tr>
    <td>
      <?php include_partial($this->getModuleName().'/section_links', array('section_links' => $section_links, 'configuration' => $configuration, 'helper' => $helper)) ?>
      
      <?php  // added by William, 28/01/2013: some admin functions ?>
      <div style="float:left;width:50%">
        <div>
          <h1>Disk Space</h1>
          <table>
          <tr><td>DISK SIZE: </td><td><?php echo $disk['total']?></td></tr>
          <tr><td>DISK FREE: </td><td><?php echo $disk['free']?></td></tr>
          <tr>
            <td>Directory [<?php echo $disk['dirs']['wamp']['path']?>]: </td>
            <td><?php echo $disk['dirs']['wamp']['size']?></td></tr>
          </table>
        </div>
        <br/><br/>
        <div>
          <h1>Traffic statistics (Virtual Machine)</h1>
          <table>
          <tr><td colspan="2"><a href="http://netflow.micron21.com/netflow/jspui/NetworkSnapShot.jsp" target="_blank">>> Login Page</a></td></tr>
          <tr><td>Username: </td><td>mike.brown</td></tr>
          <tr><td>Password: </td><td>Q8J2c172Sj3x</td></tr>
          </table>
        </div>
        <br/><br/>
        <div>
          <h1>Fax by Email Account</h1>
          <?php $faxservice = sfConfig::get("app_faxservice")?>
          <?php echo sfConfig::get("app_faxservice_loginpage")?>
          <table>
          <tr>
            <td colspan="2">
              <a href="<?php echo $faxservice['loginpage']?>" target="_blank">>> <?php echo $faxservice['provider']?> Login Page</a>
            </td>
          </tr>
          <tr><td>Username: </td><td><?php echo $faxservice['username']?></td></tr>
          <tr><td>Password: </td><td><?php echo $faxservice['password']?></td></tr>
          <tr><td>PIN: </td><td><?php echo $faxservice['PIN']?></td></tr>
          <tr><td>Fax Number: </td><td><?php echo $faxservice['faxnumber']?></td></tr>
          <tr><td>Email for Fax: </td><td><?php echo $faxservice['faxfromemail']?></td></tr>
          </table>
        </div>
      </div>
      
      <div style="float:left;width:50%">
        
        <?php if (in_array(sfContext::getInstance()->getUser()->getUsername(), array('admin', 'michael'))): ?>
          <div>
            <h1>Server</h1>
            
            <table>
            <tr>
              <td colspan="2">
                <a href="<?php echo sfConfig::get('app_server_loginpage')?>" target="_blank">>> Server Login Page</a>
              </td>
            </tr>
            <tr><td>Username: </td><td><?php echo sfConfig::get('app_server_username')?></td></tr>
            <tr><td>Password: </td><td><?php echo sfConfig::get('app_server_password')?></td></tr>
            <tr>
              <td colspan="2">
                <div style="font-size:12px;width:300px;padding: 6px 2px">
                  <b>NOTE:</b> Disregard the warning and click "Proceed anyway". 
                  There is no threat. The warning is because the Control panel 
                  application needs to run under secure domain (https) and the 
                  server generates its own security credentials, which have not 
                  been verified by the browser
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <div><b>To get The File Admin application:</b></div>
                <ul>
                  <li>Go to section: Webmin > Others > File Manager</li>
                  <li>Run "File Manager"</li>
                  <li>Select the path: "/var/www/html" in left panel</li>
                  <li>Select folder (one click only) fileadmin in right panel</li>
                  <li>Click save from top menu and follow instructions</li>
                </ul>
              </td>
            </tr>
             <tr><td colspan="2"><br /><a href="<?php echo url_for('admin/downloadfile')?>">>> Download Database backup</a></td></tr>
            </table>
          </div>
          <br/><br/>
        <?php endif; ?>
        
        <div>
          <h1>SMS Account</h1>
          <?php $smsservice = sfConfig::get("app_smsservice")?>
          <table>
          <tr>
            <td colspan="2">
              <a href="<?php echo $smsservice['loginpage']?>" target="_blank">>> <?php echo $smsservice['provider']?> Login Page</a>
            </td>
          </tr>
          <tr><td>Username: </td><td><?php echo $smsservice['params']['username']?></td></tr>
          <tr><td>Password: </td><td><?php echo $smsservice['params']['password']?></td></tr>
          </table>
        </div>
        <br/><br/>
        <div>
          <h1>PDF Conversion Account</h1>
          <?php $pdfservice = sfConfig::get("app_pdfservice")?>
          <table>
          <tr>
            <td colspan="2">
              <a href="<?php echo $pdfservice['loginpage']?>" target="_blank">>> <?php echo $pdfservice['provider']?> Login Page</a>
            </td>
          </tr>
          <tr><td>Username: </td><td><?php echo $pdfservice['user']?></td></tr>
          <tr><td>Password: </td><td><?php echo $pdfservice['password']?></td></tr>
          </table>
        </div>
        <br/><br/>
        <div>
          <h1>GMail Account</h1>
          <?php $email = sfConfig::get("app_server_emailfrom")?>
          <table>
          <tr>
            <td colspan="2">
              <a target="_blank" href="https://accounts.google.com/ServiceLoginAuth?continue=http://mail.google.com/gmail&service=mail&Email=<?php echo $email?>&Passwd=&null=Sign+in" >>> Gmail Login</a>
              <?php //<a target="_blank" href="https://www.google.com/a/dbcrimlaw.com.au/LoginAction2?continue=http://mail.google.com/a/dbcrimlaw.com.au/a/&service=mail&Email=info&Passwd=snookums01&null=Sign+in">Gmail Login</a>?>
              </tr>
          <tr><td>Username/Email: </td><td><?php echo $email?></td></tr>
          </table>
        </div>
      </div>
      
    </td>
    <td align="right">
      <div id="sf_admin_content">
        <?php include_partial($this->getModuleName().'/links', array('links' => $links, 'configuration' => $configuration, 'helper' => $helper)) ?>
      </div>
    </td>
  </tr>  
  </table>
  
  <?php /*if ($mode == 'browse'): ?>
  <div id="sf_admin_footer">
    <?php include_partial(sfContext::getInstance()->getModuleName().'/common_pager', array('helper' => $helper, 'pager' => $pager, 'edit_pager' => $edit_pager)) ?>
  </div>
  <?php endif; */ ?>
  
  
  <div style="clear:both"><?php //phpinfo(); //cheching PHP/MYSQL version ?> </div>
  
</div>
