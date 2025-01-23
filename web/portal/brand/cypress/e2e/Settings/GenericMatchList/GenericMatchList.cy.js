import MatchListsItem from '../../../fixtures/Provider/MatchList/getItem.json';
import newMatchLists from '../../../fixtures/Provider/MatchList/post.json';
import editMatchLists from '../../../fixtures/Provider/MatchList/put.json';
import MatchListsCollection from './../../../fixtures/Provider/MatchList/getCollection.json';

describe('in Generic Match List', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Generic-match-list');
    cy.before('');

    cy.get('svg[data-testid="SettingsIcon"]').first().click();
    cy.contains('Generic Match List').click();

    cy.get('header').should('contain', 'Generic Match List');

    cy.get('table').should('contain', MatchListsCollection.body[0].name);
  });

  ////////////////
  // POST
  ////////////////
  it('add Generic Match List', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/match_lists*',
        response: newMatchLists.response,
        matchingRules: newMatchLists.matchingRules,
      },
      'createMatchLists'
    );

    cy.get('[aria-label=Add]').click();

    cy.fillTheForm(newMatchLists.request);

    cy.get('header').should('contain', 'Generic Match List');

    cy.usePactWait(['createMatchLists'])
      .its('response.statusCode')
      .should('eq', 201);
  });

  /////////////////
  // PUT
  /////////////////
  it('edit Generic Match List', () => {
    cy.intercept('GET', '**/api/brand/match_lists/3', {
      ...MatchListsItem,
    }).as('getMatchLists-3');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/match_lists/${editMatchLists.response.body.id}`,
        response: editMatchLists.response,
      },
      'editMatchLists'
    );

    cy.get('svg[data-testid="EditIcon"]').eq(0).click();
    cy.fillTheForm(editMatchLists.request);

    cy.usePactWait(['editMatchLists'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  /////////////////////
  // DELETE
  /////////////////////
  it('delete Generic Match List', () => {
    cy.intercept('DELETE', '**/api/brand/match_lists/3', {
      statusCode: 204,
    }).as('deleteMatchLists');

    cy.get('td button > svg[data-testid="DeleteIcon"]').eq(0).click();

    cy.contains('Remove element');

    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Generic Match List');

    cy.usePactWait(['deleteMatchLists'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
