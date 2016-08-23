<?php require_once('../Connections/local.php'); ?>
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

$MM_restrictGoTo = "../Logout.php";
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
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_feedbacklist = 10;
$pageNum_feedbacklist = 0;
if (isset($_GET['pageNum_feedbacklist'])) {
  $pageNum_feedbacklist = $_GET['pageNum_feedbacklist'];
}
$startRow_feedbacklist = $pageNum_feedbacklist * $maxRows_feedbacklist;

mysql_select_db($database_local, $local);
$query_feedbacklist = "SELECT * FROM feedback ORDER BY `time` DESC";
$query_limit_feedbacklist = sprintf("%s LIMIT %d, %d", $query_feedbacklist, $startRow_feedbacklist, $maxRows_feedbacklist);
$feedbacklist = mysql_query($query_limit_feedbacklist, $local) or die(mysql_error());
$row_feedbacklist = mysql_fetch_assoc($feedbacklist);

if (isset($_GET['totalRows_feedbacklist'])) {
  $totalRows_feedbacklist = $_GET['totalRows_feedbacklist'];
} else {
  $all_feedbacklist = mysql_query($query_feedbacklist);
  $totalRows_feedbacklist = mysql_num_rows($all_feedbacklist);
}
$totalPages_feedbacklist = ceil($totalRows_feedbacklist/$maxRows_feedbacklist)-1;
?>
<!doctype html><html><head><meta charset="utf-8"><title>Feedback</title><meta name="generator" content="WYSIWYG Web Builder 11 - http://www.wysiwygwebbuilder.com"><link href="iprint.css" rel="stylesheet"><link href="Feedbacklist.css" rel="stylesheet"><script src="jquery-1.11.3.min.js"></script><script src="affix.min.js"></script><script src="scrollspy.min.js"></script><script>
$(document).ready(function()
{
   $("#wb_TabMenu1").affix({offset:{top: $("#wb_TabMenu1").offset().top}});
});
</script></head><body data-spy="scroll">
<div id="container"><form name="Layer2" method="get" action="mailto:yourname@yourdomain.com" enctype="multipart/form-data" accept-charset="UTF-8" id="Layer3" style="position:absolute;text-align:center;left:0%;top:131px;width:968px;height:635px;z-index:2;"><div id="Layer3_Container" style="width:968px;position:relative;margin-left:auto;margin-right:auto;text-align:left; overflow:scroll;"></div>
    <div align="center"><span style="color:#4682B4;">
      <table border="1" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center"><strong><span style="color:#4682B4;font-family:Arial;font-size:18px;">Time</span></strong></div></td>
          <td><div align="center"><strong><span style="color:#4682B4;font-family:Arial;font-size:18px;">Website feedback</span></strong></div></td>
          <td><div align="center"><strong><span style="color:#4682B4;font-family:Arial;font-size:18px;">Android feedback</span></strong></div></td>
          <td><div align="center"><strong><span style="color:#4682B4;font-family:Arial;font-size:18px;">Improvements</span></strong></div></td>
        </tr>
        <?php do { ?>
          <tr>
            <td style="max-width: 150px; word-wrap: break-word; width: 150px;"><div align="center"><strong><p><?php echo $row_feedbacklist['time']; ?></p></strong></div></td>
            <td style="max-width: 250px; word-wrap: break-word; width: 250px;"><div align="center"><strong><p><?php echo $row_feedbacklist['webEval']; ?></p></strong></div></td>
            <td style="max-width: 250px; word-wrap: break-word; width: 250px;"><div align="center"><strong><p><?php echo $row_feedbacklist['droidEval']; ?></p></strong></div></td>
            <td style="max-width: 250px; word-wrap: break-word; width: 250px;"><div align="center"><strong><p><?php echo $row_feedbacklist['others']; ?></p></strong></div></td>
          </tr>
          <?php } while ($row_feedbacklist = mysql_fetch_assoc($feedbacklist)); ?>
      </table>
    </span></div>
</form></div><div id="Layer1" style="position:absolute;text-align:center;left:0%;top:0px;width:99.7938%;height:72px;z-index:3;"><div id="Layer1_Container" style="width:968px;position:relative;margin-left:auto;margin-right:auto;text-align:left;"><div id="wb_Text1" style="position:absolute;left:30px;top:16px;width:250px;height:40px;z-index:0;text-align:left;"><span style="color:#4682B4;font-family:Arial;font-size:35px;">Admin Panel</span></div></div></div><div id="Layer2" style="position:absolute;text-align:center;left:0.1031%;top:95px;width:99.7938%;height:36px;z-index:4;"><div id="Layer2_Container" style="width:968px;position:relative;margin-left:auto;margin-right:auto;text-align:left;"><div id="wb_TabMenu1" style="position:absolute;left:0px;top:0px;width:417px;height:36px;z-index:1;overflow:hidden;"><ul id="TabMenu1"><li><a href="./Transac.php">Transactions</a></li><li><a href="./Accounts.php">Accounts</a></li><li><a href="./Feedbacklist.php" class="active">Feedback</a></li><li><a href="./../Off.php">Log-off</a></li></ul></div></div></div></body></html>
<?php
mysql_free_result($feedbacklist);
?>
