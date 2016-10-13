.. _external_ddi:

#######################
Configurar DDI saliente
#######################

Antes de realizar la llamada externa, estaría muy bien que dicha llamada se presentara con el DDI que ya hemos configurado en entrada, así el llamado podría devolvernos la llamada cómodamente.

Para ello, basta con configurar dicho DDI como **DDI saliente** de *Alice*, que será la elegida para realizar la primera llamada saliente de nuestro recién instalado IvozProvider:

.. image:: img/ddi_out.png

Esta configuración se realiza desde **Configuración de empresa** > **Usuarios**, editando el usuario de *Alice*. Si ese el operador de marca o el operador global el que realiza esta edición, tendrá que haber :ref:`emulado la empresa <emulate_company>` previamente.

.. warning:: Sin configurar un DDI saliente para el usuario que realiza la llamada, ésta no saldrá al exterior.

