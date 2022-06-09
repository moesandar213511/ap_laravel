<?php

use App\Test;
use App\Container;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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
Route::get('/namedrouting', [HomeController::class,'testroot'])->name('root'); // for named routing

//========================================================================================

// Service provider & container test example

// Route::get('/', function(){
//     $container = new Container();
//     $container->bind("test",function(){ // insert services into container class = bind(service key)လုပ်တယ်။
//         return new Test();
//     });
//     $test = $container->resolve("test"); //to output service in container use resolve() in laravel
//     dd($test->smth());
// });

//========================================================================================

//laravel real Service provider & container

// Route::get('/', function(){
//     //app(); // laravel container တစ်ခုလုံးကို access လုပ်။

//     app()->bind("test",function(){ // bind or singleton
//         return new Test("Moe Sandar");
//     });

//     $test = resolve("test");
//     // laravel container ထဲမှာ ရှိနေတာမို့ resolve() တန်းခေါ်လို့ရ။
//     // resolve() works with 2 steps။
//     // 1 step => resolve() ထဲမှာ pass လုပ်လိုက်တဲ့ parameter( test service key or App\Test::class ) က bind လုပ်တဲ့အထဲမှာ ရှိလား စစ်။ မရှိရင်
//     // 2 step => parameter က class instance ကိုယ်တိုင်(App\Test::class)ဖြစ်နေမလား စစ်။
//     dd($test);
// });

// *****************************************************

// Route::get('/', function(){

//     app()->bind("test",function(){ // bind or singleton
//         return new Test();
//     });

//     dd(resolve("test"), resolve("test"));
//     // bind method ကိုသုံးမယ်ဆိုရင် resolve လုပ်မဲ့ အခေါက်တိုင်းမှာ မတူညီတဲ့ class instance ကို return ပြန်ပေးတယ်
//     // singleton method ကိုသုံးမယ်ဆိုရင် resolve လုပ်မဲ့ အခေါက်တိုင်းမှာ တူညီတဲ့ class instance ကို return ပြန်ပေးတယ်
// });

// ****************************************************

// Route::get('/', function(){
//     //app(); // laravel container တစ်ခုလုံးကို access လုပ်။

//     // app()->bind(App\Test::class,function(){ // bind or singleton
//     //     return new Test("Moe Sandar");
//     // });

//     $test = resolve(App\Test::class);
//     dd($test);
// });

//================================================================================

// app>Providers>AppServiceProvider.php ရဲ့ register() ထဲမှာ bind လုပ်ထားတာကို resolve လုပ်။

// Route::get('/', function(){
//     dd(resolve("test"));
// });

// Route::get('/', function(Test $test){
//     dd($test);
// });



//================================================================================

// create sevice provider manually and insert services into container

Route::get('/', function(){
    return View::make("welcome"); // direct make method using View class
    // return view("welcome"); // view() => facades accessor ကိုသုံးထားတာ/ service provider ထဲမှာ bind လုပ်ထားတဲ့ key။

    // dd(resolve('view')); // view key နဲ့ bind လုပ်ထားတဲ့ services တွေကို တွေ့ရ။

    return Request::input('name'); // direct call method using Request class
    // return request('name'); // request() => facades accessor ကိုသုံးထားတာ/ service provider ထဲမှာ bind လုပ်ထားတဲ့ key။

    dd(resolve('request')); // request key နဲ့ bind လုပ်ထားတဲ့ services တွေကို တွေ့ရ။


});

//=================================================================================

Route::resource('posts', HomeController::class)->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
]);
// Route::get('/', [HomeController::class, 'index']);
// Route::get('/about', [HomeController::class, 'about']);
// Route::get('/contact', [HomeController::class, 'contact']);


// Route::get('contact/{name}',function($name){
//     // $data = request('name');
//     return view('contact',['contact'=>$name]);
// });

Route::get('/logout',[AuthController::class,'logout']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/posts', [HomeController::class, 'index']);
});
