## Reto Realizado en Laravel
### Solo se realizó backend 😐

## Pasos para levantar el proyecto
- Tener instalado composer ^2.0
- Tener instalado php ^7.4
- Asegurarse de tener una conexión a MySQL local o remota
- Crear un archivo .env en la raiz del proyecto con lo siguiente
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:Uis1h40Ar2wEttKFwddwCwUdvppYHj/LYI4Wm85Nedo=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bingo_kata
DB_USERNAME=root
DB_PASSWORD=root

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

- Ejecutar los siguientes comandos en el mismo orden
```
composer install
npm install
npm run dev
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

- Debería ver el proyecto en http://localhost:8000

#### Consideraciones 😊
- Test unitario básico
- Test de features básico
- Endpoints no probados en su totalidad
- Genere un token CSRF para no tener problemas al probar un endpoint
- Para probar los endpoints asegurese de envíar el token generado un header con el nombre ``X-CSRF-TOKEN``
- ¿ Cómo genero el token CSRF de prueba ?, haga un `GET` a la ruta ````/token```` y verá una cadena de texto amplia que debe usar para las 
  peticiones posteriores.

#### Características y Algunos casos de uso 😊
- Crear y listar cartillas de juego
- Crear y listar los juegos y juegos activos
- Agregar nuevo numero al juego de bingo ('Sube un nuevo numero para que los jugadores estén al tanto')
- Ganador de bingo con 1 columna ('Aquí el backend valida que el jugador que pica a bingo con una linea/columna de verdad haya ganado')
- Ganador de bingo con cartilla completa ('Aquí se valida que la cartilla contenga todos los numeros que se dictaron en el juego')

#### Testing 😁
- De momento los test de endpoint ``POST`` registran data en la base de datos configurada, lo ideal sería que estos test corran ya sea con data en 
  memoria o aplicar alguna arquitectura limpia que nos permita hacer unos tests mas rapidos.
- Correr el comando ```php artisan test``` para correr los test unitarios y de features
