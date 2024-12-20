<?php

namespace App\Models;

use App\Core\Model;

class FieldType extends Model
{
    public int $id;
    public string $title;

    public static function table(): string|null
    {
        return 'types';
    }
}