<?php

namespace App;


class TwitterUser
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = collect($data);
    }

    public function followersCount()
    {
        return $this->data->get('followers_count');
    }
}
