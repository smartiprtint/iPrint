$(document).ready(function(){
$('#Layer3_Container').load('Layer3_Container/Account.php');
$('a').click.function(){
	var page = $(this).attr('href');
	$('#Layer3_Container').load('Layer3_Container' + page + '.php');
return.false;});});