<form action="" method="get" id="filter-form" class="ui form">
	<div class="inline fields">
		<div class="field">
			<label>
				<?= trans('dashboard.assignment') ?>
				<select name="assignment" id="filter-assignment">
					<option><?= trans('dashboard.all') ?></option>
				</select>
			</label>
		</div>

		<div class="field">
			<label>
				<?= trans('dashboard.filter') ?>
				<select name="assignment" id="filter-assignment">
					<option><?= trans('dashboard.all') ?></option>
				</select>
			</label>
		</div>

		<div class="field">
			<input type="text" name="search" id="search-customers" placeholder="<?= trans('dashboard.customers_tab.search_placeholder') ?>">
			<button type="button" id="search-customers-button" data-loading_text="<?= trans('dashboard.customers_tab.searching') ?>..." class="ui button"><?= trans('dashboard.customers_tab.search') ?></button>
		</div>

		<div class="field">
			<a href="javascript:" id="add-customer-button" class="ui button"><?= trans('dashboard.customers_tab.add_customer') ?></a>
		</div>
	</div>
</form>

<?= \App\Helpers\SemanticUI::segmentLoadingContainer('customers-container') ?>