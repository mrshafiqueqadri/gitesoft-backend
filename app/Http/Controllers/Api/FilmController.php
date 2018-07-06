<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\{Film, FilmComment, FilmRating, Country, Genre};

use Auth, Lang;

class FilmController extends Controller
{
    protected $film_description = ['comments', 'comments.user', 'ratings', 'country', 'genre'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Film::with($this->film_description)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'release_date' => 'required',
            'description' => 'required',
            'country_id' => 'required',
            'genre_id' => 'required',
            'photo' => 'required',
        ]);
        $request['slug'] = str_slug($request->name);

        Film::create($request->all());
        return response()->json([
            'success' => 200,
            'message' => Lang::get('messages.film.created_successfully')
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Film::whereSlug($id)->with($this->film_description)->first();
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request, $id)
    {
        $request->validate([
            'body' => 'required'
        ]);
        $comment = new FilmComment(['user_id' => Auth::id(), 'body' => request('body')]);

        $film = Film::find($id);

        $film->comments()->save($comment);


        return response()->json([
            'success' => 200,
            'message' => Lang::get('messages.comment.thank_you')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rating($id)
    {
        $rating = request('rating');

        $check = FilmRating::whereUserId(Auth::id())->whereFilmId($id)->first();

        if ($check){
            $check->rating = $rating;
            $check->save();
        } else {
            FilmRating::create(['film_id' => $id, 'user_id' => Auth::id(), 'rating' => $rating]);
        }

        return response()->json([
            'success' => 200,
            'message' => Lang::get('messages.rating.thank_you')
        ], 200);
    }


    public function prerequisite()
    {
        return response()->json(['countries' => Country::all(), 'genres' => Genre::all()], 200);
    }

    
    /**
     * @param Request $request
     * @return string
     */
    public function fileUpload(Request $request)
    {
        if($request->file('file'))
        {
            $image = $request->file('file');
            $name = time().".".$image->getClientOriginalExtension();
            $image->move(storage_path('app/public/films/'), $name);
            return $name;
        }
        return array('url' =>'default.png');
    }
}
