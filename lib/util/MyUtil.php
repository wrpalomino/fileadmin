<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of util
 *
 * @author ROCIO
 */
class MyUtil 
{  
  static public function getPdfFilePages($document_path)
  {
    $binaries_path = dirname(__FILE__).'/binaries';
    
    $xpdf_path = $binaries_path.'/xpdfbin3.03';
    $xpdf_path.= (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? '/win' : '/linux';
    $xpdf_path.= self::is_64bit() ? '/bin64' : '/bin32'; 
    $exe_rel_path = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? "/pdfinfo.exe" : "/pdfinfo";
    $cmd = $xpdf_path.$exe_rel_path;
   
    // note by William, 22/02/2013: remember to change permissions for the binary file in the server
    exec("$cmd $document_path", $output);  // Parse entire output
    foreach($output as $op) {  // Find pagecount
      if(strpos($op, "Pages:") === 0) {  // Extract the number
        if (preg_match("/\d+/", $op, $matches) !== false) return $matches[0];
        else return 0;
      }
    }
    return 0;
  }
 
  
  static public function get_dir_size($dir_name)
  {
    $dir_size = 0;
       
    if (is_dir($dir_name)) {
      
      if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {   // windows
        $obj = new COM ('scripting.filesystemobject');
	if (is_object($obj)) {
          $ref = $obj->getfolder($dir_name);
          $dir_size = $ref->size;
          //echo '<div>Directory: '.$dir_name.' => Size: '.$ref->size.'</div>';
          $obj = null;
	}
	else {  
          echo '<div>Can not create object</div>';
	}
      } 
      else {    // linux/unix
        //$dir_name = '.'.$dir_name';
	$io = popen ('/usr/bin/du -sk '.$dir_name, 'r');
	$size = fgets($io, 4096);
	$dir_size = $size = substr($size, 0, strpos ($size, ' '));
	pclose ($io);
	//echo 'Directory: '.$dir_name.' => Size: '.$size;
      }
      
      /*inefficient way 
      if ($dh = opendir($dir_name)) {
        while (($file = readdir($dh)) !== false) {
          echo $file.'<br/>';
          if ($file != "." && $file != "..") {
            if (is_file($dir_name."/".$file)) {
              $dir_size += filesize($dir_name."/".$file);
            }
            if (is_dir($dir_name."/".$file)) {  // check for any new directory inside this directory
              $dir_size +=  $this->get_dir_size($dir_name."/".$file);
            }
          }
        }
      }
      closedir($dh); */
      
    }  
    
    return self::roundsize($dir_size);
  }
  
  
  static public function roundsize($size)
  {
    $i=0;
    $iec = array("B", "Kb", "Mb", "Gb", "Tb");
    while (($size/1024)>1) {
      $size=$size/1024;
      $i++;
    }
    return(round($size,1)." ".$iec[$i]);  
  }
  
  
  static public function is_64bit() 
  {
    $int = "9223372036854775807";
    $int = intval($int);
    if ($int == 9223372036854775807) {  // 64bit
      return true;
    }
    elseif ($int == 2147483647) {       // 32bit
      return false;
    }
    /*else {  // error 
      return "error";
    } */
    return false;  // it is 32bits by default
  }
  
}

?>
