************
Routing tags
************

In most scenarios, Brands administrators are responsible of configuring
:ref:`Carriers` and :ref:`Outgoing Routing` to provide connectivity for
their clients. But in some cases, clients want to choose the outgoing routing to
use per call.

A Routing tag is an code that will prefix the destination number when placing calls to Ivoz Provider.

.. ifconfig:: language == 'en'

    .. image:: img/en/routing_tag.png
        :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/routing_tag.png
        :align: center


In order to use a routing tag, the client must have it enabled in their edit screen.
Using a non enabled routing tag will case the call to be declined.

.. ifconfig:: language == 'en'

    .. image:: img/en/routing_tag_client.png
        :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/routing_tag_client.png
        :align: center


.. important:: Route tags are only available to wholesale clients at the moment.


Then, each routing tag can be used to configure their :ref:`Outgoing routing` order.

.. ifconfig:: language == 'en'

    .. image:: img/en/routing_tag_outgoing_routing.png
        :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/routing_tag_outgoing_routing.png
        :align: center
