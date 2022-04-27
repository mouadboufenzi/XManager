<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;

class articleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $categories = Categorie::all();
        $articles = Article::all();
        if ($id != null) {
            $that_article = Article::findOrFail($id);
            return view('articles', ['articles' => $articles, 'categories' => $categories, 'that_article' => $that_article, 'id' => $id]);
        }
        return view('articles', ['articles' => $articles, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = new Article();
        try {
            $article->categorie = request('categorie');
            $article->code = request('code');
            $article->designation = request('designation');
            $article->status = request('status');
            $article->pv = request('pv');
            $article->pa = request('pa');
            $article->uv = request('uv');
            $article->ua = request('ua');

            $article->save();
            return redirect('/articles')->with('msg', "Added !");
        } catch (\Throwable $th) {
            return redirect('/articles')->with('msg', "One of these fields is empty !");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $newData = $request->all();
        $article = Article::findOrFail($id);
        $article->categorie = $newData['categorie'];
        $article->code = $newData['code'];
        $article->designation = $newData['designation'];
        $article->status = $newData['status'];
        $article->pv = $newData['pv'];
        $article->pa = $newData['pa'];
        $article->uv = $newData['uv'];
        $article->ua = $newData['ua'];

        $article->save();
        return redirect('/articles');
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
