<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'tag_id'
    ];
    protected $table = 'product_tag';

    public function tags()
    {
        return $this->hasMany(Tag::class, 'id', 'tag_id');
    }

}
