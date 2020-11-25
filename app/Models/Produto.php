<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produto extends Model
{
    use HasFactory;
    protected $table = 'produtos';
    public $timestamps = false;
    protected $fillable = [
        'Nome',
        'ProdutoPreco',
    ];
}
