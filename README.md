# Microservicio de Posts (PRY_POST_MICROSERVICIO) – Grupo 3

Proyecto desarrollado en **Laravel 12** como parte de la materia **Arquitectura de Software**.  
Este microservicio implementa un **CRUD completo de Posts**, utilizando **PostgreSQL** como base de datos y validando el acceso mediante el token emitido por el microservicio de autenticación (**PRY_AUTENTICACION_MICROSERVICIO**).

Este servicio solo permite operaciones CRUD si el token enviado es válido, consumiendo el endpoint `/api/validate-token` del microservicio de autenticación.  
Además, aplica buenas prácticas de **microservicios**, comunicación entre sistemas y separación de responsabilidades.

---

## Objetivos del Proyecto

Implementar un microservicio independiente responsable de la **gestión de publicaciones**, que:

- Administre Posts mediante un CRUD completo.
- Se comunique con el microservicio de autenticación usando API REST.
- Valide el token enviado por el usuario antes de permitir cualquier operación.
- Aplique un middleware personalizado (**CheckAuthToken**) para verificar tokens.
- Utilice **PostgreSQL** como base de datos.

Este microservicio depende del servicio de autenticación, pero permanece completamente separado a nivel de código y base de datos.

---

## Requerimientos Previos

Antes de ejecutar el proyecto tener instalado:

- PHP 8.2.12  
- Composer  
- Laravel 12  
- PostgreSQL
- Node.js  
- Postman (Pruebas del API)

---

## Configuración

Instalar Guzzle si no está instalado:

- composer require guzzlehttp/guzzle

Luego se creó:
- php artisan make:controller Api/PostController --api --model=Post
- php artisan make:model Post -m
- php artisan make:middleware CheckAuthToken

**Importante**
Solo ejecutar esos comandos si se crea un proyecto desde cero, si se clona desde el repsitorio de GitHub no es necesario ejecutarlos.

---

## Instalación del Proyecto

1. Clonar el repositorio desde GitHub:
    - git clone https://github.com/EderJAndrade/pry_post_microservicio.git

2. Ingresar al directorio del proyecto:
    - cd pry_post_microservicio

3. Instalar las dependencias de Laravel:
    - composer install

4. Copiar el archivo de entorno y configurarlo:
    - cp .env.example .env

5. Generar la clave de aplicación:
    - php artisan key:generate

---

## Configuración de la Base de Datos

1. Crear la base de datos en MySQL:
    - CREATE DATABASE pry_posts_grupo3;
    - CREATE USER post_g3_user WITH ENCRYPTED PASSWORD 'PostG3!';
    - GRANT ALL PRIVILEGES ON DATABASE pry_posts_grupo3 TO post_g3_user;


2. En el archivo .env configurar la conexión:
    - DB_CONNECTION=pgsql
    - DB_HOST=127.0.0.1
    - DB_PORT=5432
    - DB_DATABASE=pry_posts_grupo3
    - DB_USERNAME=post_g3_user
    - DB_PASSWORD=PostG3!

---

## Migraciones

Ejecutar las migraciones con:
- php artisan migrate:fresh --seed  

Este comando limpia y vuelve a crear todas las tablas.

---

## Estructura del Proyecto

app/Http/Controllers/Api/
- PostController.php

app/Http/Middleware/
- CheckAuthToken.php

app/Models/
- Post.php

database/migrations/
- create_posts_table.php

routes/
- api.php

bootstrap/
- app.php

---

## Endpoints Principales (API)

Iniciar el proyecto con el comando:
- php artisan serve

**En Postman**

## **Crear un nuevo Post**
- **POST** /api/posts

*Headers*
- Authorization: Bearer COPIAR_TOKEN

**EJEMPLO**
- Authorization: Bearer 1|lbOAWBGwDqHKvE8rzI0vO8UgGKwvgCtt6WTzWzu5a651ea62

*Body - raw - JSON*

{
    "titulo": "Primer Post",
    "contenido": "Contenido del post",
    "publicado": true
}

**Listar Posts**
- **GET** /api/posts

*Headers*
- Authorization: Bearer COPIAR_TOKEN

**Actualizar Posts**
- **PUT** /api/posts/{id}

*Headers*
- Authorization: Bearer COPIAR_TOKEN

*Body - raw - JSON*

{
    "titulo": "Titulo actualizado del Post",
    "contenido": "Este es el contenido actualizado del post",
    "publicado": true
}

**Eliminar Posts**
- **PUT** /api/posts/{id}

*Headers*
- Authorization: Bearer COPIAR_TOKEN

---

## Autores

**Universidad de las Fuerzas Armadas ESPE** 

**Grupo 3 - Arquitectura de Software**  
- Aguilar Mijas Laura Estefanía  
- Andrade Alvarado Eder Jonathan  
- Bucay Pallango Carlos Avelino  
- Cisneros Cárdenas Freddy Gabriel  
- Pita Clemente Karina Annabel   

Docente: *Vilmer David Criollo Chanchicocha*  

**2025**