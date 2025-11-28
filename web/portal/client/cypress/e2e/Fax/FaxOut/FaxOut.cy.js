import FaxInOutCollection from '../../../fixtures/FaxInOut/getCollection.json';
import FaxInOutItem from '../../../fixtures/FaxInOut/getItem.json';
import newFaxInOut from '../../../fixtures/FaxInOut/post.json';

describe('Fax Out', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Fax-OutgoingFaxfiles');
    cy.before();

    cy.contains('Routing endpoints').click();
    cy.contains('Faxes').click();

    cy.get('header').should('contain', 'Faxes');

    cy.get('svg[data-testid="OutboundIcon"]').first().click();

    cy.get('table').should('contain', FaxInOutCollection.body[0].id);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Fax Out', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/faxes_in_outs*',
        response: newFaxInOut.response,
        matchingRules: newFaxInOut.matchingRules,
      },
      'createFaxOut'
    );

    cy.get('[aria-label=Add]').click();

    const { dst, dstCountry } = newFaxInOut.request;
    cy.fillTheForm({
      dst,
      dstCountry,
    });

    cy.get('header').should('contain', 'Faxes');

    cy.usePactWait('createFaxOut').its('response.statusCode').should('eq', 201);
  });

  ///////////////////////////////
  // GET
  ///////////////////////////////
  it('get Fax Out Detail', () => {
    cy.intercept('GET', '**/api/client/faxes_in_outs/1', {
      ...FaxInOutItem,
    }).as('getFax-1');

    cy.get('svg[data-testid="PanoramaIcon"]').first().click();
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Fax Out', () => {
    cy.intercept('DELETE', '**/api/client/faxes_in_outs/*', {
      statusCode: 204,
    }).as('deleteFaxOut');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Faxes');

    cy.usePactWait(['deleteFaxOut'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
