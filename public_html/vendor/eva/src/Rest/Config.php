<?php
/**
 * Created by PhpStorm.
 * User: Charles
 * Date: 08/12/2017
 * Time: 18:21
 */

namespace Eva\Rest;


class Config
{
    static $apimasterDEV = array(
        'name' =>  'apimasterdev',
        'auth' => 'token',
        'url' => 'http://10.100.103.26:8080',
        'port' => '8080',
        'header' => [
            'Content-Type: application/json',
            'x-access-access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyIkX18iOnsic3RyaWN0TW9kZSI6dHJ1ZSwiaW5zZXJ0aW5nIjp0cnVlLCJnZXR0ZXJzIjp7fSwid2FzUG9wdWxhdGVkIjpmYWxzZSwiYWN0aXZlUGF0aHMiOnsicGF0aHMiOnt9LCJzdGF0ZXMiOnsiaWdub3JlIjp7fSwiZGVmYXVsdCI6e30sImluaXQiOnt9LCJtb2RpZnkiOnt9LCJyZXF1aXJlIjp7fX0sInN0YXRlTmFtZXMiOlsicmVxdWlyZSIsIm1vZGlmeSIsImluaXQiLCJkZWZhdWx0IiwiaWdub3JlIl19LCJlbWl0dGVyIjp7ImRvbWFpbiI6bnVsbCwiX2V2ZW50cyI6e30sIl9tYXhMaXN0ZW5lcnMiOjB9fSwiaXNOZXciOmZhbHNlLCJfZG9jIjp7Il9pZCI6IjU4ZWNjOTBhY2JlOTAyMDljZGFhZjdjYSIsIl9fdiI6MH0sImlhdCI6MTQ5MTkxMjk3MH0.FLsZzhaCfCXuEV8dwJZl3OFVWP6tcAt90qG544oR4mY'
        ]
    );

    static $apimasterHOM = array(
        'name' =>  'apimasterhom',
        'auth' => 'token',
        'url' => 'http://10.100.103.26:8081',
        'port' => '8081',
        'header' => [
            'Content-Type: application/json',
            'x-access-access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyIkX18iOnsic3RyaWN0TW9kZSI6dHJ1ZSwiaW5zZXJ0aW5nIjp0cnVlLCJnZXR0ZXJzIjp7fSwid2FzUG9wdWxhdGVkIjpmYWxzZSwiYWN0aXZlUGF0aHMiOnsicGF0aHMiOnt9LCJzdGF0ZXMiOnsiaWdub3JlIjp7fSwiZGVmYXVsdCI6e30sImluaXQiOnt9LCJtb2RpZnkiOnt9LCJyZXF1aXJlIjp7fX0sInN0YXRlTmFtZXMiOlsicmVxdWlyZSIsIm1vZGlmeSIsImluaXQiLCJkZWZhdWx0IiwiaWdub3JlIl19LCJlbWl0dGVyIjp7ImRvbWFpbiI6bnVsbCwiX2V2ZW50cyI6e30sIl9tYXhMaXN0ZW5lcnMiOjB9fSwiaXNOZXciOmZhbHNlLCJfZG9jIjp7Il9pZCI6IjU4ZWNjOTBhY2JlOTAyMDljZGFhZjdjYSIsIl9fdiI6MH0sImlhdCI6MTQ5MTkxMjk3MH0.FLsZzhaCfCXuEV8dwJZl3OFVWP6tcAt90qG544oR4mY'
        ]
    );
}