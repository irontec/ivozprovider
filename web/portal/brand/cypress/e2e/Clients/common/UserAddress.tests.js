import UsersAddresses from '../../../fixtures/Kam/UsersAddresses/getCollection.json';
import NewUsersAddress from '../../../fixtures/Kam/UsersAddresses/post.json';
import EditUserAddress from '../../../fixtures/Kam/UsersAddresses/put.json';

export const addUserAddress = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/users_addresses*',
      response: NewUsersAddress.response,
    },
    'postUsersAddress'
  );

  cy.contains('Add').click();
  cy.get('header').should('contain', 'New');

  const data = NewUsersAddress.request;
  delete data.company;

  cy.fillTheForm(data);

  cy.usePactWait(['postUsersAddress'])
    .its('response.statusCode')
    .should('eq', 201);
};

export const editUserAddress = () => {
  cy.usePactIntercept(
    {
      method: 'GET',
      url: '**/api/brand/users_addresses/1',
      response: UsersAddresses.body[0],
    },
    'getUsersAddress-1'
  );
  cy.usePactIntercept(
    {
      method: 'PUT',
      url: '**/api/brand/users_addresses/1',
      response: EditUserAddress.response,
    },
    'putUsersAddress-1'
  );
  cy.get('table [data-testid="EditIcon"]').first().click();

  const { sourceAddress, description } = EditUserAddress.request;
  cy.fillTheForm({
    sourceAddress: sourceAddress,
    description: description,
  });

  cy.usePactWait('putUsersAddress-1')
    .its('response.statusCode')
    .should('eq', 204);
};
export const deleteUserAddress = () => {
  cy.usePactIntercept(
    {
      method: 'DELETE',
      url: '**/api/brand/users_addresses/1',
      response: '200',
    },
    'deleteUsersAddress-1'
  );

  cy.get('table [data-testid="DeleteIcon"]').first().click();
  cy.contains('Remove element');
  cy.get('[role="dialog"]')
    .filter(':visible')
    .contains('Yes, delete it')
    .click({ force: true });

  cy.usePactWait('deleteUsersAddress-1')
    .its('response.statusCode')
    .should('eq', 200);
};
