<?php


// Dashboard route

// Public route group
// Add web as default middleware
Route::group(['prefix' => '', 'middleware' => ['web', 'csrf'], 'namespace' => 'FlexCMS\BasicCMS\Api'], function()
{

    Route::get('/dashboard', ['middleware' => ['auth'], 'as' => 'dashboard', 'uses' => function () {
        return view('flexcms::dashboard.index');
    }]);

    Route::get('/dashboard/login', ['middleware' => ['guest'], 'as' => 'login', 'uses' => function () {
        return view('flexcms::dashboard.login');
    }]);

    Route::get('/dashboard/browse-media', function () {
        return view('flexcms::dashboard.browse-media');
    });
    Route::post('/dashboard/login', ['uses' => 'Auth\AuthController@login']);
    Route::get('/dashboard/signout', ['middleware' => ['api.auth'], 'uses' => 'Auth\AuthController@getLogout']);
    Route::get('/dashboard/api/signout', ['uses' => 'Auth\AuthController@getApiLogout']);

    Route::get('/partials/{name}', function ($name) {
        return view('flexcms::pages.' . $name);
    });

    // Route::get('/templates/{name}', function ($name) {
    //     return view('flexcms::dashboard.templates.' . $name);
    // });

});


// @inuse in this dashboard version
// Public auth route group
Route::group(['prefix' => 'api/v1', 'namespace' => 'FlexCMS\BasicCMS\Api\Auth', 'middleware' => ['cors']], function()
{
    Route::post('/login', ['uses' => 'AuthController@apiLogin']);

});
// Test route
Route::group(['prefix' => 'api/v1', 'namespace' => 'FlexCMS\BasicCMS\Api'], function()
{
    Route::get('/sites', 'SiteController@index');

    Route::get('articles', 'ArticleController@index');
    Route::get('articles/{id}', 'ArticleController@show');

    Route::get('/directories/categories', 'DirectoryController@indexByCategory');
    Route::get('directories', 'DirectoryController@index');
    Route::get('directories/{id}', 'DirectoryController@show');

    Route::get('items', 'ItemController@index');
    Route::get('items/{id}', 'ItemController@show');
    Route::get('/media/{id}', 'MediaController@show');
    Route::get('/media', 'MediaController@index');

});



Route::group(['prefix' => 'api/v1', 'namespace' => 'FlexCMS\BasicCMS\Api', 'middleware' => ['web', 'cors']], function()
{
    Route::get('/sites/pages', 'SiteController@availablePages');

    Route::get('articles', 'ArticleController@index');
    Route::get('articles/{id}', 'ArticleController@show');

    Route::get('/directories/categories', 'DirectoryController@indexByCategory');
    Route::get('directories', 'DirectoryController@index');
    Route::get('directories/{id}', 'DirectoryController@show');

    Route::get('items', 'ItemController@index');
    Route::get('items/{id}', 'ItemController@show');
    Route::get('/media/{id}', 'MediaController@show');
    Route::get('/media', 'MediaController@index');

});


// Private route group
Route::group(['prefix' => 'api/v1', 'namespace' => 'FlexCMS\BasicCMS\Api', 'middleware' => ['web', 'auth', 'cors']], function()
{
    Route::post('/sites/pages', 'SiteController@createPage');
    Route::put('/sites/pages/{pageName}', 'SiteController@updatePage');

    Route::resource('articles', 'ArticleController', ['except' => ['show', 'index']]);
    Route::post('articles/{id}/locale/{language}', 'ArticleController@locale');
    Route::post('articles/{id}/publish', 'ArticleController@publish');
    Route::post('articles/{id}/schedule', 'ArticleController@schedule');
    Route::post('articles/{id}/drop-to-draft', 'ArticleController@pullAsDraft');

    Route::resource('directories', 'DirectoryController', ['except' => ['show', 'index']]);

    Route::resource('collections', 'CollectionController', ['except' => ['create', 'edit']]);

    Route::resource('messages', 'MessageController', ['except' => ['create', 'edit', 'update']]);
    Route::post('/messages/{id}/seen', 'MessageController@updateSeen');
    Route::post('/messages/{id}/read', 'MessageController@updateRead');

    Route::resource('items', 'ItemController', ['except' => ['show', 'index']]);
    Route::post('/items/{id}/locale', 'ItemController@locale');

    Route::post('/media', 'MediaController@store');
    Route::post('/media/editor', 'MediaController@storeFromEditor');
    Route::post('/media/link', 'MediaController@storeLink');
    // Route::get('/media/{id}', 'MediaController@show');
    Route::put('/media/{id}', 'MediaController@update');
    Route::delete('/media/{id}', 'MediaController@destroy');
    Route::post('/media/{id}/best-video', 'MediaController@setBestVideo');
    Route::delete('/media/{id}/best-video', 'MediaController@unSetBestVideo');
    // Route::get('/media', 'MediaController@index');

    // Product detail

    Route::get('products/{id}/', 'Custom\ProductController@show');

});


// // Public route group with app Id
// Route::group(['prefix' => 'api/v1', 'namespace' => 'Api', 'middleware' => ['app.auth', 'cors']], function()
// {
//     Route::get('/subscriptions/email-check', 'SubscriptionController@checkEmail');
//     Route::post('/subscriptions', 'SubscriptionController@store');

// });
