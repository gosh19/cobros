<?php

use Illuminate\Database\Seeder;
use App\Dato;


class DatosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i=0; $i <20 ; $i++) {
      Dato::create([
        'id' => $i,
        'nombre' => str_random(10),
        'dni' => random_int(20000000, 50000000),
        'mail' => str_random(6)."@gmail.com",
        'tarjeta' => random_int(40000000, 49999999).random_int(40000000, 49999999),
      ]);
    }

    }
}
