<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LibrosS extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('libros')->insert([
            'titulo'=>'La Cartera',
            'numEjemplares'=>10
        ]);
        DB::table('libros')->insert([
            'titulo'=>'Redes',
            'numEjemplares'=>15
        ]);
        DB::table('libros')->insert([
            'titulo'=>'La Asistenta',
            'numEjemplares'=>5
        ]);
        DB::table('libros')->insert([
            'titulo'=>'Actos Humanos',
            'numEjemplares'=>2
        ]);
    }
}
