.. _calendars:

*********
Calendars
*********

Calenders are used to define what days are considered as holiday. Like
schedules, multiples calendars can be combined.

Calendar Holidays
-----------------

Calendar creation process only requires a name. Once created, we can add what
days will be holidays using the buttons in its row:


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

.. hint:: In addition, once a date has been created, there is the possibility of
   importing more dates from a file. This option is found in the date list menu and
   is called *Import from CSV*.
   Also a range of dates may be added with *Add Holiday date range* menu option.

.. _special schedules:

Special schedules
-----------------

Calendars can also be used to override some time periods with a different schedule.
This can be handy if vPBX has a summer schedule or other types of schedule based events.

Special schedules can define a custom Scheduler and override External Call filters configurations:

    Start Date
        Since when the schedules will override the filters configuration

    End Date
        Last day of the period (included)

    Schedules
        Schedules that will be used in the defined period

    Locution
        In case of Out of schedule, this locution that will be played. Leave empty to use External
        call filter's locution.

    Route options
        Override default external call filter Out of schedule options

Difference between non-whole day event and special schedules
------------------------------------------------------------

In order to understand the difference between these two features it is important to know the order of call filter logic:

**1. Is current day marked as holiday?**

This is where non-whole day event applies, making the answer to the question above possitive during defined period.

    - Yes: apply holiday logic defined in the calendar event or in External Call Filter.

    - No: proceed to question 2.

**2. Is current time marked as out-of-schedule?**

This is where special schedules applies, overriding schedules of External Call Filter with the one defined in calendar
period.

    - Yes: apply out-of-schedule logic defined in the special schedules or in External Call Filter.

    - No: proceed with standard logic.

.. rubric:: Example

Configuration of a given day:

    - Non-whole day event: 8:00-15:00

    - Special schedule: 13:00-17:00

Cases:

    - Call at 7:00: out of schedule due to special schedule.

    - Call at 9:00: holiday logic due to non-whole day event.

    - Call at 14:00: holiday logic due to non-whole day event.

    - Call at 16:00: normal logic.

    - Call at 18:00: out of schedule due to special schedule.

