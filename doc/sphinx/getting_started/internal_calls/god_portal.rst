********************
Global Configuration
********************

.. important:: Any of the 2 Public IP addresses configured during the
    installation will work to acces the web portal. Default credentials are
    **admin / changeme**.

In this section will reference global administrator configuration options,
avaible in the menu (**Main management**) of the web portal (only visible to
God Admins):

Emulate the Demo brand
======================

As mentioned above, the initial installation will have an already created brand
called DemoBrand, that will be used for our goal: to have 2 telephones registered
that can call each other.

Before going to the next section, is quite important to understand how the
**emulation** works.

- As global operator, you have access to the menu **Main management** only
  visible to *God* administators.

- Apart from that menu, you will also have access to the **Brand configuration**
  and **Company configuration** that will look more or less like this:

.. ifconfig:: language == 'en'

    .. image:: img/en/emular_marca_prev.png
        :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/emular_marca_prev.png
        :align: center

- Check following button

.. ifconfig:: language == 'en'

    .. image:: img/en/emular_marca.png
        :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/emular_marca.png
        :align: center

- When pressed, a popup will be displayed:

.. ifconfig:: language == 'en'

    .. image:: img/en/emular_marca2.png
        :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/emular_marca2.png
        :align: center

- After selecting the DemoBrand brand, the icon will change and shows the
  emulted brand:

.. ifconfig:: language == 'en'

    .. image:: img/en/emular_marca3.png
        :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/emular_marca3.png
        :align: center


- The upper right corner of the portal will also display the brand that is being
  emulted:

.. ifconfig:: language == 'en'

    .. image:: img/en/emular_marca4.png
        :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/emular_marca4.png
        :align: center

What emulation means
====================

Basically, that **everything in the menu 'Brand configuration' will be relative
to the chosen brand** and is **exactly** the same menu entries that the brand
operator will see using its brand portal.

.. tip:: Ok, ok. maybe exactly is not totally accurate. The global operator is
    able to see some fields in some screens that other admins cann't (i.e. On
    Company edit screen, fields like 'Media relays' or 'Application server' are
    only configurable by the global operator.
