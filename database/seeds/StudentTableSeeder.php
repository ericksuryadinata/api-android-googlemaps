<?php

use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('students')->truncate();
        $nbi = ['1461505271','1461505272','1461505273','1461505274','1461505275'];
        $name = ['Erick','Dariyanti','Fikroh','Wiwin','Rizkita'];
        $place_of_birth = ['Surabaya','Surabaya','Surabaya','Surabaya','Surabaya'];
        $date_of_birth = ['1995-02-01','1995-02-02','1995-02-03','1995-02-04','1995-02-05'];
        $phone = ['081234567890','081234567890','081234567890','081234567890','081234567890'];
        $address = ['Jalanin aja dulu, nomor terserah','Jalanin aja dulu, nomor terserah','Jalanin aja dulu, nomor terserah','Jalanin aja dulu, nomor terserah','Jalanin aja dulu, nomor terserah'];
        $latitude = ['-7.290689','-7.310185','-7.319549','-7.224533','-7.228961'];
        $longitude = ['112.714354','112.734944','112.769347','112.740708','112.773920'];
        for($i = 1; $i <= 5; $i++){
            \DB::table('students')->insert([
                'nbi' => $nbi[$i],
                'name' => $name[$i],
                'place_of_birth' => $place_of_birth[$i],
                'date_of_birth' => $date_of_birth[$i],
                'phone' => $phone[$i],
                'address' => $address[$i],
                'latitude' => $latitude[$i],
                'longitude' => $longitude[$i],
            ]);
        }
    }
}
