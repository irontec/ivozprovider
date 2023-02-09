.. _use case:

########
Use Case
########

Let's put a little use case as an example: A platform admin wants to obtain the companies of one specific brand (companies are exposed on Brand API only). The operation would be:

.. rubric:: On platform API (https://your-domain/api/platform)

#. Login (request a token) as god admin on /admin_login

#. Search target brand on /brands

.. rubric:: On Brand API (https://brand-domain/api/brand)

#. Impersonate as a brand admin on Auth> /token/exchange (requires a god token and the brand Id. You can impersonate by the username of a brand administrator instead of a brand id as well)

#. Request brand companies using the endpoint /companies

