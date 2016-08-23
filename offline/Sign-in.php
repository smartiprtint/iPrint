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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Username'])) {
  $loginUsername=$_POST['Username'];
  $password=$_POST['Password'];
  $MM_fldUserAuthorization = "level";
  $MM_redirectLoginSuccess = "../online/indexonline.php";
  $MM_redirectLoginFailed = "Sign-in.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_local, $local);
  	
  $LoginRS__query=sprintf("SELECT username, password, level FROM users WHERE username=%s AND password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $local) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'level');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Sign-up</title><meta name="generator" content="WYSIWYG Web Builder 11 - http://www.wysiwygwebbuilder.com"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="ricochet.ico" rel="shortcut icon" type="image/x-icon"><link href="IPrint_v2.css" rel="stylesheet"><link href="Sign-in.css" rel="stylesheet"><script src="jquery-1.11.3.min.js"></script><script src="wb.lazyload.min.js"></script><script src="jquery.ui.effect.min.js"></script><script src="jquery.ui.effect-size.min.js"></script><script src="jquery.ui.effect-scale.min.js"></script><script src="wb.stickylayer.min.js"></script><script>
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
         ShowObjectWithEffect('Layer2', 1, 'scale', 1000, 'easeInOutExpo');
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
</script></head><body><div id="container"></div><div id="Layer10"><div id="Layer10_Container"><div id="wb_Image5"><img src="images/placeholder.gif" data-src="images/img0006.jpg" id="Image5" alt=""></div><hr id="Line4"><div id="wb_Text13"><span style="color:#FFFFFF;font-family:Arial;font-size:13px;"> 2016 Copyright Smart iPrint. All Rights Reserved.</span></div></div></div><div id="Layer1"><div id="Layer1_Container"><div id="Layer3"><div id="wb_Image2"><a href="./index.php"><img src="images/placeholder.gif" data-src="images/iprintlogo.jpg" id="Image2" alt=""></a></div></div><form name="Layer2" method="POST" action="<?php echo $loginFormAction; ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="Layer2" onsubmit="return ValidateLayer2(this)"><div id="Layer2_Container"><div id="wb_Text1"><span style="color:#808080;font-family:Arial;font-size:35px;">Sign-in</span></div><input type="text" id="Username" name="Username" value="" maxlength="35"><div id="wb_Text4"><span style="color:#696969;font-family:Arial;font-size:24px;">Username:</span></div><div id="wb_Text2"><span style="color:#696969;font-family:Arial;font-size:24px;">Password:</span></div><input type="password" id="Password" name="Password" value="" maxlength="35"><input type="submit" id="Button1" name="" value="Enter"></div></form><div id="wb_Bookmark1"><a id="Bookmark1">&nbsp;</a></div></div></div></body></html>