
***************************
Creating a destination rate
***************************

Destination rates section is empty by default, as opposed to target patterns section,
that has all the 254 countries of the world. The reason is that one destination rate
will usually imply lots of pattern per country (GSM networks, especial numbers,
mobile numbers, fixed lines, etc.).

In most of the cases, this section data will be imported from CSV provided by your
Peering Contracts, but for our test we will create it manually. Check section
:ref:`Destination rates` for more information.

Create a **destination rate**:

.. ifconfig:: language == 'en'

    .. image:: img/en/destination_rate_new.png

.. ifconfig:: language == 'es'

    .. image:: img/es/destination_rate_new.png


And we add a price for a given prefix in E.164 (with + sign)

.. ifconfig:: language == 'en'

    .. image:: img/en/destination_rate_add.png

.. ifconfig:: language == 'es'

    .. image:: img/es/destination_rate_add.png

.. note:: Floating number must use the "." as decimal separator (e.g. 0.02)


