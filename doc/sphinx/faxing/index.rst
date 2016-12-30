.. _faxing_system:

##############
Faxing Virtual
##############

La solución de *faxing* virtual incluida en IvozProvider es muy simple, pero 
permite:

- Enviar faxes partiendo de un PDF.

- Recibir faxes vía correo electrónico y visualización web.

.. error:: IvozProvider utiliza `T.38 <http://www.voip-info.org/wiki/view/T.38>`_ para la emisión y recepción de faxes. Es responsabilidad de el administrador de marca disponer de Contratos de Peering con operadores que soporten dicho protocolo, así como configurar las rutas de salida para utilizar dicho operador.

**************************
Creación de un fax virtual
**************************

Esta es la interfaz que nos encontramos al crear un nuevo fax en la sección 
**Configuración de empresa** > **Faxes Virtuales**:

.. image:: img/fax_add.png
    :align: center

Los campos son prácticamente auto-explicativos:

.. glossary::

    Nombre
        Nombre por el que se referenciará el fax en otras secciones

    Email
        Email donde se recibirán los mails (en caso de marcar 'Enviar por 
        email' a 'Sí')

    DDI de salida
        Número que se utilizará como origen en los faxes salientes

Para recibir faxes en dicha numeración, será necesario apuntarla a nuestro 
nuevo fax, editando el DDI en la sección **DDIs**:

.. image:: img/fax_ddi.png
    :align: center

Para enviar faxes por una ruta concreta (que tenemos probada y sabemos que es 
óptima para la emisión de faxes), se puede definir una ruta exclusiva para 
faxes:

.. image:: img/fax_routes.png
    :align: center

Todos los faxes que envíe esa empresa (para todos los faxes que vaya creando), 
se enviará por esta ruta.

.. note:: Si se definieran más rutas de faxing, se utilizarían todas siguiendo 
   las lógicas de *load-balancing* y *failover* descritas en :ref:`secciones 
   anteriores <routes_metrics>`.

.. important:: Si una empresa no dispone de rutas de faxing, saldrá siguiendo 
   las lógicas de rutado de las llamadas.

*************
Emitir un fax
*************

.. image:: img/fax_send2.png
    :align: center

.. image:: img/fax_send.png
    :align: center

********************************
Visualización de faxes entrantes
********************************

Los faxes entrantes se pueden recibir vía correo electrónico, pero también 
pueden ser visualizados y descargados desde el panel web pulsando:

.. image:: img/fax_list.png

