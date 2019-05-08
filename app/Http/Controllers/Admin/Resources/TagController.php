<?php

namespace App\Http\Controllers\Admin\Resources;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Resources\ResourceController;

class TagController extends ResourceController
{
    public function index (Request $request)
    {
        $tags = Tag::all();

        return $this->showAll($tags);
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
            'name' => 'required|max:180'
        ];

        $this->validate($request, $rules);

        $data         = $request->all();
        $data['slug'] = str_slug($data['name']);

        $tag = Tag::create($data);

        return $this->showOne($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $rules = [
            'name' => 'max:180',
        ];

        $this->validate($request, $rules);

        $tag->fill($request->only([
            'description',
        ]));

        if ($request->has('name')) {
            $tag->name = $request->name;
            $tag->slug = str_slug($tag->name);
        }

        $tag->save();

        return $this->showOne($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $category->delete();

        return $this->showOne($tag);
    }
}
