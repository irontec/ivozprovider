import CurrenciesItem from '../../../fixtures/Currencies/getItem.json';
import newCurrencies from '../../../fixtures/Currencies/post.json';
import editCurrencies from '../../../fixtures/Currencies/put.json';

export const postCurrencies = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/platform/currencies*',
      response: newCurrencies.response,
      matchingRules: newCurrencies.matchingRules,
    },
    'createCurrencies'
  );

  cy.get('[aria-label=Add]').click();

  const { ...rest } = newCurrencies.request;
  delete rest.name;

  cy.fillTheForm({ ...rest });
  cy.get('header').should('contain', 'Currencies');

  cy.usePactWait('createCurrencies')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putCurrencies = () => {
  cy.intercept('GET', '**/api/platform/currencies/3', {
    ...CurrenciesItem,
  }).as('getCurrencies-3');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/platform/currencies/${editCurrencies.response.body.id}`,
      response: editCurrencies.response,
    },
    'editCurrencies'
  );

  cy.get('svg[data-testid="EditIcon"]').eq(1).first().click();

  const { ...rest } = editCurrencies.request;
  delete rest.name;
  delete rest.iden;
  delete rest.symbol;

  cy.fillTheForm({ ...rest });

  cy.get('header').should('contain', 'Currencies');

  cy.usePactWait(['editCurrencies'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteteCurrencies = () => {
  cy.intercept('DELETE', '**/api/platform/currencies/*', {
    statusCode: 204,
  }).as('deleteCurrencies');

  cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

  cy.contains('Remove element');
  cy.get('div.MuiDialog-container button')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'Currencies');

  cy.usePactWait(['deleteCurrencies'])
    .its('response.statusCode')
    .should('eq', 204);
};
