<?php

namespace App\Listeners;

use App\Events\PostHasBeenRead;
use Cache;

class PostEventListener
{
    public function handle($event)
    {
        if ($event instanceof PostHasBeenRead) {
            if (!$this->isAlreadyRead($event->post, $event->ip)) {
                $this->setAlreadyRead($event->post, $event->ip);
                $event->post->addViews();
            }
        }
    }

    private function isAlreadyRead($post, $ip)
    {
        return Cache::has("post:{$post->id}:$ip");
    }

    private function setAlreadyRead($post, $ip)
    {
        Cache::put("post:{$post->id}:$ip", true, config('sns.reading_interval'));
    }
}
