<?php

namespace App\Models;

use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Traits\CacheableRepository;

class EventRepository extends BaseRepository implements CacheableInterface
{

    use CacheableRepository;

    protected $cacheMinutes = 1440;

    protected $cacheOnly = ['findWhere'];

    public function model()
    {
        return "App\\Models\\Event";
    }

}