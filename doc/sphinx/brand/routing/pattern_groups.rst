**********************
Routing pattern groups
**********************

As we will see in :ref:`Outgoing Routing` section, every routing
pattern will be linked to a Carrier.

That's why it can be useful to group the routing patterns in **routing pattern group**
so that we can link a whole group to a Carrier more easily.

By default we can see the countries grouped in the continents defined in
`ISO 3166 <https://en.wikipedia.org/wiki/ISO_3166>`_:

.. ifconfig:: language == 'en'

    .. image:: img/en/routing_patterngroups_default.png
      :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/routing_patterngroups_default.png
      :align: center

.. important:: **To sum up**, when a user dials an external number, IvozProvider
   looks up a matching routing pattern to decide which Carrier must be used
   to place this call.
