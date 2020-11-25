<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Docvenda;
use App\Models\Itenvenda;

class VendasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $id = DB::table('docvendas')->insertGetId(
            ['DocData' => Carbon::now(), 'DocNro' => 'XXXXX', 'DocTotal' => $request->docTotal, 'DocCEP' => $request->doccep, 'DocRua' => $request->docrua,'DocComplemento' => $request->doccomplemento, 'DocBairro' => $request->docbairro, 'DocLocalidade' => $request->doclocalidade, 'DocUF' => $request->docuf]
        );

            foreach ($request->itemsVendas as $item) {
                # code...
                DB::table('itenvendas')->insert(
                    ['ProdutoId' => $item['produtoid'], 'ProdutoPreco' => $item['preco'] ,'ProdutoCantidade' => $item['cantidad'] ,'ProdutoDocId' => $id]
                );
            }

            return response()->json(['valor' => true]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
