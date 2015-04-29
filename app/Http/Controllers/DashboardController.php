<?php namespace App\Http\Controllers;

class DashboardController extends ApplicationController
{
	public $layout = 'dashboard';

	private $breadcrumb_items = [];

	function __construct()
	{
		$this->beforeFilter('@filterRequests', ['on' => 'get']);
	}

	public function filterRequests($route, $request)
	{
		$user = \Auth::user();

		if ( $user === NULL && $route->getActionName() !== 'App\Http\Controllers\Dashboard\AuthController@signIn' )
		{
			return \Redirect::route('sign-in');
		}

		$this->assign('post_max_size', \App\Helpers\Core\File::getBytes(ini_get('post_max_size')), CoreController::SECTION_JS);
		$this->assign('upload_max_filesize', \App\Helpers\Core\File::getBytes(ini_get('upload_max_filesize')), CoreController::SECTION_JS);
	}

	public function afterLayoutInit()
	{
		$this->initMenu();
		$this->initBreadcrumb();
		$this->initAvailableYears();

		parent::afterLayoutInit();
	}

	public function beforeDisplay()
	{
		$breadcrumb_view = view('layouts/partials/dashboard/breadcrumb');
		$breadcrumb_view->breadcrumb_items = $this->breadcrumb_items;
		$breadcrumb_view->num_breadcrumb_items = count($this->breadcrumb_items);

		$this->assign('breadcrumb', $breadcrumb_view->render(), CoreController::SECTION_LAYOUT);

		parent::beforeDisplay();
	}

	private function initMenu()
	{
		$menu_items =
		[
			[
				'text' => 'Dashboard',
				'icon' => 'dashboard',
				'link' => \URL::route('dashboard'),
				'pages' => ['dashboard/home/home']
			]
		];

		$this->assign('menu_items', $menu_items, CoreController::SECTION_LAYOUT);
	}

	private function initBreadcrumb()
	{
		if ( $this->current_page !== 'dashboard/home/home' )
		{
			$this->addBreadcrumbItem('Dashboard', \URL::route('dashboard'));
		}
	}

	protected function addBreadcrumbItem($text, $link = NULL)
	{
		$this->breadcrumb_items[] =
		[
			'text' => $text,
			'link' => $link
		];
	}

	private function initAvailableYears()
	{
		$available_years = \DB::select('SELECT DISTINCT YEAR(invoice_date) AS year FROM customers ORDER BY year DESC');

		$this->assign('available_years', $available_years);
	}
}