<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnqueteItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
      'enquete_id',
      'option',
    ];

    protected $table = 'enquete_items';
    public function enquete_answer()
    {
        return $this->hasMany(EnqueteAnswer::class, 'enquete_item_id', 'id');
    }
}
