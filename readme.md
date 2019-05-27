### In .env file
1. change 
```
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=LaravelReal
PUSHER_APP_KEY=LaravelReal
PUSHER_APP_SECRET=LaravelRealSecret
PUSHER_APP_CLUSTER=mt1
```
2. Uncomment Boardcast service provider in config/app.php
```
App\Providers\BroadcastServiceProvider::class,
```
3. Add this line to boardcast message
```
Broadcast::channel('messages', function () {
    return true;
});
```
4. Define port and host in boardcasting.php
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
5. Define port and host in bootstrap.js
```
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'LaravelReal',
    wsHost: window.location.hostname,
    wsPort: 6001,
    disableStats: true,
});
```
6. Run 
```
websocket:serve
```


