<?php

use App\Http\Controllers\AutenticarController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\TesteController;
use App\Http\Middleware\LogAcessoMiddleware;
use App\Models\LogAcesso;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', [PrincipalController::class, 'principal'])->name('site.index');
Route::post('/', [PrincipalController::class, 'principal'])->name('site.index');
Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato')->middleware('log.acesso');
Route::post('/contato', [ContatoController::class, 'salvar'])->name('site.contato');
Route::get('/sobre-nos', [SobreNosController::class, 'sobrenos'])->name('site.sobrenos');
Route::get('/entrar/{erro?}', [LoginController::class, 'index'])->name('site.login');
Route::post('/entrar', [LoginController::class, 'autenticar'])->name('site.login');

Route::middleware('autenticacao:ldap,visitante,p3,p4')->prefix('/app')->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('app.home');    
    Route::get('/sair', [LoginController::class, 'sair'])->name('app.sair');    
    Route::get('/cliente', [ClienteController::class, 'index'])->name('app.cliente');    
    
    
    Route::get('/fornecedor', [FornecedorController::class, 'index'])->name('app.fornecedor');
    Route::post('/fornecedor/listar', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    
    
    
    Route::get('/produto', [ProdutoController::class, 'index'])->name('app.produto');
});


Route::get('/teste/{p1}/{p2}', [TesteController::class, 'teste'])->name('teste');

Route::fallback(function(){
    echo 'A rota acessada não existe, <a href="'.route('site.index').'">clique aqui</a> para ir para página inicial';
});

// metodo redirect do objeto Route
// Route::redirect('/rota2', '/rota1');

/* redirect usando a função de callback
Route::get('/rota1', function(){
    echo 'rota 1';
})->name('site.rota1');

Route::get('/rota2', function(){
    return redirect()->route('site.rota1');
})->name('site.rota2');
*/


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
