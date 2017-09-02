<?php
/**
 * Created by PhpStorm.
 * User: hamdhanywijaya@gmail.com
 * Date: 8/29/17
 * Time: 3:47 PM
 */

namespace App\Models;
use Prettus\Repository\Eloquent\BaseRepository;


class TicketBoxRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return "App\\Models\\TicketBox";
    }
}