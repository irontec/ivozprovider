import DdiProvidersAddressesItem from '../../../../fixtures/Provider/DdiProviders/getProviderAddressesItem.json';
import newDdiProvidersAddresses from '../../../../fixtures/Provider/DdiProviders/postProviderAddresses.json';
import editDdisProvidersAddresses from '../../../../fixtures/Provider/DdiProviders/putProviderAddresses.json';

export const postDdiProvidersAddresses = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/ddi_provider_addresses*',
      response: newDdiProvidersAddresses.response,
      matchingRules: newDdiProvidersAddresses.matchingRules,
    },
    'createDdiProvidersAddresses'
  );

  cy.get('[aria-label=Add]').click();
  cy.get('header').should('contain', 'DDI Provider Addresses');

  const { ip, description } = newDdiProvidersAddresses.request;
  cy.fillTheForm({ ip, description });

  cy.usePactWait(['createDdiProvidersAddresses'])
    .its('response.statusCode')
    .should('eq', 201);
};

export const putDdiProvidersAddresses = () => {
  cy.usePactIntercept(
    {
      method: 'GET',
      url: '**/api/brand/ddi_provider_addresses/1',
      response: { ...DdiProvidersAddressesItem },
    },
    'getDdisProvidersAddresses-1'
  );

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/brand/ddi_provider_addresses/${editDdisProvidersAddresses.response.body.id}`,
      response: editDdisProvidersAddresses.response,
    },
    'editDdisProvidersAddresses'
  );

  cy.get('svg[data-testid="EditIcon"]').click();

  const { description, ip } = editDdisProvidersAddresses.request;
  cy.fillTheForm({ description, ip });

  cy.get('header').should('contain', 'DDI Provider Addresses');

  cy.usePactWait(['editDdisProvidersAddresses'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteDdiProviders = () => {
  cy.intercept('DELETE', '**/api/brand/ddi_provider_addresses/*', {
    statusCode: 204,
  }).as('deleteDdiProvidersAddresses');
  cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();
  cy.contains('Remove element');
  cy.get('div.MuiDialog-container button')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'DDI Provider Addresses');

  cy.usePactWait(['deleteDdiProvidersAddresses'])
    .its('response.statusCode')
    .should('eq', 204);
};
