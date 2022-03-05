

# Laravel 9 Get Current User Location From Ip Address Tutorial
Laravel 9 get current user location example; Through this tutorial, i am going to show you how to get current user location (Country, City, Region name, Postal code, Latitude and longitude) with user ip address using stevebauman location package in laravel 9.
<p align="center"><a href="https://wesley.io.ke" target="_blank"><img src="https://laratutorials.com/wp-content/uploads/2022/02/Laravel-9-Get-Current-User-Location-From-Ip-Address-1024x499.jpg" width="400"></a></p>

The stevebauman/location package is used for detecting a users location by their IP Address, and It made retrieving a user’s location information from IP address exorbitantly effortless.

# How to Get Current User Location in Laravel 9
Use the below given steps to get current user location from ip address in laravel 9 apps:
|#|Action|
|---|---|
|Step 1 | Install Laravel 9 Application|
|Step 2 | Connecting App to Database|
|Step 3 | Install stevebauman/location Package|
|Step 4 | Create Route|
|Step 5 | Create Controller By Artisan Command|
|Step 6 | Create Blade View|
|Step 7 | Start Development Server|

# Step 1 – Install Laravel 9 Application
Execute the following command on terminal to install laravel 9 new setup. So, open terminal and type the following command to install new laravel 9 app into your machine:

```PHP
composer create-project --prefer-dist laravel/laravel blog
```
# Step 2 – Connecting App to Database
Open .env file and setup database details as following:
```PHP
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database-name
DB_USERNAME=database-user-name
DB_PASSWORD=database-password
```
# Step 3 – Install stevebauman/location Package
Execute the following command on your termina to install Install stevebauman/location Package
```php
composer require stevebauman/location
```
After installing package we have to setup config file. So open config/app.php file and add service provider and alias.
# If you are running Laravel v5 and below
```php
'providers' => [
    ....
    Stevebauman\Location\LocationServiceProvider::class,
],
'aliases' => [
    ....
    'Location' => 'Stevebauman\Location\Facades\Location',
]
```
# if you are running on Laravel v 5.5 and above
Publish the configuration file (this will create a location.php file inside the config/ directory):
```php
php artisan vendor:publish --provider="Stevebauman\Location\LocationServiceProvider"
```
# Step 4 – Create Routes
Open web.php file from routes direcotry. And update the following routes into web.php file:

  ```php
<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\UserController;
  
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
Route::get('display-user', [UserController::class, 'index']);
```
# Step 5 – Create Controller By Artisan Command
Execute the following command on terminal to create controller file:
```php
php artisan make:controller UserController
```
Then visit app/http/controllers and open UserController.php file. And update the following code into it:

```php
<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
  
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /* $ip = $request->ip(); Dynamic IP address */
        $ip = '162.159.24.227'; /* Static IP address */
        $currentUserInfo = Location::get($ip);
          
        return view('user', compact('currentUserInfo'));
    }
}
```
# Step 6 – Create Blade View
Visit resources/views directory and create user.blade.php. Then add the following code into it:
```php
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  
<div class="container">
    <h1>How to Get Current User Location with Laravel - Wesley-sinde</h1>
    <div class="card">
        <div class="card-body">
            @if($currentUserInfo)
                <h4>IP: {{ $currentUserInfo->ip }}</h4>
                <h4>Country Name: {{ $currentUserInfo->countryName }}</h4>
                <h4>Country Code: {{ $currentUserInfo->countryCode }}</h4>
                <h4>Region Code: {{ $currentUserInfo->regionCode }}</h4>
                <h4>Region Name: {{ $currentUserInfo->regionName }}</h4>
                <h4>City Name: {{ $currentUserInfo->cityName }}</h4>
                <h4>Zip Code: {{ $currentUserInfo->zipCode }}</h4>
                <h4>Latitude: {{ $currentUserInfo->latitude }}</h4>
                <h4>Longitude: {{ $currentUserInfo->longitude }}</h4>
            @endif
        </div>
    </div>
</div>
  
</body>
</html>
```
# Step 7 – Start Development Server
Open command prompt and execute the following command to start developement server:
```php
php artisan serve
```
Then open your browser and hit the following url on it:
```php
http://127.0.0.1:8000/display-user
```
