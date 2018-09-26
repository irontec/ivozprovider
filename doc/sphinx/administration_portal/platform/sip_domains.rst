.. _god_sipdomains:

SIP domains
-----------

The section **Domains** will display the SIP domains that points to our two
public IP addresses.

- Users SIP Proxy IP address
- Trunks SIP Proxy IP address

After the initial installation, there will be two domains, one for each address:

- trunks.ivozprovider.local

- users.ivozprovider.local

This domains will be used internally by a builtin DNS server included in the
solution.

.. attention:: As mentioned in the section :ref:`domain_per_client`, each
    client will require a DNS pointing to the users SIP proxy. Once configured,
    the domain will be displayed in this list so global administrator can check
    what domains are registered for each client.
