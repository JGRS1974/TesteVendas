<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docvenda extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'docvendas';
    public $timestamps = false;
    protected $fillable = [
        'Docdata',
        'DocNro',
        'DocTotal',
        'DocCEP',
        'DocRua',
        'DocComplemento',
        'DocBairro',
        'DocLocalidade',
        'DocUF',
    ];

}
