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
3.Run 
```
websocket:serve
```


