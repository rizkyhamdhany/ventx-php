<?php
/**
 * Created by PhpStorm.
 * User: hamdhanywijaya@gmail.com
 * Date: 9/27/17
 * Time: 2:24 PM
 */

namespace App\Models;


use Prettus\Repository\Eloquent\BaseRepository;

class TicketRepository extends BaseRepository
{
    public function model()
    {
        return "App\\Models\\Ticket";
    }
}