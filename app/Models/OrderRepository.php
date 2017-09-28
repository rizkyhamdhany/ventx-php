<?php

namespace App\Models;

use Prettus\Repository\Eloquent\BaseRepository;

class OrderRepository extends BaseRepository
{
  public function model()
  {
      return "App\\Models\\Order";
  }
}
