<?php

include("database.php");
include("database-f.php");
include("oni-f.php");


function error($error, $display) {

if (!empty($error)) {
    
if ($display == "div") { $error = '<div style="margin: 10px 0px; color: red;">'.$error.'</div>'; }	
if ($display == "span") { $error = '<span style="margin: 10px 0px; color: red;">'.$error.'</span>'; }
}
    
return $error;
}

?>