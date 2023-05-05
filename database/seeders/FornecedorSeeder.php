<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\DB;  


class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Instanciando um obejto
        //mais usado
        $fornecedor = new Fornecedor();
        $fornecedor->nome = 'Fornecedore 100';
        $fornecedor->site = 'forne.com.br';
        $fornecedor->uf = 'RJ';
        $fornecedor->email = 'forne@email.com.br';
        $fornecedor->save();

        //utilizando o metodo estático 
        //atenção ao atributo fillable
        //mais usado
        Fornecedor::create([
            'nome' => 'Adidas FO',
            'site' => 'Adidas.com.br',
            'uf' => 'PB',
            'email' => 'adidas@email.com'
        ]);

        //insert
        //created_at e update_at não será computado
        DB::table('fornecedors')->insert([
            'nome' => 'PUma',
            'site' => 'puma.com',
            'uf' => 'CE',
            'email' => 'puma@email.com'
        ]);

    }
}
