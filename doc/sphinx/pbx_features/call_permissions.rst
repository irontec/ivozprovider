.. _call_permissions:

################
Call ACL Control
################

The **Call ACLs** determines what users can call to external numbers. 

.. attention:: The internal extensions are allowed to all users, the **Call 
   ACLs only apply to external numbers**  

The **Call ACL** setup has two different parts: 

- Classify the call in different types based on **regular expressions**:

    - Brand level: **Brand Configuration** > **Generic call ACL patterns**

    - Company level: **Company Configuration** > **Call ACL patterns**

- Choose policies for groups of patterns: **Company Configuration** > **Call 
  ACLs**

*****************
Call ACL patterns
*****************

The destination number is matched against the **Company ACL patterns** to determine
the destination type.

.. note:: When a Brand operator creates a new company, all of the **Generic 
   ACL patterns** defined in the **Brand configuration** are copied to the
   **Company configuration** > **Call ACLs**. This way, the brand operator can
   define the most common patterns to speed up the company configuration.

The patterns creation process is quite simple:

.. image:: img/permissions_patterns.png

This new ACL pattern are grouped the calls starting with the spanish E.164 
prefix followed by 6 or 7 and 8 more digits between 0 and 9. These is the E.164 
format for the spanish mobile numbers. 

Following this spanish example, other formats will be:

- Spanish Landline (including special numbers prefix: 902, etc.): ^34[89][0-9]{8}$
    - 8 or 9 followed by 8 digits 

- Spanish Landline (excluding special number prefix: 902, etc.): ^34[89][1-9][0-9]{7}$
    - 8 or 9, followed by one dígito between 1 and 9, followed by 7 digits.

- United Kingdom Landline: ^44[0-9]+$
    - 44 (UK E.164 prefix), followed by more digits

.. rubric:: External numbers format

The regular expresions of the Call ACL patterns must be in E.164 format. The 
main reason for this is that the same pattern will be applied to all the users 
of the company no matter what country the user is.

For example, a spanish user will call a french number using its international 
prefix (00) and France E.164 code (33) followed by the number, while a french 
user of the same company will only dial the number. For both of them the same 
company ACL pattern will be applied. 

********
Call ACL
********

The **Call ACL** configuration is easier to explain with an example:

Imagine the following **CALL ACL patterns**: 

.. image:: img/permissions_patterns_list.png

We could create a **Call ACL** that only allow calling to this destinations:

.. image:: img/permissions_add.png

.. note:: The default action determines what to do with the call when the 
   destination number **does not match any ACL patterns**.

After creating the **Call ACL** we can edit it to add the required rules:

.. image:: img/permissions_add2.png

The **metric** determines the evaulation order of the rules and the action that
 that will be applied if it *matches* the pattern (allow/deny).

.. image:: img/permissions_add3.png

Once we have added our two spanish **Call ACL patterns**, our **Call ACL** will 
look like this:

.. image:: img/permissions_add4.png

We only have to assign this ACL to the users in the section **Company 
configuration** > **Users**:

.. image:: img/permissions_add5.png

From this moment on, Alice will only be allowed to call internal extensions 
(they are always allowed) and spanish numbers.
 
