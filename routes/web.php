<?php

use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/path', function(Request $request){
    return  $request->path();
    //renvoie le chemin de la page
});

Route::get('/url', function(Request $request){
    return  $request->url();
    //renvoie le chemin de la page
});

Route::get('/all', function(Request $request){

    return  $request->all();   
     //renvoie tout les paramettre
});



route::prefix('/blog')->name('blog.')->group(function(){



    Route::get('/', function(Request $request){


        // return $post;
        // $posts = \App\Models\Post::all(['id', 'title']);
        // $posts = \App\Models\Post::findOrFail(2);
        //   return \App\Models\Post::paginate(1,['id','title']);
        // $posts = \App\Models\Post::where('id','>',0)->get();
        // dd($posts);

        $return  = \App\Models\Post::paginate(25);

        // return [
        //     "name"=>$_GET['name'],
        //     //$_GET['name'] renvoie le paramettre mis dans l'url de la page mais error s'il n'y as pas
        //     "article"=> "article 1"
        // ];
    })->name('Main');


    Route::get('/delete', function(Request $request){
        $posts = \App\Models\Post::find(1);
        $posts->delete();
    })->name('Delete');

    Route::get('/add', function(Request $request){
        $post = new \App\Models\Post();
        $post->title = 'mon deuxieme article';
        $post->slug = 'mon deuxieme article';
        $post->content = 'mon deuxieme contenue ';
        $post->save();
    })->name('add');

    Route::get('/add-grouped', function(Request $request){
        $posts = \App\Models\Post::create([
            'title'=>'mon deuxieme Nouveau titre',
            'slug' => 'Deuxieme-titre-test',
            'content' => 'contenue',
        ]);
        return $posts;
    })->name('add-group');


    Route::get('/input', function(Request $request){
        return  $request->input('name',"john doe");
        //input renvoie le parametre attribué, mais ne renvoie pas d'erreur en cas d'absence, sont deuxieme param est l'elem par default
    })->name('index');



    Route::get('/{slug}-{id}', function (string $slug, string $id ,request $request){
        return [
            "slug"=>$slug,
            "id"=> $id,
            "name"=> $request->input(('name')),
            "link"=>\route('blog.show',['slug'=>'articles','id'=>'13'])
        ];
    //  http://127.0.0.1:8000/blog/mon-premier-articles-12


    })->where([
        'id' => '[0-9]+',
        'slug' => '[a-z0-9\-]+'
    ])->name('show');
        //http://127.0.0.1:8000/blog/mon-premier-articles-12
        //utilise des expression réguliere pour ajouté des contrainte a la route



});
