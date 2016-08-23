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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_acclist = 10;
$pageNum_acclist = 0;
if (isset($_GET['pageNum_acclist'])) {
  $pageNum_acclist = $_GET['pageNum_acclist'];
}
$startRow_acclist = $pageNum_acclist * $maxRows_acclist;

mysql_select_db($database_local, $local);
$query_acclist = "SELECT * FROM users WHERE `level` = 1 ORDER BY id DESC";
$query_limit_acclist = sprintf("%s LIMIT %d, %d", $query_acclist, $startRow_acclist, $maxRows_acclist);
$acclist = mysql_query($query_limit_acclist, $local) or die(mysql_error());
$row_acclist = mysql_fetch_assoc($acclist);

if (isset($_GET['totalRows_acclist'])) {
  $totalRows_acclist = $_GET['totalRows_acclist'];
} else {
  $all_acclist = mysql_query($query_acclist);
  $totalRows_acclist = mysql_num_rows($all_acclist);
}
$totalPages_acclist = ceil($totalRows_acclist/$maxRows_acclist)-1;

$queryString_acclist = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_acclist") == false && 
        stristr($param, "totalRows_acclist") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_acclist = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_acclist = sprintf("&totalRows_acclist=%d%s", $totalRows_acclist, $queryString_acclist);
?>
<!doctype html><html><head><meta charset="utf-8"><title>Accounts</title><meta name="generator" content="WYSIWYG Web Builder 11 - http://www.wysiwygwebbuilder.com"><link href="iprint.css" rel="stylesheet"><link href="Accounts.css" rel="stylesheet"><script src="jquery-1.11.3.min.js"></script><script src="affix.min.js"></script><script src="scrollspy.min.js"></script><script>
$(document).ready(function()
{
   $("#wb_TabMenu1").affix({offset:{top: $("#wb_TabMenu1").offset().top}});
});
<script src="Admin_/jquery-3.1.0.js"></script>

<script>
$(document).ready(function(){
$('#Layer3_Container').load('Layer3_Container/Account.php');
$('a').click.function(){
	var page = $(this).attr('href');
	$('#Layer3_Container').load('Layer3_Container' + page + '.php');
return.false;});});

</script>

</head><body data-spy="scroll"><div id="container"><form name="Layer2" method="GET" action="mailto:yourname@yourdomain.com" enctype="multipart/form-data" accept-charset="UTF-8" id="Layer3" style="position:absolute;text-align:center;left:0.1031%;top:131px;width:968px;height:635px;z-index:4;">
  <div id="Layer3_Container" style="width:968px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
    <div align="center"><span style="color:#4682B4;">
      <p>
      <table border="1" cellpadding="" cellspacing="0">
        <tr>
          <td><div align="center"><span style="color:#4682B4;font-family:Arial;font-size:18px;"><strong>ID</strong></span></div></td>
          <td><div align="center"><span style="color:#4682B4;font-family:Arial;font-size:18px;"><strong>Level</strong></span></div></td>
          <td><div align="center"><strong><span style="color:#4682B4;font-family:Arial;font-size:18px;">Username</span></strong></div></td>
          <td><div align="center"><span style="color:#4682B4;font-family:Arial;font-size:18px;"><strong>Password</strong></span></div></td>
          <td><div align="center"><span style="color:#4682B4;font-family:Arial;font-size:18px;"><strong>Email</strong></span></div></td>
          <td><div align="center"><span style="color:#4682B4;font-family:Arial;font-size:18px;"><strong>Age</strong></span></div></td>
          <td><div align="center"><span style="color:#4682B4;font-family:Arial;font-size:18px;"><strong>Firstname</strong></span></div></td>
          <td><div align="center"><span style="color:#4682B4;font-family:Arial;font-size:18px;"><strong>Lastname</strong></span></div></td>
          <td><div align="center"><span style="color:#4682B4;font-family:Arial;font-size:18px;"><strong>Timestamp</strong></span></div></td>
          <td><div align="center"><span style="color:#4682B4;font-family:Arial;font-size:18px;"><strong>Comands</strong></span></div></td>
        </tr>
        <?php do { ?>
        <tr>
          <td><p><div align="center"><strong><?php echo $row_acclist['id']; ?></strong></div></p></td>
          <td><div align="center"><strong><?php echo $row_acclist['level']; ?></strong></div></td>
          <td width="30"><div align="center"><strong><?php echo $row_acclist['username']; ?></strong></div></td>
          <td><div align="center"><strong><?php echo $row_acclist['password']; ?></strong></div></td>
          <td><div align="center"><strong><?php echo $row_acclist['email']; ?></strong></div></td>
          <td><div align="center"><strong><?php echo $row_acclist['Address']; ?></strong></div></td>
          <td><div align="center"><strong><?php echo $row_acclist['firstname']; ?></strong></div></td>
          <td><div align="center"><strong><?php echo $row_acclist['lastname']; ?></strong></div></td>
          <td><div align="center"><strong><?php echo $row_acclist['timestamp']; ?></strong></div></td>
          <td><div align="center">
            <input name="id" type="hidden" id="id" value="<?php echo $row_acclist['id']; ?>">
            <a href="UpdateAccount.php?id=<?php echo $row_acclist['id']; ?>">Update</a> <a href="Delete.php?id=<?php echo $row_acclist['id']; ?>">Delete</a></div></td>
        </tr>
        <?php } while ($row_acclist = mysql_fetch_assoc($acclist)); ?>
      </table>
      <p> Showing accounts from<strong><strong><span style="color:#4682B4;font-family:Arial;font-size:18px;"> <?php echo ($startRow_acclist + 1) ?></span></strong></strong> to <strong><span style="color:#4682B4;font-family:Arial;font-size:18px;"><?php echo min($startRow_acclist + $maxRows_acclist, $totalRows_acclist) ?></span></strong> out of <strong><span style="color:#4682B4;font-family:Arial;font-size:18px;"><?php echo $totalRows_acclist ?></span></strong>
      in decending order<p>  
      <table border="0">
        <tr>
          <td><?php if ($pageNum_acclist > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_acclist=%d%s", $currentPage, 0, $queryString_acclist); ?>"><span style="color:#4682B4;font-family:Arial;font-size:20px;"><strong><<</strong></span></a>
            <?php } // Show if not first page ?></td>
          <td><?php if ($pageNum_acclist > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_acclist=%d%s", $currentPage, max(0, $pageNum_acclist - 1), $queryString_acclist); ?>"><strong><span style="color:#4682B4;font-family:Arial;font-size:20px;"><</span></strong></a>
            <?php } // Show if not first page ?></td>
          <td><?php if ($pageNum_acclist < $totalPages_acclist) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_acclist=%d%s", $currentPage, min($totalPages_acclist, $pageNum_acclist + 1), $queryString_acclist); ?>"><strong><span style="color:#4682B4;font-family:Arial;font-size:20px;">></span></strong></a>
            <?php } // Show if not last page ?></td>
          <td><?php if ($pageNum_acclist < $totalPages_acclist) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_acclist=%d%s", $currentPage, $totalPages_acclist, $queryString_acclist); ?>"><strong><span style="color:#4682B4;font-family:Arial;font-size:20px;">>></span></strong></a>
            <?php } // Show if not last page ?></td>
        </tr>
      </table>
    </span></div>
  </div>
</form></div><div id="Layer1" style="position:absolute;text-align:center;left:0.1031%;top:0px;width:99.7938%;height:72px;z-index:5;"><div id="Layer1_Container" style="width:968px;position:relative;margin-left:auto;margin-right:auto;text-align:left;"><div id="wb_Text1" style="position:absolute;left:30px;top:16px;width:250px;height:40px;z-index:0;text-align:left;"><span style="color:#4682B4;font-family:Arial;font-size:35px;">Admin Panel</span></div></div></div><div id="Layer2" style="position:absolute;text-align:center;left:0.2062%;top:95px;width:99.7938%;height:36px;z-index:6;"><div id="Layer2_Container" style="width:968px;position:relative;margin-left:auto;margin-right:auto;text-align:left;"><div id="wb_TabMenu1" style="position:absolute;left:0px;top:0px;width:417px;height:36px;z-index:1;overflow:hidden;"><ul id="TabMenu1"><li><a href="./Transac.php">Transactions</a></li><li><a href="./Accounts.php" class="active">Accounts</a></li><li><a href="./Feedbacklist.php">Feedback</a></li><li><a href="./../Off.php">Log-off</a></li></ul></div></div></div></body></html>
<?php
mysql_free_result($acclist);
?>
