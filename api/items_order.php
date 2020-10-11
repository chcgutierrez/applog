<!DOCTYPE html>
<html>
<head>
	<title>Drag and Drop Sorting</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="ui/assets/css/bootstrap.css">
	<link href="/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>

<?php
$link = mysqli_connect("localhost","root","","app-log-database");

$strSQL = "SELECT
A.sprint_item_id, B.backlog_item_name, C.status_name,
A.sprint_id, A.item_display_order
FROM sprint_items_copy AS A
INNER JOIN backlog_items AS B
ON A.backlog_item_id=B.backlog_item_id
INNER JOIN status AS C
ON A.status_id=C.status_id
ORDER BY A.item_display_order ASC;";

$result = mysqli_query($link,$strSQL);

if(mysqli_num_rows($result)>0)
{
	?>
	<h2>Actual spring items</h2>
	<table class="table table-striped table-sm">
		<tr>
			<th>Sprint Item</th>
			<th>Backlog Name</th>
			<th>Status</th>
			<th>Sprint ID</th>
			<th>Priority</th>
		</tr>		
		<tbody class="sortable">	
		<?php
		while($row=mysqli_fetch_object($result))
		{
		?>
			<tr id="<?php echo $row->sprint_item_id;?>">
				<td><?php echo $row->sprint_item_id;?></td>
				<td><?php echo $row->backlog_item_name;?></td>
				<td><?php echo $row->status_name;?></td>
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
					url:'SaveOrder.php',
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