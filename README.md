<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Pokedex
### Empezando
Estas instrucciones le proporcionarán una copia del proyecto en funcionamiento en su máquina local para fines de desarrollo y prueba.

### Requisitos previos

Necesitará instalar:

* Git.
* PHP v8.2.4
* Composer v2.5.8
* Laravel Framework 10.19.0
* Apache.
* Un administrador de paquetes de Node ( npm or yarn ).

### Instalar
Clona el repositorio de git en tu computadora

```$ git clone https://github.com/cesarva10/pokedex```

También puede descargar el repositorio completo como un archivo zip y descomprimirlo en su computadora si no tiene git

Después de clonar la aplicación, debe instalar sus dependencias.

```
$ cd pokedex
$ composer install
```

### Configuración
- Copiar el archivo `.env.example` y renombrarlo por `.env`
  ```$ cp .env.example .env```

- Generar la clave de la aplicación
  ```$ php artisan key:generate```

- Agregue las credenciales de su base de datos a los campos `env` necesarios

- Agregue las credenciales para el envío de correos a los campos `env` necesarios

- Migrar la base de datos
  ```$ php artisan migrate```

- Instalar modulos de Node
  ```$ npm install```

- Instalar Tailwindcss
  ```$ npm install -D tailwindcss```

- Instalar Flowbite
  ```$ npm install flowbite```

- Instalar Moment
  ```$ npm install moment```

- Instalar Axios
  ```$ npm install axios```
  
### Run the application

  ```$ npm run dev```
  ```$ php artisan serve```