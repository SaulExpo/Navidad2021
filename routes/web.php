<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\CentroController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\MailController;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/alumnos/grafica', [AlumnoController::class, 'grafica'])->name('alumnos.grafica')->middleware('auth');
Route::get("alumnos/listado/{curso_id}",[AlumnoController::class, 'listado']);
Route::get("alumnos/pdf",[AlumnoController::class, 'listadoPdf'])->name("alumnos.pdf");
Route::resource('alumnos', 'App\Http\Controllers\AlumnoController')->middleware("auth");

Route::get('/examenes/grafica', [ExamenController::class, 'grafica'])->name('examenes.grafica')->middleware('auth');
Route::get("examenes/pdf",[ExamenController::class, 'listadoPdf'])->name("examenes.pdf");
Route::get("examenes/listado/{alumno_id}",[ExamenController::class, 'listado']);
Route::resource('examenes', 'App\Http\Controllers\ExamenController')->middleware("auth");

Route::get('/centros/grafica', [CentroController::class, 'grafica'])->name('centros.grafica')->middleware('auth');
Route::get("centros/pdf",[CentroController::class, 'listadoPdf'])->name("centros.pdf");
Route::resource('centros', 'App\Http\Controllers\CentroController')->middleware("auth");

Route::get('/cursos/grafica', [CursoController::class, 'grafica'])->name('cursos.grafica')->middleware('auth');
Route::get("cursos/pdf",[CursoController::class, 'listadoPdf'])->name("cursos.pdf");
Route::get("cursos/listado/{centro_id}",[CursoController::class, 'listado']);
Route::resource('cursos', 'App\Http\Controllers\CursoController')->middleware("auth");

Route::get('/profesores/grafica', [ProfesorController::class, 'grafica'])->name('profesores.grafica')->middleware('auth');
Route::get("profesores/pdf",[ProfesorController::class, 'listadoPdf'])->name("profesores.pdf");
Route::get("profesores/listado/{curso_id}",[ProfesorController::class, 'listado']);
Route::resource('profesores', 'App\Http\Controllers\ProfesorController')->middleware("auth");

Route::get('/send-email', [MailController::class, 'sendEmail']);

Route::get('/auth/github/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/github/callback', function () {
    $githubUser = Socialite::driver('github')->user();
	//Create
	$user = User::firstOrCreate(
		[
			'email' => $githubUser->getEmail(),
		],
		[
			'external_id' => $githubUser->getId(),
			'name' => $githubUser->getName(),
		]
	);
	// Log
	auth()->login($user, true);
	// redirect
	return view('dashboard');
    // $user->token
});

Route::get('/auth/facebook/redirect', function () {
    return Socialite::driver('facebook')->redirect();
});

Route::get('/auth/facebook/callback', function () {
    $facebookUser = Socialite::driver('facebook')->user();
	//Create
	$user = User::firstOrCreate(
		[
			'email' => $facebookUser->getEmail(),
		],
		[
			'external_id' => $facebookUser->getId(),
			'name' => $facebookUser->getName(),
		]
	);
	// $user = User::create([
	// 	'email' => $facebookUser->getEmail(),
	// 	'name' => $facebookUser->getName(),
	// 	'external_id' => $facebookUser->getId(),
	// ]);
	// Log
	auth()->login($user, true);
	// redirect
	return view('dashboard');
    // $user->token
});

Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();
	//Create
	$user = User::firstOrCreate(
		[
			'email' => $googleUser->getEmail(),
		],
		[
			'external_id' => $googleUser->getId(),
			'name' => $googleUser->getName(),
		]
	);
	// Log
	auth()->login($user, true);
	// redirect
	return view('dashboard');
    // $user->token
});

require __DIR__.'/auth.php';
