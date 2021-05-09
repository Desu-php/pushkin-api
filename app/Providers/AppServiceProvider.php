<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extend('base64_image', function ($attribute, $value, $parameters, $validator) {

			try {
				$result = mime_content_type($value);
				if ($result == 'image/png' || $result == 'image/jpeg') {
					return true;
				} else {
					return $validator->errors()->add('image', 'base64 image is not png or jpeg');
				}
			} catch (\ErrorException $e)
			{
				return $validator->errors()->add('image', 'base64 image is not png or jpeg');
			}

		});
    }
}
