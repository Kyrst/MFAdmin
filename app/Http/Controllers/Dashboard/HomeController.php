<?php
namespace App\Http\Controllers\Dashboard;

class HomeController extends \App\Http\Controllers\DashboardController
{
	public function home()
	{
		$tabs =
		[
			'customers' =>
			[
				'title' => trans('dashboard.customers')
			],
			'assignments' =>
			[
				'title' => trans('dashboard.assignments')
			],
			'packages' =>
			[
				'title' => trans('dashboard.packages')
			],
			'modules' =>
			[
				'title' => trans('dashboard.modules')
			]
		];

		foreach ( $tabs as $tab_id => $tab )
		{
			$tab_view = view('layouts/dashboard/home/tabs/' . $tab_id);
			$tab_view->tab_id = $tab_id;

			if ( isset($tab['dynamic_item']) )
			{
				$tab_view->dynamic_item = $tab['dynamic_item'];
			}

			$tabs[$tab_id]['html'] = $tab_view->render();

			// Check for JS
			$js_path = 'js/layouts/dashboard/home/tabs/' . $tab_id . '.js';

			if ( file_exists(public_path($js_path)) )
			{
				$this->loadJS($js_path, false, true);
			}
		}

		$this->assign('tabs', $tabs);

		return $this->display('MFAdmin', true);
	}

	public function getTableItems()
	{
		$search_query = \Input::get('search_query');

		$customers = \App\Models\Customer::whereRaw('1 = 1');

		if ( !empty($search_query) )
		{
			$customers = $customers->where('id', $search_query)
				->orWhere('ocr', $search_query);
		}

		$customers = $customers->paginate(15);

		$table_view = view('layouts/dashboard/home/tabs/customers/customers_container');
		$table_view->customers = $customers;
		$table_view->num_customers = count($customers);

		$this->ajax->assign('html', $table_view->render());

		return $this->ajax->output();
	}

	public function getModal()
	{
		$modal_view = view('layouts/dashboard/home/tabs/customers/modal');

		$this->ajax->assign('html', $modal_view->render());

		return $this->ajax->output();
	}
}