*********
Calendars
*********

Calenders are used to define what days are considered as holiday. Like
schedules, multiples calendars can be combined.

Let's imagine three calendars with the following configuration:


Calendar creation process only requires a name. Once created, we can add what
days will be holidays using the buttons in its row:


From this moment on, the calendar has the 1st of January of 2016 as holiday
date with the locution "Happy New Year".

.. glossary::

    Name
        Unique name to identify this holiday date

    Locution
        Override default External call filter holiday locution

    Event Date
        Day of the calendar to be marked as holiday

    Whole day event
        Enable this to create an event that lasts all the day

    Time In/Time out
        For not whole day events, specify the time interval the event will be active

    Routing options
        Override default External call filter holiday routing

.. warning:: Calendars logic is opposite to Schedulers: If a day is not defined
   as holiday in any of the calendars, it will considered a normal day and no
   filtering will be applied.

.. hint:: Holidays without special locutions will apply the external call filter
   holiday locution.

.. hint:: Holidays without special routing will apply the external call filter
   holiday routing.

