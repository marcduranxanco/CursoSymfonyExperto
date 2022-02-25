# 05 - El sistema de plantillas Twig

## 5.1 - Output escaping
Cuando se genera HTML desde una template, hay siempre un riesgo de que una variable de una template muestre contenido 
HTML no intencionado o código peligroso por parte de terceros. En las plantillas Twig el output escaping está activado
por defecto.
En algunos casos puede ser necesario desactivar output escaping para renderizar una variable en la que se confía y 
contiene lenguaje de marcado que no ha de escaparse. Para esto simplemente se añade la etiqueta raw:
`{{ varName|raw }}`

Podemos desactivar el autoescaping de forma global desactivando en el archivo de configuración (app/config/config.yml) 
el key autoescape.

## 5.2 - Cómo utilizar PHP en vez de Twig como sistema de plantillas
Es posible cambiar el sistema de plantillas de Twig a Php o incluso convivir los dos sistemas de plantillas.
- Hay que instalar templating (`composer require templating`)
- Cambiar la key `framework.templating.engines` a `['twig', 'php']`
- Toda la info en los apuntes.

## 5.3 Cómo depurar variables en las plantillas
Para depurar variables tenemos que tener instalado el `composer require var-dumper`
Este crea la funcion `dump($variable);` que muestra en la barra de depuración (barra de Symfony con objetivo)
Para usarlo en Twig:
- se coloca como {% dump variable %} (se renderiza en la barra de depuración).
- {{ dump(variable) }} (hace un print dónde lo escribimos).

Solo está disponible en `dev` y `test`.

## 5.4 Cómo generar otros formatos de salida (css, javascript, xml…)
El formato .twig, es independiente de su extensión. Es decir en `show.html.twig`, el `.html` solamente es una referencia.
En el controlador, haremos la llamada al path con el slug y el formato (_format) de la misma.

Dentro de un Twig, todas sus opciones son válidas para todas las extensiones (extension, dumps, corchetes...)

## 5.5 Cómo inyectar variables globales
Para crear variables disponibles en toda la aplicación, tenemos que declararlas en la sección `globals` dentro del fichero
config de Twig. Después se puede utilizar como una variable normal.
El fichero de configuración se puede parametrizar para utilizarlo como '%parametro_parametrizado%' en `services.yml`.
Las variables globales pueden ser un servicio con '@RutaServicio'. Hay que tener en cuenta que este servicio no se cargará 
como Lazzy, es decir, tan pronto como se cargue Twig el servicio se instanciará. 

## 5.6 Sobrescribir plantillas de bundles de terceros
A la hora de sobreescribir bundles de terceros, solo tenemos que copiar el archivo del bundle en la carpeta templates/bundles
de nuestra app pero copiando la ruta del bundle. Necesitaremos cambiar la caché.

## 5.7 Crear plantillas sin controladores
Para renderizar un Twig, (sin crear con un "controlador vacío"), tenemos que definir una ruta que llame
al TemplateController propio de Symfony con el parámetro que indica el template.
Podemos añadir además los parámetros `maxAge` y `sharedAgep` para indicar que se tiene que cachear la página.

```
route_twig_static:
    path: /estatico
    controller: Symfony\Bundle\FrameworkBundle\Controller\TemplateController::templateAction
    defaults:
        template: path/to/template.html.twig
```

## 5.8 Cómo crear una extensión de Twig
Las extensiones de Symfony tenemos que ejecutar `composer require twig/extensions`.
La idea es:
- Tener un controlador que se encarga de la lógica
- Crear la clase que extienda de AbstractExtension (Por ejemplo en src/Twig)
- Crear un método en la clase que haga la lógica que queremos aplicar
  - Recibiendo los valores que se necesiten y devuelvan otro valor
- Declarar los métodos como extensiones
  - Creando la extensión `getFilters()` que define los filtros
- Registrar la clase como una extensión de Twig
  - Si en `services.yaml` tenemos el `autoconfigure=true` no hace falta registrarlo
  - Como estas extensiones son servicios, podemos inyectar otros servicios (DI). El problema es que siempre se cargarán todas las dependencias al iniciar el servicio de Twig y puede sobrecargar la aplicación

Para cargas las extensiones en Lazy lo podemos hacer de la siguiente manera:
- Sacar la lógica de las extensiones a otra clase
- Indicar correctamente la clase en el getFilters
- Registrar la extensión en el `services.yaml` con el tag `twig.nombreClase`

## Practica 5.1

Escribir un filtro de twig que calcule el tiempo transcurrido (tt) desde una fecha dada.

La forma de usar el filtro será

{{ variablefecha | tt }}
Este filtro debe transformar la diferencia entre la fecha actual y la fecha dada en strings de la forma que sigue:

Diferencia < 1 minuto => ‘Ahora’
1 minuto <= diferencia < 1 hora => ‘Hace X minutos’
1 hora <= diferencia < 1 día => ‘Hace X horas’
1 día <= diferencia < 1 mes => ‘Hace X días’
1 mes <= diferencia < 1 año => ‘Hace X meses’
1 año <= diferencia => ‘Hace X años y Y meses’
Siendo X la cantidad de tiempo correspondiente.

A continuación tienes la solución para que puedas descargarla, pero te recomendamos que intentes realizarlo por ti mismo antes.