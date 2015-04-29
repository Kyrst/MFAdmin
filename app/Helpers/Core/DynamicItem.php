<?php namespace App\Helpers\Core;

class DynamicItem
{
	public static $id;
	public static $model;

	public static $identifier =
	[
		'singular' => null,
		'plural' => null
	];

	public static $columns =
	[
		/*
		'id' =>
		[
			'title' => 'ID',
			'db_column' => 'id',
			'table' =>
			[
				'show' => true,
				'sortable' => true
			],
			'form' =>
			[
				'type' => 'text',
				'name' => 'text', (optional, fallbacks to 'db_column')
				'validation' =>
				[
					'required' => ALWAYS_REQUIRED
				]
			]
		]
		*/
	];

	public static $table_options =
	[
		'default_sort_column' => null,
		'default_sort_order' => 'asc',
		'paging' =>
		[
			'enabled' => false,
			'num_per_page' => 10
		]
	];

	public static $get_route;

	private static function initDynamicItem()
	{
		$dynamic_item = get_called_class();

		$dynamic_item::init();
	}

	public static function getModel()
	{
		self::initDynamicItem();

		return self::$model;
	}

	public static function getTableColumns()
	{
		self::initDynamicItem();

		$table_columns = [];

		foreach ( self::$columns as $column_id => $column )
		{
			if ( isset($column['table']['show']) && $column['table']['show'] === true )
			{
				$table_columns[$column_id] = $column;
			}
		}

		return $table_columns;
	}

	public static function getSegmentLoadingHTML($loading_text = 'Loading', $color = null, $extra_classes = [])
	{
		self::initDynamicItem();

		return '<div id="core_segment_' . self::$id . '" data-route="' . \URL::to('core/get-dynamic-items/' . self::$id) . '" data-options=\'' . json_encode(self::$table_options) . '\' class="ui segment core-segment core-is-loading' . ($color !== null ? ' ' . $color : '') . (count($extra_classes) > 0 ? ' ' . implode(' ', $extra_classes) : '') . '"><div class="ui active inverted dimmer"><div class="ui small loader'. ($loading_text !== null ? ' text' : '') . '">' . ($loading_text !== null ? $loading_text : '') . '</div></div></div>';
	}
}