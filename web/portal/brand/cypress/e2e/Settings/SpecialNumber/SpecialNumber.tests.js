import CountriesCollection from '../../../fixtures/Provider/Countries/getCollection.json';
import ServicesItem from '../../../fixtures/Provider/SpecialNumber/getItem.json';
import newSpecialNumber from '../../../fixtures/Provider/SpecialNumber/post.json';
import editSpecialNumber from '../../../fixtures/Provider/SpecialNumber/put.json';

export const postSpecialNumbers = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/special_numbers*',
      response: newSpecialNumber.response,
      matchingRules: newSpecialNumber.matchingRules,
    },
    'createSpecialNumbers'
  );

  cy.get('[aria-label=Add]').click();

  cy.fillTheForm(newSpecialNumber.request);

  cy.get('header').should('contain', 'Special Numbers');

  cy.usePactWait('createSpecialNumbers')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putSpecialNumbers = () => {
  cy.intercept('GET', '**/api/brand/countries', {
    ...CountriesCollection,
  }).as('getCountries');

  cy.intercept('GET', '**/api/brand/special_numbers/1', {
    ...ServicesItem,
  }).as('getService-1');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/brand/special_numbers/${editSpecialNumber.response.body.id}`,
      response: editSpecialNumber.response,
    },
    'editSpecialNumber'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  cy.fillTheForm(editSpecialNumber.request);

  cy.get('header').should('contain', 'Special Numbers');

  cy.usePactWait(['editSpecialNumber'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteteSpecialNumbers = () => {
  cy.intercept('DELETE', '**/api/brand/special_numbers/*', {
    statusCode: 204,
  }).as('deleteSpecialNumbers');

  cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

  cy.contains('Remove element');
  cy.get('div.MuiDialog-container button')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'Special Numbers');

  cy.usePactWait(['deleteSpecialNumbers'])
    .its('response.statusCode')
    .should('eq', 204);
};
