At this point, we are looking forward to make our first outgoing call with our
new IvozProvider, we may have even tried to call with current configuration but...

.. _noplan_nocall:

########################
No pricing plan, no call
########################

Just the way we warned :ref:`when we described the duties of the brand operator
<brand_responsibilities>`, the brand operator is **responsible for making all the
needed setup so that IvozProvider is able to bill all external calls**.

.. note:: **Billing a call** is the action of **assigning price** to a call that implies
   cost.

**IvozProvider checks live that a call can be billed when it is established** to avoid
placing calls that imply cost but won't be billed because Brand Operator, due to
a mistake, hasn't assigned a price.

.. error:: If a call can't be billed, IvozProvider won't allow its establishment.
