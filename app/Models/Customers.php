<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Support\Facades\DB;
//hoặc
use DB;

class Customers extends Model
{
    use HasFactory;

    protected $table = 'customers';

    public function getAll() {
        return DB::select('SELECT * FROM ' . $this->table);
    }

    public function insertRecord($data) {
        return DB::insert('INSERT INTO '. $this->table .' (customer_fullname, customer_email, customer_created_at)
        VALUES (:customer_fullname, :customer_email, :customer_created_at)', $data);
    }

    public function getDetail($id) {
        if(!empty($id)) {
            return DB::select('SELECT * FROM '. $this->table .' WHERE customer_id = '. $id);
        }
        return [];
    }

    public function updateRecord($data) {
        return DB::update('UPDATE '. $this->table .'
        SET customer_fullname = :customer_fullname, customer_email = :customer_email, customer_updated_at = :customer_updated_at
        WHERE customer_id = :customer_id', $data);
    }

    public function deleteRecord($id) {
        if(!empty($id)) {
            return DB::delete('DELETE FROM '. $this->table .' WHERE customer_id = '. $id);
        }
        return false;
    }
}
