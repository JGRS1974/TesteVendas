<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class AutocompleteController extends Controller
{
    //
    public function searchProduto(Request $request) {
        $query = $request->term;
        $produtos=Produto::select('ProdutoReferenca','Nome')
        ->where('ProdutoReferenca','LIKE','%'.$query.'%')
        ->orwhere('Nome','LIKE','%'.$query.'%')
        ->get();
        $data=array();
        foreach ($produtos as $prod) {
            $data[]=array('value'=>$prod->ProdutoReferenca . " - " . $prod->Nome);
        }
        if(count($data))
           return $data;
        else
          return ['value'=>'Nenhum produto encontrado..'];
      }
}
