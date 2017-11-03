.. _conference_rooms:

################
Conference rooms
################

IvozProvider supports Conference rooms that can be configured in the section
**Company configuration** > **Conference rooms**.

**In distributed installations** using Conferences is only compatible with an static
assignment or 'hash based' distribution (see **Distribute method** :ref:`here <Remaining Parameters>`).

.. hint:: Brand operators can choose which Companies have conferences (see **Features**
          in :ref:`Brand Configuration` and :ref:`Company Configuration`).

.. rubric:: Create a new audio conference

The following image shows the process of creating a new confrence room:

.. image:: img/conference_room.png

.. glossary::

    Name
        Name that will used to identify this conference room in other sections
        
    Max members
        Maximum number of participants in the conference. When this limit is 
        reached, join requests will be rejected.

    Pin protected
        Conference rooms can be pin protected. The pin will be requested before
        entering and must be numeric. 

.. note:: Member limit can be disabled by setting it to 0. 

.. rubric:: Route an extension or DDI to the conference

In order to enter a conference there must be a number that is route to them:

.. image:: img/conference_room_ext.png

In the following section we will see how to configure a :ref:`external DDI 
<external_ddis>` to a conference room so it can be used by external callers.

.. hint:: There are other ways to make external callers join a conference room
   without using a DDI: it can be assigned to an Extension. This way, any user
   can transfer the call to the conference extension, or can be routed, for 
   exmaple using an IVR entry.
