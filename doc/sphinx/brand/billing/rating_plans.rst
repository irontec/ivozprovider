#############
Rating plans
#############

**********************
Creating a rating plan
**********************

Destination rates are grouped using Rating plans. This offers the possibility to have base pricing data and customize
some destination with different prices.

Create a **rating plan**:

.. ifconfig:: language == 'en'

    .. image:: img/en/rating_plan_new.png

.. ifconfig:: language == 'es'

    .. image:: img/es/rating_plan_new.png


And then we can add our destination rate:

.. ifconfig:: language == 'en'

    .. image:: img/en/rating_plan_add.png

.. ifconfig:: language == 'es'

    .. image:: img/es/rating_plan_add.png

The **metric** of the link lets you assign more than one *destination rate* for a
plan, even though some destinations are included in more than one of those
destination rates.

.. attention:: If a given call can be billed with more than one destination rate,
    it will be billed using the one with lowest metric.

.. tip:: This allows having a general *Destination rate* and concrete the price of
    a specific destination in another *destination rate* with lower metric (free cell
    phone calls, for example).

.. rubric:: Checking Rating plans

To check the configuration so far we can **Simulate a call** from the rating plans list.

We introduce the destination number in :ref:`E.164 format <e164>`, and we can check that it matches
the **rating plan** we have just created:

.. ifconfig:: language == 'en'

    .. image:: img/en/rating_plan_simulate.png

.. ifconfig:: language == 'es'

    .. image:: img/es/rating_plan_simulate.png

*************************************
Assigning a rating plan to a company
*************************************

A specific **rating plan** can be linked to multiple companies.

In the section **Brand configuration** > **Virtual PBXs** we select the *demo*
company:

.. ifconfig:: language == 'en'

    .. image:: img/en/rating_plan_company.png

.. ifconfig:: language == 'es'

    .. image:: img/es/rating_plan_company.png


The **Rating plan** have an activation time, and only one can be active for each
company.

.. ifconfig:: language == 'en'

    .. image:: img/en/rating_plan_company2.png

.. ifconfig:: language == 'es'

    .. image:: img/es/rating_plan_company2.png


.. rubric:: Simulating a call of a specific company

In this list we can also simulate a call for a given company like we did previously
in the rating plan list and check the price it will imply. This way, we can be sure
that the configuration is ok.
