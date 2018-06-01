.. _target_patterns:

***************
Target patterns
***************

When a user dials an external phone number, IvozProvider tries to categorize
this call into a one of the target patterns defined in this section:

Usually, it will we useful to have one target pattern for the countries
defined in the `ISO 3166
<https://en.wikipedia.org/wiki/ISO_3166>`_. That's why IvozProvider automatically
includes all this countries and their prefixes:

.. ifconfig:: language == 'en'

    .. image:: img/en/target_patterns_default.png
      :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/target_patterns_default.png
      :align: center

.. warning:: Brand operator can choose between keeping this target pattern if
   finds them useful or deleting them an creating the ones that meet his needs.
