<?php

use App\Http\Controllers\api\v1\Match\MatchController;
use App\Http\Controllers\api\v1\Oauth\LoginController;
use App\Http\Controllers\api\v1\Oauth\RegisterController;
use App\Http\Controllers\api\v1\Stadium\StadiumController;
use App\Http\Controllers\api\v1\Team\TeamController;
use App\Notifications\api\v1\Match\CreateMatchNotification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware(['localization'])->group(function () {
    Route::middleware('guest')->group(function () {
        Route::post('oauth/login', [LoginController::class, 'login'])->name('auth.login');
        Route::post('oauth/register', [RegisterController::class, 'register'])->name('auth.register');
    });

    Route::middleware('auth:api')->group(function () {
        Route::apiResource('/team', TeamController::class);
        Route::apiResource('/stadium', StadiumController::class);
        Route::apiResource('/match', MatchController::class);
//        Route::controller(MatchController::class)->group(function () {
//            Route::get('match', 'post');
//            Route::get('match', 'post');
//        });
    });
});


Route::get('test', function () {
    $users = \App\Models\User::query()->get();
    Notification::send($users,new CreateMatchNotification());
//    $match = \App\Models\User::find(1);
//    dd($match->matches);
});
Route::get('location/search', function (\Illuminate\Http\Request $request) {
    $apiKey = env('GOOGLE_MAPS_API_KEY');
    $address = \App\Models\User::find(10)->addresses()->first();
    $latitude = 41.21782701971226;
    $longitude = 32.6489063395231;

    // Make a request to Google Places API Nearby Search
    $response = Http::get('https://maps.googleapis.com/maps/api/place/nearbysearch/json', [
        'key' => $apiKey,
        'location' => "$latitude,$longitude",
        'radius' => 5000, // Specify radius in meters
        'type' => 'stadium', // Filter by type 'stadium'
    ]);

    // Decode the JSON response
    $placesData = $response->json();

//    dd($placesData);
    // Extract relevant information from the response
    $stadiums = collect($placesData['results'])->map(function ($result) {
        return [
            'name' => $result['name'],
            'latitude' => $result['geometry']['location']['lat'],
            'longitude' => $result['geometry']['location']['lng'],
        ];
    });

    return response()->json($stadiums);
})->name('location.search');

Route::get('/autocomplete', function (\Illuminate\Http\Request $request) {
    $input = $request->get('input');
    $location = $request->get('location'); // Latitude,Longitude of the user's location
    $radius = 5000; // Radius in meters to search within

    $apiKey = env('GOOGLE_MAPS_API_KEY');
    $url = "https://maps.googleapis.com/maps/api/place/autocomplete/json?input=$input&key=$apiKey&location=$location&radius=$radius&type=stadium";

    $response = Http::get($url)->json();

    return response()->json($response);
});
