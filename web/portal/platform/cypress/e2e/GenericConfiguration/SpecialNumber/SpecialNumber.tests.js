import CountriesCollection from '../../../fixtures/Countries/getCollection.json';
import ServicesItem from '../../../fixtures/SpecialNumber/getItem.json';
import newSpecialNumber from '../../../fixtures/SpecialNumber/post.json';
import editSpecialNumber from '../../../fixtures/SpecialNumber/put.json';

export const postSpecialNumbers = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/platform/special_numbers*',
      response: newSpecialNumber.response,
      matchingRules: newSpecialNumber.matchingRules,
    },
    'createSpecialNumbers'
  );

  cy.get('[aria-label=Add]').click();

  cy.fillTheForm(newSpecialNumber.request);

  cy.get('header').should('contain', 'Global Special Numbers');

  cy.usePactWait('createSpecialNumbers')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putSpecialNumbers = () => {
  cy.intercept('GET', '**/api/platform/countries', {
    ...CountriesCollection,
  }).as('getCountries');

  cy.intercept('GET', '**/api/platform/special_numbers/1', {
    ...ServicesItem,
  }).as('getService-1');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/platform/special_numbers/${editSpecialNumber.response.body.id}`,
      response: editSpecialNumber.response,
    },
    'editSpecialNumber'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  cy.fillTheForm(editSpecialNumber.request);

  cy.get('header').should('contain', 'Global Special Numbers');

  cy.usePactWait(['editSpecialNumber'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteteSpecialNumbers = () => {
  cy.intercept('DELETE', '**/api/platform/special_numbers/*', {
    statusCode: 204,
  }).as('deleteSpecialNumbers');

  cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

  cy.contains('Remove element');
  cy.get('[role="dialog"]')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'Global Special Numbers');

  cy.usePactWait(['deleteSpecialNumbers'])
    .its('response.statusCode')
    .should('eq', 204);
};
