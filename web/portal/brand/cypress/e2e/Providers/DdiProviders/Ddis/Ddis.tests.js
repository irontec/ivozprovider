import CompaniesItem from '../../../../fixtures/Provider/Companies/VirtualPbxs/getItem.json';
import DdiItem from '../../../../fixtures/Provider/Ddis/getItem.json';
import newDdi from '../../../../fixtures/Provider/Ddis/post.json';
import editDdis from '../../../../fixtures/Provider/Ddis/put.json';

export const postDdi = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/ddis*',
      response: newDdi.response,
      matchingRules: newDdi.matchingRules,
    },
    'createDdi'
  );

  cy.usePactIntercept(
    {
      method: 'GET',
      url: '**/api/brand/companies/1*',
      response: { ...CompaniesItem },
    },
    'getCompanies-1'
  );

  cy.get('[aria-label=Add]').click();

  const { ddi, description, type, company, country } = newDdi.request;
  cy.fillTheForm({
    ddi,
    description,
    type,
    company,
    country,
  });

  cy.get('header li.MuiBreadcrumbs-li:last').should('contain', 'DDIs');

  cy.usePactWait(['createDdi']).its('response.statusCode').should('eq', 201);
};

export const putDdi = () => {
  cy.usePactIntercept(
    {
      method: 'GET',
      url: '**/api/brand/ddis/1',
      response: { ...DdiItem },
    },
    'getDdis-1'
  );

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/brand/ddis/${editDdis.response.body.id}`,
      response: editDdis.response,
    },
    'editDdis'
  );

  cy.get('svg[data-testid="EditIcon"]').eq(1).click();

  const { ddi, description, type, country } = newDdi.request;
  cy.fillTheForm({
    ddi,
    description,
    type,
    country,
  });

  cy.get('header').should('contain', 'DDIs');

  cy.usePactWait(['editDdis']).its('response.statusCode').should('eq', 200);
};

export const deleteDdi = () => {
  cy.intercept('DELETE', '**/api/brand/ddis/*', {
    statusCode: 204,
  }).as('deleteDdi');

  cy.get('td button svg[data-testid="DeleteIcon"]').first().click();
  cy.contains('Remove element');
  cy.get('[role="dialog"]')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header li.MuiBreadcrumbs-li:last').should('contain', 'DDIs');

  cy.usePactWait(['deleteDdi']).its('response.statusCode').should('eq', 204);
};
