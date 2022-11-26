## About Api

There Is A Service Provider Registered
$this->app->bind('App\Service\ToolTaxCalServiceInterface', 'App\Service\ToolTaxCalService');
All The Test Results Are Inside Folder Test Result inside this folder you may fond a Postman Collection and runing Api ScreenShot.
There is Only One Api which is at the End because we don't manage database at initial we calculate on basis of base Rate at End .
At Exit Vehicle User can get His total applied surcharge on Basis of All Condition Even odd On Mon -- thursday 1.5 on Weekend added  etc .
You may find all functions in interface.


## To Configure it locally
Just 
git clone with Master Branch 
Php artisan key:generate
Php artisan serve 
Api : http://127.0.0.1:8000/api/paytool Serve at this 
Thanks 
Regards 
Syed Fahad 

