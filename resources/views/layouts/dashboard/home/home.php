<div class="ui raised segment">
	<div id="tabs" class="ui top attached tabular menu">
		<?php foreach ( $tabs as $tab_id => $tab ): ?>
			<a class="item<?php if ( $tab_id === 'customers' ): ?> active<?php endif ?>" data-tab="<?= $tab_id ?>"><?= $tab['title'] ?></a>
		<?php endforeach ?>
	</div>

	<?php foreach ( $tabs as $tab_id => $tab ): ?>
		<div class="ui bottom attached tab segment<?php if ( $tab_id === 'customers' ): ?> active<?php endif ?>" data-tab="<?= $tab_id ?>">
			<?= $tab['html'] ?>
		</div>
	<?php endforeach ?>

	<form action="" method="get" id="year-form">
		<select name="year" id="year">
			<?php foreach ( $available_years as $year ): ?>
				<option value="<?= $year->year ?>"><?= $year->year ?></option>
			<?php endforeach ?>
		</select>
	</form>
</div>