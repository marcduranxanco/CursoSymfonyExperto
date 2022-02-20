# 03 - Symfony Flex
Es la herramienta que complementa a **composer** modificando los require, update y remove.
Flex complementa esas tareas simplificando los nombres de los bundles e instalando las recetas correspondientes.
Crea el archivo `symfony.lock` que es similar al `composer.lock` pero interno.

## 3.2 Las Recipes
Una recipe es el fichero `manifest.json` con diferentes secciones que indican que tiene que hacer la recipe:
- aliases: alias que tiene el bundle
- bundles: bundle que se instala y los entornos del mismo
- env: hace un echo al .env
- copy-from-recype: copia un archivo concreto
- Existen otras secciones...

Hay dos repositorios de bundles. Uno oficial funcional y con mantenimiento. El otro es funcional, pero puede no estar en 
mantenimiento.
Por defecto el segundo no está disponible a menos que ejecutemos:
`composer	config	extra.symfony.allow-contrib	true`