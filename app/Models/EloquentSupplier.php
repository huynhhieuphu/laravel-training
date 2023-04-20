<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentSupplier extends Model
{
    use HasFactory;

    protected $table = 'eloquent_suppliers';

    protected $primaryKey = 'supplier_id';

    public function user() {
        return $this->hasOne(
            EloquentUser::class,
            'user_supplier_id',
            'supplier_id');
    }

    public function userHistory() {
        return $this->hasOneThrough(
            EloquentHistory::class,
            EloquentUser::class,
            'user_supplier_id', // khóa ngoại ở bảng trung gian users
            'history_user_id', // khóa ngoại ở bảng đích histories
            'supplier_id', // khóa chính ở bảng suppliers
            'user_id'); // khóa chính ở bảng users
    }
}
