######
Queues
######

Easy queue behaviour was included in IvozProvider in 1.3 version. It is a simple
approach with **the unique goal to provide the capability to handle more calls
than users attending them**.

.. warning:: Queues and callcenter are close terms but different. **IvozProvider
             is not a suitable product for callcenters**, as it does not provide
             advanced features that are crucial to them (reports, RT visualization,
             queue related stat, etc.).

This easy approach has a drawback **in distributed installations**: as Asterisk does
not provide yet a way to share queue information between multiple instances and
as we have not found a proper way neither, **a company that uses queues must have
an static assignment to one of the Application Servers** (in Companies section).

.. hint:: Brand operators can choose which Companies have queues (see **Features**
          in :ref:`Brand Configuration` and :ref:`Company Configuration`).

Queue configuration
===================

This are the settings related to a queue:

.. glossary::

  Name
    Use to reference this queue

  Weight
    Priorizes calls to an agent that attends calls in two (or more) calls. The
    higher, the more priorized.

  Strategy
    How will the queue deliver the calls? Calling to all agents, calling to a
    random one?

  Member call seconds
    Defines how long will a call to an agent last.

  Member rest seconds
    Seconds between calls for an agent.

  Announce
    Select a locution and its frequency. Caller waiting in the call will listen
    to this locution.

  Timeout configuration
    Limits the time that a call can wait in a queue and the following behaviour.

  Full Queue configuration
    Limits the amount of people waiting in a call and the behaviour when this limit
    it reached.

Apart from creating a queue, you have to assign users to it. This users will have
a **penalty: a user will not be selected to deliver a call if any user with lower
penalty is available**.


.. hint:: A call can be sent to a queue selecting it in the "Route type" selectors
          available in multiple sections of IvozProvider (extension to queue, DDI
          to queue, etc.)
