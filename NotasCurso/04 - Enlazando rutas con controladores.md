# 04 - Enlazando rutas con controladores

## **DEBUG ROUTES**
## 4.4 Herramientas de Depuración de rutas
Desde la consola existen varios comandos disponibles para la deputación de rutas
- `bin/console debug:router`: lista todas las rutas
- `bin/console debug:router route_name`: muestra toda la info de una ruta en concreto (incluida la expresión regular)
- `bin/console router:match /url/to/match`: encuentra la ruta con la que hace match

## **PARÁMETROS**
## 4.1 Restricción de los valores de los parámetros
- Las rutas pueden ser restringidas desde el routes.yaml con los `requirements` dónde se puede elegir el parámetro y hacer el match correspondiente:
- Podemos dar valores por defectos a un parámetro
- Podemos añadir parámetros extra que no aparezcan en la ruta pero llega al controlador 

Ejemplo:
```
routes.yaml
... 
route_one:
  path: /path/one
  defaults: {_controller: App\Controller\ControllerQueGestionaLaPetición:método, param1: 1, param3: 'Este param viene directo'}
  #En los defaults el parámetro 1 tiene el valor por defecto 1. El param3, viene directo aunque no venga en la url.
  requirements: # Resrticción de parámetros
    param1: '\d+' # Restringido a números
    param2: 'es|fr' # Restringido a español y francés
...
```

## 4.2 Parámetros especiales
Symfony tiene 4 parámetros especiales:
- _controller: utilizado en todas las rutas (defaults). Es el controlador al que llama la ruta
- _locale: establece el idioma de la aplicación. Para tomar las traducciones de ese locale
- _format: establece el formato del a request
- _fragment establece el fragment de la url (la parte tras la almuadilla)

Ejemplo:
```
routes.yaml
... 
route_two:
  path: /path/one.{_format}
  defaults: {_controller: App\Controller\ControllerQueGestionaLaPetición:método}
  requirements:
    _format: 'html|json|csv' #Formatos aceptados
...
```

## **REDIRECCIONES**
## 4.3 Redirecciones
Hay varias maneras de crear redirecciones en Symfony:
- Creando la ruta y utilizando el controlador `Symfony\Bundle\FrameworkBundle\Controller\RedirectController::urlRedirectAction` añadiendo con sus dos parámetros necesarios (defaults.path y defaults.permanent)
- A una ruta por nombre llamando al controlador `Symfony\Bundle\FrameworkBundle\Controller\RedirectController::redirectAction`

Ejemplos
```
routes.yaml
... 
redir_with_path:
  path: /
  defaults: {_controller: Symfony\Bundle\FrameworkBundle\Controller\RedirectController::urlRedirectAction}
  defaults:
    path: /other/route
    permanent: true
    
redir_with_route_name:
  path: /
  defaults: {_controller: Symfony\Bundle\FrameworkBundle\Controller\RedirectController::redirectAction}
  defaults:
    route: route_name
    permanent: true
...
```

## **RESTRICCIONES**
## 4.5 Restricción de rutas por Host
Podemos restringir las rutas por el host que la llama. De esta manera podemos tener un `/home` para **web.site.com** y 
otro `/home` para **proyecto1.site.com**.
También podemos hacer requirements en el subdomino, de esta manera hacer que `proyectoX` sea un parámetro y que pueda cambiar.

Ejemplo
```
routes.yaml
... 
# Ruta para proyectos. Tiene que estar encima de la ruta home principal, por el orden de las rutas
# Tenemos el host: que indicará que proyecto llegará: project1.site.com
# Project_name: solo podrá llegar project1, project2.... 
projects_homepage:
  path: /
  controller: App\Controller\ControllerQueGestionaLaPetición:projectMétodo
  host: '{project_name}.site.com'
  requirements:
    project_name: 'project1|project2|project3'

# Homepage principal
homepage:
  path: /
  controller: App\Controller\ControllerQueGestionaLaPetición:método
...
```

## 4.6 Restricción de rutas por método
A la hora de restringir por método, únicamente tendremos que añadir la sección `methods` que recibe un array de métodos
permitidos.

Ejemplo:
```
routes.yaml
... 
route_two:
  path: /path/one.{_format}
  defaults: {_controller: App\Controller\ControllerQueGestionaLaPetición:método}
  methods: [PUT,POST] #Solo permitiría put y post
...
```

## 4.7 Restricción de rutas por protocolo
Finalmente también podemos restringir por protocolo (esquema). Añadiendo la sección `schemes` que recibe un array con
el esquema al que está restringido: `schemes: [https]`
Lo que hace Symfony es cambiar al esquema que hemos añadido.
Esta restricción también se puede hacer con el componente seguridad.

## **CREACIÓN URL**
## 4.8 Generación de urls
Si necesitamos es obtener/generar un enlace en texto (en el código, no en el Twig) hacemos lo siguiente:
`$this->genereateUrl()` perteneciente a la clase base AbstractController
- `$this->genereateUrl('route_name')`
- `$this->genereateUrl('route_name', ['argument1' => 3, 'queryArgument' => 'foo'])` # Crea una ruta añadiendo el argumento de la ruta, si el argumento no está en la ruta lo mete como un query string (../3/?queryArgument=foo)
- `$this->genereateUrl('route_name', ['argument1' => 3, 'queryArgument' => 'foo'], UrlGeneratorInterface::MODE_DESEADO)` # Tercer argumento es el modo de generación de la ruta (para que salga toda la ruta, solo una parte....)
