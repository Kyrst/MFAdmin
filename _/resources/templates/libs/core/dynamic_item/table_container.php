<div class="core-table-page-info-container sixteen wide column">
	<?php if ( $num_total_filtered_items > 0 ): ?>
		<p>
			<?php if ( $paging_enabled ): ?>
				Showing <?= $num_page_items ?> of <?= $num_total_items ?> <?= $identifier[($num_total_items === 1 ? 'singular' : 'plural')] ?>.
			<?php else: ?>
				Showing <?= $num_page_items ?> of <?= $num_total_items ?> <?= $identifier[($num_total_items === 1 ? 'singular' : 'plural')] ?>.
			<?php endif ?>
		</p>
	<?php else: ?>
		No <?= $identifier['plural'] ?> found.
	<?php endif ?>
</div>

<table class="core-table ui small striped table">
	<thead>
		<tr>
			<?php foreach ( $columns as $column ): ?>
				<th class="two wide"><?= $column['title'] ?></th>
			<?php endforeach ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $items as $item_index => $item ): ?>
			<tr class="customer">
				<?php $column_index = 0 ?>

				<?php foreach ( $columns as $column ): ?>
					<td>
						<?= $table_column_data[$item_index][$column_index] ?>
					</td>

					<?php $column_index++ ?>
				<?php endforeach ?>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<?php if ( $paging_enabled ): ?>
	<div class="ui pagination menu">
		<a class="icon item prev<?php if ( $items->currentPage() === 1 ): ?> disabled<?php endif ?>">
			<i class="left arrow icon"></i>
		</a>

		<div class="active item">
			Page <?= $items->currentPage() ?> of <?= $items->lastPage() ?>
		</div>

		<a class="icon item next<?php if ( $items->currentPage() === $items->lastPage() ): ?> disabled<?php endif ?>">
			<i class="right arrow icon"></i>
		</a>
	</div>
<?php endif ?>