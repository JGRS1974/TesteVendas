<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedore extends Model
{
    use HasFactory;
    protected $table = 'fornecedores';
    public $timestamps = false;
    protected $fillable = [
        'FornecedorNome',
    ];
}
