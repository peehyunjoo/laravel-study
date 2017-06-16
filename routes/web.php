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

/* Hyunjoo.... */
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use App\Exceptions\CustomException;
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
Route::resource('articles','ArticlesController');
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
	return redirect('protected2');
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


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/page',function(){
	$page=App\User::paginate(5);
	return view('page',compact('page'));
});
Route::get('/error',function(){
	return App\User::findOrFail(100);
});
Route::get('/custom',function(){
 $message = [
            'Success' => true,
            'Message' =>'success message'
        ];
 
        // 강제 예외 발생
        throw new CustomException('exception message');
 
        return response()->json($message);
});

Route::get('/authException',function(){
 $message = [
            'Success' => true,
            'Message' =>'success message_test'
        ];

        // 강제 예외 발생
        throw new AuthenticationException('exception Auth');

        return response()->json($message);
});
Route::get('auth', function () {
    $credentials = [
        'email'    => 'pizzu@gmail.com',
        'password' => 'vlguswn'
    ];

    if (! Auth::attempt($credentials)) {
        return 'Incorrect username and password combination';
    }

    Event::fire('user.login', [Auth::user()]);       //Auth::user()->config/auth.php

    var_dump('Event fired and continue to next line...');

    return;
});

Auth::routes();
Event::listen('user.login', function($user) {
	$user->last_login=(new DateTime)->format('Y-m-d H:i:s');
	return $user->save();
});

Route::post('posts', function(\Illuminate\Http\Request $request) {
    $rule = [
        'title' => ['required'], // == 'title' => 'required'
        'body' => ['required', 'min:10'] // == 'body' => 'required|min:10'
    ];

    $validator = Validator::make($request->all(), $rule);

    if ($validator->fails()) {
        return redirect('posts/create')->withErrors($validator)->withInput();
    }

    return 'Valid & proceed to next job ~';
});

Route::get('posts/create', function() {
    return view('post_create');
});

Route::get('/composer', function() {
    $text =<<<EOT
**Note** To make lists look nice, you can wrap items with hanging indents:

    -   Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
        Aliquam hendrerit mi posuere lectus. Vestibulum enim wisi,
        viverra nec, fringilla in, laoreet vitae, risus.
    -   Donec sit amet nisl. Aliquam semper ipsum sit amet velit.
        Suspendisse id sem consectetuer libero luctus adipiscing.
EOT;

    return app(ParsedownExtra::class)->text($text);
});
Route::get('markdown',function(){
	$text=<<<EOT
#markdown example 1
#HTML
#first
#second

EOT;
return app(ParsedownExtra::class)->text($text);
});
