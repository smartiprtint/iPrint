<?php require_once('../Connections/local.php'); ?>
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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="Sign-up_shopOwner.php";
  $loginUsername = $_POST['Username'];
  $LoginRS__query = sprintf("SELECT username FROM users WHERE username=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_local, $local);
  $LoginRS=mysql_query($LoginRS__query, $local) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "Layer2")) {
  $insertSQL = sprintf("INSERT INTO users (`level`, username, password, email, Address, firstname, lastname) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['level'], "int"),
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Address'], "text"),
                       GetSQLValueString($_POST['Firstname'], "text"),
                       GetSQLValueString($_POST['Lastname'], "text"));

  mysql_select_db($database_local, $local);
  $Result1 = mysql_query($insertSQL, $local) or die(mysql_error());

  $insertGoTo = "Sign-up_shopOwner.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_local, $local);
$query_regAsSo = "SELECT * FROM feedback";
$regAsSo = mysql_query($query_regAsSo, $local) or die(mysql_error());
$row_regAsSo = mysql_fetch_assoc($regAsSo);
$totalRows_regAsSo = mysql_num_rows($regAsSo);
?>
<!doctype html><html><head><meta charset="utf-8"><title>Sign-up</title><meta name="generator" content="WYSIWYG Web Builder 11 - http://www.wysiwygwebbuilder.com"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="ricochet.ico" rel="shortcut icon" type="image/x-icon"><link href="IPrint_v2.css" rel="stylesheet"><link href="Sign-up_shopOwner.css" rel="stylesheet"><script src="jquery-1.11.3.min.js"></script><script src="wb.lazyload.min.js"></script><script src="jquery.ui.effect.min.js"></script><script src="jquery.ui.effect-size.min.js"></script><script src="jquery.ui.effect-scale.min.js"></script><script src="wb.stickylayer.min.js"></script><script>
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
   }
   Bookmark1Scroll();
   $(window).scroll(function(event)
   {
      Bookmark1Scroll();
   });
   $("#Layer3").stickylayer({orientation: 1, position: [0, 0], delay: 0});
   $('img[data-src]').lazyload();
});
</script></head><body><div id="container"></div><div id="Layer10"><div id="Layer10_Container"><div id="wb_Image5"><img src="images/placeholder.gif" data-src="images/img0007.jpg" id="Image5" alt=""></div><hr id="Line4"><div id="wb_Text13"><span style="color:#FFFFFF;font-family:Arial;font-size:13px;"> 2016 Copyright Smart iPrint. All Rights Reserved.</span></div></div></div><div id="Layer1"><div id="Layer1_Container"><div id="Layer3"><div id="wb_Image2"><a href="./index.php"><img src="images/placeholder.gif" data-src="images/iprintlogo.jpg" id="Image2" alt=""></a></div></div><form name="Layer2" method="POST" action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="Layer2" onsubmit="return ValidateLayer2(this)"><div id="Layer2_Container"><input type="text" id="Username" name="Username" value="" maxlength="35"><input type="text" id="Firstname" name="Firstname" value=""><input type="text" id="Lastname" name="Lastname" value=""><input type="text" id="Addresss" name="Address" value=""><input type="email" id="Email" name="Email" value=""><div id="wb_Text4"><span style="color:#696969;font-family:Arial;font-size:24px;">Username:</span></div><div id="wb_Text2"><span style="color:#696969;font-family:Arial;font-size:24px;">Password:</span></div><div id="wb_Text5"><span style="color:#696969;font-family:Arial;font-size:24px;">Firstname:</span></div><div id="wb_Text6"><span style="color:#696969;font-family:Arial;font-size:24px;">Lastname:</span></div><div id="wb_Text7"><span style="color:#696969;font-family:Arial;font-size:24px;">Address:</span></div><input type="submit" id="Button1" name="" value="Submit"><input type="password" id="Password" name="Password" value="" maxlength="35"><div id="wb_Text3"><span style="color:#696969;font-family:Arial;font-size:24px;">Email:</span></div><div id="wb_Bookmark1"><a id="Bookmark1">&nbsp;</a></div><div id="wb_Text1"><span style="color:#808080;font-family:Arial;font-size:35px;">Sign-up as Shop Owner</span></div></div> <input name="level" type="hidden" id="level" value="3">
  <input type="hidden" name="MM_insert" value="Layer2">
     
</form></div></div></body></html>
<?php
mysql_free_result($regAsSo);
?>
