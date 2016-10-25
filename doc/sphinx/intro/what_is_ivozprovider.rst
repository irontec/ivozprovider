*********************
¿Qué es IvozProvider?
*********************

IvozProvider es una solución de :ref:`telefonía IP <voip>` :ref:`multinivel <multilevel>` :ref:`orientada a operador <operator_oriented>` :ref:`expuesta a la red pública <exposed>`.

.. _voip:

Telefonía IP
============

IvozProvider es compatible con los sistemas de telefonía que utilicen el protocolo *Session Initiation Protocol*, **SIP**, descrito en el `RFC 3261 <https://tools.ietf.org/html/rfc3261>`_ y todos los `RFCs relacionados <https://www.packetizer.com/ipmc/sip/standards.html>`_, independientemente del fabricante.

Esto implica libertad total a la hora de elegir *softphones*, *hardphones* y el resto de elementos que interactúan con IvozProvider, sin ningún tipo de ataduras a ningún fabricante.

En lo relativo a los **protocolos de transporte** para transportar SIP, actualmente IvozProvider soporta:

- UDP
- TCP
- TLS
- Websockets

Este último protocolo de transporte descrito en el `RFC 7118 <https://tools.ietf.org/html/rfc7118>`_ permite la utilización de softphones desde la web, utilizando el estándar `WebRTC <https://webrtc.org/>`_ de los navegadores web para establecer comunicaciones en tiempo real *peer-to-peer*.

En lo relativo a los **codecs de audio soportados**, la lista sería la siguiente:

- PCMA (*alaw*)
- PCMU (*ulaw*)
- GSM
- SpeeX
- G.722
- G.726
- G.729
- iLBC
- `OPUS <http://opus-codec.org/>`_

.. _multilevel:

Multinivel
==========

El esquema de portales y diseño de IvozProvider permite que **múltiples actores cohabiten en una misma infraestructura**:

.. image:: ../operation_roles/img/operator_levels.png

En la sección :ref:`operation_roles` se describen los distintos roles en profundidad, pero se puede resumir en:

- **Nivel God**: instalador y mantenedor de la solución. Da acceso a n operadores de marca.

- **Nivel Brand Operator**: Responsable de dar acceso, tarificar y facturar a n operadores de empresa.

- **Nivel Company Operator**: Responsable de configurar el comportamiento de su centralita y dar de alta n usuarios finales.

- **Nivel de Usuario**: Dispone de unas credenciales para sus terminales SIP y otra para el acceso a su panel web.


Cabe destacar que **cada uno** de estos niveles **dispone de un acceso web** que le permite realizar sus funciones. Los acceso web se pueden personalizar a nivel de:

- Temas y *skins* con los colores corporativos.

- Logo de la empresa.

- URLs personalizadas con el dominio de la marca/empresa.

.. _operator_oriented:

Orientada a operador
====================

IvozProvider es una solución de telefonía **diseñada con el escalado horizontal en mente**, lo que la permite adecuarse a **altos volúmenes de tráfico y de usuarios** sin más que adaptar el número de máquinas y los recursos de éstas.

Estas son las ideas principales que lo hacen un producto orientado a operador:

- A pesar de que todas las piezas pueden correr en una misma máquina, lo que facilita las pruebas iniciales, cada elemento de IvozProvider se puede separar del resto y correr en su propio hardware.

- Una **instalación distribuida** permite asignar máquinas con recursos adecuados a cada tarea, pero también posibilita:

    - Separación geográfica de los elementos para garantizar una disponibilidad a prueba de fallo de CPD.

    - Instalación de elementos clave cerca de los usuarios finales, para minimizar latencias en sus comunicaciones.

    - Escalado horizontal de los elementos clave para dar servicios a cientos de miles de llamadas concurrentes.

Los elementos que limitan la capacidad de servicio de las soluciones VoIP suelen ser:

- Gestión del audio de las llamadas establecidas.

- Gestión de las lógicas programadas por cada administador de empresa (IVRs, salas de conferencias, filtros de horario, etc.)

- Bases de datos de almacenamiento de configuraciones y registros.

IvozProvider ha sido diseñado con la idea de mantener el **escalado horizontal** de cada uno de estos elementos, **para así poder llegar a poder gestionar cientos de miles de llamadas concurrentes** y, lo que es más importante, poder **adaptar los recursos de la plataforma al nivel de servicio que se espera en cada momento**:

- Los **Media-relays** se encargan de reenviar las tramas de audio de las sesiones establecidas:

    - Se pueden poner tantos media-relays como sean necesarios.

    - Se pueden crear grupos de media-relays y hacer una asignación estática a las empresas deseadas.

    - Se pueden poner los media-relays cerca de los usuarios finales, para evitar latencias en las llamadas.

- Los **Servidores de Aplicación** se encargan de la fase previa de toda llamada: hacer que siga la lógica programada. Este rol:

    - Se puede escalar horizontalmente: que los Servidores de Aplicación empiezan a estar saturados, se instalan más y se añaden al pool.

    - Una llamada acaba en el Servidor de Aplicación que menos cargado esté en cada momento.

    - En la configuración por defecto no existe asignación estática [*]_ que envíe las llamadas de una empresa a un Servidor de Aplicación concreto, de modo que la caída de cualquier Servidor de Aplicación no es crítica: el sistema dejará de contar con él a la hora de distribuir las llamadas.

.. _exposed:

Expuesta a la red pública
=========================

Tal y como se verá en el proceso de instalación, **IvozProvider está diseñado para servir a usuarios directamente desde Internet**. Aunque pueda utilizarse en entornos locales, IvozProvider se ha diseñado para disponer de direcciones IPs públicas para dar servicio sin necesidad de túneles VPN o IPsec que te conecten con la infraestructura.

Cabe destacar:

- Solo los elementos imprescindibles están expuestos a Internet.

- Los accesos desde países de dudosa confianza se cortan en el firewall incorporado.

- Se puede filtrar el acceso desde IPs/redes autorizadas para evitar fraudes.

- Existe un mecanismo anti-flood para evitar grandes consumos en poco tiempo.

- Existe un mecanismo de control de llamadas concurrentes por empresa.

- IvozProvider soporta la conexión desde terminales tras `NAT <https://es.wikipedia.org/wiki/Traducci%C3%B3n_de_direcciones_de_red>`_.

- IvozProvider se encarga de mantener activas dichas ventanas de NAT con mecanismos de *nat-piercing*.

.. [*] El administrador global puede asignar Servidores de Aplicación estáticamente a empresas, pero esta funcionalidad está pensada como herramienta de *troubleshooting* puntual.
