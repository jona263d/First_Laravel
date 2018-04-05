<?php


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

Route::get('/', 'DatabaseController@index')->middleware('auth');
Route::get('home', 'DatabaseController@index')->middleware('auth');

/*	function () {
$Content = DB::table('content')->get()->toArray();
    return view('welcome', compact('Content'));
})->middleware('auth');	
*/

//--------------- Projecten ------------------------//------------------------------------------------//

Route::get('project/{cid}', function ($id) {
    $cid = DB::table('content')->find($id);
    if($cid !== NULL)
    {
        return view('content', compact('cid'));
    }
    else{
        return abort(404, "Pagina niet gevonden");
    }
    
})->middleware('auth');	

Route::get('edit/{cid}', function ($id) {

    $cid = DB::table('content')->find($id);

    if(auth::user()->BedrijfsID===$cid->BedrijfsID || auth::user()->rank=="Admin" || auth::user()->rank=="Assessor")
        {
            return view('EditProject', compact('cid'));
        }
    else
        {
            return abort(401, "U kunt deze opdracht niet bewerken");
        }
})->middleware('auth')->name('EditProject');

Route::post('edit/{cid}', function ($id) {

    $cid = DB::table('content')->find($id);

    if(auth::user()->BedrijfsID===$cid->BedrijfsID || auth::user()->rank=="Admin" || auth::user()->rank=="Assessor")
        {
            return view('EditProject', compact('cid'));
        }
    else
        {
            return abort(401, "U kunt deze opdracht niet bewerken");
        }
})->middleware('auth');

Route::get('EigenOpdrachten', 'DatabaseController@EigenProjecten')->middleware('auth');


//-------------- Manage ---------------------------//------------------------------------------------//
Route::get('Manage', 'DatabaseController@Manage')->middleware('auth');
        
Route::post('delete', function () {
    if(auth::user()->rank == "Bedrijf" || auth::user()->rank=="Admin" || auth::user()->rank=="Assessor")
        {
            return view('delete');
        }
    else
        {
            return abort(401, "U kunt deze opdracht niet verwijderen");
        }
})->middleware('auth');

Route::get('Manage/{bid}', function ($id) {
    $cuid = DB::table('users')->find($id);
    if(auth::user()->rank=="Admin" || auth::user()->rank=="Assessor")
    {    
        return view('ManageUser', compact('cuid'));
    }
    else
    {
        return abort(401, "AUTHENTICATION ERROR");
    }
})->middleware('auth')->name('ManageUser'); 
Route::post('Manage/{bid}', function ($id) {
    $cuid = DB::table('users')->find($id);
    if(auth::user()->rank=="Admin" || auth::user()->rank=="Assessor")
    {    
        return view('ManageUser', compact('cuid'));
    }
    else
    {
        return abort(401, "AUTHENTICATION ERROR");
    }
})->middleware('auth'); 

//------------------------------------------------//------------------------------------------------//

//--------------- Tests --------------------------//------------------------------------------------//


Route::get('test', function () {

    return view('test');
})->middleware('auth'); 





//------------------------------------------------//------------------------------------------------//

//-------------- Settings ------------------------//------------------------------------------------//


Route::get('settings', function () {

    return view('settings');
})->middleware('auth')->name('settings');

Route::post('settings', function () {

    return view('settings');
})->middleware('auth');


//------------------------------------------------//------------------------------------------------//

//-------------- Make Assignment -----------------//------------------------------------------------//


Route::get('aanmaken', function () {

    return view('aanmaken', compact('uid', 'cid'));
})->middleware('auth')->name('aanmaken');	

Route::post('aanmaken', function () {

    return view('aanmaken', compact('uid', 'cid'));
})->middleware('auth'); 



//--------------- Register & Auth ----------------//------------------------------------------------//
// Registration Routes...
Route::get('RegCompany', 'Auth\CustomRegisterController@Custom_showRegistrationForm')->name('registerBedrijf');
Route::post('RegCompany', 'Auth\CustomRegisterController@Custom_register');

Route::get('RegDocent', 'Auth\CustomRegisterController@Custom_showDocentRegForm')->name('registerDocent');
Route::post('RegDocent', 'Auth\CustomRegisterController@Custom_registerDocent');

Auth::routes();

Route::get('Accounttype', 'CustomUserController@PRegister')->name('Accounttype');

