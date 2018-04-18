.. _peering_contracts:

*****************
Peering contracts
*****************

These are the basic information of a Peering contract:

.. ifconfig:: language == 'en'

    .. image:: img/en/peeringcontract.png
      :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/peeringcontract.png
      :align: center

If we edit it, well see something like this:

.. ifconfig:: language == 'en'

    .. image:: img/en/peeringcontract_edit.png
      :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/peeringcontract_edit.png
      :align: center

.. glossary::

    Name
        Used to reference this Peering contract.

    Description
        Optional field with any required extra information.

    Numeric Transformation
        Transformation that will be applied to the origin and destination of the
        incoming and outgoing numbers that use this Peering contact
        (see :ref:`Numeric transformations`).

    External tarification
        This setting requires the external tarification module and allows
        tarification on special numbers. This module is not standard so don't
        hesitate in :ref:`contact us <getting_help>` if you are interested.

.. important:: Fields marked with a red start are mandatory.