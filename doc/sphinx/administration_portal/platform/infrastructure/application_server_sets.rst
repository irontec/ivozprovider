Application Server Sets

The Application Server Sets section allows users to manage sets of application servers by adding, deleting, and editing them.
Overview

An Application Server Set consists of the following attributes:

    Name: The name of the Application Server Set (string, required).
    Distribute Method: The method used for distributing tasks among servers (string, required). Possible values are:
        "Round Robin"
        "Hash"
    Description: A brief description of the Application Server Set (string, optional).
    Application Servers: A multi-select list where users can choose one or more application servers (string list). This can be left empty when creating an Application Server Set but is mandatory when editing.

Features

    Add: Allows the user to create a new Application Server Set by providing a Name and a Distribute Method. The Description is optional, and the Application Servers list can initially be empty.
    Edit: Enables editing of an existing Application Server Set. While Name and Distribute Method remain mandatory, the Application Servers list must contain at least one selected server during the editing process.
    Delete: Permits the removal of an existing Application Server Set.

Field Descriptions
Field	Description	Required
Name	The unique name of the Application Server Set.	Yes
Distribute Method	The method of distributing tasks (Round Robin or Hash).	Yes
Description	An optional description of the set.	No
Application Servers	A multi-select list of chosen application servers. Can be empty on creation, but required on editing.	No (creation), Yes (editing)
Usage Notes

    When creating a new Application Server Set, ensure that both Name and Distribute Method are provided.
    The Application Servers list can be left empty when first creating the set but must be populated with at least one server upon editing.
