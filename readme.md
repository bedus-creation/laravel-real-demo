1. Install laravel-websockets
```
composer require beyondcode/laravel-websockets
```
2.  Publish the migration file
```
php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="migrations"
```
3. Migrate
```
php artisan migrate
```
4. publish the WebSocket configuration file:
```
php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="config"
```
6. change In  .env file
```
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=LaravelReal
PUSHER_APP_KEY=LaravelReal
PUSHER_APP_SECRET=LaravelRealSecret
PUSHER_APP_CLUSTER=mt1
```
7. Uncomment Boardcast service provider in config/app.php
```
App\Providers\BroadcastServiceProvider::class,
```
8. Add this line to boardcast message
```
Broadcast::channel('messages', function () {
    return true;
});
```
9. Define port and host in boardcasting.php
```
'pusher' => [
    'driver' => 'pusher',
    'key' => env('PUSHER_APP_KEY'),
    'secret' => env('PUSHER_APP_SECRET'),
    'app_id' => env('PUSHER_APP_ID'),
    'options' => [
        'cluster' => env('PUSHER_APP_CLUSTER'),
        'encrypted' => true,
        'host' => '127.0.0.1',
        'port' => 6001,
        'scheme' => 'http'
    ],
],
```
10. Define port and host in bootstrap.js
```
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'LaravelReal',
    wsHost: window.location.hostname,
    wsPort: 6001,
    disableStats: true,
});
```
11. Run 
```
websocket:serve
```


