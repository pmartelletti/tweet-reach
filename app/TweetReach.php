<?php

namespace App;

use App\Exceptions\TweetInvalidUrlException;
use Illuminate\Support\Facades\Cache;

class TweetReach
{
    // 2 hours cache
    const CACHE_TIME = 7200;

    public function calculate($url)
    {
        try {
            return Cache::remember($url, self::CACHE_TIME, function () use ($url) {
                return Tweet::url($url)->retweeters()->sum(function (TwitterUser $user) {
                    return $user->followersCount();
                });
            });
        } catch (\Exception $e) {
            throw new TweetInvalidUrlException($url);
        }
    }
}
