<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        
        {{-- faz referência à classe de estilo --}}
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

        <title>Paginação</title> 

        <style>
            body{
                padding: 20px;
            }
        </style>
    </head>
    <body>
       <div class="container">
            <div class="card text-center">
                <div class="card-header">
                    Tabela de Clientes
                </div>
                <div class="card-body">
                    <h5 class="card-title" id="cardTitle"> {{-- Carrega o nome via javascript --}}</h5>
                    <table class="table table-hover" id="tabelaClientes">
                        <thead>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Sobrenome</th>
                            <th scope="col">E-mail</th>
                        </thead>
                       
                        <tbody>
                            {{-- aqui entrarão os dados de clientes paginados via JQuery --}}
                            <tr>
                                <td>#</td>
                                <td>Pedro</td>
                                <td>Sanches</td>
                                <td>pedro@gmail.com</td>
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
                <div class="card-footer">
                    
                    {{-- Paginação usando Bootstrap e JQuery --}}
                    <nav id="paginator">
                        <ul class="pagination">
                         
                        </ul>
                    </nav>
                </div>
            </div/>
       </div>

       {{-- faz referência aos eventos --}}
       <script src="{{asset('/js/app.js')}}" type="text/javascript"></script>

       {{-- Monta a paginação via JQuery --}}
       <script>

            // Monta o li de paginação de 'pagina anterior'
            function getItemAnterior(data){
                // Verifica se está no início da paginação
                classe = '';
                if(data.current_page == 1){
                    classe = 'disabled';    // se estiver no item 1, não pode retroceder = desabilita o item
                }

                anterior = data.current_page - 1; // pega a página anterior

                // monta o item 
                item = '<li class="page-item '+ classe +'" pagina="'+ anterior +'">' +
                            '<a class="page-link" href="javascript::void(0);">Anterior</a>' + // javascript::void(0) = evita subir a lista qd recarrega
                      '</li>';
          
                return item; 
            }

            function getItemProximo(data){
                // Verifica se está no item final da paginação
                classe = '';
                if(data.current_page == data.last_page){
                    classe = 'disabled';    // se estiver no item 1, não pode retroceder = desabilita o item
                }

                proximo = data.current_page + 1;  // pega a próxima página

                // monta o item 
                item = '<li class="page-item '+ classe +'" pagina="'+ proximo +'">' +
                            '<a class="page-link" href="javascript::void(0);">Próximo</a>' +  // javascript::void(0) = evita subir a lista qd recarrega
                        '</li>';
          
                return item; 
            }

            // Monta os itens de paginação
            function getItem(data, i){
                //console.log('cheguei aqui 1');

                // Se o item pertence à página atual, aplica a classe 'active'
                ativo = '';
                if(i == data.current_page){
                    ativo = 'active';
                }      
                
                // monta o item 
                item = '<li class="page-item '+ ativo +'" pagina="'+ i +'"><a class="page-link" href="javascript::void(0);">' + i + '</a></li>';

                return item;
            }

            // Monta a estrutura de paginação
            function montarPaginator(data){

                // remove os li's de paginação atuais (limpa o paginador)
                $('#paginator>ul>li').remove();

                // monta o li de retorno à página anterior
                $('#paginator>ul').append(getItemAnterior(data));

                // Definição de limites para a visualização dos itens no paginador

                /* Ex. dos números das páginas
                1 2 3 4 5 6 7 8 9 10   = limite inferior
                21 22 23 24 25 26 27 28 29 30
                91 92 93 94 95 96 97 98 99 100  = limite superior
                */

                n = 10; // define o número de itens que desejo visualizar no paginador

                if(data.current_page - n/2 <= 1) // Trata o LIMITE INFERIOR    (n/2 = média de elementos antes e depois do que estiver ativo)
                    inicio = 1;                  // Páginas até 6 iniciam em 1
                else if( data.last_page - data.current_page < n )  // Trata o LIMITE SUPERIOR
                    inicio = data.last_page - n + 1;   // Páginas >= 91, inicio = (última página - n + 1)
                else
                    inicio = data.current_page - n/2;  // Acima de 6, início = (número da página - 5) 

                fim = inicio + n - 1;  // mantém sempre 11 itens, sendo o item do meio ativo

                for(i=inicio;i<=fim;i++){
                    item = getItem(data, i);  // monta o item de paginaçao
                    
                    $('#paginator>ul').append(item);  // insere o item no paginador
                }

                // monta o li de avanço p/ a próxima página
                $('#paginator>ul').append(getItemProximo(data));
            }

            // Monta as linhas da tabela
            function montarLinha(cliente){
                // Monta a linha
                return linha = 
                '<tr>' +
                    '<td>'+ cliente.id +'</td>' +
                    '<td>'+ cliente.nome +'</td>' + 
                    '<td>'+ cliente.sobrenome +'</td>' +
                    '<td>'+ cliente.email +'</td>' +
                '</tr>';
            }

            // Monta a tabela dinamicamente
            function montarTabela(data){

                // recupera o tdody da tabela
                tbody = $('#tabelaClientes>tbody');

                // remove o conteúdo atual do tbody
                tbody.children().remove();
            
                // popula a tabela com os novos dados de clientes
                for(i = 0; i < data.length; i++){
                    
                    // Insere uma nova linha na tabela
                    tbody.append(montarLinha(data[i]));
                }
            }

            // Consulta os clientes na base de forma paginada via Jquery e popula a tabela
            function carregarClientes(pagina){
                $.get('/json', {page: pagina}, function(resp){
                    console.log(resp);
                    montarTabela(resp.data); // Carrega os dados retornados de clientes
                    montarPaginator(resp);  // Monta o componente de paginação

                    // Após carregar todos os dados dos clientes na página, atrela
                    // o clique nos itens de paginação ao carregamento da página selecionada
                    $('#paginator>ul>li').click(function(){ 
                        carregarClientes( $(this).attr('pagina') );
                    });

                     // Adiciona o título à tabela
                    $('#cardTitle').html("Exibindo "+ resp.per_page + " clientes de " + resp.total + " ( " + resp.from + " a " + resp.to + " )");
           
                });
            }

            // Chama esta função sempre que a página é aberta
            $(function(){
                carregarClientes(1);
            });

       </script>
    </body>
</html>
