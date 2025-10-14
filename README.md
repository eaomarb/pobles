<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Pobles
======

Proyecto web desarrollado en **Laravel** que permite gestionar y visualizar los municipios de Cataluña, incluyendo imágenes y datos asociados.

Tecnologías
-----------

*   Laravel (PHP)
*   SQLite (base de datos)
*   HTML / CSS / Blade (frontend)
*   Python (scripts de scraping usados previamente para poblar la base de datos, no necesarios para correr la web)

Funcionalidades
---------------

*   Listar municipios con su información y fotografía.
*   CRUD completo: crear, leer, actualizar y eliminar municipios.
*   Visualización de imágenes asociadas a cada municipio.
*   Gestión sencilla de los datos de la base de datos SQLite.

Instalación
-----------

1.  Clonar el repositorio:
    
        git clone https://github.com/eaomarb/pobles.git
        cd pobles
        
    
2.  Instalar dependencias de Laravel:
    
        composer install
        
    
3.  Configurar el archivo `.env` (si es necesario).  
    Para este proyecto, la base de datos SQLite ya viene incluida.
4.  Levantar el servidor:
    
        php artisan serve
        
    
5.  Abrir en el navegador:
    
        http://127.0.0.1:8000

6. Iniciar sesión con las credenciales de administrador:

- **Email:** admin@admin.admin  
- **Contraseña:** adminadmin

Base de datos
-------------

*   Archivo SQLite incluido con todos los municipios, descripciones y fotografías.
*   No se requiere configuración adicional para empezar a usar la aplicación.
