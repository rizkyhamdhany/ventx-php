<?php

namespace App\Models;

use Prettus\Repository\Eloquent\BaseRepository;

class SeatRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return "App\\Models\\Seat";
    }
}