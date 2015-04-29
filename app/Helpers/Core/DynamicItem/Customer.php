<?php namespace App\Helpers\Core\DynamicItem;

use App\Helpers\Core\DynamicItem;

class Customer extends DynamicItem
{
	static function init()
	{
		self::$id = 'customer';
		self::$model = '\App\Models\Customer';

		self::$identifier =
		[
			'singular' => 'customer',
			'plural' => 'customers'
		];

		self::$columns =
		[
			'id' =>
			[
				'title' => 'ID',
				'db_column' => 'id',
				'table' =>
				[
					'show' => true
				],
				'form' =>
				[
					'type' => 'text',
					'validation' =>
					[
						'required' => ALWAYS_REQUIRED
					]
				]
			],
			'ocr' =>
			[
				'title' => 'OCR',
				'db_column' => 'ocr',
				'table' =>
				[
					'show' => true
				],
				'form' =>
				[
					'type' => 'text',
					'validation' =>
					[
						'required' => ALWAYS_REQUIRED
					]
				]
			],
			'price' =>
			[
				'title' => 'Price',
				'db_column' => 'price',
				'table' =>
				[
					'show' => true
				],
				'form' =>
				[
					'type' => 'text',
					'validation' =>
					[
						'required' => ALWAYS_REQUIRED
					]
				]
			],
			'invoice_date' =>
			[
				'title' => 'Invoice Date',
				'db_column' => 'invoice_date',
				'table' =>
				[
					'show' => true
				],
				'form' =>
				[
					'type' => 'text',
					'validation' =>
					[
						'required' => ALWAYS_REQUIRED
					]
				]
			],
			'invoice_due_date' =>
			[
				'title' => 'Invoice Due Date',
				'db_column' => 'reminder_invoice_date',
				'table' =>
				[
					'show' => true
				],
				'form' =>
				[
					'type' => 'text',
					'validation' =>
					[
						'required' => ALWAYS_REQUIRED
					]
				]
			],
			'reminder_invoice_date' =>
			[
				'title' => 'Invoice Due Reminder Date',
				'db_column' => 'reminder_invoice_date',
				'table' =>
				[
					'show' => true
				],
				'form' =>
				[
					'type' => 'text',
					'validation' =>
					[
						'required' => ALWAYS_REQUIRED
					]
				]
			],
			'payment' =>
			[
				'title' => 'Payment',
				'db_column' => 'payment',
				'table' =>
				[
					'show' => true
				],
				'form' =>
				[
					'type' => 'text',
					'validation' =>
					[
						'required' => ALWAYS_REQUIRED
					]
				]
			],
			'comment' =>
			[
				'title' => 'Comment',
				'db_column' => 'comment',
				'table' =>
				[
					'show' => true
				],
				'form' =>
				[
					'type' => 'text',
					'validation' =>
					[
						'required' => ALWAYS_REQUIRED
					]
				]
			]
		];

		self::$table_options['default_sort_column'] = 'id';
		self::$table_options['paging']['enabled'] = true;
	}

	public static function getTableColumnHTML($customer, $column_id)
	{
		return null;
	}
}