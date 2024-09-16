import CompaniesItem from '../../../fixtures/Provider/Companies/Residentials/getItem.json';
import newCompanies from '../../../fixtures/Provider/Companies/Residentials/post.json';
import editCompanies from '../../../fixtures/Provider/Companies/Residentials/put.json';
import { MODE, testPbx } from '../utils/PbxsValidator';

export const postCompany = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/companies*',
      response: newCompanies.response,
      matchingRules: newCompanies.matchingRules,
    },
    'createResidentialCompanies'
  );

  cy.get('[aria-label=Add]').click();

  testPbx({ ...newCompanies, mode: MODE.NEW });

  cy.get('header').should('contain', 'Residentials');

  cy.usePactWait(['createResidentialCompanies'])
    .its('response.statusCode')
    .should('eq', 201);
};
export const putCompany = () => {
  cy.usePactIntercept(
    {
      method: 'GET',
      url: '**/api/brand/companies/4',
      response: { ...CompaniesItem },
    },
    'getResidentialCompanies-4'
  );

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/brand/companies/${editCompanies.response.body.id}`,
      response: editCompanies.response,
    },
    'editResidentialCompanies'
  );

  cy.get('svg[data-testid="EditIcon"]').eq(2).click();

  testPbx({ ...editCompanies, mode: MODE.EDIT });

  cy.get('header').should('contain', 'Residentials');

  cy.usePactWait(['editResidentialCompanies'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteCompany = () => {
  cy.contains('Residentials').click();

  cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
  cy.get('li.MuiMenuItem-root').contains('Delete').click();

  cy.contains('Remove element');
  cy.get('div.MuiDialog-container button')
    .filter(':visible')
    .contains('Yes, delete it')
    .click({ force: true });

  cy.get('header').should('contain', 'Residentials');
};

export const postWebPortal = () => {
  cy.contains('Residentials').click();

  cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
  cy.get('li.MuiMenuItem-root').contains('Administration Portals').click();
  cy.get('svg[data-testId="AddIcon"]').first().click();

  cy.get('input[name="urlType"]').should('be.disabled');
};
