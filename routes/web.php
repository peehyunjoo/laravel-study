<?php
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
/*Route::get('/{foo?}', function ($foo='bar') {
	return $foo;    
});*/

/*Route::get('/', [
	'as' => 'home',
	function () {
    		return 'route name';
	}
]);

Route::get('/home',function(){
	return redirect(route('home'));
});*/

/*Route::get('/',function(){
	//$items = ['apple','banana','tomato'];
	//return view('welcome',['items'=>$items]);
	return view('welcome');
});*/
Route::get('/','WelcomeController@index');
//Route::resource('articles','ArticlesController');
Route::get('auth/login',function(){
	$credentials =[
		'email' => 'pizzu@gmail.com',
		'password' => 'vlguswn'
	];
	/*if(!auth()->attempt($credentials)){
		return 'login fail';
	}*/
	
	if(!Auth::attempt($credentials)){
		return 'login fail';
	} 
	return redirect('protected');
});

Route::get('protected',function(){
	dump(session()->all());
	//dump(Auth::user);
	if(!Auth::check()){
		return 'nuguseyo!!';
	}
	return 'Welcome '.auth()->user()->name;
});

Route::get('protected2', [
    'middleware' => 'auth',
    function () {
        return 'Welcome back, ' . Auth::user()->name;
    }
]);

Route::get('auth/logout',function(){
	auth()->logout();
	return 'see you again';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
