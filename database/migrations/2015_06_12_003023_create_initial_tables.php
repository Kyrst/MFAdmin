<?php
use Illuminate\Database\Migrations\Migration;

class CreateInitialTables extends Migration
{
	public function up()
	{
		// Packages
		Schema::create('packages', function($table)
		{
			$table->increments('id');
			$table->string('title', 40);
			$table->decimal('price', 6, 2)->unsigned();
			$table->text('description')->nullable();
			$table->timestamps();
		});

		// Assignments
		Schema::create('assignments', function($table)
		{
			$table->increments('id');
			$table->string('title', 40);
			$table->integer('package_id')->unsigned();
			$table->timestamps();

			$table->foreign('package_id')->references('id')->on('packages');
		});

		// Customers
		Schema::create('customers', function($table)
		{
			$table->increments('id');
			$table->char('ocr', 7)->unique();
			$table->integer('assignment_id')->unsigned();
			$table->decimal('price', 6, 2)->unsigned();
			$table->date('invoice_date');
			$table->decimal('discount', 6, 2)->unsigned()->nullable();
			$table->date('reminder_invoice_date')->nullable();
			$table->date('requirement_invoice_date')->nullable();
			$table->text('comment')->nullable();
			$table->timestamps();

			$table->foreign('assignment_id')->references('id')->on('assignments');
		});

		// Modules
		Schema::create('modules', function($table)
		{
			$table->increments('id');
			$table->string('title', 40);
			$table->decimal('price', 6, 2)->unsigned();
			$table->text('description')->nullable();
			$table->timestamps();
		});

		// Package Modules
		Schema::create('package_modules', function($table)
		{
			$table->increments('id');
			$table->integer('package_id')->unsigned();
			$table->integer('module_id')->unsigned();
			$table->decimal('price', 6, 2)->unsigned();
			$table->integer('position')->unsigned()->default(0);
			$table->timestamps();

			$table->foreign('package_id')->references('id')->on('packages');
			$table->foreign('module_id')->references('id')->on('modules');
		});

		// Customer Modules
		Schema::create('customer_modules', function($table)
		{
			$table->increments('id');
			$table->integer('customer_id')->unsigned();
			$table->integer('module_id')->unsigned();
			$table->decimal('price', 6, 2)->unsigned();
			$table->enum('returned', array('yes', 'no'))->default('no');
			$table->timestamps();

			$table->foreign('customer_id')->references('id')->on('customers');
			$table->foreign('module_id')->references('id')->on('modules');
		});

		// Payments
		Schema::create('payments', function($table)
		{
			$table->increments('id');
			$table->integer('customer_id')->unsigned();
			$table->dateTime('time');
			$table->decimal('sum', 6, 2)->unsigned();
			$table->timestamps();

			$table->foreign('customer_id')->references('id')->on('customers');
		});
	}

	public function down()
	{
		Schema::drop('payments');
		Schema::drop('customer_modules');
		Schema::drop('package_modules');
		Schema::drop('modules');
		Schema::drop('customers');
		Schema::drop('assignments');
		Schema::drop('packages');
		Schema::drop('users');
	}
}