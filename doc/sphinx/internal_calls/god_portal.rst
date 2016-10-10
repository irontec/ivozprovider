************************
Bloque 'Gestión General'
************************

.. important:: Cualquiera de las 2 IPs públicas configuradas en la instalación servirá para acceder al panel web. Las credenciales por defecto son *admin / changeme*.

En esta sección haremos referencia a todo lo relativo al rol operador global, configurable en el bloque **Gestión general** del panel web (solo visible para God):

.. image:: img/bloque_god.png
    :align: center

Configuración personalizada en la instalación
=============================================

En el proceso de instalación se pregunta al administrador dos direcciones IP, con el fin de arrancar los siguientes 2 procesos:

.. _proxyusers:

Proxy de Usuarios
-----------------

Es el proxy SIP expuesto al mundo exterior al que se registran los terminales de los usuarios.

El valor mostrado en la sección **Proxy de Usuarios** reflejará la IP introducida en el proceso de instalación.

.. image:: img/proxyusers.png

Proxy de Salida
---------------

Es el proxy SIP expuesto al mundo exterior al que hablarán los Operadores IP con los que el operador de marca decida hacer *peering*.

El valor mostrado en la sección **Proxy de Salida** reflejará la IP introducida en el proceso de instalación.

.. image:: img/proxytrunks.png

.. note:: Solo se explicita la dirección IP, ya que el puerto siempre será 5060 (5061 para SIP sobre TLS).

.. danger:: Estos 2 valores pueden editarse desde la web, pero siempre tienen que tener la dirección IP a la que escuchan dichos procesos.

Configuración global estándar
=============================

El proceso de instalación incluye otros valores globales que son iguales en toda instalación de IvozProvider (standalone) y que también se pueden ver desde la interfaz web.

Servidores de aplicación
------------------------

En la sección **Servidores de Aplicación** se listan las direcciones IP donde escuchan los distintos Asterisk que componen la solución que, tal y como se ha mencionado, escalan horizontalmente para adaptarse a la carga de la plataforma.

A diferencia de los Proxies, estos Asterisk no están expuestos al exterior, por lo que en una instalación standalone solo habrá uno y escuchará en 127.0.0.1.

.. image:: img/app_servers.png

.. note:: El puerto en el que escuchan no se recoge en el campo, ya que siempre será 6060 (UDP).

.. important:: Desde el momento en el que se añade otro Servidor de Aplicación, se intentará contar con él a la hora de repartir la carga. Si éste no responde, se desactivará automáticamente.


Servidores de Media
-------------------

Los media-relays son los que mueven el tráfico RTP en una llamada establecida y, al igual que ocurre con los Servidores de Aplicación, permiten un escalado horizontal para adaptarse a la carga de la plataforma.

Los media-relays se organizan en grupos con el fin de poder asignar un grupo concreto a una empresa concreta. Cada elemento del grupo tiene una **métrica** que permite repartos de carga desiguales dentro de un mismo grupo (e.g. media-relay1 métrica 1; media-relay2 métrica 2: media-relay2 gestionará el audio del doble de llamadas que media-relay1). 

.. hint:: La asignación de grupos de media-relays concretos a empresas concretas permite asignar recursos estáticos a empresas que requieren tener garantizado unos recursos concretos. Pero, lo más útil de este tipo de configuración es que estos **grupos de media-relays pueden estar en ubicaciones geográficas cercanas al emplazamiento de la empresa** (y lejanas al resto de la plataforma) para **reducir las latencias** en sus conversaciones.

En una instalación standalone, no obstante, solo existe un grupo de media-relays:

.. image:: img/media_relay_groups.png

Por defecto, este grupo solo contiene un media-relay:

.. image:: img/media_relays.png

.. note:: La dirección que aparece es la dirección del socket de control, no la dirección que se acaba incluyendo en los SDPs de negociación de sesión. Por defecto, este único media-relay utiliza la misma IP que el Proxy de Usuarios.

.. _god_sipdomains:

Dominios SIP
------------

En la sección **Dominios** se muestran los dominios SIP que apuntan a las 2 IPs públicas:

- IP de Proxy de Usuarios
- IP de Proxy de Salida

Tras una instalación inicial existen 2 dominios, uno para queda una de esas 2 IPs:

.. image:: img/domain_list_local.png

Estos dominios se utilizan internamente y el servidor de DNS incorporado en la solución los resuelve a las IPs concretas.

.. attention:: Tal y como se verá en la sección :ref:`domain_per_company`, cada compañía necesitará un DNS que apunte a la IP del Proxy de Usuarios. Una vez configurado, el dominio aparecerá en esta sección para que el operador global sepa los dominios configurados para cada empresa de un vistazo.

Emular la marca Demo
====================

Tras la instalación inicial, la plataforma incluye una marca pre-creada llamada DemoBrand, que es la que utilizaremos para el fin que nos ocupa: tener 2 teléfonos registrados y que se puedan llamar entre sí.

Antes de pasar a la siguiente sección, es importante entender el concepto de **Emular una marca**:

- Como operador global, tienes acceso al bloque **Gestión general**, que solo ve *God*.

- Aparte de ese bloque, también ves los bloques **Configuración de marca** y **Configuración de empresa** que tienen este aspecto:

.. image:: img/emular_marca_prev.png
    :align: center

- Atención especial al siguiente botón:

.. image:: img/emular_marca.png
    :align: center

- Una vez pulsado, muestra una ventana flotante tal que:

.. image:: img/emular_marca2.png
    :align: center

- Al seleccionar la marca DemoBrand, el icono cambia y muestra la marca que se está emulando:

.. image:: img/emular_marca3.png
    :align: center

- La parte superior derecha de la página también muestra la marca que se está emulando:

.. image:: img/emular_marca4.png
    :align: center

¿Qué implica esta emulación?
----------------------------

Que **todo lo que se ve en el bloque 'Configuración de marca' es relativo a esa marca** y es *exactamente* lo mismo que lo que ve el operador de marca cuando entra con sus credenciales de acceso.

.. tip:: Decir exactamente es mucho decir, ya que el operador global ve campos en ciertas secciones del bloque **Configuración de marca** que el operador de marca no ve. e.g. Al editar una empresa *God* ve 'Servidores de media' y 'AS', que el operador de marca no ve.

