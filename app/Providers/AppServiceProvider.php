<?php

namespace App\Providers;
use App\Models\Cart;
use Illuminate\Support\ServiceProvider;
use App\Models\ProductType;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('header',function($view){
            $loaisp = ProductType::all();
            
            $view->with('loaisp', $loaisp);
        });
        view()->composer('header', function($view){
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with(['cart' => Session::get('cart'),
                        'product_cart' => $cart->items, 
                        'totalPrice' => $cart->totalPrice,
                        'totalQly' => $cart->totalQty]);
            }
        });
        view()->composer('page.dathang', function($view){
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with(['cart' => Session::get('cart'),
                        'product_cart' => $cart->items, 
                        'totalPrice' => $cart->totalPrice,
                        'totalQly' => $cart->totalQty]);
            }
        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
