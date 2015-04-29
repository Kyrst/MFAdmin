<?php namespace App\Http\Controllers\Dashboard\Home;

class CustomersController extends \App\Http\Controllers\Dashboard\HomeController
{
	public function getCustomers()
	{
		$view = view('dashboard/home/tabs/customers/customers_container');

		$customers = \App\Models\Customer::orderBy('id')
			->limit(10)
			->get();

		$num_customers = count($customers);

		$view->customers = $customers;
		$view->num_customers = $num_customers;

		$this->ajax->addData('num_customers', $num_customers);

		$this->ajax->addData('html', $view->render());

		return $this->ajax->output();
	}
}