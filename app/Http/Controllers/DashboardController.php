<?php
namespace App\Http\Controllers;

use App\Helpers\Nordea;

class DashboardController extends \PXLBros\PXLFramework\Http\Controllers\DashboardController
{
	function __construct()
	{
		parent::__construct();

		//$this->home_route = route('home');
	}

	public function afterLayoutInit()
	{
		/*if ( $this->is_ajax === false )
		{
			$this->initMenu();
		}*/

		Nordea::readTotalINBas();

		$this->initAvailableYears();

		parent::afterLayoutInit();
	}

	private function initAvailableYears()
	{
		$available_years = \DB::select('SELECT DISTINCT YEAR(invoice_date) AS year FROM customers ORDER BY year DESC');

		$this->assign('available_years', $available_years);
	}

	/*private function initMenu()
	{
		$menu_items =
		[
			[
				'text' => 'Dashboard',
				'icon' => 'dashboard',
				'link' => route('home'),
				'pages' => ['dashboard/home/home']
			],
			[
				'text' => 'Policies',
				'icon' => 'file text outline',
				'link' => route('policies'),
				'pages' => ['dashboard/policies/policies']
			],
			[
				'text' => 'Classifieds',
				'icon' => 'travel',
				'link' => route('classifieds'),
				'pages' => ['dashboard/classifieds/classifieds']
			]
		];

		if ( $this->user->is('Administrator') )
		{
			$menu_items[] =
			[
				'text' => 'Calendar',
				'icon' => 'calendar',
				'link' => route('calendar'),
				'pages' => ['dashboard/calendar/calendar']
			];

			$menu_items[] =
			[
				'text' => 'News',
				'icon' => 'newspaper',
				'link' => route('news'),
				'pages' => ['dashboard/news/news']
			];

			$menu_items[] =
			[
				'text' => 'Users',
				'icon' => 'user',
				'link' => route('users'),
				'pages' => ['dashboard/users/users', 'dashboard/users/user']
			];
		}

		$this->assign('menu_items', $menu_items, self::SECTION_LAYOUT);
	}*/

	public function signOut()
	{
		if ( $this->user !== NULL )
		{
			\Auth::logout();
		}

		return \Redirect::to($this->base_url);
	}
}