<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentUser extends Model
{
    use HasFactory;

    protected $table = 'eloquent_users';

    protected $primaryKey = 'user_id';

    public function supplier() {
        return $this->belongsTo(EloquentSupplier::class, 'user_supplier_id', 'supplier_id');
    }

    public function history() {
        return $this->hasOne(EloquentHistory::class, 'history_user_id', 'user_id');
    }
}
