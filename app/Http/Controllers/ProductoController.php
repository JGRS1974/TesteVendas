<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produto;
use App\Models\Fornecedore;


class ProductoController extends Controller
{

    public function show(Request $request)
    {

        $prod = DB::table('produtos')
        ->join('fornecedores', 'produtos.ProdutoIdFornecedor', '=', 'fornecedores.Id')
        ->where('produtos.ProdutoReferenca', '=', $request->idReferencaProduto)
        ->select('produtos.*', 'fornecedores.FornecedorNome', 'fornecedores.Id')
        ->get();


        //$prod=Produto::select('ProdutoReferenca','Nome','ProdutoPreco')
        //->where('ProdutoReferenca','=',$request->idReferencaProduto)
        //->get();
        return response()->json($prod);
    }
    
}
