# Coco digital test (laravel 6)

## Requerimientos
Para instalar la aplicacion se necesita en la maquina tener instalado
* php >= 7.0 
* mysql >= 5.7
* xdebug (opcional solo para ejecutar el coverage de las pruebas)

## Instrucciones

* Clonar este repositorio en su maquina

* Ejecutar el comando **composer install** en la raiz del proyecto para descargar paquetes necesarios en la aplicación.

* Se debe crear las bases de datos en mysql "coco_digital" y "coco_digital_test".

* Para conectar la aplicacion a la base de datos creada se debe ingresar al fichero .env de la raiz y modificar las variables de coneccion de base de datos.

* Para conectar los test a la base de datos creada se debe ingresar al fichero .env.testing y modificar las variables de coneccion de base de datos.

* Una vez modificados los ficheros de enviroment se debe ejecutar el comando **php artisan config:clear** para que estos cambios sean tomados.

* Despues se debe ejecutar el comando **npm install && npm run dev** para compilar las librerias necesarias para la autenticacion de usuarios.

* Ejecutar el comando de las migraciones **php artisan migrate --seed** para generar las tablas y correr un seeder necesario para su funcionamiento.

* Usar el siguiente comando para activar las rutas de la aplicación:

 sudo php artisan serve --port=80
 
 Nota: se puede configurar con vagrant pero en caso de no tenerlo basta con ejecutar el servicio de rutas de laravel siempre y cuando la maquina cumpla con los requerimientos. 


## Pruebas

* Para correr las pruebas de la aplicación se debe estar ubicado en la raiz del proyecto y ejecurar el siguiente comando:

**vendor/bin/phpunit tests/**

Nota: En caso de querer generar el coverage ejecutar el comando 

**vendor/bin/phpunit tests --coverage-html=coverage** y abrir el archivo index.html del directorio generado coverage.
