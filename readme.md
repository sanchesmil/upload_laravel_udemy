## Projeto Álbum de Fotos usando Laravel - Download e Upload de Arquivos 

### Documentação de referência

    Link: https://laravel.com/docs/5.8/filesystem

### Gerador de imagens aleatórias

    Link: https://loremflickr.com/

### Armazenamento de arquivos

Por default, o arquivo 'config\filesystems.php' já define 3 'discos' de armazenamento para arquivos:

- 'local'  =>  Que aponta para o diretório 'storage\app'
- 'public' =>  Que aponta para o diretório 'storage\app\public'
- 's3'     =>  Que aponta para a núvem da Amazon

    'disks' => [

        'local' => [
            .......
        ],

        'public' => [
           ........
        ],

        's3' => [
           .........
        ],

* Acesso aos arquivos em 'storage\app\public': 

  Por default, o Laravel só permite acessar os arquivos contidos na raiz 
  do diretório 'public', o qual é uma espécie de 'front controller' para
  todas as requisições feitas ao aplicativo.
  Para resolver este problema, deve-se criar um link simbólico.

#### Criação de Link Simbólico:
  Para acessar os arquivos em 'storage\app\public' é necessário
  criar um link simbólico na raiz do diretório 'public' que
  aponte para o diretório 'storage\app\public'.

  Cmd: php artisan storage:link

  - Obs.: Tudo que for criado dentro de 'storage\app\public' estará 
  acessível em 'public'.





