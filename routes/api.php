 <?php

 use App\Http\Controllers\Api\V1\TaskController;
 use App\Http\Controllers\Api\V1\UserController;
 use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

 Route::prefix('v1')->middleware(['throttle:api'])->group(function () {
     Route::post('register', [\App\Http\Controllers\Api\V1\AuthController::class, 'register']);
     Route::post('login', [\App\Http\Controllers\Api\V1\AuthController::class, 'login']);
 });

 Route::prefix('v1')->middleware(['throttle:api', 'auth:sanctum'])->group(function () {
 //Route::prefix('v1')->middleware(['throttle:api'])->group(function () {
     Route::apiResource('tasks', TaskController::class);
     Route::apiResource('users', UserController::class);
     Route::get('logout', [\App\Http\Controllers\Api\V1\AuthController::class, 'logout']);

     Route::get('filter-sorting', [ \App\Http\Controllers\Api\V1\FilterSortingController::class,'index']);
     Route::get('tree-api', [ \App\Http\Controllers\Api\V1\TaskTreeController::class,'index']);
 });

 Route::fallback(function () {
     // ...
     return 'You should use right url for request.' ;
 });
