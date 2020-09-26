<?php

// use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/admin/login', function () {
    return view('auth.login');
});
Route::prefix('dashboard')->group(function () {
    Route::get('/', 'Dashboard\DashboardController@index');
    Route::name('product.')->group(function () {
        Route::get('/product/edit/{product}', 'Dashboard\ProductController@edit')->name('edit');
        Route::get('/product/banned', 'Dashboard\ProductController@showBannedProduct')->name('banned');
        Route::get('/product/draft', 'Dashboard\ProductController@showDraftProduct')->name('draft');
        Route::put('/product/banned/{product}', 'Dashboard\ProductController@bannedProduct')->name('banned.edit');
        Route::put('/product/unbanned/{product}', 'Dashboard\ProductController@unBannedProduct')->name('unbanned.edit');
        Route::put('/product/publish/{product}', 'Dashboard\ProductController@publishProduct')->name('publish.edit');
        Route::put('/product/update/{product}', 'Dashboard\ProductController@update')->name('update');
        Route::delete('/product/img/delete/{img}', 'Dashboard\ProductController@deleteImg')->name('img.delete');
        Route::resource('/product', 'Dashboard\ProductController');
    });
    Route::name('member.')->group(function () {
        Route::put('/member/banned/{user}', 'Dashboard\UserController@bannedMember')->name('banned.edit');
        Route::put('/member/unbanned/{user}', 'Dashboard\UserController@unBannedMember')->name('unbanned.edit');
        Route::get('/member/banned', 'Dashboard\UserController@showBannedMember')->name('banned');
        Route::resource('/member', 'Dashboard\UserController');
    });
    Route::name('transaksi.')->group(function () {
        Route::get('/transaksi/user', 'Dashboard\TransactionController@getUserTransaction')->name('user');
        Route::delete('/transaksi/user/{transaction}', 'Dashboard\TransactionController@destroy')->name('delete');
        Route::put('/transaksi/user/receipt/{transaction}', 'Dashboard\TransactionController@updateReceipt')->name('user.editreceipt');
        Route::put('/transaksi/user/approve/{transaction}', 'Dashboard\TransactionController@approveTransaction')->name('user.approve');
        Route::put('/transaksi/user/unapprove/{transaction}', 'Dashboard\TransactionController@unApproveTransaction')->name('user.unapprove');
        Route::get('/transaksi/user/{transaction}', 'Dashboard\TransactionController@show')->name('user.detail');
        Route::get('/transaksi/user/{transaction}/print', 'Dashboard\TransactionController@printInvoice')->name('print');
        Route::get('/transaksi/tamu', 'Dashboard\TransactionController@getGuestTransaction')->name('guest');
        Route::delete('/transaksi/tamu/{transaction}', 'Dashboard\TransactionController@destroyGuestTrans')->name('guest.delete');
        Route::put('/transaksi/tamu/receipt/{transaction}', 'Dashboard\TransactionController@updateReceiptGuest')->name('guest.editreceipt');
        Route::put('/transaksi/tamu/approve/{transaction}', 'Dashboard\TransactionController@approveTransactionGuest')->name('guest.approve');
        Route::put('/transaksi/tamu/unapprove/{transaction}', 'Dashboard\TransactionController@unApproveTransactionGuest')->name('guest.unapprove');
        Route::get('/transaksi/tamu/{transaction}', 'Dashboard\TransactionController@showGuestTrans')->name('guest.detail');
        Route::get('/transaksi/tamu/{transaction}/print', 'Dashboard\TransactionController@printInvoice')->name('guest.print');
    });
    Route::name('pendapatan.')->group(function () {
        Route::get('/pendapatan', 'Dashboard\EarningController@index');
    });
    Route::name('tiket.')->group(function () {
        Route::get('/kategori-tiket', 'Dashboard\TicketController@getAllCategory')->name('kategori');
        Route::get('/tiket', 'Dashboard\TicketController@index')->name('tiket');
        Route::post('/tiket', 'Dashboard\TicketController@storeReply')->name('tiket.reply');
        Route::put('/tiket/{ticket}/pending', 'Dashboard\TicketController@updatePending')->name('tiket.pending');
        Route::put('/tiket/{ticket}/open', 'Dashboard\TicketController@updateOpen')->name('tiket.open');
        Route::put('/tiket/{ticket}/close', 'Dashboard\TicketController@updateClose')->name('tiket.close');
        Route::get('/tiket/{no_ticket}', 'Dashboard\TicketController@detailTicket')->name('tiket.detail');
        Route::delete('/tiket/{ticket}', 'Dashboard\TicketController@destroy')->name('tiket.destroy');
        Route::post('/kategori-tiket', 'Dashboard\TicketController@storeCategory')->name('kategori.store');
        Route::delete('/kategori-tiket/{categorie}', 'Dashboard\TicketController@destroyCategory')->name('kategori.destroy');
    });
    Route::name('pesanmasuk.')->group(function () {
        Route::get('/pesan-masuk', 'Dashboard\PesanMasukController@index')->name('all');
        Route::post('/pesan-masuk/detail/', 'Dashboard\PesanMasukController@store')->name('store');
        Route::get('/pesan-masuk/detail/{contact}', 'Dashboard\PesanMasukController@show')->name('detail');
        Route::delete('/pesan-masuk/{contact}', 'Dashboard\PesanMasukController@destroy')->name('destroy');
    });
    Route::name('bank.')->group(function () {
        Route::get('/bank', 'Dashboard\bankController@index')->name('all');
    });
    Route::name('kategori.')->group(function () {
        Route::get('/kategori', 'Dashboard\categoryController@index')->name('all');
        Route::post('/kategori', 'Dashboard\categoryController@store')->name('store');
        Route::put('/kategori/{category}', 'Dashboard\categoryController@update')->name('edit');
        Route::delete('/kategori/{category}', 'Dashboard\categoryController@destroy')->name('destroy');
    });
    Route::name('templateemail.')->group(function () {
        Route::get('/template-email', 'Dashboard\templateEmailController@index')->name('all');
        Route::get('/edit-template/{template}', 'Dashboard\templateEmailController@edit')->name('editPage');
        Route::put('/edit-template/{template}', 'Dashboard\templateEmailController@update')->name('edit');
    });
    Route::name('faq.')->group(function () {
        Route::get('/faq', 'Dashboard\pageController@getAllFaq')->name('all');
        Route::get('/faq/edit/{faq}', 'Dashboard\pageController@editFaqPage')->name('editPage');
        Route::put('/faq/edit/{faq}', 'Dashboard\pageController@editFaq')->name('edit');
        Route::delete('/faq/{faq}', 'Dashboard\pageController@deleteFaq')->name('destroy');
        Route::get('/faq/add', 'Dashboard\pageController@addFaqPage')->name('addPage');
        Route::post('/faq/add', 'Dashboard\pageController@addFaq')->name('add');
    });
    Route::name('about.')->group(function () {
        Route::get('/about', 'Dashboard\pageController@getAllAbout')->name('all');
        Route::delete('/about/{about}', 'Dashboard\pageController@deleteAbout')->name('destroy');
        Route::delete('/about/point/{value}', 'Dashboard\pageController@deletePoint')->name('destroyPoint');
        Route::get('/about/add', 'Dashboard\pageController@aboutAddPage')->name('addPage');
        Route::get('/about/addPointAbout', 'Dashboard\pageController@aboutPointAddPage')->name('addPointPage');
        Route::get('/about/edit/{about}', 'Dashboard\pageController@aboutEditPage')->name('editPage');
        Route::get('/about/edit/point/{value}', 'Dashboard\pageController@aboutPointEditPage')->name('editPointPage');
        Route::put('/about/edit/{about}', 'Dashboard\pageController@aboutEdit')->name('edit');
        Route::put('/about/edit/point/{value}', 'Dashboard\pageController@aboutPointEdit')->name('editPoint');
        Route::post('/about/add', 'Dashboard\pageController@aboutAdd')->name('add');
        Route::post('/about/addPointAbout', 'Dashboard\pageController@aboutPointAdd')->name('addPoint');
    });
    Route::name('help.')->group(function () {
        Route::get('/help', 'Dashboard\pageController@getAllHelp')->name('all');
        Route::get('/help/add', 'Dashboard\pageController@addHelpPage')->name('addPage');
        Route::get('/help/edit/{help}', 'Dashboard\pageController@editHelpPage')->name('editPage');
        Route::put('/help/edit/{help}', 'Dashboard\pageController@editHelp')->name('edit');
        Route::post('/help/add', 'Dashboard\pageController@addHelp')->name('add');
        Route::delete('/help/{help}', 'Dashboard\pageController@deleteHelp')->name('destroy');
    });
    Route::name('page.')->group(function () {
        Route::get('/page', 'Dashboard\pageController@getAllPage')->name('all');
        Route::get('/page/add', 'Dashboard\pageController@addPage')->name('addPage');
        Route::get('/page/edit/{page}', 'Dashboard\pageController@editPage')->name('editPage');
        Route::put('/page/edit/{page}', 'Dashboard\pageController@updatePage')->name('edit');
        Route::post('/page/add', 'Dashboard\pageController@storePage')->name('add');
        Route::delete('/page/{page}', 'Dashboard\pageController@deletePage')->name('destroy');
    });
    Route::name('slider.')->group(function () {
        Route::get('/slider', 'Dashboard\sliderController@index')->name('all');
        Route::put('/slider/{slider}', 'Dashboard\sliderController@update')->name('edit');
        Route::delete('/slider/{slider}', 'Dashboard\sliderController@destroy')->name('destroy');
        Route::post('/slider', 'Dashboard\sliderController@store')->name('add');
    });
    Route::name('manajemenadmin.')->group(function () {
        Route::get('/manajemen-admin', 'Dashboard\manajemenAdminController@index')->name('all');
        Route::get('/manajemen-admin/{id}', 'Dashboard\manajemenAdminController@show')->name('detail');
        Route::put('/manajemen-admin/{id}', 'Dashboard\manajemenAdminController@update')->name('update');
        Route::put('/manajemen-admin/pass/{user}', 'Dashboard\manajemenAdminController@updatePassword')->name('updatePass');
        Route::post('/manajemen-admin', 'Dashboard\manajemenAdminController@store')->name('add');
        Route::put('/manajemen-admin/ban/{user}', 'Dashboard\manajemenAdminController@bannedAdmin')->name('banned');
        Route::put('/manajemen-admin/unban/{user}', 'Dashboard\manajemenAdminController@unbannedAdmin')->name('unbanned');
    });
    Route::name('setting.')->group(function () {
        Route::get('/setting', 'Dashboard\settingController@index')->name('all');
        Route::get('/setting/set-address', 'Dashboard\settingController@getAddress')->name('address');
        Route::put('/setting/set-address/{id}', 'Dashboard\settingController@updateAddress')->name('address-update');
        Route::get('/setting/maps', 'Dashboard\settingController@getMaps')->name('maps');
        Route::get('/setting/other', 'Dashboard\settingController@getOther')->name('other');
        Route::put('/setting/other/{site}', 'Dashboard\settingController@editOther')->name('otherEdit');
        Route::put('/setting/maps/{site}', 'Dashboard\settingController@editMaps')->name('mapsEdit');
        Route::put('/setting/{site}', 'Dashboard\settingController@update')->name('update');
    });
    Route::name('alamat.')->group(function () {
        Route::get('/getKota/{id}', 'Dashboard\alamatController@getKota')->name('kota');
        Route::get('/getKecamatan/{id}', 'Dashboard\alamatController@getKecamatan')->name('kecamatan');
    });
    Route::name('qrcode.')->group(function () {
        Route::get('/qrcode/add', 'Dashboard\qrCodeController@create')->name('addView');
        Route::post('/qrcode/add', 'Dashboard\qrCodeController@store')->name('add');
        Route::get('/qrcode/daftar', 'Dashboard\qrCodeController@index')->name('daftar');
        Route::get('/qrcode/banned', 'Dashboard\qrCodeController@getBanned')->name('daftar-banned');
        Route::put('/qrcode/banned/{qr}', 'Dashboard\qrCodeController@banned')->name('banned');
        Route::put('/qrcode/active/{qr}', 'Dashboard\qrCodeController@active')->name('active');
        Route::delete('/qrcode/delete/{qr}', 'Dashboard\qrCodeController@destroy')->name('destroy');
    });
});
// Route::get('/dashboard', 'UserController@dashboard');

Auth::routes();
Route::get('/p/{product}', 'ProductController@show')->name('main.product.show');
Route::post('/p/comment/reply', 'ProductController@replyComment')->name('main.product.comment.reply');
