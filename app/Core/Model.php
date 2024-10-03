<?php

namespace App\Core;

use App\Models\Database;

class Model
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}
