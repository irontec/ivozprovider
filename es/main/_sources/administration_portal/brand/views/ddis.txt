.. _ddis:

****
DDIs
****

This section lists **all configured DDIs** in all the clients of the brand.

It makes easy to answer to these questions:

- Is this DDI of one of my clients? If so, whose?

- Who DDI Provider provides it?

- How many DDIs of country X does client Y have?

- Etc.

**********
CSV Import
**********

The *Import DDIs* option of the list menu creates DDIs in bulk from a CSV file and completes
the existing ones. The dialog asks for:

- **CSV file**: required, with the format described below.

- **Client**: optional. Empty creates the DDIs unassigned to any client.

- **Country**: required, with or without client. Selecting a client preselects its country, but
  it can be changed: a Spanish client can import DDIs of another country.

- **DDI provider**: optional, one of the DDI providers of the brand. Empty creates the DDIs without
  DDI provider.

The client, the country and the DDI provider apply to every row of the file. To import DDIs of
several countries or DDI providers, use one file per combination.

The file has a single column without header row: the DDI number without country prefix. Empty
rows and the spaces around the number are ignored, and files saved by Excel (UTF-8 BOM, Windows
line endings) are accepted::

    944048182
    944048183
    944048184

A DDI exists when its number and country match. The import follows these rules:

- A **new DDI** is created with the selected client, country and DDI provider. The other fields
  keep their default value: type *inout*, without description nor route. It counts as *created*.

- A DDI that **exists in another brand** is skipped without changes and counts as *skipped*. The
  result only says that the DDI already exists, not who owns it.

- A DDI that **exists in this brand** can only receive the selected client and DDI provider, and
  only when it has none. Nothing else changes, and a DDI is never moved from one client or DDI
  provider to another:

  - If it belongs to another client, or to another DDI provider, nothing is changed, not even the
    other field. It counts as *skipped* with a generic reason that does not tell which one.

  - If it is an outbound only DDI and a DDI provider was selected, it is skipped too: outbound
    only DDIs cannot have a DDI provider.

  - Otherwise, the selected fields it has empty are filled and it counts as *updated*. A field
    that was not selected, or that already has the selected value, is left as it is.

  - If there is nothing to fill, it counts as *skipped*.

- A number **repeated** in the file is processed once; its other rows are skipped.

- A row that is **not a valid number**, for example with a country prefix like ``+34``, is
  reported as *failed* with its line number and does not stop the import of the other rows.

With client A and DDI provider P selected in the dialog, an existing DDI of the brand ends up as
follows:

=============================  ================================================
Existing DDI                   Result
=============================  ================================================
Without client nor provider    Updated: client A and DDI provider P
Client A, without provider     Updated: DDI provider P
Without client, provider P     Updated: client A
Client A, provider P           Skipped: nothing to fill
Client B, without provider     Skipped: belongs to another client, nothing is assigned
Without client, provider Q     Skipped: belongs to another DDI provider, nothing is assigned
Outbound only                  Skipped: outbound only DDIs cannot have a DDI provider
Of another brand               Skipped: already exists
=============================  ================================================

At the end, the dialog shows how many DDIs were created, updated, skipped and failed, the lines
that were updated, and the line and reason of every skipped or failed row. Importing the same
file again is safe: the second time nothing is created nor updated.

.. warning:: Imported DDIs have no route, and no DDI provider unless one is selected. Edit them
             afterwards to assign the destination of their incoming calls.
