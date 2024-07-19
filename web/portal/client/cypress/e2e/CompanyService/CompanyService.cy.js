import CompanyServiceCollection from '../../fixtures/CompanyService/getCollection.json';
import CompanyServiceItem from '../../fixtures/CompanyService/getItem.json';
import newCompanyService from '../../fixtures/CompanyService/post.json';
import editCompanyService from '../../fixtures/CompanyService/put.json';

describe('CompanyService', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('CompanyService');
    cy.prepareGenericPactInterceptors('Service');
    cy.before();

    cy.contains('Services').click();

    cy.get('header').should('contain', 'Services');

    cy.get('table').should('contain', CompanyServiceCollection.body[0].code);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add CompanyService', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/company_services*',
        response: newCompanyService.response,
        matchingRules: newCompanyService.matchingRules,
      },
      'createCompanyService'
    );

    cy.get('[aria-label=Add]').click();

    const { service, code } = newCompanyService.request;
    cy.fillTheForm({
      service,
      code,
    });

    cy.get('header').should('contain', 'Services');

    cy.usePactWait('createCompanyService')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit CompanyService', () => {
    cy.intercept('GET', '**/api/client/company_services/1', {
      ...CompanyServiceItem,
    }).as('getCompanyService-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/company_services/${editCompanyService.response.body.id}`,
        response: editCompanyService.response,
      },
      'editCompanyService'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { code } = editCompanyService.request;
    cy.fillTheForm({
      code,
    });

    cy.get('header').contains('Services');

    cy.usePactWait(['editCompanyService'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete CompanyService', () => {
    cy.intercept('DELETE', '**/api/client/company_services/*', {
      statusCode: 204,
    }).as('deleteCompanyService');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Services');

    cy.usePactWait(['deleteCompanyService'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
