<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <title>Vendas Produtos</title>

</head>
<body>
    <div class="container">
        <div class="card">
          <div class="card-header">
            <h2>Vendas de produtos</h2>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="input-group mb-2 col-12 pl-0">
                  <div class="col-6 pl-0">
                    <input type="text" class="form-control" id="input_produto" placeholder="Procura pelo codigo do produto o nome...">
                  </div>
                  <div class="col-3 ml-1">
                    <button class="btn btn-primary ml-2" type="button" id="add_produto">Adiciona produto</button>
                  </div>
                </div>
                <div class="input-group mb-2 col-12 pl-0">
                  <div class="ml-2">
                    <label for=""><h2>Total:</h2></label>
                  </div>
                  <div class="ml-2">
                    <input type="text" class="form-control" id="total" disabled="disabled" value="0,00" style="text-align:right">
                  </div>
                </div>              
              </div>
            </div>
          </div>
        </div>
        <div id="loading" class="text-center"></div>  
        <table class="table table-striped table-hover table-condensed table-bordered" id="table1">
              <thead>
                  <tr class="success">
                    <th class="text-center">Produto nome</th>
                    <th class="text-center">Preco</th>
                    <th class="text-center">Fornecedor</th>
                  </tr>
              </thead>
              <tbody>
              </tbody>
        </table>
        <div class="modal-footer col-12">
        </div>
        <div class="input-group col-12 pl-0">
          <div class="col-4 pl-0">
            <input type="text" class="form-control" id="cep" placeholder="CEP 00000-00">
          </div class="col-2">          
            <button type="button" class="btn btn-primary" id="okCEP" disabled="disabled">Ok</button>
          </div>
          <div>
            <label class="mt-2" for="">Endereço</label>
            <input type="text" class="form-control" id="endereco" disabled="disabled">
          </div>
        </div>
        <div class="modal-footer mt-2">          
          <button type="button" class="btn btn-primary" disabled="disabled" id="salvar_venda">Salvar</button>
        </div>        
    </div>
</body>
</html>

<script>
    $(document).ready(function() {
 
      var totalVenda = 0; //Aucuma preco de cada produto
      var logradouro, complemento, bairro, localidade, uf ,cep = "";
      let items = [];

      //autocompleta dados no input de produto, segundo o ingresado, procurando na banco de dados
      //autocomplete Jquery-UI
      $("#input_produto").autocomplete({
         source: function(request, response) {
             $.ajaxSetup({
               headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
             });
 
             $.ajax({
                 url: "/procuraProdutoajax",
                 dataType: "json",
                 data: {
                     term : request.term
                 },
                 success: function(data) {
                     response(data);
                 }
             });
         },
         minLength: 1,
     });

     //procura os dados do produto ingresado no input no banco de dados e agrega
     //a informação na tabela
     $('#add_produto').on('click', function(){
      $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
      });
      $pos = $('#input_produto').val().indexOf('-')-1;
      $idRefProduto= $('#input_produto').val().substring(0,$pos);
      $.ajax({
              url: "/dadosProduto",
              data: {'idReferencaProduto':$idRefProduto},
              dataType: "json",
              method: "GET",
              success: function(dados)
              {
                if (dados.length != 0){
                      $('#table1').append("<tr><td class=text-center><h6><strong>" + dados[0].Nome
                      + "</strong></h6></td> <td><h6><strong>"
                      + dados[0].ProdutoPreco + "</strong></h6></td> <td><h6><strong>"
                      + dados[0].FornecedorNome + "</strong></h6></td></tr>");
                      totalVenda += dados[0].ProdutoPreco;
                    $('#input_produto').val("");
                    $('#total').val(totalVenda);
                    $('#okCEP').removeAttr('disabled');
                    let fila = {
                        produtoid: dados[0].ProdutoReferenca,
                        preco: dados[0].ProdutoPreco,
                        cantidad: 1
                    };
                    items.push(fila);
                    console.log(items);
                 }
                 else{
                   
                   alert("Nenhum dado encontrado...");
                 }
              }
      });
		});

    function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#cep").val("");
    }

    $('#okCEP').on('click', function(){

      cep = $('#cep').val().replace(/\D/g, '');

      //Verifica se campo cep possui valor informado.
      if (cep != " ") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

        //Consulta o webservice viacep.com.br/
          $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

            if (!("erro" in dados)) {
              //Atualiza os campos com os valores da consulta.
              logradouro = dados.logradouro;
              complemento = dados.complemento;
              bairro = dados.bairro;
              localidade = dados.localidade;
              uf = dados.uf;
            
              $("#endereco").val(dados.logradouro + " " + dados.complemento + " / " + dados.bairro + " / " + dados.localidade + " / " + dados.uf);
              $("#bairro").val(dados.bairro);
              $("#cidade").val(dados.localidade);
              $("#uf").val(dados.uf);
              $('#salvar_venda').removeAttr('disabled');
  
            } //end if.
            else {
              //CEP pesquisado não foi encontrado.
              //limpa_formulário_cep();
              alert("CEP não encontrado.");
            }
          });
        } //end if.
        else {
        //cep é inválido.
          limpa_formulário_cep();
          alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
      //cep sem valor, limpa formulário.
      limpa_formulário_cep();
    }
  });

  
  $('#salvar_venda').on('click', function(){
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
      });
      
      $.ajax({
              url: "/salvaVenda",
              data: {'itemsVendas': items,'docTotal': totalVenda, 'doccep': cep,'docrua': logradouro, 'doccomplemento': complemento ,'docbairro': bairro, 'doclocalidade': localidade, 'docuf': uf },
              dataType: "json",
              method: "POST",
              success: function(salvo)
              {
                if (salvo.valor == true){
                  alert("Venda salva com sucesso...");
                  limparDados();
                }
                else {
                   limparDados();
                   alert("Nenhum dado salvado...");
                }
              
              }
      });
  });

  function limparDados(){
    $('#total').val("0,00");
    $("#table1 tbody tr").slice(0).remove();
    $('#okCEP').attr('disabled', 'disabled');
    $("#cep").val("");
    $('#salvar_venda').attr('disabled', 'disabled');
    $("#endereco").val("");
    logradouro, complemento, bairro, localidade, uf ,cep = "";    
    totalVenda = 0;
  }

 });
 </script>