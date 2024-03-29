# 02 - Variables de entorno y configuración de Symfony

La configuración de Symfony se carga con el `src\kernel.php`

## 2.1 Los archivos de configuración
La configuración se puede definir en `config`.
La configuración de cada bundle està en `packages`.
Cada archivo de configuración pueden ser `yaml`, `php` y `xml`.
La configuración general està en `config`, pero si queremos dividir la configuración en los entornos podemos añadir los archivos de configuración en la carpeta del entorno (pe. config/test) y se aplicará la configuración general + la específica.
La clave `parameters` (services.yaml), nos permite crear parámetros que podremos utilizar en otros ficheros de configuración. Por elemplo tener `locale` en `parameters` y utilizarlo luego con `%locale%` en otros archivos.

## 2.2 Los entornos y las variables de entorno
- Archivo `.env`: variables que dependen de la máquina (entorno físico). Es equivalente al parameters.yaml en versiones anteriores. En nuevas versiones, se incluye en el VCS, y no debe tener información sensible.
- Archivo `.env.dist`: NO exiesta para nuevas versiones de Symfony. En versiones anteriores es un archivo para subir como referencia al VCS.

Las variables de entorno se utilizan en las configuraciones como `%env(NOMBRE_VARIABLE)%`

El controlador "frontal" `public/index.php`. Por defecto se carga el APP_ENV del .env para definir el entorno en que se trabaja. Desde aquí se define el entorno, el modo (debug o no).

## Ejercicio 1: Configurar doctrine para utilizar una base de datos SQLite
El archivo .db debe estar dentro del directorio var de nuestra aplicación, concretamente en var/db/app.db y se añade la url al .env
`DATABASE_URL="sqlite:///%kernel.project_dir%/var/db/app.db"`

## Ejercicio 2: Crear un nuevo entorno
Crear un entorno en symfony que se llame *secreto*. Este entorno debe cargar una ruta */urlsecreta*, no disponible para el resto de entornos.

- Crear el controlador que responda las llamadas a `/urlsecreta`
- El routing es una de las excepciones en que la configuración no va a `config\packages`, tendremos que crear la carpeta `config\routes\secreto`
- Crear el archivo `routes.yaml` y añadir la ruta que gestione la petición 
- Editar el `.env` y asignar la variable `APP_ENV=` al entorno deseado (`secreto`)