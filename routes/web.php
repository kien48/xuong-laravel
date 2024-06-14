<?php
use App\Http\Controllers\Admin\CatelogueController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    $products = \App\Models\Product::query()->latest('id')->limit(4)->get();

    return view('welcome', compact('products'));
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('product/{slug}', [App\Http\Controllers\ProductController::class, 'detail'])->name('product.detail');

// Mua bán hàng
Route::get('cart/list', [CartController::class, 'list'])->name('cart.list');
Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('order/save', [OrderController::class, 'save'])->name('order.save');


Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth', 'isAdmin'])
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::prefix('catelogues')
            ->as('catelogues.')
            ->group(function () {
                Route::get('/',                 [CatalogueController::class, 'index'])->name('index');
                Route::get('create',            [CatalogueController::class, 'create'])->name('create');
                Route::post('store',            [CatalogueController::class, 'store'])->name('store');
                Route::get('show/{id}',         [CatalogueController::class, 'show'])->name('show');
                Route::get('{id}/edit',         [CatalogueController::class, 'edit'])->name('edit');
                Route::put('{id}/update',       [CatalogueController::class, 'update'])->name('update');
                Route::get('{id}/destroy',      [CatalogueController::class, 'destroy'])->name('destroy');
            });

        Route::resource('products', ProductController::class);
    });

