####################
Tipos de instalación
####################

.. _instalacion-distribuida:

***********************
Instalación distribuida
***********************

IvozProvider está diseñado para que la mayor parte del software trabaje de manera distribuida en lo que llamamos perfiles.

Cada perfil es encargado de realizar una de las funciones de la plataforma:

    * Data storage
    * SIP Proxy
    * Application Server
    * Web portal

Para cada uno de estos perfiles existe un paquete virtual que instalará todas las dependencias necesarias (ver :ref:`instalando-paquete-virtual`).

Puedes instalar cuantas instancias desees de cada perfil, pero ten en cuenta que, mientras algunos estan pensados para escalar horizontalmente de manera nativa (por ejemplo: asterisk o media-relays) otros requerirán software adicional para que las máquinas del mismo perfil esten coordinadas (por ejemplo: replicación de bases de datos o balanceo de peticiones web).

.. _instalacion-standalone:

**********************
Instalación standalone
**********************
Pero si lo que deseas es tener una plataforma pequeña para realizar tus pruebas o dar un servicio básico, hemos diseñado todas las configuraciones para que puedan convivir en una sola máquina.

Hemos bautizado este tipo de instalaciones como **StandAlone** y hemos creado `CDs automáticos de instalación <https://github.com/irontec/ivozprovider>`_ para que puedas instalarlos en un par de minutos (ver :ref:`instalacion-cd`).

