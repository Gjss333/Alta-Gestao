<?php

namespace Database\Seeders;

use App\Models\SiteContato;
use Database\Factories\SiteContatoFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        // $contato =  new SiteContato();
        // $contato->nome = 'Sistema SG';
        // $contato->telefone = '81995641517';
        // $contato->email = 'sistemaSG@email.com';
        // $contato->motivo_contato = 2;
        // $contato->mensagem = 'eu sou muito legal cara';
        // $contato->save();


        
        SiteContato::factory()->count(100)->create();
    }
}
