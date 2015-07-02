<?php if ( $num_customers > 0 ): ?>
	<table class="ui striped table">
		<thead>
			<tr>
				<th class="two wide">ID</th>
				<th class="two wide">OCR</th>
				<th class="two wide"><?= trans('dashboard.price') ?></th>
				<th class="two wide"><?= trans('dashboard.invoice_date') ?></th>
				<th class="two wide"><?= trans('dashboard.invoice_due_date') ?></th>
				<th class="two wide"><?= trans('dashboard.invoice_due_reminder_date') ?></th>
				<th class="two wide"><?= trans('dashboard.payment') ?></th>
				<th class="two wide"><?= trans('dashboard.comment') ?></th>
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

	<div class="ui pagination menu">
		<a class="icon item prev<?php if ( $customers->currentPage() === 1 ): ?> disabled<?php endif ?>">
			<i class="left arrow icon"></i>
		</a>

		<div class="active item">
			<?= trans('dashboard.page_of', [ 'current_page' => $customers->currentPage(), 'last_page' => $customers->lastPage() ]) ?>
		</div>

		<a class="icon item next<?php if ( $customers->currentPage() === $customers->lastPage() ): ?> disabled<?php endif ?>">
			<i class="right arrow icon"></i>
		</a>
	</div>
<?php else: ?>
	<span class="no-data-text">No customers.</span>
<?Php endif ?>
