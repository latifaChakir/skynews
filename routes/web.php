<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\JwtAuthentication;
use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('user.dashboard');
});
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/profile', function () {
    return view('user.profile');
});



Route::get('/newsletters/search', [NewsletterController::class, 'search'])->name('newsletters.search');
Route::resource('newsletters', NewsletterController::class);

Route::resource('contacts', ContactController::class);
Route::resource('categories', CategoryController::class);
Route::post('/import-excel', [ContactController::class, 'import'])->name('import.excel');
Route::get('/export', [ContactController::class, 'export']);




Route::post('/getContacts', [CampaignsController::class, 'getContacts'])->name('getContacts');

Route::resource('Campaigns', CampaignsController::class);
// Route::get('send/email', function(){

// 	$send_mail = 'mbarekelaadraoui@gmail.com';

//     dispatch(new App\Jobs\SendEmailQueueJob($send_mail));

//     print_r('send mail successfully !!');
// });



Route::get('/', function () {
    return view('authentication.sign-in');
});
Route::get('/register', function () {
    return view('authentication.sign-up');
});

Route::get('/forgetpassword', [AuthController::class, 'forgetpassword']);
Route::Post('/sendforgetpaswword/email', [AuthController::class, 'sendResetPwd'])->name('password.sendforgetform');
Route::get('/resetform/{token}', [AuthController::class, 'rest']);
Route::post('/resetform', [AuthController::class, 'postrest'])->name('change.password');

// authentication with jwt.
Route::group([

    'middleware' => 'web',
    'prefix' => 'auth'

], function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register',  [AuthController::class, 'register']);
    Route::get('logout',  [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'infoUser']);
});


Route::middleware([JwtAuthentication::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    });
    Route::get('/welcome', function () {
        return view('welcome');
    });
    Route::get('/profile', function () {
        return view('user.profile');
    });
    Route::get('/campaigns', function () {
        return view('user.campaigns');
    });
    Route::get('/news', function () {
        return view('user.news');
    });
    Route::resource('contacts', ContactController::class);
    Route::resource('categories', CategoryController::class);
});
