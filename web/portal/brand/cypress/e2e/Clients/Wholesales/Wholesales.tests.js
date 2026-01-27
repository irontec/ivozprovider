import CompaniesItem from '../../../fixtures/Provider/Companies/Wholesales/getItem.json';
import newCompanies from '../../../fixtures/Provider/Companies/Wholesales/post.json';
import editCompanies from '../../../fixtures/Provider/Companies/Wholesales/put.json';
import { MODE, testPbx } from '../utils/PbxsValidator';

export const postCompany = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/companies*',
      response: newCompanies.response,
      matchingRules: newCompanies.matchingRules,
    },
    'createWholesaleCompanies'
  );

  cy.get('[aria-label=Add]').click();

  testPbx({ ...newCompanies, mode: MODE.NEW });

  cy.get('header').should('contain', 'Wholesales');

  cy.usePactWait(['createWholesaleCompanies'])
    .its('response.statusCode')
    .should('eq', 201);
};

export const putCompany = () => {
  cy.usePactIntercept(
    {
      method: 'GET',
      url: '**/api/brand/companies/5',
      response: { ...CompaniesItem },
    },
    'getWholesaleCompany-5'
  );

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/brand/companies/${editCompanies.response.body.id}`,
      response: editCompanies.response,
    },
    'editWholesaleCompanies'
  );

  cy.get('svg[data-testid="EditIcon"]').eq(4).click();

  testPbx({ ...editCompanies, mode: MODE.EDIT });

  cy.get('header').should('contain', 'Wholesales');

  cy.usePactWait(['editWholesaleCompanies'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteCompany = () => {
  cy.contains('Wholesales').click();

  cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
  cy.contains('button', 'Delete').click();

  cy.contains('Warning');
  cy.get('[role="dialog"]').filter(':visible').contains('Continue').click();
  cy.get('[role="dialog"] input[type="text"]').type('DemoCompany');

  cy.contains('Remove element');
  cy.get('[role="dialog"]')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'Wholesales');
};

export const postWebPortal = () => {
  cy.contains('Retails').click();

  cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
  cy.get('li.MuiMenuItem-root').contains('Administration Portals').click();
  cy.get('svg[data-testId="AddIcon"]').first().click();

  cy.get('input[name="urlType"]').should('be.disabled');
};
