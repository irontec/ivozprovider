.. _retail_clients:

**************
Retail Clients
**************

.. glossary::

  Name
      Sets the name for this company.

  NIF
      Number used in this company's invoices.

  Invoice data
      Data included in invoices created by this brand.

  Outgoing DDI
      Introduced in 1.3, this setting selects a DDI for outgoing calls
      of this company, if it is no overridden in a lower level (e.g. user level)

  Media relay set
      As mentioned above, media-relay can be grouped in sets to reserve capacities
      or on a geographical purpose. This section lets you assign them to companies.

  Distribute Method
      'Hash based' distributes calls hashing a parameter that is unique per
      company/retail, 'Round robin' distributes calls equally between AS-es and
      'static' is used for debugging purposes.

  Application Server
      If 'static' *distribute method* is used, select an application server here.

  Recordings
      Configures a limit for the size of recordings of this company. A
      notification is sent to configured address when 80% is reached and
      older recordings are rotated when configured size is reached.

  Features
      Introduced in 1.3, lets brand operator choose the features of the company.
      Related sections are hidden consequently and the company cannot use them.




