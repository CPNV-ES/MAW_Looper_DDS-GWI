<?php

namespace App\Models;

use App\Core\Model;
use Exception;

class Status extends Model
{
    public int $id;
    public string $title;
}