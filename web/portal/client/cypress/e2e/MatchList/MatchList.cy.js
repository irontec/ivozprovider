import MatchListCollection from '../../fixtures/MatchList/getCollection.json';
import MatchListItem from '../../fixtures/MatchList/getItem.json';
import newMatchList from '../../fixtures/MatchList/post.json';
import editMatchList from '../../fixtures/MatchList/put.json';

describe('MatchList', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('MatchList');
    cy.before();

    cy.contains('Routing tools').click();
    cy.contains('Match Lists').click();

    cy.get('header').should('contain', 'Match Lists');

    cy.get('table').should('contain', MatchListCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add MatchList', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/match_lists*',
        response: newMatchList.response,
        matchingRules: newMatchList.matchingRules,
      },
      'createMatchList'
    );

    cy.get('[aria-label=Add]').click();

    cy.fillTheForm(newMatchList.request);

    cy.get('header').should('contain', 'Match Lists');

    cy.usePactWait('createMatchList')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit MatchList', () => {
    cy.intercept('GET', '**/api/client/match_lists/1', {
      ...MatchListItem,
    }).as('getMatchList-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/match_lists/${editMatchList.response.body.id}`,
        response: editMatchList.response,
      },
      'editMatchList'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    cy.fillTheForm(editMatchList.request);

    cy.contains('Match Lists');

    cy.usePactWait(['editMatchList'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete MatchList', () => {
    cy.intercept('DELETE', '**/api/client/match_lists/*', {
      statusCode: 204,
    }).as('deleteMatchList');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Match Lists');

    cy.usePactWait(['deleteMatchList'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
