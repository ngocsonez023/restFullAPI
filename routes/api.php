<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// http://localhost/restFullAPI/public/rest-api/hello-world
Route::get('/hello-world', function(Request $request){
    return response()->json('Hello World! Welcome to codingpearls.com', 200);
});
// param option on link
Route::get('/hello/{age?}', function(Request $request, $age = ''){
    $string = '';
    if($age == null){
        $string = 'you are teenager';
    }else{
        $string = 'you are adult';
    }
    return response()->json($string, 200);
});
// json
// việc chuyển từ Array sang JSON và ngược lại sử dụng 2 cái hàm: json_encode() và json_decode() 
Route::get('/books', function(Request $request){
    $entries = [
        'books' => [
            [
                "isbn" => "9781593275846",
                "title" => "Eloquent JavaScript, Second Edition",
                "author" => "Marijn Haverbeke"      
            ],
            [
                "isbn" => "9781449331818",
                "title" => "Learning JavaScript Design Patterns",
                "author" => "Addy Osmani"
            ],
            [
                "isbn" => "9781449365035",
                "title" => "Speaking JavaScript",
                "author" => "Axel Rauschmayer",
            ],
            [
                "isbn" => "9781491950296",
                "title" => "Programming JavaScript Applications",
                "author" => "Eric Elliott"
            ]
        ]
    ];
    return response()->json($entries, 200);
});

Route::post('/addbooks', function(Request $request){
    
    $entries = [
        [
            "isbn" => "9781593275846",
            "title" => "Eloquent JavaScript, Second Edition",
            "author" => "Marijn Haverbeke"      
        ],
        [
            "isbn" => "9781449331818",
            "title" => "Learning JavaScript Design Patterns",
            "author" => "Addy Osmani"
        ]
    ];

    // Get book data from POST
    $book = [
        "isbn" => $request->input('isbn'),
        "title" => $request->input('title'),
        "author" => $request->input('author')
    ];

    // Append news book into current list.
    $entries[] = $book;
    // array_push($entries, $book);

    return response()->json($entries, 200);
});

// api with token
Route::post('auth/register', 'restFullAPIController@register');
Route::post('auth/login', 'restFullAPIController@login');
Route::post('auth/adminlogin', 'restFullAPIController@adminlogin');

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('user-info', 'restFullAPIController@getUserInfo');
});