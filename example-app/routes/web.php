<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/newlogin', [AuthManager::class, 'newlogin'])->name('newlogin');
Route::post('/newlogin', [AuthManager::class, 'newloginp'])->name('newloginp');

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [AuthManager::class, 'home'])->name('home');

Route::get('/login', [AuthManager::class, 'login'])->name('logi');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('loginPost');

Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registrationPost');

Route::post('/logout', [AuthManager::class, 'logout'])->name('logout');
Route::get('/back', [AuthManager::class, 'back'])->name('back');
Route::post('/delete', [AuthManager::class, 'delete'])->name('delete');

///////////////////////////////////

Route::get('/', function () {
    return view('newlogin');
});

// Route::post('/newlogin', [AuthManager::class, 'authenticate'])->name('newloginp');
////////////////////////for student login and adding//////////////////////////
Route::get('/newregistration', [AuthManager::class, 'newregistration'])->name('newregistration');
Route::post('/newregistration', [AuthManager::class, 'newregistrationp'])->name('newregistrationp');

//////////////////////for librarian loging and adding////////////////////////
Route::get('/newregistration2', [AuthManager::class, 'newregistration2'])->name('newregistration2');
Route::post('/newregistration2', [AuthManager::class, 'newregistration2p'])->name('newregistration2p');

Route::get('/newhome',[AuthManager::class, 'newhome'])->name('newhome');
Route::get('/viewprofile',[Authmanager::class, 'viewProfile'])->name('viewprofile');
Route::get('/getprofile/{user}',[Authmanager::class, 'getProfile'])->name('getprofile');
Route::put('/updateprofile/{user}', [AuthManager::class, 'updateProfile'])->name('updateprofile');

///////////////////students///////////////

Route::get('/newhome2',[AuthManager::class, 'newhome2'])->name('newhome2');

Route::get('/viewallstudent', [AuthManager::class, 'getStudents'])->name('viewallstudent');
Route::get('/viewstudent/{student}', [AuthManager::class, 'getStudent'])->name('viewstudent');
Route::put('/viewstudent/{student}', [AuthManager::class, 'updateStudent'])->name('updatestudent');
Route::delete('/viewstudent/{student}', [AuthManager::class, 'deleteStudent'])->name('deleteStudent');
Route::match(['get', 'post'],'/viewsearchstudent', [AuthManager::class, 'getSearchStudent'])->name('viewsearchstudent');
Route::get('/viewrequest', [AuthManager::class, 'viewRequest'])->name('viewrequest');

////////////////////books////////////////

Route::get('/viewallbookstd/{is_student}', [AuthManager::class, 'getBooks'])->name('viewallbookstd');
Route::get('/viewallbookadmn/{is_student}', [AuthManager::class, 'getBooks'])->name('viewallbookadmn');
Route::get('/viewstudentborrow/{student}', [AuthManager::class, 'getStudentBorrow'])->name('viewstudentborrow');
Route::get('/viewstudentrequest/{student}', [AuthManager::class, 'getStudentRequest'])->name('viewstudentrequest');
Route::get('/viewbook/{book}', [AuthManager::class, 'getBook'])->name('viewbook');
Route::get('/bookdescription/{book}', [AuthManager::class, 'getBookDescription'])->name('bookdescription');
Route::put('/viewbook/{book}', [AuthManager::class, 'updateBook'])->name('updatebook');
Route::get('/addbook', [AuthManager::class, 'addBook'])->name('addbook');
Route::post('/addbook', [AuthManager::class, 'addBookp'])->name('addbookp');
// Route::post('/viewsearchbookadv/{is_student}', [AuthManager::class, 'searchBookadv'])->name('viewsearchbookadv');
// Route::post('/viewsearchbook/{is_student}', [AuthManager::class, 'searchBook'])->name('viewsearchbook');
Route::match(['get', 'post'],'/viewsearchbookadv/{is_student}', [AuthManager::class, 'searchBookadv'])->name('viewsearchbookadv');
Route::match(['get', 'post'], '/viewsearchbook/{is_student}', [AuthManager::class, 'searchBook'])->name('viewsearchbook');
Route::delete('/deletebook/{book}', [AuthManager::class, 'deleteBook'])->name('deletebook');

Route::post('/requestBook/{book}', [AuthManager::class, 'requestBook'])->name('requestbook');
Route::post('/removeRequest/{book}', [AuthManager::class, 'removeRequest'])->name('removerequest');

///////////////////////////lent and return /////////////////
Route::post('/borrow/{book}', [AuthManager::class, 'borrow'])->name('lent');
Route::post('/return/{book}', [AuthManager::class, 'return'])->name('return');
   
});




//////////////////test////////////////////////
Route::get('/t',[AuthManager::class, 't'])->name('t');