<?php

// created by William, 10/05/2013: this file and its folder "templates" were added to solve a problem
// it seems did not work....  they can be deleted!!

use_helper('permission');

if ($sf_request->hasError('sf_guard_group{permissions}'))
{
  echo form_error('sf_guard_group{permissions}', array('class' => 'form-error-msg'));
}

$value = module_permission_check_list($sf_guard_group, 'getPermissions', array(
  'control_name'  => 'sf_guard_group[permissions]',
  'through_class' => 'sfGuardGroupPermission',
  'sort' => 'name'
)); 

foreach($value as $module=>$action)
{
  echo "<h2>$module</h2><div style=\"padding:5px\">";
  $ca  = 0;
  $cab = 0;
  foreach ($action as $actName => $perm)
  {
    if (is_array($perm))
    {
      foreach($perm as $a=>$p)
      {
        if (!$actName && !$ca)
        {
          echo __('Globals:').'&nbsp;';
          $ca++;
        }
        else if($actName && !$cab)
        {
          echo '<br />'.__('Actions:').'&nbsp;';
          $cab++;
        }
        echo $p;
      }
    }
    else
    {
      echo $perm;
    }
  }

  echo '</div>';
}
