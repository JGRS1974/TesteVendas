Instalar e iniciar o servidor Laragon (https://laragon.org/download/).
O repositorio clonado desde o GitHub debe ser descompactado na pasta C:\laragon\www
Laragon vai crear o mapping (127.0.0.1 VendasCliente.loc), pelo contrario você debe
criar ou mapping manualmente.

ER banco de dados.mwb - Modelo ER do Workbench para o banco de datos.
SQL Script ER banco dados.sql - Arquivo script SQL para crear as tabelas e os dados.

Desde o Workbench - conectar ao banco de dados / Databases -> Connect to Database.
Abrir o arquivo script SQL / File -> Open SQL Script.
Execute a consulta / Query -> Execute (All or Selection).
As tabelas serão criadas e inseridos alguns dados para testes.

Ruta da aplicação -> http://vendasclientes.loc/

Para testar a tela de vendas:

Debe procurar um produto debe inserir algun dado referente ao código/nome do mesmo.
Selecionado o produto, debe ser adicionado na tabela com o botão <Adiciona Produto>.
Introduza todos os produtos necessários.
No campo CEP debe ingresar o correspondiente para obter o endereço de entrega.
Se o CEP é válido e se a tabela tem produtos carregador os dados da venda podem
ser salvos no banco de dados com o botão <Salvar>.
