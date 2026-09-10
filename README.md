# Laravel — Instalação, Configuração e Estrutura Básica

Este README serve como um guia rápido para relembrar o processo inicial de configuração de um ambiente PHP/Laravel e a estrutura básica de um projeto Laravel.

---

## 1. Instalação do PHP

No Windows:

1. Baixe o PHP 8.X pelo site oficial: https://www.php.net/
2. Extraia o arquivo ZIP para uma pasta, por exemplo:

```text
C:\src\php
```

3. Adicione a pasta do PHP ao `PATH` do Windows:
   - Abra **Variáveis de Ambiente**;
   - Edite a variável `Path`;
   - Adicione o caminho onde o PHP foi extraído.

4. Verifique a instalação:

```bash
php -v
```

Se o comando exibir a versão instalada do PHP, a configuração do `PATH` está funcionando.

---

## 2. Configuração do `php.ini`

Na pasta do PHP, localize o arquivo `php.ini`.

Caso exista apenas um arquivo como:

```text
php.ini-development
```

você pode copiá-lo/renomeá-lo para:

```text
php.ini
```

Para descobrir qual arquivo de configuração o PHP do terminal está utilizando:

```bash
php --ini
```

No `php.ini`, habilite as extensões necessárias removendo o `;` do início das linhas:

```ini
extension=curl
extension=fileinfo
extension=mbstring
extension=openssl
extension=pdo_pgsql
extension=pgsql
```

Depois de salvar o arquivo, feche e abra novamente o terminal.

Você pode verificar as extensões carregadas com:

```bash
php -m
```

---

## 3. Instalação do Composer

O Composer é o gerenciador de dependências utilizado pelo PHP.

No Windows:

1. Baixe o instalador em: https://getcomposer.org/
2. Execute o instalador;
3. Durante a instalação, informe o executável do PHP, caso solicitado.

Verifique a instalação:

```bash
composer -V
```

---

## 4. Criando um projeto Laravel

Navegue até a pasta onde deseja criar o projeto e execute:

```bash
composer create-project --prefer-dist laravel/laravel meu-primeiro-projeto-laravel
```

Depois entre na pasta:

```bash
cd meu-primeiro-projeto-laravel
```

---

## 5. Configuração do banco de dados

O Laravel utiliza o arquivo `.env` para configurações específicas do ambiente.

Exemplo utilizando PostgreSQL:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

Depois de configurar o banco, execute:

```bash
php artisan migrate
```

As migrations pendentes serão aplicadas ao banco de dados.

---

# 6. Estrutura básica do Laravel

Uma instalação Laravel possui uma estrutura parecida com:

```text
meu-primeiro-projeto-laravel/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   └── Models/
│
├── bootstrap/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│
├── public/
├── resources/
│   └── views/
│
├── routes/
├── storage/
├── tests/
├── vendor/
│
├── .env
├── artisan
├── composer.json
└── package.json
```

## Pastas mais importantes no desenvolvimento

### `app/`

Contém grande parte do código da aplicação.

Principais locais:

```text
app/Http/Controllers/
app/Models/
```

- **Controllers**: recebem/coordenam as requisições;
- **Models**: representam os dados e permitem trabalhar com o banco por meio do Eloquent ORM.

### `routes/`

Contém as rotas da aplicação.

Para páginas web, normalmente utilizamos:

```text
routes/web.php
```

Exemplo:

```php
Route::get('/produtos', [ProdutoController::class, 'index']);
```

### `resources/views/`

Contém as telas da aplicação.

O Laravel utiliza o **Blade** como mecanismo de templates:

```text
resources/views/produtos/index.blade.php
```

### `database/`

Contém arquivos relacionados à estrutura e preparação do banco:

```text
database/
├── migrations/
├── seeders/
└── factories/
```

- **Migrations**: definem a estrutura do banco;
- **Seeders**: inserem dados iniciais ou de teste;
- **Factories**: auxiliam na geração de dados para testes.

### `vendor/`

Contém as dependências PHP instaladas pelo Composer.

Normalmente não deve ser editada manualmente.

### `.env`

Contém configurações específicas do ambiente, como:

- banco de dados;
- chave da aplicação;
- serviços externos;
- configurações locais.

### `artisan`

É a interface de linha de comando do Laravel.

Exemplo:

```bash
php artisan migrate
```

---

# 7. Como funciona o Laravel — MVC

Laravel segue o padrão **MVC — Model, View, Controller**.

Um fluxo básico pode ser representado assim:

```text
Usuário
   ↓
Requisição HTTP
   ↓
Route
   ↓
Controller
   ↓
Model / Eloquent
   ↓
Banco de Dados
   ↓
Controller
   ↓
View / Blade
   ↓
HTML
   ↓
Usuário
```

## Model

Representa os dados da aplicação e permite consultar/manipular registros utilizando o Eloquent ORM.

Exemplo:

```php
Produto::all();
```

## View

Responsável pela apresentação dos dados.

Exemplo:

```blade
@foreach ($produtos as $produto)
    {{ $produto->nome }}
@endforeach
```

## Controller

Coordena a requisição e liga as demais partes da aplicação.

Exemplo:

```php
public function index()
{
    $produtos = Produto::all();

    return view('produtos.index', compact('produtos'));
}
```

## Route

Define qual ação deve tratar determinada requisição.

Exemplo:

```php
Route::get('/produtos', [ProdutoController::class, 'index']);
```

---

# 8. Criando os principais arquivos com Artisan

Abaixo está uma sequência comum para iniciar um CRUD.

## 8.1. Criar Model

```bash
php artisan make:model Produto
```

Cria:

```text
app/Models/Produto.php
```

---

## 8.2. Criar Migration

```bash
php artisan make:migration create_produtos_table
```

Cria um arquivo em:

```text
database/migrations/
```

A Migration define a estrutura da tabela.

Exemplo:

```php
Schema::create('produtos', function (Blueprint $table) {
    $table->id();
    $table->string('nome');
    $table->text('descricao')->nullable();
    $table->decimal('preco', 8, 2);
    $table->integer('quantidade');
    $table->timestamps();
});
```

Depois:

```bash
php artisan migrate
```

---

## 8.3. Criar Model e Migration juntos

Também é possível criar os dois de uma vez:

```bash
php artisan make:model Produto -m
```

---

## 8.4. Configurar `$fillable` no Model

Exemplo:

```php
class Produto extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'quantidade',
    ];
}
```

O `$fillable` define quais atributos podem ser preenchidos por atribuição em massa.

---

## 8.5. Criar Controller

Controller simples:

```bash
php artisan make:controller ProdutoController
```

Resource Controller:

```bash
php artisan make:controller ProdutoController --resource
```

O `--resource` cria os métodos padrão de CRUD:

```text
index
create
store
show
edit
update
destroy
```

---

## 8.6. Criar rotas CRUD

No arquivo:

```text
routes/web.php
```

adicione:

```php
use App\Http\Controllers\ProdutoController;

Route::resource('produtos', ProdutoController::class);
```

Isso cria as rotas padrão:

```text
GET       /produtos
GET       /produtos/create
POST      /produtos
GET       /produtos/{produto}
GET       /produtos/{produto}/edit
PUT/PATCH /produtos/{produto}
DELETE    /produtos/{produto}
```

Para visualizar todas as rotas:

```bash
php artisan route:list
```

---

## 8.7. Criar Seeder

```bash
php artisan make:seeder ProdutoSeeder
```

Cria:

```text
database/seeders/ProdutoSeeder.php
```

Executar os seeders:

```bash
php artisan db:seed
```

---

## 8.8. Criar Factory

```bash
php artisan make:factory ProdutoFactory
```

Cria:

```text
database/factories/ProdutoFactory.php
```

Factories são úteis para gerar dados fictícios para testes.

---

## 8.9. Criar Middleware

```bash
php artisan make:middleware NomeMiddleware
```

Middlewares podem filtrar ou verificar requisições antes que elas cheguem ao Controller.

---

# 9. Resumo do fluxo de criação de um CRUD

Uma sequência prática pode ser:

```text
1. Criar o projeto
        ↓
2. Configurar o .env
        ↓
3. Criar Model + Migration
        ↓
4. Configurar a Migration
        ↓
5. Executar php artisan migrate
        ↓
6. Configurar o Model
        ↓
7. Criar Resource Controller
        ↓
8. Criar as rotas
        ↓
9. Criar as Views Blade
        ↓
10. Implementar e testar o CRUD
```

Comandos principais:

```bash
composer create-project --prefer-dist laravel/laravel meu-primeiro-projeto-laravel

cd meu-primeiro-projeto-laravel

php artisan make:model Produto -m

php artisan migrate

php artisan make:controller ProdutoController --resource

php artisan route:list
```

---

# 10. Iniciando o projeto Laravel

Na raiz do projeto, execute:

```bash
php artisan serve
```

Por padrão, o servidor de desenvolvimento ficará disponível em:

```text
http://127.0.0.1:8000
```

Para interromper o servidor, utilize:

```text
Ctrl + C
```

---

# 11. Comandos úteis de Migration

Executar migrations pendentes:

```bash
php artisan migrate
```

Reverter o último lote:

```bash
php artisan migrate:rollback
```

Ver o status das migrations:

```bash
php artisan migrate:status
```

Reverter e executar novamente todas as migrations:

```bash
php artisan migrate:refresh
```

---

## Resumo rápido

```text
Route
  ↓
Controller
  ↓
Model / Eloquent
  ↓
Banco de Dados
  ↓
Controller
  ↓
View / Blade
```

Para projetos pequenos e para aprendizado, essa estrutura MVC já é suficiente.

Em projetos maiores, responsabilidades podem ser separadas em outras camadas, como:

```text
Controller
   ↓
Form Request
   ↓
Service
   ↓
Repository
   ↓
Model
```

Porém, é recomendável dominar primeiro o fluxo MVC básico antes de adicionar novas camadas.
