.. _call_recordings:

#####################
Grabación de llamadas
#####################

IvozProvider permite grabar las llamadas que se cursan en 2 modalidades 
distintas:

- **Grabación automática** para llamadas desde/hacia cierto :ref:`DDI externo 
  <external_ddis>`.

- **Grabación bajo demanda** solicitada por un usuario en medio de una 
  conversación.

****************************
Grabación automática por DDI
****************************

En el caso de grabaciones automáticas por DDI, **se graba toda la 
conversación**: desde el principio hasta el final.

Se distinguen 2 casos:

- **Llamadas entrantes a un DDI**: la grabación seguirá mientras la parte 
  externa de la llamada permanezca en la conversación.

- **Llamadas salientes utilizando un DDI** como :ref:`DDI saliente 
  <external_ddis>`: mientras el interlocutor externo permanezca en la 
  conversación, la grabación sigue.

.. attention:: El hecho de que **mientras el interlocutor permanezca en la 
   llamada la grabación continúe**, hace que no importe cuántes veces se 
   transfiera la llamada de un usuario a otro, la grabación contendrá toda la 
   conversación (desde el punto de vista del participante externo).

.. rubric:: Grabar todas las llamadas de un DDI

Basta con editar el DDI en cuestión y habilitar las grabaciones:

.. image:: img/recordings_ddi.png

Existen 4 opciones:

- Desactivar la grabación
- Activarla para llamadas entrantes a dicho DDI
- Activarla para llamadas salientes que presente dicho DDI
- Activarla para ambas

**********************
Grabación bajo demanda
**********************

La grabación bajo demanda u *on-demand* la tiene que activar el *operador de 
marca* para las empresas que la necesiten, sin más que editar su empresa y 
configurar el código deseado:

.. image:: img/recordings_ondemand.png

.. warning:: A diferencia de los :ref:`Servicios <services>` comentado en la 
   sección anterior, la funcionalidad de grabación bajo demanda se activa en 
   mitad de una conversación.

Activación por medio de tecla *Record*
======================================

Los terminales *Yealink* soportan el envío de mensajes `SIP INFO 
<https://tools.ietf.org/html/rfc6086>`_ con una cabecera *Record* (ver 
`referencia <http://www.yealink.com/Upload/document/UsingCallRecordingFeatureonYealinkPhones/UsingCallRecordingFeatureonYealinkSIPT2XPphonesRev_610-20561729764.pdf>`_). 
No es un estándar, pero al ser *Yealink* uno de los modelos soportados, 
IvozProvider incluye soporte para la activación de grabación bajo demanda de 
esta forma.

.. important:: El código seleccionado no influye en este caso, pero **la 
   empresa sí que tiene que tener las grabaciones bajo demanda activadas**.

La activación de las grabaciones es muy simple en este caso, basta con pulsar 
la tecla y el sistema inicia la grabación.

Activación por medio de transferencia ciega frustrada
=====================================================

Existe otra forma de acceder a esta funcionalidad para los terminales que no 
tengan soporte para el método anterior.

.. danger:: Este método de acceder a la funcionalidad es una forma imaginativa 
   de hacerla accesible para terminales sin soporte nativo de tecla *Record* 
   (que es el método recomendado). En función del terminal en cuestión y de la 
   configuración del mismo, resultará más o menos cómodo utilizar la 
   funcionalidad (tecla rápida de transferencia ciega, no retener al
   interlocutor, etc.).

Los pasos a seguir en este método alternativo e imaginativo son los siguientes:

- No se activa marcando el código en medio de la conversación.

- Se activa iniciando una transferencia ciega al código configurado.

- El sistema rechazará la transferencia e iniciará la grabación.

- El usuario podrá volver a la conversación que tenía (si es que su terminal no 
  ha vuelto solo) y seguir hablando.

.. rubric:: ¿Por qué esta forma tan *peculiar* de activar la grabación y no por 
   medio de tonos normales?

El motivo de activar la grabación por medio de una transferencia ciega 
frustrada se debe a la :ref:`architecture` y, más concretamente, al 
:ref:`flujo de audio RTP <audioflow>`.

Lo habitual suele ser activar servicios por medio de pulsaciones en medio de 
la llamada (lo que se conoce por `tonos DTMF 
<https://es.wikipedia.org/wiki/Marcaci%C3%B3n_por_tonos>`_). Estos tonos suelen 
viajar por el mismo camino del audio (siguiendo el `RFC 4733 
<https://tools.ietf.org/html/rfc4733>`_ o como sonido audible).

IvozProvider utiliza la transmisión de estos tonos siguiendo el `RFC 4733 
<https://tools.ietf.org/html/rfc4733>`_ y, por tanto, dichos paquetes de audio 
pasan por los *media-relays*, que se limitan a reenviar el audio sin analizar 
su contenido. Al no analizar su contenido, no pueden detectar las pulsaciones y 
activar lógicas.

.. note:: Esta decisión de diseño es la que permite escalar la solución y ser 
   capaz de gestionar cientos de miles de llamadas concurrentes.

Al realizar una transferencia ciega, en cambio, se produce señalización SIP 
dentro de un diálogo (en concreto, un `REFER 
<https://tools.ietf.org/html/rfc3515>`_) y sí que es posible activar lógicas de 
este estilo, ya que la señalización sigue `otro camino <signallingflow>` que 
incluye a los elementos con lógica (servidores de aplicación y *proxies*).

.. warning:: La grabación bajo demanda graba la llamada desde que se activa 
   hasta que el usuario que la activó desaparece de la misma.

.. important:: No existe la funcionalidad de parar la grabación, 
   independientemente del método elegido para activarla.

**********************
Listado de grabaciones
**********************

El *administrador de empresa* puede acceder a las grabaciones realizadas por 
medio de la sección **Configuración de Empresa** > **Grabaciones**:

.. image:: img/recordings_list.png

Haciendo clic en una de ellas, podría escucharla desde la *web* o descargársela 
en formato MP3:

.. image:: img/recordings_list2.png

En el caso de una grabación bajo demanda, se indica qué usuario la inició:

.. image:: img/recordings_list3.png

