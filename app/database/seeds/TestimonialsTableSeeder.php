<?php

class TestimonialsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		 DB::table('testimonials')->truncate();

		 Testimonial::create(array(
            'name'   => 'Douglas Antonio Duran Diaz',
            'email'   => 'test@test.com',
            'comments'    => 'Muy bueno el servicio brindado por el señor Juan David Castro Angulo, muy confiable, seguro, paciente y amable, sin duda alguna fue uno de los mejores servicios que he tenido y la gran variedad que ofrecen es muy bueno. Gracias por la ayuda y paciensa.',
            'publish' => 1,
	        ));
 

		// Uncomment the below to run the seeder
		// DB::table('testimonials')->insert($testimonials);
	}

}
