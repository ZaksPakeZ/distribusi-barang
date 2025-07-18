<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchProductStock extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id', 'product_id', 'stock'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
        return $this->belongsTo(\App\Models\Branch::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
        return $this->belongsTo(\App\Models\Product::class);
    }

    
}
