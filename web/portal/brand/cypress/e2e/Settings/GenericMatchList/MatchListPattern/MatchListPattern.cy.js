import MatchListPatternsItem from '../../../../fixtures/Provider/MatchListPattern/getItem.json';
import editMatchListPatterns from '../../../../fixtures/Provider/MatchListPattern/put.json';
import MatchListPatternsCollection from './../../../../fixtures/Provider/MatchListPattern/getCollection.json';
import newMatchListPatterns from './../../../../fixtures/Provider/MatchListPattern/post.json';

describe('in Match List Patterns', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Generic-match-list-patterns');
    cy.before('');

    cy.get('svg[data-testid="SettingsIcon"]').first().click();
    cy.contains('Generic Match List').click();
    cy.get('svg[data-testid="FormatListBulletedIcon"]').first().click();

    cy.get('header').should('contain', 'Match List Patterns');

    cy.get('table').should('contain', MatchListPatternsCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Match List Patterns', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/match_list_patterns*',
        response: newMatchListPatterns.response,
        matchingRules: newMatchListPatterns.matchingRules,
      },
      'createMatchListPatterns'
    );

    cy.get('[aria-label=Add]').click();

    const { ...rest } = newMatchListPatterns.request;
    delete rest.matchList;

    cy.fillTheForm(rest);

    cy.get('header').should('contain', 'Match List Patterns');

    cy.usePactWait(['createMatchListPatterns'])
      .its('response.statusCode')
      .should('eq', 201);
  });

  ////////////////
  // PUT
  ////////////////
  it('edit Match List Patterns', () => {
    cy.intercept('GET', '**/api/brand/match_list_patterns/2', {
      ...MatchListPatternsItem,
    }).as('getMatchListPatterns-2');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/match_list_patterns/${editMatchListPatterns.response.body.id}`,
        response: editMatchListPatterns.response,
      },
      'editMatchListPatterns'
    );

    cy.get('svg[data-testid="EditIcon"]').eq(0).click();

    const { ...rest } = editMatchListPatterns.request;

    delete rest.numbervalue;
    delete rest.matchList;

    cy.fillTheForm(rest);

    cy.usePactWait(['editMatchListPatterns'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  /////////////////
  // DELETE
  /////////////////
  it('delete Match List Patterns', () => {
    cy.intercept('DELETE', '**/api/brand/match_list_patterns/2', {
      statusCode: 204,
    }).as('deleteMatchListPatterns');

    cy.get('td button > svg[data-testid="DeleteIcon"]').eq(0).click();

    cy.contains('Remove element');

    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Match List Patterns');

    cy.usePactWait(['deleteMatchListPatterns'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
