<?php namespace App\Http\Controllers\Dashboard;

use App\Helpers\Core\DynamicItem\Customer;

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
			$tab_view = view('dashboard/home/tabs/' . $tab_id);
			$tab_view->tab_id = $tab_id;

			if ( isset($tab['dynamic_item']) )
			{
				$tab_view->dynamic_item = $tab['dynamic_item'];
			}

			$tabs[$tab_id]['html'] = $tab_view->render();

			// Check for JS
			$js_path = 'js/dashboard/home/tabs/' . $tab_id . '.js';

			if ( file_exists(base_path('resources/assets/' . $js_path)) )
			{
				$this->loadJS($js_path, false, true);
			}
		}

		$this->assign('tabs', $tabs);

		return $this->display();
	}
}