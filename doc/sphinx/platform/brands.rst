Brands
------

.. glossary::

    Name
        Sets the name for this brand.

    TIN
        Number used in this brand's invoices.

    Logo
        Used as default logo in invoices and in portals (if they don't specify
        another logo).

    Invoice data
        Data included in invoices created by this brand.

    SIP domain
        Introduced in 1.4. Domain pointing to Users SIP proxy used by all the
        Retail Accounts and Residential Devices of this brand.

    Recordings
        Configures a limit for the size of recordings of this brand. A
        notification is sent to configured address when 80% is reached and
        older recordings are rotated when configured size is reached.

    Features
        Introduced in 1.3, lets god operator choose the features of the created
        brand. An equivalent configuration is available in Companies, to choose
        between the ones that god operator gave to your Brand. Related sections
        are hidden consequently.

    Max calls
        Limits both user generated and **external** received calls to this value
        (0 for unlimited).

    Locales
        Define default Timezone and Language for clients of this brand.

.. hint:: Some features are related to brand and cannot be assigned to companies.
    Other ones are also related to companies and lets the brand operator to
    assign them to its companies.

.. warning:: Disabling billing hides all related sections and assumes that an
    external element will set a price for calls (external tarification
    module is needed, ask for it!).

.. note:: Disabling invoices hides related sections, assuming you will use an
    external tool to generate them.

.. note:: SIP domain is only visible for Brands with Retail or Residential features
    enabled.