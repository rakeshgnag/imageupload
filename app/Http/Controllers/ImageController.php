<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Input;
use Storage;
use App\Tag;
use Session;
use Redirect;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
         return view('manage_images.index',[
            'images'=>Image::orderBy('id','desc')
                        ->paginate (env('APP_PAGINATE_PER_PAGE', 15)),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('manage_images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,[
            'title'=> 'required',
            'categories_array'=> 'required',
            'photo' =>'required|mimes:jpeg,jpg,png,JPG,PNG', 
        ]);


        $request['user_id'] = $request->user()->id;
        $request['slug'] = str_slug($request->title);

        if($request->photo) {

           $photo = $request->photo;
           $imagename = 'image_crop'.time().'.'.$photo->getClientOriginalExtension();
           $image = \Image::make($photo);
           $image = $image->crop(100, 100, 25, 25);
           $request['image_uri_cropped'] =  $imagename;
           $picture = (string) $image->encode();
           $local = Storage::disk('local')->put(env('CROPPED_IMAGE_PATH') . $imagename, $picture);

           $imagename2 = 'image_original'.time().'.'.$photo->getClientOriginalExtension();
           $image2 = \Image::make($photo);
           $request['image_uri_original'] =  $imagename2;
           $picture2 = (string) $image2->encode();
           $local = Storage::disk('local')->put(env('ORIGINAL_IMAGE_PATH') . $imagename2, $picture2);
           
        }
        
        $request['categories'] = implode(',', $request->categories_array);
        $image = Image::create($request->all());
      
        return redirect('/images');
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
