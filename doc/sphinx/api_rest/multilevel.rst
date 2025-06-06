################
Multi-level API
################

IvozProvider API is divided in same three levels as the web administration portal plus user API:

- God

- Brand

- Client

- User

This split allows different roles with different responsibilities to be integrated against it without compromising
security (read, edit, update or delete the data they should not).

If you check out `security policies <https://github.com/irontec/ivozprovider/blob/main/web/rest/brand/config/api/raw/provider.yml>`_
(read_access_control and write_access_control attributes), you’ll see that we apply
read filters and write validations based on user information (token). One single API approach would require a complex
validations more prone to failure, introduce errors and require huge queries that would impact the performance.

.. note:: That is why we split it into three APIs with **impersonate mechanism** to move between them. This mechanism is
          explained in :ref:`Use Case` section.

In order to access to each level, **you will need a corresponding level URL and credentials**:

.. rubric:: God API access

- Credentials: God credentials defined in :ref:`Main operators`.

.. rubric:: Brand API access

- Credentials: Brand credentials defined in :ref:`Brand operators`.

.. rubric:: Client API access

- Credentials: Client credentials defined in :ref:`Client operators`.

.. rubric:: User API access

- Credentials: User credentials defined in :ref:`users`.

.. warning:: All credentials usernames are unique at brand level. This is why *username + brand URL* duple is needed to
             identify a user (both in API and in web portal).

.. tip:: As both brand and client URLs are internally linked to the same brand (client within that brand), it is also
         possible to access to client API using a brand URL + /api/client.
