<?php

use Illuminate\Database\Seeder;
use App\Ktp;

class KtpSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $jml_data = 50000;
        for ($i = 1; $i <= $jml_data; $i++) {
            $ktp = new Ktp();
            $ktp->nik = $faker->nik;
            $ktp->nama = $faker->name;
            $ktp->tempatlahir = $faker->city;
            $ktp->tanggallahir = $faker->date($format = 'Y-m-d', $max = 'now');
            $ktp->jekel = $faker->randomElement($array = array('0', '1'));
            $ktp->alamat = $faker->address;
            $ktp->agama = $faker->randomElement($array = array('0', '1', '2', '3', '4', '5'));
            $ktp->status = $faker->randomElement($array = array('0', '1'));
            //$ktp->foto = "sm-" . $faker->image($dir = 'public/foto', $width = 110, $height = 110);
            $ktp->save();
        }
    }
}
