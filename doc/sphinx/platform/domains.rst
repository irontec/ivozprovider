.. _god_sipdomains:

SIP Domains
-----------

The section **Domains** will display the SIP domains that points to our two
public IP addresses.

- Users SIP Proxy IP address
- Trunks SIP Proxy IP address

After the initial installation, there will be two domains, one for each address:

.. ifconfig:: language == 'en'

    .. image:: img/en/domain_list_local.png

.. ifconfig:: language == 'es'

    .. image:: img/es/domain_list_local.png

This domains will be used internally by a builtin DNS server included in the
solution.

.. attention:: As mentioned in the section :ref:`domain_per_company`, each
    company will require a DNS pointing to the users SIP proxy. Once configured,
    the domain will be displayed in this list so global administrator can check
    what domains are registered for each company.
