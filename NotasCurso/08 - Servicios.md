# 08. SERVICIOS

## Novedades desde Symfony 4.1
### Servicios Ocultos
Muchas veces creamos servicios que no están pensados para ser utilizados por los programadores. Si al declarar un servicio, añadimos un punto (.) al inicio del identificador del servicio, symfony lo tratará como “Servicio oculto”.

Lo único distinto entre los servicios ocultos y el resto de servicios es que los servicios ocultos no aparecen en el listado del comando: `bin/console debug:container`

Aunque se ha creado la opción –show-hidden para mostarlos si lo necesitáramos: `./bin/console debug:container --show-hidden`

## El contenedor de Servicios
Una aplicación está llena de objetos útiles: Un objeto "Mailer" es útil para enviar correos, el "EntityManager" para hacer operaciones con las entidades de Doctrine...

En Symfony, estos "objetos útiles" se llaman servicios, y viven dentro de un objeto especial llamado contenedor de servicios. El contenedor nos permite centralizar el modo en el que los objetos son construidos. Simplifica el desarrollo, ayuda a construir una arquitectura robusta y es muy rápido.

El contenedor de servicios actúa mediante el patrón de inyección de dependencias cuando tipamos la clase en un parámetro de entrada de un controlador o de un constructor.

```php
public function index(Doctrine\ORM\EntityManagerInterface $em)
{

 }
```

El siguiente comando nos da una lista de los servicios que tenemos disponibles:
> bin/console debug:autowiring

Se puede ejecutar el comando para buscar algo específico:
> bin/console debug:autowiring cache

Pra obtener la lista completa con más detalles, tenemos otro comando:
> bin/console debug:container


NOTA: El contenedor de dependecias utiliza la técnica de lazy-loading: no instancia un servicio hasta que se pide dicho servicio. Si no se pide, no se instancia.

NOTA: Un servicio se crea una única vez. Si en varias partes de la aplicación se le pide a Symfony un mismo servicio, Symfony devolverá siempre la misma instancia del servicio.

## 8.1 El patrón de inyección de dependencias
- Los objetos no se instancian, se suministran directamente a la clase.
- La inyección de dependencias en Symfony se realiza tipando los parámetros que pide vamos a montar
- Con Symfony no necesitamos conocer los parámetros de los servicios

## 8.2 El service container (contenedor de servicios)
- Los servicios viven en el contenedor de servicios
- Gestiona y centraliza como los objetos son entregados a las distintas partes del framework
- Podemos ver los servicios con: `bin/console debug:autowiring`, `bin/console debug:autowiring cache`
- Detalle de los servicios `bin/console debug:container`

Symfony trabaja con Lazy Loading, solo instancia un servicio cuando se pide y solamente se instancia una vez

## 8.3 Creación y configuración de servicios
- Los servicios se gestionan en `config\services.yaml`

**DEFINICIÓN DEL SERVICES.YAML**

- Services: servicios de la app
  - _defaults: comportamientos por defecto
    - autowire: se encarga de la inyección de dependencias
    - autoconfigure: en true, no precisa de tags para dar de alta servicios. Con la interfaz, Symfony detectará el servicio que hay que instanciar 
    - public: en false (recomendado), evita que se puede acceder al contenedor de servicios `$container->get()`
  - App\: Corresponde al namespace
    - resource: incluye los archivos que serán considerados servicios
    - exclude: excluye a los controladores dentro de estas carpetas
    - tag: etiqueta para identificar el servicio
    - arguments: define los argumentos de los servicios. Si un servicio necesita otro servicio no hace falta registrarlo, de lo contrario (necesitamos valores), es necesario indicarlo en el arguments. **Importante**: los arguments se pueden parametrizar, si ponemos el valor entre % (ej. %param%), se tomara del params.yaml
  
### Registrar varios servicios con la misma clase
En caso de necesitar un servicio varias veces, instanciado de forma diferente, solo tenemos que configurar el servicio con un _identificador_ de servicio diferente. Podremos seleccionar uno u otro en función del identificador.

# Práctica 8.1
Enunciado
¿Cómo configurarías el fichero services.yaml para que la aplicación se comporte como sigue?

- Que los Repositorios y los Formularios no se consideren servicios
- Que haya que registrar los servicios especiales que requieren especificar una tag, como commandos, subscribers, extensiones de twig, etc.

