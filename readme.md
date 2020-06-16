## Projeto de Paginação

Neste projeto foram empregadas duas formas de realizar paginação: 

1ª FORMA: Usando o método paginate() do LARAVEL 

2ª FORMA: Paginação via JQuery (Javascript)

### Importação de massa de dados para teste

- Site: "mockaroo.com"

1º - Para este projeto, gerei um arquivo '.csv' com 1000 registros de clientes contendo os campos 'nome', 'sobrenome' e 'email'.
2º - Após o download, foi necessário formatar o arquivo no excel para ficar no estilo de SEEDER do Laravel.
     Ex.:  DB::table('clientes')->insert(['nome'=>'Lanni','sobrenome'=>'Raxworthy','email'=>'lraxworthy0@princeton.edu']); 
3º - Colei os registros formatados na classe 'ClientesSeeder'.
4º - Executei a seeder no terminal para popular o banco de dados.

### 1ª FORMA: Paginação com o método PAGINATE() do LARAVEL

    O paginador do Laravel é integrado ao construtor de consultas Query Builder e ao Eloquent ORM e 
    fornece paginação conveniente e fácil de usar dos resultados do banco de dados. 
    O HTML gerado pelo paginador é compatível com a estrutura CSS do Bootstrap.

#### Paginando os resultados no CONTROLADOR

    Método 'paginate()':

    O método paginate() cuida automaticamente da definição do limite e do deslocamento 
    adequados com base na página atual que está sendo visualizada pelo usuário.

    O único argumento passado para o paginate() é o número de itens que você deseja exibir "por página". 

    Ex.: No método 'index()' da classe ClienteControlador foi usado o método 'paginate()' 
         que retorna 10 clientes de cada vez de forma paginada.

        $clientes = Cliente::paginate(10); 

#### Exibindo resultados da paginação na VIEW

    Na view 'index.blade.php' que mostra os clientes, foi usado no rodapé da página o método 
    'links()', que 'cria' automaticamente o componente visual de paginação.

    Ex.: Criar o componente visual de paginação
    {{ $clientes->links()}}    


#### Métodos da instância do paginador

    Cada instância do paginador fornece informações adicionais de paginação 
    através dos seguintes métodos: https://laravel.com/docs/5.8/pagination#paginator-instance-methods


### 2ª FORMA: Paginação via JQUERY




