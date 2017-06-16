<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	//return __METHOD__. 'one';
        $articles=\App\Article::latest()->paginate(3);
	
//	dd(view('articles',compact('articles'))->render());
	return view('articles',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	//return __METHOD__.'two';
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(Request $request)
    {
	$rules =[
                'title'=>['required'],
                'content'=>['required','min:10'],
        ];
	$messages=[
		'title.required' => 'title message',
		'content.required'=>'content message',
		'content.min'=>'content min',
	];
        $validator=\Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
                return back()->withErrors($validator)->withInput();
        }

        $article = \App\User::find(1)->articles()->create($request->all());
        
        if(! $article){
                return back()->with('flash_message','글이 저장되지않았습니다')->withInput();
        }

        return redirect(route('index'))->with('flash_message','글이 저장되었습니다');
    }*/

	public function store(\App\Http\Requests\ArticlesRequest $request){
		$article = \App\User::find(1)->articles()->create($request->all());

	if(! $article){
		return back()->with('flash_message','글이 저장되지않았습니다')->withInput();
	}
		return redirect(route('articles.index'))->with('flash_message','글이 저장되었습니다');
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
	
        $article= \App\Article::findOrFail($id);
	debug($article->toArray());
	return view('index',compact('article'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
