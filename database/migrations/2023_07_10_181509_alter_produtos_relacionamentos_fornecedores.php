<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //criando a coluna em produtos que vai receber a FK de fornecedores
        Schema::table('produtos', function(Blueprint $table){

            $fornecedor_ID = DB::table('fornecedors')->insertGetId([
                'nome' => 'Fornecedor PADRÂO SG',
                'site' => 'padraofornecedor.com',
                'uf' => 'RO',
                'email' => 'contatofornecedorpadrao@gmail.com'
            ]);

            $table->unsignedBigInteger('fornecedor_id')->default($fornecedor_ID)->after('id');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function(Blueprint $table){
            $table->dropForeign('produtos_fornecedor_id_foreign');
            $table->dropColumn('fornecedor_id');

        });
    }
};
