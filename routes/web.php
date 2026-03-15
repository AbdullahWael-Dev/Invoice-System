<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerReportController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceDetailsController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});


\Illuminate\Support\Facades\Auth::routes();
    Route::group(['middleware' => ['auth']], function() {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('sections', SectionController::class);
        Route::get('/section/{id}',[InvoiceController::class,'getProducts'])->name('section.getProducts');
        Route::resource('products', \App\Http\Controllers\ProductController::class);
        Route::resource('invoices', InvoiceController::class);
        Route::get('invoice/export/', [InvoiceController::class, 'export']);
        Route::resource('Archive', \App\Http\Controllers\InvoiceArchiveController::class);
        Route::get('Invoice_Paid',[InvoiceController::class,'Invoice_Paid'])->name('Invoice_Paid');
        Route::get('Invoice_UnPaid',[InvoiceController::class,'Invoice_UnPaid'])->name('Invoice_UnPaid');
        Route::get('Invoice_Partial',[InvoiceController::class,'Invoice_Partial'])->name('Invoice_Partial');
        Route::get('/status_show/{id}', [InvoiceController::class,'get_status'])->name('status_show');
        Route::post('/status_Update/{id}', [InvoiceController::class,'status_Update'])->name('status_Update');
        Route::resource('InvoiceAttachments', \App\Http\Controllers\InvoiceAttachmentsController::class);
        Route::get('/InvoiceDetails/{id}',[\App\Http\Controllers\InvoiceDetailsController::class,'edit']);
        Route::get('Print_invoice/{id}',[InvoiceController::class,'Print_invoice'])->name('Print_invoice');
        Route::get('download/{invoice_number}/{file_name}', [InvoiceDetailsController::class,'getfile']);
        Route::get('View_file/{invoice_number}/{file_name}', [InvoiceDetailsController::class,'open_file']);
        Route::post('delete_file', [InvoiceDetailsController::class,'destroy'])->name('delete_file');
        Route::resource('roles',\App\Http\Controllers\RoleController::class);
        Route::resource('users',UserController::class);
        Route::get('invoices_report',[\App\Http\Controllers\InvoiceReportController::class,'index'])->name('invoices_report');
        Route::post('search_invoices',[\App\Http\Controllers\InvoiceReportController::class,'search_invoices'])->name('search_invoices');
        Route::get('customers_report', [\App\Http\Controllers\CustomerReportController::class,'index'])->name("customers_report");
        Route::post('Search_customers', [CustomerReportController::class,'Search_customers'])->name("Search_customers");
    });

Route::get('/{page}', [AdminController::class,'index']);
