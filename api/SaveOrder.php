<?php
$link = mysqli_connect("localhost","root","","app-log-database");
$ids = $_POST['ids'];
$arr = explode(',',$ids);
for($i=1;$i<=count($arr);$i++)
{
	$strSQL = "UPDATE sprint_items_copy SET item_display_order = ".$i." WHERE sprint_item_id = ".$arr[$i-1];
	mysqli_query($link, $strSQL);
}
?>