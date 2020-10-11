<!DOCTYPE html>
<html>
<head>
	<title>Drag and Drop Sorting</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="ui/assets/css/bootstrap.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>

<?php
$link = mysqli_connect("localhost","root","","app-log-database");
$strSQL = "SELECT * FROM sprint_items_copy ORDER BY item_display_order ASC";
$result = mysqli_query($link,$strSQL);

if(mysqli_num_rows($result)>0)
{
	?>
	<table class="table table-striped">
		<tr>
			<th>sprint_item_id</th>
			<th>backlog_item_id</th>
			<th>status_id</th>
			<th>sprint_id</th>
			<th>item_display_order</th>
		</tr>
		<tbody class="sortable">
	
		<?php
		while($row=mysqli_fetch_object($result))
		{
			?>
			<tr id="<?php echo $row->sprint_item_id;?>">
				<td><?php echo $row->sprint_item_id;?></td>
				<td><?php echo $row->backlog_item_id;?></td>
				<td><?php echo $row->status_id;?></td>
				<td><?php echo $row->sprint_id;?></td>
				<td><?php echo $row->item_display_order;?></td>				
			</tr>
			<?php
		}
		?>
	</tbody>
	</table>
	<?php
}
?>

<script type="text/javascript">
	$(function(){
		$('.sortable').sortable({
			stop:function()
			{
				var ids = '';
				$('.sortable tr').each(function(){
					id = $(this).attr('id');
					if(ids=='')
					{
						ids = id;
					}
					else
					{
						ids = ids+','+id;
					}
				})
				$.ajax({
					url:'save_order.php',
					data:'ids='+ids,
					type:'post',
					success:function()
					{
						alert('Order saved successfully');
					}
				})
			}
		});
	});
</script>
</body>
</html>