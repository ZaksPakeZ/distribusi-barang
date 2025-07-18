<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // app/Models/Transaction.php
public function product() {
    return $this->belongsTo(Product::class);
}
public function fromBranch() {
    return $this->belongsTo(Branch::class, 'from_branch_id');
}
public function toBranch() {
    return $this->belongsTo(Branch::class, 'to_branch_id');
}

protected $fillable = [
    'from_branch_id',
    'to_branch_id',
    'product_id',
    'quantity',
    'keterangan',
    'tanggal',
];

}
