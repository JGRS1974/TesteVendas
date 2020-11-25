<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itenvenda extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'itenvendas';
    public $timestamps = false;
    protected $fillable = [
        'ProdutoPreco',
        'ProdutoCantidade',
    ];
}
