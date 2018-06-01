
##############################
Outgoing Routing configuration
##############################

We already have our test call categorized as a call within the **Target pattern**
'Spain'. In addition, we also have a **Target pattern group** including 'Spain',
called 'Europe'.

Now we have to tell IvozProvider that calls to 'Spain' or 'Europe' should be
established through our **Contract Peering**.

To make this assignment, we use the section **Outgoing routing**:

If we choose routing 'Spain' calls only through our *Peering contract*, we will
make this configuration:

.. ifconfig:: language == 'en'

    .. image:: img/en/outgoing_routes_by_pattern.png
      :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/outgoing_routes_by_pattern.png
      :align: center

On the other hand, if we are more generous and we decide to place calls to all
european countries, we would make this configuration:

.. ifconfig:: language == 'en'

    .. image:: img/en/outgoing_routes_by_patterngroup.png
      :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/outgoing_routes_by_patterngroup.png
        :align: center


For more information about routing and load balancing check :ref:`Outgoing Routing` section: