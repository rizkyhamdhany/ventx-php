<?php

namespace App\Models;

use Prettus\Repository\Eloquent\BaseRepository;

class EventArtistRepository extends BaseRepository
{
    public function model()
    {
        return "App\\Models\\EventArtist";
    }
}
