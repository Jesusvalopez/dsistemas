<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('articulos/show/all', [
    'uses' => 'ArticlesController@all',
    'as' => 'articles.show.all'
]);



Route::get('/', 'WelcomeController@index');
Route::get('/load', 'WelcomeController@listing');


 Route::post('/contact', [
    'uses' => 'MessagesController@store',
    'as' => 'messages.store'
]);


Route::get('/contact', ['as' => 'contact', function () {
     $categories = App\Category::all();
   
    return view('contact')->with('categories', $categories);
}]);



/* ruta para mostrar un articulo */
Route::get('articulos/{category}/{slug}', [ 'as' => 'hombres.mostrarArticulo', function ($cat, $slug) {
     $categories = App\Category::all();
    
  
    $article = App\Article::where('slug', '=', $slug)->get();
    $article_id = $article[0]->id;
    $article = App\Article::find($article_id);
  
    return view('showArticle')->with('categories', $categories)->with('article', $article);
}]);


/* ruta para motrar los articulos de una categoria*/

Route::get('/articulos/{category}', function ($cat) {
     $categories = App\Category::all();
    
    foreach($categories as $category){
        
        if($category->name == $cat){
            
           $category_id = $category->id;
        }
    }    
    
  
    $articles = App\Article::where('category_id','=', $category_id)->orderBy('id','DESC')->get();
  
   /*  $categories = App\Category::all();*/
    return view('show')->with('categories', $categories)->with('articles', $articles);
});

Route::get('articulos/{category}/{slug}', [ 'as' => 'mostrar.articulo', function ($cat, $slug) {
     $categories = App\Category::all();
    
  
    $article = App\Article::where('slug', '=', $slug)->get();
    $article_id = $article[0]->id;
    $article = App\Article::find($article_id);
  
    return view('showArticle')->with('categories', $categories)->with('article', $article);
}]);


Route::get('/QuienesSomos', function () {
     $categories = App\Category::all();
    
    
    
  

    return view('whoweare')->with('categories', $categories);
});


Route::get('/download', 'FilesController@download');



Route::get('/descuentos', function () {
     $categories = App\Category::all();
    
    
    
  
    $articles = App\Article::where('ondiscount','=', 'yes')->orderBy('id','DESC')->get();
  
   /*  $categories = App\Category::all();*/
    return view('showoutlet')->with('categories', $categories)->with('articles', $articles);
});






Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    
    
    
    
     Route::get('/front/edit', [
    'uses' => 'FrontController@edit',
    'as' => 'admin.front.edit'
]);
     Route::put('/front/edit/{id}', [
    'uses' => 'FrontController@update',
    'as' => 'admin.front.update'
]);
    

      Route::get('/front/edit/mas', [
    'uses' => 'FrontController@mas',
    'as' => 'admin.front.mas'
]);
     Route::get('/front/edit/menos', [
    'uses' => 'FrontController@menos',
    'as' => 'admin.front.menos'
]);
    
    
    
    Route::get('/messages', [
    'uses' => 'MessagesController@index',
    'as' => 'admin.messages.index'
]);
    Route::get('/messages/show/{id}', [
    'uses' => 'MessagesController@show',
    'as' => 'admin.messages.show'
]);
    Route::get('/messages/destroy/{id}', [
    'uses' => 'MessagesController@destroy',
    'as' => 'admin.messages.destroy'
]);
    
    
    Route::get('/outlet', [
    'uses' => 'FrontController@outletindex',
    'as' => 'admin.outlet.index'
]);
    Route::get('/outlet/add/{id}', [
    'uses' => 'FrontController@add',
    'as' => 'admin.outlet.add'
]);
    
    
    Route::get('/outlet/show', [
    'uses' => 'FrontController@outletshow',
    'as' => 'admin.outlet.show'
]);
    
    Route::get('/outlet/sus/{id}', [
    'uses' => 'FrontController@sus',
    'as' => 'admin.outlet.sus'
]);
    
     Route::get('/clients', [
    'uses' => 'ClientsController@index',
    'as' => 'admin.clients.index'
]);
    
      Route::get('/clients/create', [
    'uses' => 'ClientsController@create',
    'as' => 'admin.clients.create'
]);
    
       Route::get('/clients/{id}', [
    'uses' => 'ClientsController@edit',
    'as' => 'admin.clients.edit'
]);
    
   
    Route::post('/clients/create', [
    'uses' => 'ClientsController@store',
    'as' => 'admin.clients.store'
]);
     Route::get('/clients/{id}/destroy', [
    'uses' => 'ClientsController@destroy',
    'as' => 'admin.clients.destroy'
]);
     Route::put('/clients/{id}/update', [
    'uses' => 'ClientsController@update',
    'as' => 'admin.clients.update'
]);
    
    
    
    Route::get('/', ['as' => 'admin.index', function () {
        $categories = App\Category::all();
        $unread = App\Message::where('read','=', 'no')->get();
        $unread = sizeof($unread);
        
        if($unread > 99){
            
            $unread = '+99';
        }
        
      
        $carousel = App\CarouselImage::find(1);
        
        return view('admin.index')->with('categories', $categories)->with('unread', $unread)->with('carousel', $carousel);
}]);
    
   Route::resource('users','UsersController');
Route::get('users/{id}/destroy', [
    'uses' => 'UsersController@destroy',
    'as' => 'admin.users.destroy'
]);
    
    Route::resource('categories', 'CategoriesController');
    Route::get('categories/{id}/destroy', [
    'uses' => 'CategoriesController@destroy',
    'as' => 'admin.categories.destroy'
]);
    

    
    
    
    
    
    
    
    
      Route::resource('articles', 'ArticlesController');
    Route::get('articles/{id}/destroy', [
    'uses' => 'ArticlesController@destroy',
    'as' => 'admin.articles.destroy'
]);
   /*  Route::get('articles/{id}/newItem', [
    'uses' => 'ArticlesController@newItem',
    'as' => 'admin.articles.newItem'
]);*/

    
    /*  inicio rutas sites  */ 
    
  
    
   /*  fin rutas states  */ 
    
 
    
});

 


    
Route::get('admin/auth/login',[
 'uses' => 'Auth\AuthController@getLogin',
 'as' => 'admin.auth.login'
]);
Route::post('admin/auth/login',[
 'uses' => 'Auth\AuthController@postLogin',
 'as' => 'admin.auth.login'
]);
Route::get('admin/auth/logout',[
 'uses' => 'Auth\AuthController@logout',
 'as' => 'admin.auth.logout'
]);
 




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
