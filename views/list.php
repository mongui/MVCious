<table>
	<tr>
		<th>ID</th>
		<th>Item</th>
	</tr>

	<? foreach($itemlist as $item): ?>
	<tr>
		<td><?php echo $item['id_item']?></td>
		<td><?php echo $item['item']?></td>
	</tr>
	<? endforeach; ?>
</table>