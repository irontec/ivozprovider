import CallAclRelMatchList from '../../../fixtures/CallAclRelMatchList/getCollection.json';
import CallAclRelMatchListItem from '../../../fixtures/CallAclRelMatchList/getItem.json';
import newCallAclRelMatchList from '../../../fixtures/CallAclRelMatchList/post.json';
import editCallAclRelMatchList from '../../../fixtures/CallAclRelMatchList/put.json';

describe('CallAclMatchList', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('CallAcl-CallAclRelMatchList');
    cy.before('call_acls');

    cy.get('button > svg[data-testid="AccountTreeIcon"]').first().click();
    cy.get('header').should('contain', 'Call ACL MatchLists');
    cy.get('table').should('contain', CallAclRelMatchList.body[0].matchList);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add CallAclRelMatchList', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/call_acl_rel_match_lists*',
        response: newCallAclRelMatchList.response,
        matchingRules: newCallAclRelMatchList.matchingRules,
      },
      'createCallAclRelMatchList'
    );

    cy.get('[aria-label=Add]').click();

    const { ...rest } = newCallAclRelMatchList.request;
    delete rest.callAcl;

    cy.fillTheForm({
      ...rest,
    });

    cy.get('header').should('contain', 'Call ACL MatchLists');

    cy.usePactWait('createCallAclRelMatchList')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit CallAclRelMatchList', () => {
    cy.intercept('GET', '**/api/client/call_acl_rel_match_lists/1', {
      ...CallAclRelMatchListItem,
    }).as('getCallAcl-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/call_acl_rel_match_lists/${editCallAclRelMatchList.response.body.id}`,
        response: editCallAclRelMatchList.response,
      },
      'editCallAclRelMatchList'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { ...rest } = editCallAclRelMatchList.request;
    delete rest.callAcl;

    cy.fillTheForm({
      ...rest,
    });

    cy.contains('Call ACL MatchLists');

    cy.usePactWait(['editCallAclRelMatchList'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete CallAclRelMatchList', () => {
    cy.intercept('DELETE', '**/api/client/call_acl_rel_match_lists/*', {
      statusCode: 204,
    }).as('deleteCallAclRelMatchList');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Call ACL MatchLists');

    cy.usePactWait(['deleteCallAclRelMatchList'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
