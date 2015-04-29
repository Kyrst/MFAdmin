<table class="ui striped table">
	<thead>
		<tr>
			<th class="two wide">ID</th>
			<th class="two wide">OCR</th>
			<th class="two wide">Price</th>
			<th class="two wide">Invoice Date</th>
			<th class="two wide">Invoice Due Date</th>
			<th class="two wide">Invoice Due Reminder Date</th>
			<th class="two wide">Payment</th>
			<th class="two wide">Comment</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $customers as $customer ): ?>
			<tr class="customer">
				<td><?= $customer->id ?></td>
				<td><?= $customer->ocr ?></td>
				<td><?= $customer->price ?></td>
				<td><?= $customer->invoice_date ?></td>
				<td><?= $customer->reminder_invoice_date ?></td>
				<td><?= $customer->reminder_invoice_date ?></td>
				<td>-</td>
				<td><?= $customer->comment ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>