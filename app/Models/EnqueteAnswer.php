<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class EnqueteAnswer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
       '*',
    ];

    protected $table = 'enquete_answers';

    public function enquetes(): BelongsToMany
    {
        return $this->belongsToMany(Enquete::class, 'enquete_answers');
    }

    public function enquete_items(): BelongsToMany
    {
        return $this->belongsToMany(EnqueteItem::class, 'enquete_answers');
    }
}
