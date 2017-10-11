<?php

namespace App\Models;

use Prettus\Repository\Eloquent\BaseRepository;

class RoleRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return "App\\Models\\Role";
    }
}
