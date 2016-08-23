<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "2";
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

$MM_restrictGoTo = "../online/indexonline.php";
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
<!doctype html><html><head><meta charset="utf-8"><title>Transaction</title><meta name="generator" content="WYSIWYG Web Builder 11 - http://www.wysiwygwebbuilder.com"><link href="iprint.css" rel="stylesheet"><link href="Transac.css" rel="stylesheet"><script src="jquery-1.11.3.min.js"></script><script src="affix.min.js"></script><script src="scrollspy.min.js"></script><script>
$(document).ready(function()
{
   $("#wb_TabMenu1").affix({offset:{top: $("#wb_TabMenu1").offset().top}});
});
</script></head><body data-spy="scroll"><div id="container"><form name="Layer2" method="get" action="mailto:yourname@yourdomain.com" enctype="multipart/form-data" accept-charset="UTF-8" id="Layer3" style="position:absolute;text-align:center;left:0%;top:131px;width:968px;height:635px;z-index:2;"><div id="Layer3_Container" style="width:968px;position:relative;margin-left:auto;margin-right:auto;text-align:left;"></div></form></div><div id="Layer1" style="position:absolute;text-align:center;left:0%;top:0px;width:99.7938%;height:72px;z-index:3;"><div id="Layer1_Container" style="width:968px;position:relative;margin-left:auto;margin-right:auto;text-align:left;"><div id="wb_Text1" style="position:absolute;left:30px;top:16px;width:250px;height:40px;z-index:0;text-align:left;"><span style="color:#4682B4;font-family:Arial;font-size:35px;">Admin Panel</span></div></div></div><div id="Layer2" style="position:absolute;text-align:center;left:0.1031%;top:95px;width:99.7938%;height:36px;z-index:4;"><div id="Layer2_Container" style="width:968px;position:relative;margin-left:auto;margin-right:auto;text-align:left;"><div id="wb_TabMenu1" style="position:absolute;left:0px;top:0px;width:417px;height:36px;z-index:1;overflow:hidden;"><ul id="TabMenu1"><li><a href="./Transac.php" class="active">Transactions</a></li><li><a href="./Accounts.php">Accounts</a></li><li><a href="./Feedbacklist.php">Feedback</a></li><li><a href="./../Off.php">Log-off</a></li></ul></div></div></div></body></html>