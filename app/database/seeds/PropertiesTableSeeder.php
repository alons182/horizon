<?php

class PropertiesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('properties')->truncate();

		/*$properties = array(

		);*/

		// Uncomment the below to run the seeder
		// DB::table('properties')->insert($properties);

		DB::table('properties')->delete();
       

        Property::create(array(
            'code'   => 'A422',
            'type'   => 'house',
            'title'    => 'Casa Peter #2',
            'description'    => 'Linda casa de 2 habitaciones, sala, cocina, cochera para un vehículo, cuarto de pila y patio. Incluye cable en el precio.',
            'furniture'    => 0,
            'bedrooms'    => 2,
            'priced' => 320,
         	'pricec' => 250000,
          	'image' => 'images_properties/main.jpg',
           	'location' => 'Liberia',
            'city' => 'Liberia',
         	'area' => '250 mtrs',
          	'contact' => '2666666666',
            'publish' => 1,
	        ));
 
       

	}

}
