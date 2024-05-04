<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

### Nuevo proyecto
- Instalar el instalador de proyectos de Laravel:
~~~
composer global require laravel/installer
~~~
- Crear un nuevo proyecto:
~~~
laravel new nombre-proyecto
~~~
### Rutas
#### Nombres
- Se puede dar nombres a las rutas, para luego hacer referencias a los mismos, en lugar a la URL.
~~~
Route::get('/',function(){
    return view('welcome');
})->name('home');
~~~
- Para conocer todas las rutas instaladas en el sistema utilizamos el comando `php artisan route:list`
#### Enviar variables a las vistas
- Utilizando el método `with()`, con una sola variable:
~~
Route::get('/',function(){

    $nombre = "Eric";
    return view('home')->with('nombre', $nombre);

})->name('home');
~~~
- Utilizando el método `with()`, con varias variables:
~~
Route::get('/',function(){
    
    $nombre = "Eric";
    $email = "menaeric@hotmail.com";

    return view('home')->with(['nombre'=>$nombre, 'email' => $email]);

})->name('home');
~~~
- Como segundo parámetro del método `view()`
~~~
Route::get('/',function(){
    $nombre = "Eric";
    $email = "menaeric@hotmail.com";
    return view('home',['nombre'=>$nombre, 'email' => $email]);
})->name('home'); 
~~~
- Como segundo parámetro del método `compact()` como segundo parámetro del método `view()`, siempre y cuando coincida con el nombre de la variable.
~~~
Route::get('/',function(){
    $nombre = "Eric";
    $email = "menaeric@hotmail.com";
    return view('home',compact('nombre','email'));
})->name('home');
~~~
#### Método view()
Se utiliza este método para vista que se le envía pocas o nada de información.
~~~
Route::view('/','terms', ['nombre'=>'Eric'])->name('terms');
~~~
## Vistas con Blade
- Se puede crear un **layout** donde se encuentre la estructura común para todas las vistas
- Utilizando la directiva `@yield()` se hace referencia al contenido se incrustrará en el layout
~~~
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
</head>
<body>
    <ul>
        <li><a href="{{route('home')}}">Home</a></li>
        <li><a href="{{route('contact')}}">Contacto</a></li>
        <li><a href="{{route('about')}}">Acerca de</a></li>
        <li><a href="{{route('portfolio')}}">Portfolio</a></li>
    </ul>
    @yield('content')
</body>
</html>
~~~
- Luego en cada vista se utiliza la directiva `@extends()` para hacer referencia al layout
- Y la directiva `@section()...@endsection` para hacer referencia al `@yield()` que corresponda.
- La directiva `@section()` puede recibir, como segundo parámetro la información
~~~
@extends('layout')
@section('title','Home')
@section('content')
<h1>Home</h1>
<hr>
@endsection
~~~
## Estructuras
### Foreach
- Declaro un array con la siguiente información:
~~~
$projects = [
    ['title' => 'Project #1'],
    ['title' => 'Project #2'],
    ['title' => 'Project #3'],
];
~~~
- Creo una ruta de la siguiente manera:
~~~
Route::view('/portfolio', 'portfolio', ['projects' => $projects])->name('portfolio');
~~~
- En la vista recorro el array:
~~~
    <ul>
        @foreach ($projects as $project)
        <li>{{$project['title']}}</li>
        @endforeach
    </ul>
~~~
### If... elseIf... else
- En en el caso que no hubiese elementos en el array puedo mostrar un mensaje
~~~
  <ul>
        @if ($projects)
        @foreach ($projects as $project)
        <li>{{$project['title']}}</li>
        @endforeach
        @else
            <li>No hay proyectos</li>
        @endif
    </ul>
~~~
### Forelse
- Se utiliza para recorrer un array si es que este tiene elementos, de lo contrario utilizando la directiva `@empty` se muestra un mensaje
~~~
 <ul>
        @forelse ( $projects as $project )
            <li>{{$project['title']}}</li>
        @empty
            <li>No hay proyectos</li>
        @endforelse
    </ul>
~~~
### Loop
- Es una variable que existe dentro de un iterador. Por medio de ella podemos acceder a información de la iteración:
~~~
  
  <li>{{$project['title']}} <pre>{{var_dump($loop)}}</pre></li>


object(stdClass)#302 (10) {
  ["iteration"]=>
  int(1) //número de la iteración
  ["index"]=>
  int(0) //posición del elemento en el array
  ["remaining"]=>
  int(2) //iteraciones restantes
  ["count"]=>
  int(3) //cantidad total de iteraciones
  ["first"]=>
  bool(true) //si es la primera iteración
  ["last"]=>
  bool(false) //si es la última iteración
  ["odd"]=>
  bool(true) //si es una iteración impar
  ["even"]=>
  bool(false) //si es una iteración par
  ["depth"]=>
  int(1) //el nivel, si es una matriz de array's
  ["parent"]=>
  NULL
}
~~~
- En este ejemplo se muestra un mensaje utilizando la info de loop
~~~
   <li>{{$project['title']}} <pre>{{($loop->first ? 'Es el primero' : null)}}</pre></li>
~~~
### @for () ... @endfor
- Ciclo for

### @while () ... @endwhile
- While

### @switch() ... @case() ... @break ... @default ... @endswitch
- Switch

<hr/>

## Controladores
- Para crear un controlador escribimos en la terminal: `php artisan make:controller`
- Pueden usarse al momento de crear el controlador diferentes banderas:
~~~
php artisan make:controller NombreDelControlador -m, --model //sirve para pasarle un modelo de Eloquent

php artisan make:controller NombreDelControlador -r, --resource //crea un controlador resource

php artisan make:controller NombreDelControlador -i, --invokable //crea un solo método invocable en el controlador

php artisan make:controller NombreDelControlador -p --partent //recursos anidados

php artisan make:controller NombreDelControlador --api //crea un controlador resource, pero excluye los étodos EDIT y CREATE
~~~
- `php artisan make:controller PortfolioController`, como resultado tenemos un controlador en blanco
~~~
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    //
}
~~~
- `php artisan make:controller PortfolioController -i` crea un controlador con un único método, que se ejecutará cada vez que hagamos referencia al controlador
~~~
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Handle the incoming request.
     */
    
    public function __invoke(Request $request)
    {
        $projects = [
            ['title' => 'Project #1'],
            ['title' => 'Project #2'],
            ['title' => 'Project #3'],
        ];

        return view('portfolio', ['projects' => $projects]);
    }
}

/* EN LA RUTA */
use App\Http\Controllers\PortfolioController;

Route::get('/portfolio', PortfolioController::class)->name('portfolio');

~~~
- `php artisan make:controller PortfolioController -r` crea el controlador con todos 7 métodos: index, create, store, show, edit, update, destroy
~~~
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

~~~
- Para acceder al método desde la ruta escribimos lo siguiente:
~~~
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
~~~
- También se puede utilizar el método `resouce` para que Laravel nos cree todas las rutas
~~~
Route::resource('projects',PortfolioController::class);
~~~
- Si hacemos `php artisan route:list` obtendremos la lista de todas las rutas
~~~
  GET|HEAD        projects ................................................ projects.index › PortfolioController@index
  POST            projects ................................................ projects.store › PortfolioController@store
  GET|HEAD        projects/create ....................................... projects.create › PortfolioController@create
  GET|HEAD        projects/{project} ........................................ projects.show › PortfolioController@show
  PUT|PATCH       projects/{project} .................................... projects.update › PortfolioController@update
  DELETE          projects/{project} .................................. projects.destroy › PortfolioController@destroy
  GET|HEAD        projects/{project}/edit ................................... projects.edit › PortfolioController@edit
~~~
- Podemos configurar que rutas queremos que nos cree el método `resource` con el método `only`. Por ejemplo para crear solo las rutas index y create sería así:
~~~
Route::resource('projects',PortfolioController::class)->only(['index','create']);
~~~
- Por el contrario si queremos crear todas las rutas, excepto algunas podemos usar el método `except`. Ejemplo:
~~~
Route::resource('projects',PortfolioController::class)->except(['index','create']);
~~~
- También se puede crear un controlador solo con los métodos utilizados en API con `php artisan make:controller PortfolioController -api`. Esto creará solo 5 métodos, excluyendo el create y edit
- Las rutas se crean en ingles. Para cambiar se debe acceder al archivo `/app/Providers/AppServiceProvider.php`, y en el método `boot()` escribir lo siguiente: 
~~~

use Illuminate\Support\Facades\Route;


   public function boot(): void
    {
        Route::resourceVerbs([
            'create' => 'crear',
            'edit' => 'editar'
        ]);
    }
~~~
## Activacion del menú de navegación
- Se debe crear una clase que cambie los estilos del item del menú
- La función `request()` en la vista retorna mucha información del request
~~~
    {{dump(request())}} // retorna un objeto JSON
    {{dump(request()->url())}} // retorna la URL completa de la petición
    {{dump(request()->path())}} // retorna la URL, sin el dominio
    {{dump(request()->routeIs('nombreRuta'))}} // retorna true o false si el nombre de ruta corresponde con el string que recibe por parámetro
~~~
- Aplicando esto último podemos mostrar activo el item de menú que corresponda:
~~~
<style>
    .active{
        color : red;
        text-decoration: none;
    }
</style>

<ul>
    <li ><a class="{{request()->routeIs('home') ? 'active' : null}}" href="{{route('home')}}">Home</a></li>
    <li><a class="{{request()->routeIs('contact') ? 'active' : null}}" href="{{route('contact')}}">Contacto</a></li>
    <li><a class="{{request()->routeIs('about') ? 'active' : null}}" href="{{route('about')}}">Acerca de</a></li>
   
</ul>
~~~
## Creación de helpers
- Para hacer el código más limpio hacemos una función dentro del archivo `/app/helpers.php` (debemos crear el archivo)
~~~
<?php

function setActive($nameRoute){
    return request()->routeIs($nameRoute) ? 'active' : null;
}
~~~
- Luego refactozamos el menú de la siguiente forma
~~~
<ul>
    <li ><a class="{{setActive('home')}}" href="{{route('home')}}">Home</a></li>
    <li><a class="{{setActive('contact')}}" href="{{route('contact')}}">Contacto</a></li>
    <li><a class="{{setActive('about')}}" href="{{route('about')}}">Acerca de</a></li>
</ul>
~~~
- Es probable que no reconozca la función. Para ello debemos modificar el archivo `composer.json`, agregando la clave `files` dentro del objeto `autoload` y asignarle como valor un array en cuyos elementos incluyamos el archivo: `"files" : ["app/helpers.php"]`
~~~
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Database\\Factories\\": "database/factories/",
        "Database\\Seeders\\": "database/seeders/"
    },
    "files" : ["app/helpers.php"]
},
~~~
- Luego debemos teclear en la terminal `composer dump-autoload` para vuelva a generar nuevamente el *archivo de carga automática*
## Enviar datos de un formulario
- Creamos un nuevo controlador `php artisan make:controller MessagesController --resource`
- Creamos las rutas utilizando `Route::resouce`, haciendo referencia la controlador:
~~~
use App\Http\Controllers\MessagesController;

Route::resource('messages',MessagesController::class);
~~~
- Creamos el formulario, en el action indico la ruta donde irán los datos
~~~
 <form action="{{route('messages.store')}}" method="POST">
            @csrf
            <div>
                <input name="name" type="text" placeholder="Nombre">
            </div>
            <div>
                <input name="email" type="email" placeholder="Email">
            </div>
            <div>
                <input name="subject" type="text" placeholder="Asunto">
            </div>
            <div>
                <textarea name="content" id="content" placeholder="Mensaje" cols="30" rows="10"></textarea>
            </div>
            <div>
                <button type="submit">Enviar</button>
            </div>
        </form>
~~~
- En el método `store` podemos recibir los datos en la variable `$request` creada por la clase `Request`
~~~
use Illuminate\Http\Request;

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        return $request;
    }
~~~
- Para acceder al valor de un campo específico podemos acceder de haciendo referencia al 'name' del mismo: `$request->name`
- También se puede acceder a los datos utiliznado el método `request()` que hereda de la clase `Request`
~~~
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        return request();
    }
~~~
- Y para acceder al valor de un campo, pasamos el 'name' por parámetro, por ejemplo: `request('email')`
### Validación de formularios
- Podemos utilizar el método `validate()`, pasandole como parámetro un array con las reglas de validación por cada campo a validar:
~~~
request()->validate([
    'name' => 'required',
    'email' => 'required',
    'subject' => 'required',
    'content' => 'required'
]);
~~~
- Luego en la vista, por medio de la variable `$errors` podemos acceder a los errores y mostrarlos todos juntos, recorriendo el array, por ejemplo:
~~~
<ul>
    @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
</ul>
~~~
- O podemos acceder a cada uno particular haciendo uso del método `first()` de la variable `$errors`, que recibe como primer parámetro el nombre del campo y como segundo el formato html a usar. Ojo que para que se muestre correctamente debemos usar la sintáxis: `{!! !!}`, de lo contrario no se interpretará correctamente las etiquetas HTML:
~~~
<div>
    <input name="name" type="text" placeholder="Nombre"><br>
    {!!$errors->first('name','<small>:message</small>')!!}
</div>
~~~
- Se pueden agregar más reglas de validación se paradas por el caracter `|`
~~~
request()->validate([
   
    'email' => 'required|email',
   
]);
~~~
- Para que persistan los datos que fueron ingresados correctamente usamos el método `old()` que recibe como parámetro el name del campo. Ejemplo:
~~~
 <div>
    <input name="name" type="text" placeholder="Nombre" value="{{old('name')}}"><br>
    {!!$errors->first('name','<small>:message</small>')!!}
</div>
~~~
### Traducir los mensajes
- Primero hay que instalar el paquete *Laravel Lang* tecleando en la terminal:
~~~
composer require laravel-lang/common --dev

php artisan lang:add es

php artisan lang:update
~~~
- Luego se debe editar el archivo `/config/app.php`
~~~
 /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'es',
~~~
- Tambien se pueden personalizar los mensajes de error, pasando un array como segundo parámetro del método `validate()`
~~~
        request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'content' => 'required|min:10'
        ],[
            'name.required' => 'El nombre es obligatorio',
            'email.required' => 'Tu email es obligatorio',
            'email.email' => 'El formato de email es incorrecto',
            'subjet.required' => 'El asunto es obligatorio',
            'content.required' => 'El contenido es obligatorio',
            'content.min' => 'Vamos... escribí un toque más',
        ]);

~~~
- También se puede usar la función `__('Keyword')` para traducir la palabra que recibe por parámetro, siempre y cuando esta se encuentre en el json que corresponda al idioma. Ejemplo: `./lang/es.json`. De manera que en la vista se haga referencia de la siguiente manera:
~~~
<h1>{{__('Contact')}}</h1>
~~~
## Enviar emails
- Se debe crear un **Mailable** tecleando en la terminal `php artisan make:mail MessageContactPage`
- Luego de creado se edita el método `content()` para hacer referencia a la vista que funcionará como plantilla del email a enviar
~~~
  /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact',
        );
    }
~~~
- En el método correspondiente del controlador, invocamos una instancia de la clase utilizando el método `send()`: 
~~~
use Illuminate\Support\Facades\Mail;

    Mail::to('menaericdaniel@gmail.com')->send(new MessageContactPage);
~~~
- Para hacer las pruebas, se puede cambiar el valor de la variable de entorno:
~~~
MAIL_MAILER=log
MAIL_FROM_ADDRESS="hello@laravel.com"
MAIL_FROM_NAME="${APP_NAME}"
~~~
## Variables de entorno
- Son variables que se configuran segun el *entorno* donde corre la aplicación: desarrollo (development o local), producción (production), etc.
- Se encuetran en el archivo `.env`. 
    - La variable `APP_ENV` define el entorno donde está corriendo la aplicación. Por defecto viene seteada en `local`, cuyo valor sería `production`, si la aplicación corre en producción.
    - Otra variable que debe cambiarse si el entorno está en producción es la variable `APP_DEBUG` que por defecto viene seteada en `true` de manera que se muestre detalles del error.Algo que no debe suceder en *producción* dado que muestra datos sensibles de la apicación, por ello en producción debe setearse en `false`
## Conexión con la base de datos.
- Para ellos se debe configurar las siguientes variables de entorno, en el caso se trabaje en local:
~~~
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=guide-app_db
DB_USERNAME=root
DB_PASSWORD=root
~~~
- Estas variables se utilizarán en el archivo `/config/database.php`
## Migraciones
- Por defecto, Laravel trae algunas migraciones, por ejemplo una que crea la tabla users por medio del siguiente método:
~~~
  public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
~~~
- Utilizando la clase Blueprint creata la tabla users con sus respectivas columnas
    - El método `id()` crea la columna id con las siguientes restricciones: bigInt, primaryKey, autoIncrement, unsigned
    - El método `string()` crea una columna de tipo `VARCHAR` cuyo nombre va por parámetro
    - El método `timestamp()` crea una columna de tipo *marca de tiempo*
    - El método `nullable()` añade la restricción que la columna soporta nulos
    - El método `rememberToken()` crea una columna de tipo `VARCHAR` de 100 caracteres, y soporta nulos
### Correr las migraciones
- Para ejecutar las migracioens se ejecuta el siguiente comando:
~~~
php artisan migrate
~~~
### Volver atrás todas las migraciones
- Para volver atras todas la migraciones se ejecuta el siguiente comando:
~~~
php artisan migrate:rollback
~~~
### Volver atrás una determinada cantidad de migraciones
- En el caso que queramos volver a tras una migración utilizamos la banera `--step` asignando un valor numérico que hace referencia a cuantos pasos atras se prentende retroceder. Ejemplo:
~~~
php artisan migrate:rollback --step=1
~~~
- Ojo que si se corre el comando para retroceder una o más migraciones pero no todas, luego al correr el comando `php artisan migrate`, este correrá las migraciones pendientes pero en número de lote diferente, es decir que cuando se corra `php artisan migrate:rollback` solo se eliminarás las migraciones correspondientes a ese lote.
### Volver atrás todas las migraciones y correrlas de nuevo
- Otro comando que permite retroceder las migracioens y volverlas a correr es el comando:
~~~
php artisan migrate:fresh
~~~
- Cuidado!! Este comando es destructivo. Borra todos los datos. NO HAY QUE EJECUTARLO EN PRODUCCIÓN
### Crear una nueva tabla
- Se utiliza el comando `php artisan make:migrate` añadiendo luego el nombre de la migración procurando que en el mismo se encuentre las cadenas *create_* y *_table*. Ejemplo:
~~~
php artisan make:migration create_products_table
~~~
- O también se puede nombrar la migración en español y usar la bandera `--create=nombreDeLaTabla`
- De esta forma Laravel creará la migración con la sintaxis correspondiente para la creación de una nueva tabla.
### Actualizar una tabla existente
- También se utiliza el comando `php artisan make:migration` añadiendo luego el nombre de la migración, procurando en este caso que en el mismo se encuentre las cadenas *_to* y *_table* Ejemplo:
~~~
php artisan make:migration add_phone_users_table
~~~
- O también se puede nombrar la migración en español y usar la bandera `--table=nombreDeLaTabla`

(Ver el archivo `vendor/laravel/src/Illuminate/Database/Console/Migrations/TableGuesser.php;)
## Base de datos
### Traer todos los registros (sin Eloquent)
- Se utiliza un constructor de consultas, importando la clase `DB`, por ejemplo:
~~~
        $projects = DB::table('projects')->get();
~~~
## Eloquent (ORM para Laravel)
### Crear un Modelo (Model)
- Sirve para expresar las *Tablas de la DB* en *Clases de PHP* y viceversa.
- Se debe crear una clase o Modelo por cada tabla de nuestra DB. Para ello se utiliza el siguiente comando:
~~~
php artisan make:model Project
~~~
- Se pueden usar las siguientes banderas
    - `--controller o -c` para crear con el modelo un nuevo controlador
    - `--migration o -m` para crear con el modelo una nueva migración para crear la tabla (hay que editarla)
    - `--resource o -r` para crear con el modelo los 7 métodos en el controlador (index, create, store, show, edit, update, destroy)
    (solo hay que crear la ruta `Route::resource('projects',ProjectController::class);`)
- Al ejecutar el comando se crea un nuevo archivo en `app/Models/Project.php` con la siguiente información:
~~~
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
}
~~~
- Por defecto, **Eloquet** vinculará el Modelo con la tabla cuyo nombre sea el plural y todo en minúscula del mismo, por ejemplo: la tabla *projects* del modelo *Project*. En el caso que esto no fuese así hay que setearlo con la propiedad `$table`
~~~
protected $table = "projects";
~~~
### Traer todos los registros
- Una vez creado el modelo, se hace referencia del mismo en el controlador y se puede utilizar usando el método `get()` para traer todos los registros de la tabla que representa
~~~
use App\Models\Project;

    $projects = Project::get();
~~~
- Se pueden treaer los registros ordenados por fecha de creación de forma DESCENDENTE
~~~
    $newest = Project::latest()->get();
~~~
- En el caso que queramos ordenarlos de forma DESCENDENTE utilizando como referencia otra columna, esta se pasa por parámetro del método `latest()`. Ejemplo:
~~~
    $newest = Project::latest('updated_at')->get();
~~~
### Manejo de fechas en las vistas con CARBON
- Se puede aplicar el formato que querramos para mostrar la fecha utilzando el método `format()`. Ejemplo:
~~~
    <small><b>{{$project->created_at->format('d-m-Y')}}</b></small>
~~~
- Incluso mostrar la diferencia de tiempo en formato humano. Ejemplo:
~~~
    <small><b>{{$project->created_at->diffForHumans()}}</b></small>
~~~
### Paginación con *paginate()*
- Se puede aplicar en el *controlador* a la petición el método `paginate()` que por defecto paginará 15 elementos por página, a no ser que le pasemos por parámetro un número que indique cuantos elementos queremos que traiga.
~~~
    $paginates = Project::paginate(2);
~~~
- En la *vista* solo se mostrarán los registros que correspondan a la página. Para mostrar los links para ver las demás páginas se utiliza el método `links()`:
~~~
    {{$paginates->links()}}
~~~
## Traer un registro en específico
- Asumiendo que tenemos creado una controlador de tipo *resource* con su correspondiente enrutador, podemos pasarle al método `show` el id del registro que queremos traer. Por ejemplo:
~~~
    <p><a href="{{route('projects.show',$project)}}">{{ $project->title }}</a> </p>
~~~
- El identificador lo trae implícito en la referencia al regisro `$project` invocando el método `getRouterKey()`, generando un link para cada registro
- El *controlador* recibe el id y se construye la consulta:
~~~
    public function show(Project $project)
    {
        return view('project', [
            'project' => Project::all()->find($project)
        ]);
    }
~~~
- Así en al vista mostrar todos los datos que querramos:
~~~
<h1>Projecto: {{$project->title}}</h1>
<hr>
<h4>Descripción</h4>
<p>{{$project->description}}</p>
<h5>Creado {{$project->created_at->diffForHumans()}}</h5>
~~~
## Manejo de 404
- Si el registro no se encuentra, tirará un 404 con una página por defecto. Si queremos mostrar una vista personalizada para ese error se puede crear una carpeta `/resources/views/errors` y dentro de la misma crear un archivo `404.blade.php` para crear la vista personalizada
## Form Request Validation
- Estan pensados para validar formularios más complejos.
- Son clases dedicadas para encapsular la lógica de validación y autorización de uno o varios formularios
- Para crearlos se ejecuta desde la terminal la siguiente instrucción
~~~
php artisan make:request nombreDelRequest //ejemplo createProjectRequest
~~~
- Esto creará en la carpeta `app/Http/Request` el archivo request con la siguiente estructura:
~~~
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}

~~~
- Todo request consta de dos métodos:
    - El método `authorize()` que evalúa si el que hace el request está habilitado o no para hacerlo. Por ejemplo, se puede solicitar si el usuario es adiministrador `$this->user()->isAdmin()`. Este método retorna `true` o `false` Si devuelve `false`, la respuesta será un *HTTP Response Forbidden (Prohibido)*, caso contrario se ejecutará el método `rules()`
    - El método `rules()` verifica las reglas de validación. Un ejemplo podría ser el siguiente:
~~~
public function rules(): array
    {
        return [
            'title' => 'bail|required|min:2|max:255',
            'description' => 'bail|required|min:20'
        ];
    }
~~~
- Luego en el controlador se implementa el Form Request Validation de la siguiente manera:
~~~
use App\Http\Requests\CreateProjectRequest;

    public function store(CreateProjectRequest $request)
    {
               
        $request->validated();
      
        $project = new Project;

        $project->title = $request->title;
        $project->description = $request->description;
        
        $project->save();
        
        return redirect()->route('projects.show',$project);

    }
~~~
- En el caso de querer personalizar los mensajes de error, esto se puede creando el método `messages()` en el Form Request Validation
~~~
    public function messages(): array
    {
        return [
            'title.required' => 'El título es obligatorio',
            'description.required' => 'La descripción es obligatoria',
        ];
    }
~~~
## Update
### Método que muestra el formulario
- Se envía al método edit la instancia del proyecto (puede ser desde la vista que reciba la misma, por ejemplo el detalle del producto)
~~~
  public function edit(Project $project)
    {
        return view('projects.edit',['project'=>$project]);
    }
~~~
### Vista de edición
- En la vista del formulario de edición, se hace referencia en el atributo `value` a la propiedad que correponda
~~~
<form action="{{route('projects.update',$project)}}" method="POST">
    @csrf
    @method('PUT')
<input type="text" id="title" name="title" placeholder="Titulo del proyecto" value="{{old('title',$project->title)}}"><br><br>
<textarea name="description" id="description" cols="30" rows="10" placeholder="Descripción del proyecto">{{old('description',$project->description)}}</textarea>
<button type="submit">Actualizar</button>
</form>
~~~
- En el caso que el método no esté soportado por HTML, en el caso de PUT, DELETE o PATCH, se utiliza directriz `@method('METODO')`
- A fin de persistir los datos cuando se ha escrito correctamente pero ha generado un error en otro input se utiliza el método `old('nombreDelCampo','valorPorDefecto')`
### Método que procesa updatea el registro
- Se puede utilizar un *Form Request Validator* para validar los datos ingresados. Luego, como los valores que se reciben son una instancia de la clase, solo se reemplazan los valores que correspondan.
~~~
  public function update(CreateProjectRequest $request, Project $project)
    {
        $request->validated();

        $project->title =  $request->title;
        $project->description = $request->description;

        $project->save();

        return redirect()->route('projects.show',$project);

    }
~~~
