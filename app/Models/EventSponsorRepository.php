<?php

namespace App\Models;

use Prettus\Repository\Eloquent\BaseRepository;

class EventSponsorRepository extends BaseRepository
{
    public function model()
    {
        return "App\\Models\\EventSponsor";
    }
}
