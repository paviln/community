<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Game;
use App\Models\Server;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $games = Game::all();

        return view('admin.categories.create', compact('games'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        // validate
        $validated = $request->validated();

        $category = new Category([
            'name' => $validated['name'],
            'game_id' => $validated['game_id']
        ]);
        $category->save();
        return redirect('/admin/categories')->with('success', 'Category created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $games = Game::all();

        return view('admin.categories.edit', compact('category', 'games'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest  $request
     * @param  int  $id
     * @return void
     */
    public function update(CategoryRequest $request, $id)
    {
        // validate
        $validated = $request->validated();

        // process
        $category = Category::find($id);
        $category->name = $validated['name'];
        $category->game_id = $validated['game_id'];
        $category->save();

        return redirect('/admin/categories')->with('success', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Server  $server
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Server $server, $id)
    {
        if (!$server->where('category_id', $id)->count()) {
            $category = Category::find($id);
            $category->delete();

            return redirect('/admin/categories')->with('success', 'Category deleted!');
        } else {
            return redirect('/admin/categories')->with('error', 'The category is used!');
        }
    }
}
