<?php

namespace App\Core;

use App\Models\Database;

class Model
{
    protected Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}
