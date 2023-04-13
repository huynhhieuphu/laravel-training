<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function getAll()
    {
        return DB::table($this->table)->get();
    }

}
