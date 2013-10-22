<table>
	<tr>
		<th>ID</th>
		<th>Item</th>
	</tr>

	<?php foreach($itemlist as $item): ?>
	<tr>
		<td><?= $item['id_item'] ?></td>
		<td><?= $item['item'] ?></td>
	</tr>
	<?php endforeach; ?>
</table>