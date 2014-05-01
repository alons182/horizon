<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		//$this->call('PropertiesTableSeeder');
		$this->call('SentrySeeder');
        $this->command->info('Sentry tables seeded!');
 
        //$this->call('PropertiesTableSeeder');
       // $this->command->info('Content tables seeded!');

		$this->call('CategoriesTableSeeder');
		$this->command->info('Categories tables seeded!');

		$this->call('PrequestsTableSeeder');
		$this->call('TestimonialsTableSeeder');
	}

}