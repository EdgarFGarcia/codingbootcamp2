<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "items";
    protected $fillable = [
        'id',
        'name',
        'category_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function categories(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
