<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'image',
        'pu',
        'description',
        'quantite',
        'categorie_id',
        'panier_id'
    ];
    public function article()
{
return $this->belongsTo(categorie::class);
}
public function panier()
{
return $this->belongsTo(panier::class);
}
}
