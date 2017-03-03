*******************
Brand Configuration
*******************

We need that the default DemoBrand have a company with at least 2 users. In
order to archive this we will require little configuration in this section.

In fact, if we check **Companies** in the brand menu, we'll discover that there
is already an existing *DemoCompany* that we can use to fulfill our desired
goal :)

.. ifconfig:: language == 'en'

    .. image:: img/en/company_list.png

.. ifconfig:: language == 'es'

    .. image:: img/es/company_list.png

Only a thing is required to configure for this company, marked as edit in the
previous image.

.. _domain_per_company:

Company SIP Domain
==================

As mentioned in the previous section, is **required** that each of the companies
have a public domain that resolves to the configured IP address for
:ref:`proxyusers`.

.. note:: DNS register can be type A (supported by all the hardphones/softphones
   ) or even NAPTR+SRV.

Once the domain has been configured (by means that are out of scope of this
document), it will be enought to write it in our company configuration:


.. ifconfig:: language == 'en'

    .. image:: img/en/set_domain.png

.. ifconfig:: language == 'es'

    .. image:: img/es/set_domain.png

Once the company has been saved, the domain will be also displayed in the list
:ref:`previously mentioned <god_sipdomains>`:

.. ifconfig:: language == 'en'

    .. image:: img/en/domain_list.png

.. ifconfig:: language == 'es'

    .. image:: img/es/domain_list.png

.. attention:: It's important to understand this block. Wihout a DNS domain
   pointing to our users proxy IP address, everything will fail.

This is a good sign for the domain we have configured right now, replacing the
10.10.3.10 with the public address we have used to configure :ref:`proxyusers`.

.. ifconfig:: language == 'en'

    .. image:: img/en/dominio_bien_configurado.png

.. ifconfig:: language == 'es'

    .. image:: img/es/dominio_bien_configurado.png

.. danger:: Have we stressed enough that without a properly configured DNS
   pointing to the Users proxy IP address nothing will work?

.. _dnshack:

I have no time for a DNS registry
---------------------------------

Everything we have said is true: as we create new brands and brands create new
companies, each of them will need a DNS registry.

But the first company of the platform is quite special and can take over the IP
address of the proxy to use it as a domain:

.. ifconfig:: language == 'en'

    .. image:: img/en/fake_domain.png

.. ifconfig:: language == 'es'

    .. image:: img/es/fake_domain.png

Although it is not a domain, but being used like it was, it will be displayed
in Domain section:

.. ifconfig:: language == 'en'

    .. image:: img/en/fake_domain2.png

.. ifconfig:: language == 'es'

    .. image:: img/es/fake_domain2.png


.. tip:: It’s important to understand the this trick is only valid for the first
   company of the platform ;)


.. _emulate_company:

Emulate Demo company
====================

The company emulation process is the same as the brand emulation, with the
difference that it filters the block ‘Company Configuration’ insted of
‘Brand Configuration’.

.. ifconfig:: language == 'en'

    .. image:: img/en/emulate_company.png
        :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/emulate_company.png
        :align: center

.. ifconfig:: language == 'en'

    .. image:: img/en/emulate_company2.png
        :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/emulate_company2.png
        :align: center

Once the company has been emulated, the top right corner of the portal will
show that we are in the right path :)

.. ifconfig:: language == 'en'

    .. image:: img/en/emular_empresa.png
        :align: center

.. ifconfig:: language == 'es'

    .. image:. img/es/emular_empresa.png
        :align: center

