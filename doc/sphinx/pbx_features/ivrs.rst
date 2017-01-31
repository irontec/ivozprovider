################################
Interactive Voice Response (IVR)
################################

IVRs are the most common way to make **audio menus** where the caller must 
choose the destination of the call by **pressing codes** based on the locutions
instructions that will be played.

.. _generic_ivrs:

************
Generic IVRs
************

In this type of IVRs, the caller will directly press the extension that must
previously know (or the welcome locution suggests) and the system will
automatically connect with that extension: 

.. image:: img/ivr_generic.png

Generic IVRs have the following fields:

.. glossary::

    Name
        Descriptive name of the IVR that will be used in other sections.

    Timeout
        Time that caller has to enter the digits of the target extension. 

    Welcome locution
        This locution will be played as soon as the caller enters the IVR.

    Success locution
        In case the dialed extension exists in the company, this locution will
        be played (usually something like 'Connecting, please wait...').

    Blacklist regular expression
        This field can be used to avoid some extensions to be accessed from the
        IVR. In the image above, the exntesions 105 and 106 will not be 
        available, and trying to dialing them will trigger the **error 
        configuration**.
        
    No answer process
        If the dialed extension does not answer in X seconds, the no answer 
        process will trigger, playing the configured locution and redirecting 
        the call to another number, extension or voicemail.

    Error process
        If the dialed extension is invalid (o nothing has been dialed), the 
        error process will trigger, playing the configured locution and
        redirecting the call to another number, extension or voicemail. 

.. _custom_ivrs:

***********
Custom IVRs
***********

Contrary to the generic IVRs where the caller can only dial internal 
extensions, the custom IVRS can configure up to 10 options that can be routed
in different ways.

.. hint:: The most common usage for this IVR is combining them with a welcome
   locution that says something like 'Press 1 to contact XXX, Press 2 to 
   contact YYY, ..."

Most of the configurable fields are the same that generic IVR uses:   

.. image:: img/ivr_custom.png

The main difference on these screens is that **Blacklist regular expression**
makes no sense in this kind of IVRs.

The process of each entry of the IVR can be defined in the following button:

.. image:: img/ivr_custom2.png

In this example, the caller can dial 1, 2 or 3 (the rest will be considered as
an error and will trigger the **Error process**): 

.. image:: img/ivr_custom3.png

- 1: Call to the internal extension 200, created in :ref:`previous section 
  <huntgroups>` that routes to hunt group *Reception*.
- 2: Call to the internal extension 101.
- 3: Route this call to the external number 676 676 676.

.. note:: Each of the Custom IVR entries supports a locution that, if set, 
   will be played instead of the IVR **success locution**. This way, you can 
   configure a generic locution (like 'Connecting....') or a custom one for
   a given entry (like 'Connecting reception department, please wait...').
