##########
Extensions
##########

.. note:: **An extensions is**, by definition, **an internal number with an
   assigned logic**.   

.. rubric:: Create a new extension

.. glossary::

    Number
        The number that must be dialed by the internal user that will trigger
        the configured logic. It must have a minimum length of 2 and must be 
        a number.

    Route
        This select will allow us to choose the logic that will use this
        extension when is dialed from an internal user. Depending on the selected
        route, and additional select or input will be shown to select the
        hunt group, conference room, user, etc.

.. warning:: If an extension has a number that conflicts with an external
   number, this external number will be masked and, in practice, will be
   unavailable for the whole client.
