# 07. Doctrine

Características de Doctrine:
- Symfony "limpio" no tiene nada propio de acceso a base de datos
- Proporciona acceso a partir de Doctrine
- Permite mapear objetos de modelo con una base de datos

Instalación: en apuntes

*CONFIGURACIÓN DE LA BASE DE DATOS*
La configuración se realiza en el `.env` con el string de configuración.

## Comandos
- Creación de una entidad: `bin/console make:entity` y seguir poniendo las propiedades
  - Nota: con interrogante saca el manual
- Si intentamos crear una entidad existente, simplemente la modificamos

## 7.2 Transacciones
- Automáticas:
  - hasta que no llamamos al flush las persistencias no se realizan.
  - Flush es quien hace el commit de la transacción
- Manuales:
  - Se recomienda hacer de forma manual
  - al hacer beginTransaction se suspende el autocommit
  - tras el flush, tendremos que hacer el commit()
Más información en los apuntes

## 7.3 DQL
- Es parecido a SQL, pero no trabajamos con Campos y Tablas, trabajamos con Entidades y Propiedades
- Solo permite hacer `SELECT`, `UPDATE` y `DELETE`
- Los inserts se hacen con el `persist()` del `entityManager`
- Doctrine devuelve Entidades y no arrays cuando no pedimos la propiedad de un objeto
  - `SELECT u, p FROM users u... ` -> entidades
  - `SELECT u.name, p.quantity FROM users u... ` -> array de arrays

**JOINS**
las relaciones no se hacen con otra table, se administran con las propiedades de la misma entidad. Y Doctrine sabe como hacer gestionarlo

## 7.4 El objeto Doctrine Query Builder
- Es similar a DQL
- Los tipos de respuesta dependen del método accesor (array de objetos, un único objeto, escalares...)
- Revisar apuntes para ver los métodos del queryBuilder

## 7.5 Repositorios
- Extienden de `ServiceEntityRepository`. Al extender de esa clase tienen unos métodos definidos
  - find, findOneBy, findAll... (más info en los apuntes)
- El repositorio se enlaca con la entidad en la propia entidad

Las consultas, querybuilders, SQL... se hacen siempre en el repositorio.

## 7.6 Sentencias SQL Nativas
- Es recomendable utilizar DQL, pero si no nos queda más remedio, podemos ejecutar SQL Nativo
- Se debe hacer en el repositorio
- En este caso no son devueltas las entidades
- Revisión de como hacerlo en los apuntes

## 7.7 Ingeniería inversa con Doctrine
Como crear las entidades a partir de una base de datos ya creada (DB compartida, Legacy...)
- El único requisito es que todas las tablas tengan primary key 
  - excepto las many to many, estas requieren ids a las tablas que hacen referencia

Comandos:
- Generar las entidades
  - `bin/console doctrine:mapping:import App\\Namespace\\Entity annotation --path=src/Entity`
  - Estos métodos no tienen Getter y Setters, tampoco los repositorios
- Regenerar las entidades para mapear las entidades (crear getters, setters...):
  - `bin/console make:entity --regenerate App`
