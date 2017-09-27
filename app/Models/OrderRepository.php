<?php
/**
 * Created by PhpStorm.
 * User: hamdhanywijaya@gmail.com
 * Date: 9/27/17
 * Time: 2:29 PM
 */

namespace App\Models;

use Prettus\Repository\Eloquent\BaseRepository;

class OrderRepository extends BaseRepository
{
    public function model()
    {
        return "App\\Models\\Order";
    }
}