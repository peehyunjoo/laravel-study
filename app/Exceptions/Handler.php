<?php

namespace App\Exceptions;

use Exception;
#use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
    	parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
	/*if(app()->environment('production')){
		if($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException){
			return response(view('errors.notice',[
				'title'=>'NOT FOUND',
				'description'=>'sorry'
			]),404);
		}
	}
        return parent::render($request, $exception);*/
	if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return response(view('errors.notice', [
                'title'       => 'Page Not Found',
                'description' => 'Sorry, the page or resource you are trying to view does not exist.'
            ]), 404);
        }
	if ($exception instanceof CustomException) {
        	return response()->json([
	            'Success' => false,
        	    'Message' => $exception->getMessage()
	        ], 500);	
    	}
	if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
		return response(view('errors.notice', [
                'title'       => 'Page Not Authentication',
                'description' => 'Sorry, Authentication'
            ]), 404);
        }
        return parent::render($request, $exception);
	
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
