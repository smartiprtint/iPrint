<?php
// *** Logout the current user.
$logoutGoTo = "offline/index.php";
if (!isset($_SESSION)) {
  session_start();
}
$_SESSION['MM_Username'] = NULL;
$_SESSION['MM_UserGroup'] = NULL;
unset($_SESSION['MM_Username']);
unset($_SESSION['MM_UserGroup']);
if ($logoutGoTo != "") {header("Location: $logoutGoTo");
exit;
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Untitled Page</title><meta name="generator" content="WYSIWYG Web Builder 11 - http://www.wysiwygwebbuilder.com"><link href="IPrint_v2.css" rel="stylesheet"><link href="Logout.css" rel="stylesheet"></head><body></body></html>