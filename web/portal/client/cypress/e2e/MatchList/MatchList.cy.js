import MatchListCollection from '../../fixtures/MatchList/getCollection.json';
import newMatchList from '../../fixtures/MatchList/post.json';
import MatchListItem from '../../fixtures/MatchList/getItem.json';
import editMatchList from '../../fixtures/MatchList/put.json';

describe('in MatchList', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('MatchList');
    cy.before();

    cy.contains('Listas de coincidencia').click();

    cy.get('h3').should('contain', 'List of Listas de coincidencia');

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

    cy.get('h3').should('contain', 'List of Listas de coincidencia');

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

    cy.contains('List of Listas de coincidencia');

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

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Listas de coincidencia');

    cy.usePactWait(['deleteMatchList'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
