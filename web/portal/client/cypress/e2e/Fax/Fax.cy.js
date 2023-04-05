import FaxCollection from '../../fixtures/Fax/getCollection.json';
import newFax from '../../fixtures/Fax/post.json';
import FaxItem from '../../fixtures/Fax/getItem.json';
import editFax from '../../fixtures/Fax/put.json';

describe('in Fax', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Fax');
    cy.before();

    cy.contains('Fax').click();

    cy.get('h3').should('contain', 'List of Faxes');

    cy.get('table').should('contain', FaxCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Fax', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/faxes*',
        response: newFax.response,
        matchingRules: newFax.matchingRules,
      },
      'createFax'
    );

    cy.get('[aria-label=Add]').click();

    const { name, outgoingDdi, sendByEmail, email } = newFax.request;
    cy.fillTheForm({
      name,
      outgoingDdi,
      sendByEmail,
      email,
    });

    cy.get('h3').should('contain', 'List of Faxes');

    cy.usePactWait('createFax').its('response.statusCode').should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Fax', () => {
    cy.intercept('GET', '**/api/client/faxes/1', {
      ...FaxItem,
    }).as('getFax-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/faxes/${editFax.response.body.id}`,
        response: editFax.response,
      },
      'editFax'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { name, outgoingDdi, sendByEmail, email } = editFax.request;
    cy.fillTheForm({
      name,
      outgoingDdi,
      sendByEmail,
      email,
    });

    cy.contains('List of Faxes');

    cy.usePactWait(['editFax']).its('response.statusCode').should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Fax', () => {
    cy.intercept('DELETE', '**/api/client/faxes/*', {
      statusCode: 204,
    }).as('deleteFax');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Faxes');

    cy.usePactWait(['deleteFax']).its('response.statusCode').should('eq', 204);
  });
});
