.. _routes_metrics:

****************
Outgoing Routing
****************

.. glossary::

    Priority
        If a call matches several routes, it will be placed using the outgoing
        route with lower priority, as long as it is available.

    Metric
        If a call matches several routes with equal priority, metric will determine
        the proportion of calls that will use one route or another.

.. note:: This are the key parameters to achieve two interesting features:
   **load-balancing** and **failover-routes**.

Load balancing
==============

*Load-balancing* lets us distribute calls matching the same pattern using
several valid outgoing routes.

.. rubric:: Example 1

- Route A: priority 1, metric 1
- Route B: priority 1, metric 1

Call matching these routes will use route A for %50 of the calls and route B for
%50 of the calls.

.. rubric:: Example 2

- Route A: priority 1, metric 1
- Route B: priority 1, metric 2

Call matching these routes will use route A for %33 of the calls and route B for
%66 of the calls.

Failover routes
===============

Failover route lets us use another route whenever the main route fails.

.. rubric:: Example

- Route A: priority 1, metric 1
- Route B: priority 2, metric 1

All calls matching these routes will try to use route A. In case the call fails,
the call will be placed using route B.

.. tip:: Although given examples use two routes, more routes can be chained and
   failover and load-balancing estrategies can be combined.
