*********************
Target pattern groups
*********************

As we will see in :ref:`Outgoing Call Routing` section, every target
pattern will be linked to a Peering Contract.

That's why it can be useful to group the target patterns in **target pattern group**
so that we can link a whole group to a Peering Contract more easily.

This is the goal of this section:

.. ifconfig:: language == 'en'

    .. image:: img/en/target_patterngroups_section.png
      :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/target_patterngroups_section.png
      :align: center


By default we can see the 254 countries grouped in the continents defined in
`ISO 3166 <https://es.wikipedia.org/wiki/ISO_3166>`_:

.. ifconfig:: language == 'en'

    .. image:: img/en/target_patterngroups_default.png
      :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/target_patterngroups_default.png
      :align: center

.. important:: **To sum up**, when a user dials an external number, IvozProvider
   looks up a matching target pattern to decide which PeeringContract must be used
   to place this call.

To achieve our goal of making an external call to a spanish number, we didn't have
to modify the initial contents of this two sections :)
