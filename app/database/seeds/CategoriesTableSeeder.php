<?php

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		 DB::table('categories')->truncate();

		Category::create(array(
            'name'   => 'Venta',
            'description'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elitla pariatur. ',
           
            'publish' => 1,
	        ));

		/*Category::create(array(
            'name'   => 'Venta',
            'description'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elitla pariatur. ',
           
            'publish' => 1,
	        ));*/
 

		// Uncomment the below to run the seeder
		// DB::table('categories')->insert($categories);
	}

}
