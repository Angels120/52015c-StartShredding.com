<?php

namespace App\Providers;

use App\Advertisement;
use App\Cart;
use App\SiteLanguage;
use App\Clients;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($settings) {
            $settings->with('settings', DB::select('select * from settings where id=?', [1]));
            $settings->with('language', SiteLanguage::findOrFail(1));
            $settings->with('pagesettings', DB::select('select * from page_settings where id=?', [1]));
            $settings->with('sociallinks', DB::select('select * from social_links where id=?', [1]));
            $settings->with('lblogs', DB::select('select * from blogs LIMIT 4'));
            $settings->with('sliders', DB::select('select * from sliders'));
            $settings->with('menus', DB::select('select * from categories where role=?', ['main']));
            $settings->with('code', DB::select('select * from code_scripts'));
            $settings->with('ads728x90', Advertisement::inRandomOrder()
                ->where('banner_size', '728x90')->where('status', 1)->first());
            $settings->with('ads300x250', Advertisement::inRandomOrder()
                ->where('banner_size', '300x250')->where('status', 1)->get());
        });

        view()->composer('*', function ($view) {
            $view->with('response', Cart::select('cart.id', 'cart.uniqueid', 'cart.product', 'cart.title', 'cart.quantity', 'cart.size', 'cart.cost', 'products.feature_image')->join('products', 'cart.product', '=', 'products.id')->where('cart.uniqueid', Session::get('uniqueid'))->get());
        });

        view()->composer('*', function ($view) {
            $view->with('cart_result', Cart::select('cart.id', 'cart.uniqueid', 'cart.product', 'cart.title', 'cart.quantity', 'cart.size', 'cart.cost', 'products.feature_image')->join('products', 'cart.product', '=', 'products.id')->where('cart.uniqueid', Session::get('uniqueid'))->get());
        });

        // view()->composer('*', function ($view) {
            // $view->with('logged_in_user', Clients::find(Auth::user()->id));
        // });
        Schema::defaultStringLength(191);
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
