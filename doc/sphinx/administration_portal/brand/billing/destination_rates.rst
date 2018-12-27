.. _destination_rate:

#################
Destination Rates
#################

A *Destination rate* groups some prefixes with their cost details.

They only have two fields:

.. glossary::

    Name
        Name to reference the destination rate

    Description
        Additional details

    Currency
        All rates imported/added will use this currency

.. tip:: Destination rate names are not shown to the final client, you can use whatever makes sense to you.

******************
Add rates manually
******************

Brand operator can add rates by hand, filling these fields (**List of rates** subsection):

.. glossary::

    Destination
        Pre-created destination that specifies a concrete prefix.

    Connection fee
        The amount that is charged just for call establishment.

    Interval start
        When should the billing engine start rating the calls. If you set it to 10, first 10 seconds will be for free.

    Per minute rate
        Price per minute of conversation.

    Charge period
        Increase cost every seconds? Or in 10 second intervals? Or every minute?

.. note:: A call with less duration that the one defined in interval start will have the price of the **Connection fee**.

.. warning:: All decimals must use point as decimal delimiter. 4 decimals precision is used.

.. rubric:: How it works

Call cost/price is increased by (*Per minute rate* / 60 ) * *charge period* every *charge period* seconds:

- If *billing period* is set to 1, every second the price will be increased
  *price per minute* divided by 60 (bill by seconds).

- If *billing period* is set to 60, every minute the price will be increased
  *price per minute* (bill by minutes).

********************
Importing a CSV file
********************

At this point, the brand operator may have noticed that adding thousands
of rates would be a really annoying and time consuming task, as there
are 254 countries, each of them with their mobile networks, landline networks,
special service numbers, etc.

That's why the creation of destination rates is done using a
`CSV <https://es.wikipedia.org/wiki/CSV>`_ file.

The first step is creating an empty *Destination rate* to import the prices in and using **Import rates** option.


We can select which column contains which field, in case we want to import a
`CSV <https://es.wikipedia.org/wiki/CSV>`_ file in a non-recommended format. We
can also decide whether to import the first line or discard it as it may have
titles instead of data.

.. hint:: The importing process is done in background, letting the brand operator
   continue doing other stuff while it is finished.

CSV format
==========

Although the import window allows importing non-recommended format CSV files,
we encourage you to import a file in the proposed format, as it will make
this process much easier.

You can find a sample CSV for importing `here <https://raw.githubusercontent.com/
irontec/ivozprovider/artemis/web/admin/samples/pricesSample.csv>`_.


The order of the columns should be:

- Destination name
- Destination prefix (E.164 with + sign)
- Per minute charge
- Establishment cost
- Billing period in seconds

.. note:: It is recommended to double quote alphanumeric entries, though
   it is not compulsory for single word entries (or entries without odd symbols).
   **If they contain any comma, they MUST be quoted**.

.. error:: Floating numbers **MUST use point as decimal separator**.

.. note:: Numeric entries can be quoted with double quotes, but it is
   not mandatory.

You can download the imported file of the destination rate. Take into account that while importing
over existing data, the matching values are overwritten and the not matching are kept. This allows
downloading the imported file, changing some values and importing pricing back.

.. note:: When re-importing, non-existent prefixes are kept.

Once the import process is over, we only have to include this destination rate into some
rating plan and bind it to the clients we want following the procedure explained in
:ref:`Rating plans`.
