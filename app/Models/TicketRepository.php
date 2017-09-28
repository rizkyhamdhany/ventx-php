<?php

namespace App\Models;

use Prettus\Repository\Eloquent\BaseRepository;

class TicketRepository extends BaseRepository
{
  public function model()
  {
      return "App\\Models\\Ticket";
  }

}
