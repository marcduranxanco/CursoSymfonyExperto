# 06 - Controladores

## 6.1 Manejo de exepciones
Al lanzar exepciones:
- En modo debug: muestra la pantalla de error
- En "NO" debug: muestra un error 500

*PAGINAS 404*
También podemos personalizar las páginas 404. Por ejemplo, cuando un elemento no exista (siguiendo los estándares).
Symfony permite ejecutar modificar las páginas 404 extendiendo los el template bundle de twig. Symfony busca las plantillas con nombre `errorXXXX.formato.twig` o una pantalla de error genèrica.

*VISUALIZAR PÁGINAS DE ERROR*
Se pueden visualizar páginas de error con las rutas especiales de twig (apuntes).

## 6.2 Sesiones en Symfony
Es necesario activar las sesiones en el framework.yaml (tiene que estar descomentada)
Para accceder tenemos que acceder a la SessionInterface y utilizar los métodos correspondientes.
Al objeto session se puede acceder desde Twig con `app.session` (tiene los mismos métodos que el SessionInterface)

## 6.3 Mensajes Flash
Son claves de sesión que se eliminan al leerlos (utilizados por ejemplo para mostrar notificaciones)

## 6.4 Objeto Request
Objeto para obtener toda la info de la petición.
Tiene multiples métodos para hacer diferentes acciones (revisar apuntes):
- Obtener variables globales
- Obtener información del archivo subido
- Lectura de cookies...
Es mala práctica acceder directamente a las variables globales ($_SERVER...) por seguridad...

## 6.5 Objeto Response
Un controlador, siempre tiene que acabar haciendo un return de un objeto response.
Al igual que Request, Response tiene multiples métodos que definen la respuesta (revisar apuntes).

*RENDER DE PLANTILLAS*
Cuando estamos renderizando plantillas hacemos `$this->render()` que, internamente, crea un objeto response.

*OTRAS RESPONSE*
Hay otras response (extienden de response) que construyen distintas response (Redirect, Json, Binary...).
Además si extendemos de Controller o AbstractController, tendremos funciones helper para construir responses (revisar apuntes).
