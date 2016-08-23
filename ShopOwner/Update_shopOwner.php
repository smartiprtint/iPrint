<?php require_once('../Connections/local.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "3";
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

$MM_restrictGoTo = "../offline/Sign-up_shopOwner.php";
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
  $updateSQL = sprintf("UPDATE users SET username=%s, password=%s, email=%s, Address=%s, firstname=%s, lastname=%s WHERE id=%s",
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Address'], "text"),
                       GetSQLValueString($_POST['Firstname'], "text"),
                       GetSQLValueString($_POST['Lastname'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_local, $local);
  $Result1 = mysql_query($updateSQL, $local) or die(mysql_error());

  $updateGoTo = "Update_shopOwner.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
mysql_select_db($database_local, $local);
$query_Recordset1 = sprintf("SELECT * FROM users WHERE username = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $local) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html><html><head><meta charset="utf-8"><title>Sign-up</title><meta name="generator" content="WYSIWYG Web Builder 11 - http://www.wysiwygwebbuilder.com"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="ricochet.ico" rel="shortcut icon" type="image/x-icon"><link href="IPrint_v2.css" rel="stylesheet"><link href="Update_shopOwner.css" rel="stylesheet"><script src="jquery-1.11.3.min.js"></script><script src="jquery.ui.effect.min.js"></script><script src="jquery.ui.effect-size.min.js"></script><script src="jquery.ui.effect-scale.min.js"></script><script src="wb.lazyload.min.js"></script><script src="wb.stickylayer.min.js"></script><script>
function ValidateLayer2(theForm)
{
   var regexp;
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ0-9-]*$/;
   if (!regexp.test(theForm.Username.value))
   {
      alert("Please enter only letter and digit characters in the \"Username\" field.");
      theForm.Username.focus();
      return false;
   }
   if (theForm.Username.value == "")
   {
      alert("Please enter a value for the \"Username\" field.");
      theForm.Username.focus();
      return false;
   }
   if (theForm.Username.value.length < 7)
   {
      alert("Please enter at least 7 characters in the \"Username\" field.");
      theForm.Username.focus();
      return false;
   }
   if (theForm.Username.value.length > 35)
   {
      alert("Please enter at most 35 characters in the \"Username\" field.");
      theForm.Username.focus();
      return false;
   }
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ]*$/;
   if (!regexp.test(theForm.Firstname.value))
   {
      alert("Please enter only letter characters in the \"Firstname\" field.");
      theForm.Firstname.focus();
      return false;
   }
   if (theForm.Firstname.value == "")
   {
      alert("Please enter a value for the \"Firstname\" field.");
      theForm.Firstname.focus();
      return false;
   }
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ]*$/;
   if (!regexp.test(theForm.Lastname.value))
   {
      alert("Please enter only letter characters in the \"Lastname\" field.");
      theForm.Lastname.focus();
      return false;
   }
   if (theForm.Lastname.value == "")
   {
      alert("Please enter a value for the \"Lastname\" field.");
      theForm.Lastname.focus();
      return false;
   }
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ]*$/;
   if (!regexp.test(theForm.Addresss.value))
   {
      alert("Please enter only letter characters in the \"Address\" field.");
      theForm.Addresss.focus();
      return false;
   }
   if (theForm.Addresss.value == "")
   {
      alert("Please enter a value for the \"Address\" field.");
      theForm.Addresss.focus();
      return false;
   }
   if (theForm.Email.value == "")
   {
      alert("Please enter a value for the \"Email\" field.");
      theForm.Email.focus();
      return false;
   }
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ0-9-]*$/;
   if (!regexp.test(theForm.Password.value))
   {
      alert("Please enter only letter and digit characters in the \"Password\" field.");
      theForm.Password.focus();
      return false;
   }
   if (theForm.Password.value == "")
   {
      alert("Please enter a value for the \"Password\" field.");
      theForm.Password.focus();
      return false;
   }
   if (theForm.Password.value.length < 7)
   {
      alert("Please enter at least 7 characters in the \"Password\" field.");
      theForm.Password.focus();
      return false;
   }
   return true;
}
</script><script src="wwb11.min.js"></script><script>
$(document).ready(function()
{
   function Bookmark1Scroll()
   {
      var $obj = $("#wb_Bookmark1");
      if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false))
      {
         $obj.addClass("in-viewport");
         ShowObjectWithEffect('Layer2', 1, 'scale', 1000, 'easeInOutBack');
      }
      if ($obj.hasClass("in-viewport") && !$obj.inViewPort(true))
      {
         $obj.removeClass("in-viewport");
         ShowObject('Layer2', 0);
      }
   }
   Bookmark1Scroll();
   $(window).scroll(function(event)
   {
      Bookmark1Scroll();
   });
   $("#Layer3").stickylayer({orientation: 1, position: [0, 0], delay: 0});
   $('img[data-src]').lazyload();
});
</script></head><body><div id="container"></div><div id="Layer10"><div id="Layer10_Container"><div id="wb_Image5"><img src="images/placeholder.gif" data-src="images/img0010.jpg" id="Image5" alt=""></div><hr id="Line4"><div id="wb_Text13"><span style="color:#FFFFFF;font-family:Arial;font-size:13px;"> 2016 Copyright Smart iPrint. All Rights Reserved.</span></div></div></div><div id="Layer1"><div id="Layer1_Container"><div id="Layer3"><div id="wb_Image1"><a href="./../offline/index.php"><img src="images/placeholder.gif" data-src="images/iprintlogo.jpg" id="Image1" alt=""></a></div></div><form name="Layer2" method="POST" action="<?php echo $editFormAction; ?>" enctype="text/plain" accept-charset="UTF-8" id="Layer2" onsubmit="return ValidateLayer2(this)"><div id="Layer2_Container"><div id="wb_Text1"><span style="color:#808080;font-family:Arial;font-size:35px;">Update Shop</span></div><input type="text" id="Username" name="Username" value="<?php echo $row_Recordset1['username']; ?>" maxlength="35" readonly><input type="text" id="Firstname" name="Firstname" value="<?php echo $row_Recordset1['firstname']; ?>"><input type="text" id="Lastname" name="Lastname" value="<?php echo $row_Recordset1['lastname']; ?>">
        <input type="text" id="Addresss" name="Address" value="<?php echo $row_Recordset1['Address']; ?>">
        <input type="email" id="Email" name="Email" value="<?php echo $row_Recordset1['email']; ?>"><div id="wb_Text4"><span style="color:#696969;font-family:Arial;font-size:24px;">Username:</span></div><div id="wb_Text2"><span style="color:#696969;font-family:Arial;font-size:24px;">Password:</span></div><div id="wb_Text5"><span style="color:#696969;font-family:Arial;font-size:24px;">Firstname:</span></div><div id="wb_Text6"><span style="color:#696969;font-family:Arial;font-size:24px;">Lastname:</span></div><input type="password" id="Password" name="Password" value="<?php echo $row_Recordset1['password']; ?>" maxlength="35"><div id="wb_Text7"><span style="color:#696969;font-family:Arial;font-size:24px;">Address:</span></div><div id="wb_Text3"><span style="color:#696969;font-family:Arial;font-size:24px;">Email:</span></div><input type="submit" id="Button1" name="" value="Submit"></div>
      <input name="id" type="hidden" id="id" value="<?php echo $row_Recordset1['id']; ?>">
      <input type="hidden" name="MM_update" value="Layer2">
</form><div id="wb_Bookmark1"><a id="Bookmark1">&nbsp;</a></div></div></div></body></html>
<?php
mysql_free_result($Recordset1);
?>
