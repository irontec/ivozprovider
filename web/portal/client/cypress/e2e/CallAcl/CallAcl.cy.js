import CallAclCollection from '../../fixtures/CallAcl/getCollection.json';
import CallAclItem from '../../fixtures/CallAcl/getItem.json';
import newCallAcl from '../../fixtures/CallAcl/post.json';
import editCallAcl from '../../fixtures/CallAcl/put.json';

describe('CallAcl', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('CallAcl');
    cy.before();

    cy.contains('User configuration').click();
    cy.contains('Call ACLs').click();

    cy.get('header').should('contain', 'Call ACLs');

    cy.get('table').should('contain', CallAclCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add CallAcl', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/call_acls*',
        response: newCallAcl.response,
        matchingRules: newCallAcl.matchingRules,
      },
      'createCallAcl'
    );

    cy.get('[aria-label=Add]').click();

    const { name, defaultPolicy } = newCallAcl.request;
    cy.fillTheForm({
      name,
      defaultPolicy,
    });

    cy.get('header').should('contain', 'Call ACLs');

    cy.usePactWait('createCallAcl')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit CallAcl', () => {
    cy.intercept('GET', '**/api/client/call_acls/1', {
      ...CallAclItem,
    }).as('getCallAcl-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/call_acls/${editCallAcl.response.body.id}`,
        response: editCallAcl.response,
      },
      'editCallAcl'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { name, defaultPolicy } = editCallAcl.request;
    cy.fillTheForm({
      name,
      defaultPolicy,
    });

    cy.contains('Call ACLs');

    cy.usePactWait(['editCallAcl'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete CallAcl', () => {
    cy.intercept('DELETE', '**/api/client/call_acls/*', {
      statusCode: 204,
    }).as('deleteCallAcl');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Call ACLs');

    cy.usePactWait(['deleteCallAcl'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
