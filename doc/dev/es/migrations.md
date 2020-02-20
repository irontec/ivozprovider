# Gestión de migraciones de base de datos

La aplicación de gestión de deltas de base de datos se encuentra alojada en el directorio ivozprovider/schema.
Se trata de una aplicación completa symfony, requiere por tanto que sus dependencia sean resultas vía composer,
`composer install`, para su correcto funcionamiento.

Las credenciales de acceso a base de datos son compartidas con el resto de applicaciones symfony y están definidas en
vendor/irontec/ivoz-provider-bundle/Resources/config/parameters.yml

## Proceso de creación de deltas de base de datos
Para hacer cambios en base de datos el proceso es el siguiente:

    1 - Cambiar los ficheros de mappeo
    2 - Crear un delta de base de datos
    2 - Regenerar entidades (ver generators.md)

## Ficheros de mapeo
Ficheros de mappeo entidad - base de datos:
Las entidades se encuentran en la directorio ivozprovider/library/Ivoz divididas en los sub-directorios
Ast, Kam y Provider. Existe además un directorio adicional llamado `Core` que contiene clases comunes a todos ellos. 
Con el fin de separar la lógica de negocio del esquema de base de datos, se hace uso de ficheros independientes de mapeo
[yml](http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/yaml-mapping.html) . Estos están
alojados en ivozprovider/library/Ivoz/*/Infrastructure/Persistence/Doctrine/Mapping y hay un mínimo de dos ficheros
por entidad.

Si tomamos como ejemplo la entidad Brand dentro de Provider encontraremos los siguiente ficheros de mapeo:

     - ivozprovider/library/Ivoz/Provider/Infrastructure/Persistence/Doctrine/Mapping/Brand.BrandAbstract.orm.yml
     - ivozprovider/library/Ivoz/Provider/Infrastructure/Persistence/Doctrine/Mapping/Brand.Logo.orm.yml
     - ivozprovider/library/Ivoz/Provider/Infrastructure/Persistence/Doctrine/Mapping/Brand.Brand.orm.yml

Siendo los objetos mapeados:

    - ivozprovider/library/Ivoz/Provider/Domain/Model/Brand/BrandAbstract.php
    - ivozprovider/library/Ivoz/Provider/Domain/Model/Brand/Logo.php
    - ivozprovider/library/Ivoz/Provider/Domain/Model/Brand/Brand.php

`Brand.BrandAbstract.orm.yml` es la representación "1:1" de la tabla de base de datos salvo su id. No permite
definir relaciones inversas (oneToMany) como puede ser brand -> companies. Es posible agrupar campos en modelos propios
si se desea: Logo por ejemplo. Dado que la finalidad de las entidades es evitar estados inconsistentes en el
dataset y en entidades grandes esto puede resultar en clases enormes, dividir la entidad en unidades lógicas
más pequeñas (value objects) está considerado una buena práctica.

`Brand.Brand.orm.yml` contiene el id de la entidad, las relaciones inversas (brand -> companies) y la referencia al
repositorio de la misma. Por motivos de rendimiento es recomendable no definir relaciones inversas de las que la
aplicación no hace uso. El repositorio es la clase mediante la cual se harán las operaciones de lectura sobre la
entidad en cuestión. las modificaciones realizadas sobre este fichero (id aparte) no generan cambios en base de datos.

### Enlaces de interés
 - http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/types.html

## Generar un nuevo delta
Una vez realizadas la modificaciones oportunas, ejecute el siguiente comando para crear el delta de base de datos:

    irontec@artemis-dev-alt:/opt/irontec/ivozprovider/schema$ bin/console doctrine:migrations:diff
    Generated new migration class to "/opt/irontec/ivozprovider/schema/DoctrineMigrations/Version20171009074016.php" from schema differences.

Una vez generado, es perfectamente posible realizar modificaciones manuales sobre él.

## Consultar el estado de los delta

    $ bin/console doctrine:migrations:status

     == Configuration

        >> Name:                                               Application Migrations
        >> Database Driver:                                pdo_mysql
        >> Database Name:                                ivozprovider
        >> Configuration Source:                        manually configured
        >> Version Table Name:                          migration_versions
        >> Version Column Name:                       version
        >> Migrations Namespace:                      Application\Migrations
        >> Migrations Directory:                          /opt/irontec/ivozprovider/schema/DoctrineMigrations
        >> Previous Version:                               2017-09-14 11:00:36 (20170914110036)
        >> Current Version:                                2017-09-18 16:04:22 (20170918160422)
        >> Next Version:                                     2017-10-09 07:40:16 (20171009074016)
        >> Latest Version:                                   2017-10-09 07:40:16 (20171009074016)
        >> Executed Migrations:                         4
        >> Executed Unavailable Migrations:       0
        >> Available Migrations:                          5
        >> New Migrations:                                 1

## Aplicar deltas pendientes
    $ bin/console doctrine:migrations:migrate

## Volver a un delta dado
    $ bin/console doctrine:migrations:migrate deltaDatetime

## Verificar que esquema y mapeo están sincronizados:
    $ bin/console doctrine:schema:update --dump-sql

En caso de estar sincronizado, el resultado será vacío.
