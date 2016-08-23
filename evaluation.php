<?php require_once('Connections/local.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "Layer1")) {
  $insertSQL = sprintf("INSERT INTO feedback (webEval, droidEval, others) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['webEval'], "text"),
                       GetSQLValueString($_POST['droidEval'], "text"),
                       GetSQLValueString($_POST['others'], "text"));

  mysql_select_db($database_local, $local);
  $Result1 = mysql_query($insertSQL, $local) or die(mysql_error());

  $insertGoTo = "Logout.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_local, $local);
$query_Recordset1 = "SELECT * FROM feedback";
$Recordset1 = mysql_query($query_Recordset1, $local) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html><html><head><meta charset="utf-8"><title>Untitled Page</title><meta name="generator" content="WYSIWYG Web Builder 11 - http://www.wysiwygwebbuilder.com"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="IPrint_v2.css" rel="stylesheet"><link href="evaluation.css" rel="stylesheet"></head><body><div id="space"><br></div><div id="container"><form name="Layer1" method="POST" action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="Layer1"><div id="Layer1_Container"><div id="wb_Text2"><span style="color:#FFFFFF;font-family:Arial;font-size:27px;">How's your experince to the website?</span></div><div id="wb_Text1"><span style="color:#FFFFFF;font-family:Arial;font-size:27px;">If you've already used the android app, how was it?</span></div><div id="wb_Text3"><span style="color:#FFFFFF;font-family:Arial;font-size:27px;">Any good idea's that you can share to us for the further improvement of our service?</span></div><textarea name="webEval" id="webEval" rows="6" cols="50"></textarea><textarea name="droidEval" id="droidEval" rows="6" cols="50"></textarea><textarea name="others" id="others" rows="5" cols="50"></textarea><div id="wb_Text4"><span style="color:#FFFFFF;font-family:Arial;font-size:27px;">Thanks for your support </span></div><input type="submit" id="Button1" name="" value="Submit and logout"></div>
  <input type="hidden" name="MM_insert" value="Layer1">
</form></div></body></html>
<?php
mysql_free_result($Recordset1);
?>
