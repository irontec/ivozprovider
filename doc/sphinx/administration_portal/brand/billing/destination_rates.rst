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

    Connection charge
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
this process much easier:

.. error:: Comma is the only allowed separator character.

.. error:: Single quotes are not supported.

You can find a sample CSV for importing `here <https://raw.githubusercontent.com/
irontec/ivozprovider/artemis/web/admin/samples/pricesSample.csv>`_.


The order of the columns should be:

- Destination name

.. warning:: If they contain any comma, they MUST be quoted with double quotes. Otherwise, double quotes are optional.

- Destination prefix

.. warning:: MUST start with + sign.

.. error:: If same prefix is used in multiple times in CSV file, import process will fail.

- Per minute rate
- Connection charge

.. warning:: MUST use point as decimal separator.

- Charge period

.. tip:: Given in seconds, only integers greater or equal 1 are supported.


Once the import process is over, we only have to include this destination rate into some
rating plan and bind it to the clients/carriers we want following the procedure explained in
:ref:`Rating plans`.

***********************
Re-importing a CSV file
***********************

Once a CSV (first.csv) is imported into an empty destination-rates row, you can **import another CSV** (second.csv).

However, it is **important to understand what happens** when you do so:

- Prefixes in both CSV will get its rate **updated** with second's CSV one.

- Prefixes existing only in the first CSV file will be **kept**.

- Prefixes existing only in the second CSV file will be **added**.


.. error:: Downloading CSV using *Imported file* option will always download **last imported CSV file** (no the
           combination of both as described above).

Note that if both *first.csv* and *second.csv* contain exactly the same prefixes, resulting destination-rate will be as
we had only imported *second.csv*. And downloading *Imported file* will download *second.csv*, that is exactly the current
state of destination-rate.
