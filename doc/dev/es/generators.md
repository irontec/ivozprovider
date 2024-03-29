# Generadores

Tal y como pasaba en la versión anterior de Ivoz Provider, existe un conjunto de generadores diseñados
para evitar la creación/actualización manual de código automatizable a partir del esquema de base de datos (ficheros de 
mapeo a base de datos a partir de ahora). Consulté la sección migrations antes de continuar si no lo ha hecho aún.

Estos son los comandos disponibles actualmente:

    irontec@artemis-dev-alt:/opt/irontec/ivozprovider/schema$ bin/console | grep ivoz
    ivoz:commandlog:show                       Show entity change history
    ivoz:make:entities                         Creates or updates a Doctrine entity classes
    ivoz:make:interfaces                       Creates or updates a Doctrine entity classes
    ivoz:make:repositories                     Creates or updates a Doctrine repository classes
    ivoz:update:service_collections            Updates binded services of service collections

Tenga en cuanta que el orden en el que se ejecután los distintos comandos importa. Si elimina un atributo requerido
de la entidad, está no cumplirá el contrato con su interfaz y no será instanciable hasta que esto sea corregido
manualmente.

Para evitar errores, existe un pequeño script de shell que ejecuta los distintos generados en un orden concreto
que busca minimizar errores:

    irontec@artemis-dev-alt:/opt/irontec/ivozprovider/schema$ bin/run-generators Ast Kam Cgr Provider

Este script requiere al menos un argumento.

## CoreBundle
CoreBundle es el modulo encargado de hacer de pegamento entre la lógica de negocio y el framework. Entre otras cosas,
registra las entidades:

- `library/composer-packages/irontec/ivoz-provider-bundle/Resources/config/orm_target_entities.yml`:
  Dado que uno de los objetivos de la versión 2 de Ivoz Provider consiste en poder extender/modificar/reemplazar todo
  tipo de unidades lógicas, verás que todas las relaciones y referencias a entidades se hace a traves de abstracciones
  (interfaces). Esto permite definir las implementaciones concretas (clases) a utilizar en una instalación dada
  vía configuración, teniendo estas como requisito único cumplir con el contrato definido en dicha interfaz.
  Este fichero contiene el mapeo interface-entidad. Recuerde registrar toda nueva entidad creada o no será posible
  hacer uso de ella.

## Ficheros generados
Tomando la entidad Brand como ejemplo, encontraremos los siguientes ficheros:

    ../library/Ivoz/Provider/Domain/Model/Brand
    ├── BrandAbstract.php
    ├── BrandDtoAbstract.php
    ├── BrandDto.php
    ├── BrandInterface.php
    ├── Brand.php
    ├── BrandRepository.php
    ├── BrandTrait.php
    ├── Invoice.php
    └── Logo.php


`BrandAbstract` es creada a partir del fichero de mapeo `Brand.BrandAbstract.orm.yml`. Se trata de una clase abstracta.

`BrandTrait.php` es creada a partir del fichero de mapeo `Brand.Brand.orm.yml`.

`Logo.php` es creada a partir de `Brand.Logo.orm.yml`

`Brand.php` contiene lógicas de negocio añadidas manualmente, este fichero no se modifica por los generadores.

`BrandInterface.php` es la interface de Brand, toda clase que quiera reemplazar la implementación por defecto de Brand
deberá implementarla.

`BrandDto.php` es un objeto sin lógica de negocio que únicamente contiene valores. Su función es la de
transportar datos entre procesos y evitar la necesidad de sacar la entidad de la capa de lógica de negocio.
A diferencia de las entidades, que deben garantizar un estado consistente de datos, este objeto no realiza
validaciones de ningún tipo.

`BrandRepository.php` es la interface que debe recoger todos los métodos de accesos a la entidad.
