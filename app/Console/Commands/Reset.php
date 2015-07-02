<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class Reset extends Command
{
    protected $signature = 'mfadmin:reset';

    protected $description = 'Reset MFAdmin.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $environment = \App::environment();

        $this->info('Delete database tables...');

		$result_tables = \DB::select('SHOW TABLES');

		$tables = array();

		$tables_in_database_str = 'Tables_in_' . config('database.connections.mysql.database');

		foreach ( $result_tables as $table )
		{
			$tables[] = $table->$tables_in_database_str;
		}

		if ( count($tables) > 0 )
		{
			\DB::statement('SET foreign_key_checks = 0');
			\DB::statement('DROP TABLE IF EXISTS ' . implode(', ', $tables) . ';');
			\DB::statement('SET foreign_key_checks = 1');
		}

		$this->info('Run migration...');

        \Artisan::call('migrate',
        [
            '--env=' . $environment
        ]);

        \Artisan::call('db:seed',
        [
            '--env=' . $environment
        ]);

		// Import old data
		$this->info('Import old data...');

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