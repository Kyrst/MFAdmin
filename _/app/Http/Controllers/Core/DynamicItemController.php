<?php namespace App\Http\Controllers\Core;

class DynamicItemController extends \App\Http\Controllers\ApplicationController
{
	public function getItems($id)
	{
		$dynamic_item_class = self::IdToClass($id);

		$model = $dynamic_item_class::getModel();

		$sort_column = \Input::get('sort_column', $dynamic_item_class::$table_options['default_sort_column']);
		$sort_order = \Input::get('sort_order', $dynamic_item_class::$table_options['default_sort_order']);

		$paging_enabled = (isset($dynamic_item_class::$table_options['paging']['enabled']) && $dynamic_item_class::$table_options['paging']['enabled'] === true);

		$items = $model::whereRaw('1 = 1')
			->orderBy($sort_column, $sort_order);

		if ( $paging_enabled )
		{
			$num_per_page = (isset($dynamic_item_class::$table_options['paging']['num_per_page']) ? $dynamic_item_class::$table_options['paging']['num_per_page'] : 10);

			$items = $items->paginate($num_per_page);
		}
		else
		{
			$items = $items->get();
		}

		$table_columns = $dynamic_item_class::getTableColumns();

		$table_column_data = [];

		foreach ( $items as $item_index => $item )
		{
			$column_index = 0;

			foreach ( $table_columns as $column_id => $column )
			{
				$html = $dynamic_item_class::getTableColumnHTML($item, $column_id);

				if ( $html === null )
				{
					$html = $item->$column_id;

					if ( $html === null )
					{
						$html = '-';
					}
				}

				$table_column_data[$item_index][$column_index] = $html;

				$column_index++;
			}
		}

		$num_items = count($items);

		$table_container_view = view('libs.core.dynamic_item.table_container');
		$table_container_view->identifier = $dynamic_item_class::$identifier;
		$table_container_view->num_total_items = $model::all()->count();
		$table_container_view->items = $items;
		$table_container_view->columns = $table_columns;
		$table_container_view->table_column_data = $table_column_data;

		if ( $paging_enabled )
		{
			$table_container_view->num_total_filtered_items = $items->total();
			$table_container_view->num_page_items = count($items);

			$this->ajax->addData('paging', ['current_page' => $items->currentPage(), 'num_pages' => $items->lastPage()]);
		}
		else
		{
			$num_items = $items->count();

			$table_container_view->num_total_filtered_items = $num_items;
			$table_container_view->num_page_items = $num_items;
		}

		$table_container_view->paging_enabled = $paging_enabled;

		$this->ajax->addData('html', $table_container_view->render());

		return $this->ajax->output();
	}

	private static function IdToClass($id)
	{
		switch ( $id )
		{
			case 'customer':
				return '\App\Helpers\Core\DynamicItem\Customer';
		}
	}
}