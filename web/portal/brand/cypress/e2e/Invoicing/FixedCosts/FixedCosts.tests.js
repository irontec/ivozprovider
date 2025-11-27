import FixedCostsItem from '../../../fixtures/Provider/FixedCosts/getItem.json';
import newFixedCosts from '../../../fixtures/Provider/FixedCosts/post.json';
import editFixedCosts from '../../../fixtures/Provider/FixedCosts/put.json';

export const postFixedCosts = () => {
  cy.intercept('GET', '**/api/brand/fixed_costs/1', {
    ...FixedCostsItem,
  }).as('getFixedCosts-1');
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/fixed_costs*',
      response: newFixedCosts.response,
      matchingRules: newFixedCosts.matchingRules,
    },
    'createFixedCostsRel'
  );

  cy.get('[aria-label=Add]').click();
  cy.fillTheForm(newFixedCosts.request);

  cy.get('header').should('contain', 'Fixed costs');

  cy.usePactWait('createFixedCostsRel')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putFixedCosts = () => {
  cy.intercept('GET', '**/api/brand/fixed_costs/1', {
    ...FixedCostsItem,
  }).as('getFixedCosts-1');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/brand/fixed_costs/${editFixedCosts.response.body.id}`,
      response: editFixedCosts.response,
    },
    'editFixedCosts-1'
  );
  cy.get('svg[data-testid="EditIcon"]').eq(1).first().click();
  cy.fillTheForm(editFixedCosts.request);
  cy.get('header').should('contain', 'Fixed costs');
  cy.usePactWait(['editFixedCosts-1'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteteFixedCosts = () => {
  cy.intercept('DELETE', '**/api/brand/fixed_costs/*', {
    statusCode: 204,
  }).as('deleteInvoiceTemplate');

  cy.get('td svg[data-testid="DeleteIcon"]').first().click();

  cy.contains('Remove element');
  cy.get('[role="dialog"]')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.usePactWait(['deleteInvoiceTemplate'])
    .its('response.statusCode')
    .should('eq', 204);
};
