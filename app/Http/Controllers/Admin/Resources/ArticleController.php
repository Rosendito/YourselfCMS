<?php

namespace App\Http\Controllers\Admin\Resources;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Admin\Resources\ResourceController;
use Illuminate\Support\Facades\Storage;

class ArticleController extends ResourceController
{
    public function index (Request $request)
    {
        $articles = Article::all();

        return $this->showAll($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $rules = [
            'title'       => 'required|max:180|unique:articles',
            'status'      => 'in:' . Article::PUBLISHED . ',' . Article::DRAFT,
            'category_id' => 'integer',
        ];

        $this->validate($request, $rules);

        $data = $request->only([
            'title', 'description', 'status', 'body', 'category_id',
        ]);

        $data['user_id'] = $request->user()->id;
        $data['slug']    = str_slug($data['title']);

        if ($request->has('image_url')) {
            $data['image'] = $request->image_url;
        }

        if ($request->hasFile('image_file')) {
            $data['image'] = public_path($request->image_file->store(''));
        }

        if (!$request->has('description') || !$request->has('body') || !$request->has('category_id')) {
            $data['status'] = Article::DRAFT;
        }

        $article = Article::create($data);

        if ($request->has('tags_array')) {
            $tagsId = json_decode($request->tags_array);

            $article->tags()->syncWithoutDetaching($tagsId);
        }

        return $this->showOne($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $rules = [
            'title'       => [
                'max:180',
                Rule::unique('articles')->ignore($article->id)
            ],
            'status'      => 'in:' . Article::PUBLISHED . ',' . Article::DRAFT,
            'category_id' => 'integer',
        ];

        $this->validate($request, $rules);

        $article->fill($request->only([
            'description',
            'body',
            'status',
            'category_id',
        ]));

        if ($request->has('title')) {
            $article->title = $request->title;
            $article->slug  = str_slug($article->title);
        }

        if ($request->has('image_url')) {
            $article->image = $request->image_url;
        }

        if ($request->hasFile('image_file')) {
            Storage::delete($article->image);

            $article->image = $request->image_file->store('');
        }

        $article->save();

        if ($request->has('tags_array')) {
            $tagsId = json_decode($request->tags_array);

            $article->tags()->syncWithoutDetaching($tagsId);
        }

        return $this->showOne($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        Storage::delete($article->image);

        $article->delete();

        return $this->showOne($article);
    }
}
