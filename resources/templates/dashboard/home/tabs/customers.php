<form action="" method="get" id="filter_form" class="ui form">
	<div class="inline fields">
		<div class="field">
			<label>
				<?= trans('dashboard.assignment') ?>
				<select name="assignment" id="filter_assignment">
					<option>All</option>
				</select>
			</label>
		</div>

		<div class="field">
			<label>
				<?= trans('dashboard.filter') ?>
				<select name="assignment" id="filter_assignment">
					<option>All</option>
				</select>
			</label>
		</div>
	</div>
</form>

<?= \App\Helpers\Core\DynamicItem\Customer::getSegmentLoadingHTML() ?>