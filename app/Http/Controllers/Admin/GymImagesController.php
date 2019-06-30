<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Gym;

class GymImagesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gym_images_store_error = false;

        if (session('gym_images_store_error')) {
            session()->forget('gym_images_store_error');
            $gym_images_store_error = true;
        }
        $gym_images = current_user()->gym->gym_images;
        return view('admin.gym-images.index', compact('gym_images', 'gym_images_store_error'));
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
        $validator = Validator::make($request->all(), [
            'images' => 'required|array',
            'images.*' => 'file|image'
        ]);
        if ($validator->fails()) {
            session(['gym_images_store_error' => true]);
            return response()->json($validator->errors(), 400);
        }
        $gym = current_user()->gym;
        $images = [];
        foreach ($request->images as $image) {
            $path = $image->store('public/gym-images');
            $prefix = 'public/';
            if (substr($path, 0, strlen($prefix)) == $prefix) {
                $path = substr($path, strlen($prefix));
            }
            $images[] = [
                "type" => $image->getMimeType(),
                "path" => $path,
            ];
        }
        $gym->gym_images()->createMany($images);
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " uploaded new photos for Gym (GYM ID#" . $gym->id . ")");
        session()->flash('message-success', 'Gym images uploaded!');
        return response()->json([], 200);
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
