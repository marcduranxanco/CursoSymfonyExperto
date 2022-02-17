# 01 - Empezando con Symfony

Además de a través de composer, se pueden crear aplicaciones Symfony mediante un instalador propio: https://symfony.com/download
Para crear un proyecto con una versión de symfony concreta se debe utilizar la siguiente sintaxis:
- composer create-project symfony/website-skeleton:^4.4 my_project_name
- symfony new my_project_name --version=4.4 
- composer create-project symfony/website-skeleton my_web

Aplicación sin interfaz (API, Comandos, Microservicio) sin los Twig
- composer create-project symfony/skeleton:^4.4 my_project_name

## Cuando acaba da algunas indicaciones sobre como realizar ciertas acciones:
Arrancar servidor:
- Cambiar al directorio
- php -S 127.0.0.1:8000 -t public

## Ejecutar servidor propio de Symfony
Tiene un listener que espera los cambios en el proyecto:
- bin/console server:run

# Estructura de directorios
- `.env`: variables de entorno

- `src`: Los directorios con los ficheros de desarrollo. Nota: En Symfony 4 desaparece el bundle de la aplicción, de esta manera, `templates`, `assets`, `config`, està fuera de `src`. Dejando src libre para ficheros de desarrollo.
- `templates`: carpeta con los twigs.
- `tests`: tests de la app
- `tanslations`: traducciones
- `config`: configuración
- `assets`:
- `public`:


# Ejercicio 1.1 Diferencias entre 

- Crear un proyecto website-skeleton y otro proyecto skeleton. Escribe las diferencias observadas entre los dos proyectos.

De entrada, la diferencia a simple vista es que la estructura de directorios al ejecutar el create project con `symfony/skeleton` es más simple que al correr `symfony/website-skeleton`.
Skeleton pierde, entre otros, _twig_, _Doctrine_, _Monolog_... de esta manera, desaparecen carpetas como `templates` o `migrations`.
Al revisar en profundidad y comparando los `package.json`, podemos ver que *skeleton* es una versión con los paquetes mínimos para iniciar la aplicación. En caso de ser necesario se tendrán que añadir las diferentes dependencias explicitamente de forma manual.
*Website-skeleton* se asemeja más a las instalaciones standard de symfony en versiones 2 o 3.