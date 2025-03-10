import CompaniesItem from '../../../fixtures/Provider/Companies/VirtualPbxs/getItem.json';
import newCompanies from '../../../fixtures/Provider/Companies/VirtualPbxs/post.json';
import editCompanies from '../../../fixtures/Provider/Companies/VirtualPbxs/put.json';
import webPortals from '../../../fixtures/Provider/WebPortals/getCollection.json';
import { MODE, testPbx } from '../utils/PbxsValidator';

export const postCompany = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/companies*',
      response: newCompanies.response,
      matchingRules: newCompanies.matchingRules,
    },
    'createCompanies'
  );

  cy.get('[aria-label=Add]').click();

  testPbx({ ...newCompanies, mode: MODE.NEW });

  cy.get('header').should('contain', 'Virtual PBXs');

  cy.usePactWait(['createCompanies'])
    .its('response.statusCode')
    .should('eq', 201);
};
export const putCompany = () => {
  cy.usePactIntercept(
    {
      method: 'GET',
      url: '**/api/brand/companies/1',
      response: { ...CompaniesItem },
    },
    'getCompanies-1'
  );

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/brand/companies/${editCompanies.response.body.id}`,
      response: editCompanies.response,
    },
    'editCompanies'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  testPbx({ ...editCompanies, mode: MODE.EDIT });

  cy.get('header').should('contain', 'Virtual PBXs');

  cy.usePactWait(['editCompanies'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteCompany = () => {
  cy.contains('Virtual PBXs').click();

  cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
  cy.get('li.MuiMenuItem-root').contains('Delete').click();

  cy.contains('Remove element');
  cy.get('div.MuiDialog-container button')
    .filter(':visible')
    .contains('Yes, delete it')
    .click({ force: true });

  cy.get('header').should('contain', 'Virtual PBXs');
};

export const postWebPortal = () => {
  cy.usePactIntercept(
    {
      method: 'GET',
      url: '**/api/brand/companies/1',
      response: CompaniesItem,
    },
    'getCompanies-1'
  );

  cy.contains('Virtual PBXs').click();

  cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
  cy.get('li.MuiMenuItem-root').contains('Administration Portals').click();
  cy.get('svg[data-testId="AddIcon"]').first().click();

  cy.get('input[name="urlType"]').should('be.enabled');
};

export const checkImpersonationURL = () => {
  cy.contains('Virtual PBXs').click();

  const impersonationURLs = webPortals.body.map((wp) => wp.url);

  cy.get('div.actions-cell a[target="_impersonate-client"]').as(
    'impersonation-links'
  );

  cy.get('a[target="_impersonate-client"]')
    .eq(0)
    .should('have.attr', 'href')
    .should('match', new RegExp(`${impersonationURLs[2]}.*`));

  cy.get('@impersonation-links')
    .eq(1)
    .should('have.attr', 'href')
    .should('match', new RegExp(`${impersonationURLs[0]}.*`));
};
