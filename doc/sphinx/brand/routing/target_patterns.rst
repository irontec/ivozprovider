.. _target_patterns:

***************
Target patterns
***************

When a user dials an external phone number, IvozProvider tries to categorize
this call into a one of the target patterns defined in this section:

.. ifconfig:: language == 'en'

    .. image:: img/en/target_patterns_section.png
      :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/target_patterns_section.png
      :align: center


Usually, it will we useful to have one target pattern for the 254 countries
defined in the `ISO 3166
<https://es.wikipedia.org/wiki/ISO_3166>`_. That's why IvozProvider automatically
includes all this countries and their prefixes:

.. ifconfig:: language == 'en'

    .. image:: img/en/target_patterns_default.png
      :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/target_patterns_default.png
      :align: center

Within this list we can find Spain's prefix, that will be the prefix of the test
call we are going to make in this section:

.. ifconfig:: language == 'en'

    .. image:: img/en/target_patterns_spain.png
      :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/target_patterns_spain.png
      :align: center


.. warning:: Brand operator can choose between keeping this target pattern if
   finds them useful or deleting them an creating the ones that meet his needs. In
   fact, apart from phone prefixes it is also possible to use regular expressions.
   e.g. Unique target pattern that contains all possible targets: ^[0-9]+$

.. danger:: Notice that using regular expressions instead of prefixes can make
   a phone number to match more than one target pattern. Use with responsibility.