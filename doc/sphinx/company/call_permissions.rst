.. _call_permissions:

################
Call ACL Control
################

The **Call ACLs** determines what users can call to external numbers. 

.. attention:: The internal extensions are allowed to all users, the **Call 
   ACLs only apply to external numbers**  

The **Call ACL** setup has two different parts: 

- Classify the call in different types based on **match lists**:

    - Brand level: **Brand Configuration** > **Match Lists**

    - Company level: **Company Configuration** > **Match Lists**

- Choose policies for groups of patterns: **Company Configuration** > **Call 
  ACLs**

******************
Call ACL Matchlits
******************

The destination number is matched against the **ACL MatchLits** to determine
the call permission.

.. note:: Brand matchlists can be used by any of its companies, so most common
   ACL Patterns (p.e. country prefixes) can be reused easily.

For more information of how MatchLists patterns are created, please refer to section
:ref:`match_lists`.

.. attention:: **Regular expressions of Match List patterns must be in E.164 format**.

********
Call ACL
********

The **Call ACL** configuration is easier to explain with an example:

Imagine the following **match list** with this patterns:

.. ifconfig:: language == 'en'

   .. image:: img/en/permissions_patterns_list.png

.. ifconfig:: language == 'es'

   .. image:: img/es/permissions_patterns_list.png

We could create a **Call ACL** that only allow calling to this destinations:

.. ifconfig:: language == 'en'

   .. image:: img/en/permissions_add.png

.. ifconfig:: language == 'es'

   .. image:: img/es/permissions_add.png


.. note:: The default policy determines what to do with the call when the
   destination number **does not match any ACL matchlists**.

After creating the **Call ACL** we can edit it to add the required rules:

.. ifconfig:: language == 'en'

   .. image:: img/en/permissions_add2.png

.. ifconfig:: language == 'es'

   .. image:: img/es/permissions_add2.png

The **metric** determines the evaluation order of the rules and the action
that will be applied if it *matches* the list (allow/deny).

.. ifconfig:: language == 'en'

   .. image:: img/en/permissions_add3.png

.. ifconfig:: language == 'es'

   .. image:: img/es/permissions_add3.png

Once we have added our spanish **Match List**, our **Call ACL** will
look like this:

.. ifconfig:: language == 'en'

   .. image:: img/en/permissions_add4.png

.. ifconfig:: language == 'es'

   .. image:: img/es/permissions_add4.png

We only have to assign this ACL to the users in the section **Company 
configuration** > **Users**:

.. ifconfig:: language == 'en'

   .. image:: img/en/permissions_add5.png

.. ifconfig:: language == 'es'

   .. image:: img/es/permissions_add5.png

From this moment on, Alice will only be allowed to call internal extensions 
(they are always allowed) and spanish numbers.
 
