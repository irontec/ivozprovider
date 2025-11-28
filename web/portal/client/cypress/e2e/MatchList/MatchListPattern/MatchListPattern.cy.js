import MatchListPatternCollection from '../../../fixtures/MatchListPattern/getCollection.json';
import MatchListPatternItem from '../../../fixtures/MatchListPattern/getItem.json';
import newMatchListPattern from '../../../fixtures/MatchListPattern/post.json';
import editMatchListPattern from '../../../fixtures/MatchListPattern/put.json';

describe('MatchListPattern', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('MatchList');
    cy.before();

    cy.contains('Routing tools').click();
    cy.contains('Match Lists').click();

    cy.get('svg[data-testid="FormatListNumberedIcon"]').first().click();

    cy.get('table').should(
      'contain',
      MatchListPatternCollection.body[0].numbervalue
    );
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add MatchListPattern', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/match_list_patterns*',
        response: newMatchListPattern.response,
        matchingRules: newMatchListPattern.matchingRules,
      },
      'createMatchListPattern'
    );

    cy.get('[aria-label=Add]').click();

    const { description, type, regexp, numbervalue } =
      newMatchListPattern.request;
    cy.fillTheForm({
      description,
      type,
      regexp,
      numbervalue,
    });

    cy.get('header').should('contain', 'Match Lists');
    cy.usePactWait('createMatchListPattern')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit MatchListPattern', () => {
    cy.intercept('GET', '**/api/client/match_list_patterns/1', {
      ...MatchListPatternItem,
    }).as('getMatchListPattern-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/match_list_patterns/${editMatchListPattern.response.body.id}`,
        response: editMatchListPattern.response,
      },
      'EditMatchListPattern'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { description, type, regexp, numbervalue } =
      editMatchListPattern.request;
    cy.fillTheForm({
      description,
      type,
      regexp,
      numbervalue,
    });

    cy.contains('Match List Patterns');
    cy.usePactWait(['EditMatchListPattern'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete MatchListPattern', () => {
    cy.intercept('DELETE', '**/api/client/match_list_patterns/*', {
      statusCode: 204,
    }).as('deleteMatchListPattern');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();
    cy.contains('Remove element');
    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Match Lists');

    cy.usePactWait(['deleteMatchListPattern'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
