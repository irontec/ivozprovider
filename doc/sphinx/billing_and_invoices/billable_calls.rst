.. _billable_calls:

####################
Llamadas facturables
####################

Los listados de llamadas de las secciones **Llamadas facturables** muestran solo las **llamadas que implican coste**.

.. important:: La gran diferencia respecto a las llamadas del :ref:`call_registry` es que todas las que aparecen aquí implican coste (no aparecen, por tanto, llamadas internas, etc.)

Se muestra el coste asociado a las llamadas (una vez calculado) y, dado que las empresas son notificadas de sus llamadas por medio de facturas emitidas por el *operador de marca*, solo se existe a dos niveles:

- A nivel global (*god*).

- A nivel de marca.

Estos listados muestran la siguiente información:

.. glossary::

    Fecha
        Fecha y hora del establecimiento de la llamada.

    Marca
        Solo visible a nivel *god*, indica la marca de la empresa en cuestión.

    Compañía
        Empresa responsable de la llamada.

    Destino
        Número externo al que se ha llamado.

    Patrón de destino
        Indica el :ref:`patrón de precio <price_pattern>` en base al cual se ha puesto precio a la llamada.

    Duración
        Indica cuánto ha durado la llamada.

    Tarificado (sí/no)
        Indica si el proceso que pone precio a las llamadas ha calculado el precio de esta llamada concreta.

    Precio
        Coste calculado para la llamada.

    Plan de precio
        :ref:`Plan de precio <price_plan>` en base al cual se ha puesto precio a la llamada.

    Contrato de peering
        Indica por qué :ref:`Contrato de peering <peering_contracts>` ha salido la llamada.

    Factura
        Indica si la llamada está incluida en alguna :ref:`factura <invoices>`.

    Tipo (entrante/saliente)
        Dado que ciertas llamadas entrantes pueden implicar coste (ver :ref:`tarificación de llamadas entrantes <bill_inbound>`), indica si la llamada es entrante o saliente.

.. note:: Las llamadas aparecen en este listado en cuanto se cuelgan. Pasados unos minutos, el proceso que pone precios a las llamadas habrá tarificado la llamada (*Tarificado* igual a 'Sí') y tendremos disponible el **Precio** calculado.

