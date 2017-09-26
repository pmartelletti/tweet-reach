<?php

namespace App;

use App\Exceptions\TweetInvalidUrlException;
use Spatie\Regex\Regex;
use Thujohn\Twitter\Facades\Twitter;

class Tweet
{
    protected $status;

    public function __construct($url)
    {
        // validation
        if ('' === $status = $this->extractStatusId($url)) {
            throw new TweetInvalidUrlException($url);
        }
        $this->status = $status;
    }

    public static function url($url)
    {
        return new self($url);
    }

    private function extractStatusId($url)
    {
        return Regex::match('/twitter.com\/\w+\/status\/(\d+)/', $url)->groupOr(1, '');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function retweeters()
    {
        // I can only retrieve up to 100 retweets, that's how the API works.
        return collect(Twitter::getRts($this->status, ['count' => 100]))->map(function($retweet) {
            return new TwitterUser((array) $retweet->user);
        });
    }
}
