<?php

namespace App\Models;

use Prettus\Repository\Eloquent\BaseRepository;

class TicketClassRepository extends BaseRepository
{
  public function model()
  {
      return "App\\Models\\TicketClass";
  }

}
