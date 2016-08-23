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

$MM_restrictGoTo = "../offline/Sign-in.php";
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "Layer2")) {
  $updateSQL = sprintf("UPDATE users SET `level`=%s, username=%s, password=%s, email=%s, age=%s, firstname=%s, lastname=%s WHERE id=%s",
                       GetSQLValueString($_POST['level'], "int"),
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Age'], "int"),
                       GetSQLValueString($_POST['firstname'], "text"),
                       GetSQLValueString($_POST['lastname'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_local, $local);
  $Result1 = mysql_query($updateSQL, $local) or die(mysql_error());

  $updateGoTo = "Accounts.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_updateadmin = "-1";
if (isset($_GET['id'])) {
  $colname_updateadmin = $_GET['id'];
}
mysql_select_db($database_local, $local);
$query_updateadmin = sprintf("SELECT * FROM users WHERE id = %s", GetSQLValueString($colname_updateadmin, "int"));
$updateadmin = mysql_query($query_updateadmin, $local) or die(mysql_error());
$row_updateadmin = mysql_fetch_assoc($updateadmin);
$totalRows_updateadmin = mysql_num_rows($updateadmin);
?>
<!doctype html><html><head><meta charset="utf-8"><title>Update</title><meta name="generator" content="WYSIWYG Web Builder 11 - http://www.wysiwygwebbuilder.com"><link href="cupertino/jquery-ui.min.css" rel="stylesheet"><link href="iprint.css" rel="stylesheet"><link href="UpdateAccount.css" rel="stylesheet"><script src="jquery-1.11.3.min.js"></script><script src="jquery.ui.core.min.js"></script><script src="jquery.ui.widget.min.js"></script><script src="jquery.ui.position.min.js"></script><script src="jquery.ui.tooltip.min.js"></script><script>
function ValidateLayer2(theForm)
{
   var regexp;
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ]*$/;
   if (!regexp.test(theForm.username.value))
   {
      alert("Please enter only letter characters in the \"Username\" field.");
      theForm.username.focus();
      return false;
   }
   if (theForm.username.value == "")
   {
      alert("Please enter a value for the \"Username\" field.");
      theForm.username.focus();
      return false;
   }
   if (theForm.username.value.length < 7)
   {
      alert("Please enter at least 7 characters in the \"Username\" field.");
      theForm.username.focus();
      return false;
   }
   if (theForm.username.value.length > 35)
   {
      alert("Please enter at most 35 characters in the \"Username\" field.");
      theForm.username.focus();
      return false;
   }
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ0-9-]*$/;
   if (!regexp.test(theForm.password.value))
   {
      alert("Please enter only letter and digit characters in the \"Password\" field.");
      theForm.password.focus();
      return false;
   }
   if (theForm.password.value == "")
   {
      alert("Please enter a value for the \"Password\" field.");
      theForm.password.focus();
      return false;
   }
   if (theForm.password.value.length < 7)
   {
      alert("Please enter at least 7 characters in the \"Password\" field.");
      theForm.password.focus();
      return false;
   }
   if (theForm.password.value.length > 35)
   {
      alert("Please enter at most 35 characters in the \"Password\" field.");
      theForm.password.focus();
      return false;
   }
   regexp = /^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i;
   if (!regexp.test(theForm.email.value))
   {
      alert("Please enter a valid email address.");
      theForm.email.focus();
      return false;
   }
   if (theForm.email.value == "")
   {
      alert("Please enter a value for the \"Email\" field.");
      theForm.email.focus();
      return false;
   }
   if (theForm.email.value.length < 1)
   {
      alert("Please enter at least 1 characters in the \"Email\" field.");
      theForm.email.focus();
      return false;
   }
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ]*$/;
   if (!regexp.test(theForm.firstname.value))
   {
      alert("Please enter only letter characters in the \"firstname\" field.");
      theForm.firstname.focus();
      return false;
   }
   if (theForm.firstname.value == "")
   {
      alert("Please enter a value for the \"firstname\" field.");
      theForm.firstname.focus();
      return false;
   }
   if (theForm.firstname.value.length < 1)
   {
      alert("Please enter at least 1 characters in the \"firstname\" field.");
      theForm.firstname.focus();
      return false;
   }
   if (theForm.lastname.value == "")
   {
      alert("Please enter a value for the \"lastname\" field.");
      theForm.lastname.focus();
      return false;
   }
   if (theForm.lastname.value.length < 1)
   {
      alert("Please enter at least 1 characters in the \"lastname\" field.");
      theForm.lastname.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.age.value))
   {
      alert("Please enter only digit characters in the \"Age\" field.");
      theForm.age.focus();
      return false;
   }
   if (theForm.age.value == "")
   {
      alert("Please enter a value for the \"Age\" field.");
      theForm.age.focus();
      return false;
   }
   if (theForm.age.value.length < 1)
   {
      alert("Please enter at least 1 characters in the \"Age\" field.");
      theForm.age.focus();
      return false;
   }
   return true;
}
</script><script>
$(document).ready(function()
{
   var jQueryToolTip1Options =
   {
      hide: true,
      show: true,
      content: "<span style=\"color:#4682B4;font-family:'Comic Sans MS';font-size:11px;\"><strong>Only 1 and 2 are the available value where 1 is for non admin users and 2 for admin users</strong></span>",
      items: '#lvl',
      position: { my: "left center", at: "right center", collision: "flipfit" },
      tooltipClass: "jQueryToolTip1"
   };
   $("#lvl").tooltip(jQueryToolTip1Options);
});
</script></head><body><div id="container"><div id="Layer3" style="position:absolute;text-align:center;left:0.1031%;top:131px;width:968px;height:813px;z-index:41;"><div id="Layer3_Container" style="width:968px;position:relative;margin-left:auto;margin-right:auto;text-align:left;"><form name="Layer2" method="POST" action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="Layer4" onsubmit="return ValidateLayer2(this)" style="position: absolute; text-align: center; left: 242px; top: 25px; width: 462px; height: 729px; z-index: 20;"><div id="Layer4_Container" style="width:462px;position:relative;margin-left:auto;margin-right:auto;text-align:left;"><input type="text" id="username" style="position:absolute;left:130px;top:78px;width:208px;height:28px;line-height:28px;z-index:2;" name="Username" value="<?php echo $row_updateadmin['username']; ?>" maxlength="35"><input type="password" id="password" style="position:absolute;left:130px;top:162px;width:208px;height:28px;line-height:28px;z-index:3;" name="Password" value="<?php echo $row_updateadmin['password']; ?>" maxlength="35"><input type="email" id="email" style="position:absolute;left:130px;top:246px;width:208px;height:28px;line-height:28px;z-index:4;" name="Email" value="<?php echo $row_updateadmin['email']; ?>"><input type="text" id="firstname" style="position:absolute;left:130px;top:329px;width:208px;height:28px;line-height:28px;z-index:5;" name="firstname" value="<?php echo $row_updateadmin['firstname']; ?>"><input type="text" id="lastname" style="position:absolute;left:130px;top:413px;width:208px;height:28px;line-height:28px;z-index:6;" name="lastname" value="<?php echo $row_updateadmin['lastname']; ?>"><input type="number" id="age" style="position: absolute; left: 132px; top: 497px; width: 207px; height: 28px; line-height: 28px; z-index: 7;" name="Age" value="<?php echo $row_updateadmin['Address']; ?>" maxlength="150"><div id="wb_Text3" style="position:absolute;left:134px;top:56px;width:99px;height:22px;z-index:8;text-align:left;"><span style="color:#4682B4;font-family:Arial;font-size:19px;"><strong>Username</strong></span></div><div id="wb_Text4" style="position:absolute;left:132px;top:140px;width:103px;height:22px;z-index:9;text-align:left;"><span style="color:#4682B4;font-family:Arial;font-size:19px;"><strong>Password</strong></span></div><div id="wb_Text5" style="position:absolute;left:130px;top:224px;width:83px;height:22px;z-index:10;text-align:left;"><span style="color:#4682B4;font-family:Arial;font-size:19px;"><strong>Email</strong></span></div><div id="wb_Text6" style="position:absolute;left:130px;top:307px;width:105px;height:22px;z-index:11;text-align:left;"><span style="color:#4682B4;font-family:Arial;font-size:19px;"><strong>First Name</strong></span></div><div id="wb_Text7" style="position:absolute;left:130px;top:391px;width:101px;height:22px;z-index:12;text-align:left;"><span style="color:#4682B4;font-family:Arial;font-size:19px;"><strong>Last Name</strong></span></div><div id="wb_Text8" style="position:absolute;left:132px;top:475px;width:47px;height:22px;z-index:13;text-align:left;"><span style="color:#4682B4;font-family:Arial;font-size:19px;"><strong>Age</strong></span></div><input type="submit" id="Button1" name="" value="Update" style="position: absolute; left: 196px; top: 656px; width: 95px; height: 38px; z-index: 14;"><div id="Layer5" style="position:absolute;text-align:left;left:0px;top:0px;width:191px;height:54px;z-index:15;"><div id="wb_Text2" style="position:absolute;left:13px;top:15px;width:172px;height:24px;z-index:1;text-align:left;"><span style="color:#FFFFFF;font-family:Arial;font-size:21px;"><strong>Update Account</strong></span></div></div><input type="text" id="lvl" style="position:absolute;left:134px;top:584px;width:85px;height:28px;line-height:28px;z-index:16;" name="level" value="<?php echo $row_updateadmin['level']; ?>"><div id="wb_Text9" style="position:absolute;left:132px;top:562px;width:103px;height:22px;z-index:17;text-align:left;"><span style="color:#4682B4;font-family:Arial;font-size:19px;"><strong>User Level</strong></span></div></div>
  <input name="id" type="hidden" id="id" value="<?php echo $row_updateadmin['id']; ?>">
  <input type="hidden" name="MM_update" value="Layer2">
</form></div></div></div><div id="Layer1" style="position:absolute;text-align:center;left:0%;top:0px;width:99.7938%;height:72px;z-index:42;"><div id="Layer1_Container" style="width:968px;position:relative;margin-left:auto;margin-right:auto;text-align:left;"><div id="wb_Text1" style="position:absolute;left:30px;top:16px;width:250px;height:40px;z-index:0;text-align:left;"><span style="color:#4682B4;font-family:Arial;font-size:35px;">Admin Panel</span></div></div></div><div id="Layer2" style="position:absolute;text-align:center;left:0.1031%;top:95px;width:99.7938%;height:36px;z-index:43;"><div id="Layer2_Container" style="width:968px;position:relative;margin-left:auto;margin-right:auto;text-align:left;"></div></div></body></html>
<?php
mysql_free_result($updateadmin);
?>
