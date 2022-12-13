<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::select('name', 'description', 'type')->paginate(10);
        // return Post::all([
        //     'Name',
        //     'Description',
        //     'Type'
        // ]);
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

            $images = new Post();
            $request->validate([
                "name" => "required|max:50",
                "description" => "required|max:250",
                "image" => "required|max:5048",
                "type" => "required|digits_between:1,3"
            ]);

            $imageName ="";
            if ($request->hasFile('image')) {
                $imageName = $request->file('image')->store('private');
                $images->image=$imageName;
            $result = $images->save();

            if ($result) {
                //create post
                Post::create($request->validated([
                    'name' => $request['name'],
                    'description' => $request['description'],
                    'image' => $request['image'],
                    'type' => $request['type'],
            ]));

            return Post::select('name', 'description', 'type');
            }
            } else {
                return false;
            }

        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $url = Storage::temporaryUrl('private', now()->addMinutes(10));
        return Post::select([
            'name',
            'type',
            'description',
            $url['image']
            ])->find($post['id']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
