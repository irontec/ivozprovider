import DdiCollection from '../../fixtures/Ddi/getCollection.json';
import DdiItem from '../../fixtures/Ddi/getItem.json';
import editDdi from '../../fixtures/Ddi/put.json';

describe('Ddi', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Ddi');
    cy.before();

    cy.contains('DDIs').click();

    cy.get('header').should('contain', 'DDIs');

    cy.get('table').should('contain', DdiCollection.body[0].ddie164);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Ddi', () => {
    cy.intercept('GET', '**/api/client/ddis/1', {
      ...DdiItem,
    }).as('getDdi-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/ddis/${editDdi.response.body.id}`,
        response: editDdi.response,
      },
      'editDdi'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const {
      conditionalRoute,
      conferenceRoom,
      description,
      displayName,
      externalCallFilter,
      fax,
      huntGroup,
      ivr,
      language,
      queue,
      recordCalls,
      residentialDevice,
      routeType,
      user,
    } = editDdi.request;

    cy.fillTheForm({
      conditionalRoute,
      conferenceRoom,
      description,
      displayName,
      externalCallFilter,
      fax,
      huntGroup,
      ivr,
      language,
      queue,
      recordCalls,
      residentialDevice,
      routeType,
      user,
    });

    cy.contains('DDIs');

    cy.usePactWait(['editDdi']).its('response.statusCode').should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('cannot delete DDIs', () => {
    cy.get(
      'td > div.actions-cell > span > button:has(svg[data-testid="DeleteIcon"])'
    )
      .first()
      .should('be.disabled');

    cy.get('header').should('contain', 'DDIs');
  });
});
