*********
Companies
*********

These are remaining relevant parameters configured in Companies section:


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

Most of the features are self-explanatory, but **voice notification** deserves
an explanation: if you enable them, when a call fails, the user will listen a
locution explaining what occurred ("you have no permissions to place this call",
"the call cannot be billed", etc.)

.. warning:: Recordings rotation happens at two levels: brand and company. This
              means that **a company's recordings can be rotated even though its limit
              has not arrived (or even it has no limit) if brand's limit applies first**.

.. error:: Again: recordings rotation happens at two levels: brand and company. This
              means that **a company's recordings can be rotated even though its limit
              has not arrived (or even it has no limit) if brand's limit applies first**.

.. hint:: To avoid this, make sure that the sum of all companies does not exceed
          the size assigned to your brand and make sure that all companies has
          a size configured (if 0, it has unlimited size).

Both **Distribute method** and **Application Server** are only visible for God
Administrator.

.. warning:: 'Round-robin' distribute method is reserved for huge companies/retails
              whose calls cannot be handled in a single AS. **Use 'Hash based'
              for remaining ones**, as 'Round-robin' imposes some limitations
              to company features (no queues, no conferences).



