<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetCommand extends Command
{
	protected $name = 'user:reset';

	protected $description = 'Reset data';

	public function fire()
	{
		$this->info('Delete database tables...');

		$result_tables = \DB::select('SHOW TABLES');

		$tables = array();

		foreach ( $result_tables as $table )
		{
			$tables[] = $table->Tables_in_mfadmin;
		}

		if ( count($tables) > 0 )
		{
			\DB::statement('SET foreign_key_checks = 0');
			\DB::statement('DROP TABLE IF EXISTS ' . implode(', ', $tables) . ';');
			\DB::statement('SET foreign_key_checks = 1');
		}

		$this->info('Run migration...');

		exec('sudo php artisan migrate');
		exec('sudo php artisan db:seed');

		// Import old database data
		$this->info('Import old database data...');

		$old_db_files = ['assignments', 'customer_modules', 'customers', 'modules', 'package_modules', 'packages', 'payments'];

		foreach ( $old_db_files as $old_db_file )
		{
			$filename = $old_db_file . '.sql';

			$this->info('Import ' . $filename . '...');

			$old_raw_sql = file_get_contents(base_path('resources/database/' . $filename));

			\DB::connection()->getPdo()->exec($old_raw_sql);
		}

		$this->info('Reset complete.');
	}
}