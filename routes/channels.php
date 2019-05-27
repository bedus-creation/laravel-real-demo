<?php

Broadcast::channel('messages', function () {
    return true;
});
Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});
