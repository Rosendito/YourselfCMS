<?php

namespace App\Http\Controllers\Admin\Resources;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Resources\ResourceController;

class CategoryController extends ResourceController
{
    public function index (Request $request)
    {
        $categories = Category::all();

        return $this->showAll($categories);
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
            'name'        => 'required|max:180',
            'description' => 'required|max:180'
        ];

        $this->validate($request, $rules);

        $data         = $request->all();
        $data['slug'] = str_slug($data['name']);

        $category = Category::create($data);

        return $this->showOne($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name'         => 'max:180',
            'description:' => 'max:180',
        ];

        $this->validate($request, $rules);

        $category->fill($request->only([
            'description',
        ]));

        if ($request->has('name')) {
            $category->name = $request->name;
            $category->slug = str_slug($category->name);
        }

        $category->save();

        return $this->showOne($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return $this->showOne($category);
    }
}
