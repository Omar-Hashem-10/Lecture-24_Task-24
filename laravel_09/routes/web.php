<?php

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;

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
    return view('site.home.index');
})->name("home.index");

Route::get('/home', function () {
    return view('site.home.index');
})->name("home.index");

Route::get('/about', function () {
    return view('site.about.index');
})->name("about.index");

// Route::get('/contact', function () {
//     return view('site.contact.index');
// })->name("contact.index")->middleware('age:20');

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Route::get('/products/{product}/show', [ProductController::class, 'show'])->name('products.show');

Route::resource('products', ProductController::class);

Route::prefix('demo')->group(function() {
    Route::get('/redirect', function() {
        return redirect('contact');
    });

    Route::get('/back', function() {
        return redirect()->back();
    });

    Route::get('/named-route', function() {
        return redirect()->route('about.index');
    });

    Route::get('/away', function() {
        return redirect()->away('https://google.com');
    });

    Route::get('/json', function() {

        $products = [
            [
                'title'         => 'product 1',
                'description'   => 'this description for product number 1',
                'price'         => 200,
                'offer'         => 100
            ],
            [
                'title'         => 'product 2',
                'description'   => 'this description for product number 2',
                'price'         => 400,
                'offer'         => 300
            ],
            [
                'title'         => 'product 3',
                'description'   => 'this description for product number 3',
                'price'         => 500
            ]
            ];

        return response()->json($products);
    });

    Route::get('/download', function() {
        return response()->download(public_path('Untitled document.pdf'), 'unknown.pdf');
    });
});

Route::get('one-to-many', function() {

    // $category = Category::create([
    //     'name' => 'four',
    // ]);

    // # category_id with fillable

    // $product = Product::create([
    //     'title' => 'first product',
    //     'price' => 250,
    //     'description' => 'dafdsfdsfsdfdsfs',
    //     'category_id' => $category->id,
    // ]);

    //------------------------------------------

    // # category_id without fillable

    // $product = Product::make([
    //     'title' => 'third product',
    //     'price' => 250,
    //     'description' => 'dafdsfdsfsdfdsfs',
    // ]);

    // $category->products()->save($product);

    //------------------------------------------

    // # There is a problem here (2 product in run)

    //     $product = Product::make([
    //     'title' => 'fourth product',
    //     'price' => 250,
    //     'description' => 'dafdsfdsfsdfdsfs',
    // ]);

    // $product->category()->associate($category)->save();

    // dd('success');

    //------------------------------------------

    // # Print all products of this category

    // $category = Category::find(1);

    // foreach($category->products as $product)
    // {
    //     echo $product->title;
    //     echo "<hr>";
    // }

});

Route::get('many-to-many', function() {

    // attach
    // detach
    // sync
    // syncWithoutDetaching

    $order1 = Order::find(1);
    $order2 = Order::find(2);
    $order3 = Order::find(3);

    $product = Product::find(1);

    //=====================================================================
    // $product->orders()->attach($order1);
    // $product->orders()->attach([$order1->id, $order2->id, $order3->id]);
    //=====================================================================

    //=====================================
    // $product->orders()->detach($order1);
    //=====================================

    //======================================================
    // $product->orders()->sync([$order1->id, $order2->id]);
    //======================================================

    //===================================================================================
    // $product->orders()->syncWithoutDetaching([$order1->id, $order2->id, $order3->id]);
    //===================================================================================

    dd('success');
});

Route::get('/responses', function() {

    $products = [
        [
            'title'         => 'product 1',
            'description'   => 'this description for product number 1',
            'price'         => 200,
            'offer'         => 100
        ],
        [
            'title'         => 'product 2',
            'description'   => 'this description for product number 2',
            'price'         => 400,
            'offer'         => 300
        ],
        [
            'title'         => 'product 3',
            'description'   => 'this description for product number 3',
            'price'         => 500
        ]
        ];

        return response($products, 201)
        ->header('Content-Type', 'text/html')
        ->cookie('NAME', 'Omar', 60 * 60);
});



Route::get('send-mail', MailController::class);
