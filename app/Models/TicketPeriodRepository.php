<?php

namespace App\Models;

use Prettus\Repository\Eloquent\BaseRepository;

class TicketPeriodRepository extends BaseRepository
{
  public function model()
  {
      return "App\\Models\\TicketPeriod";
  }

}
