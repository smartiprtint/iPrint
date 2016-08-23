<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "3,1";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "offline/Sign-in.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Untitled Page</title><meta name="generator" content="WYSIWYG Web Builder 11 - http://www.wysiwygwebbuilder.com"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="IPrint_v2.css" rel="stylesheet"><link href="Off.css" rel="stylesheet"><script src="jquery-1.11.3.min.js"></script><script>
$(document).ready(function()
{
   $("#NavigationBar1 .navbar a").hover(function()
   {
      if ($(this).hasClass('active'))
         return;
      $(this).children("span").stop().fadeTo(500, 0);
   }, function()
   {
      $(this).children("span").stop().fadeTo(500, 1);
   })
});
</script></head><body><div id="space"><br></div><div id="container"><div id="Layer1"><div id="Layer1_Container"><div id="wb_Text1"><span style="color:#FFFFFF;font-family:Arial;font-size:53px;">Hi</span></div><div id="wb_Text2"><span style="color:#FFFFFF;font-family:Arial;font-size:27px;">Before you logout, can you spare us a minute and answer some small question?</span></div><div id="NavigationBar1"><ul class="navbar"><li><a href="./evaluation.php"><img alt="" src="images/img0020_over.png"><span><img alt="" src="images/img0020.png"></span></a></li><li><a href="./Logout.php"><img alt="" src="images/img0021_over.png"><span><img alt="" src="images/img0021.png"></span></a></li></ul></div></div></div></div></body></html>