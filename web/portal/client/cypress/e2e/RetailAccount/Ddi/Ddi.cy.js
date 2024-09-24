import DdiCollection from '../../../fixtures/Ddi/getCollection.json';
import DdiItem from '../../../fixtures/Ddi/getItem.json';
import editDdi from '../../../fixtures/Ddi/put.json';

describe('Retail Accounts Ddi', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Retail-Accounts-Ddi');
    cy.before();

    cy.contains('Retail Accounts').click();

    cy.get('header').should('contain', 'Retail Accounts');

    cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
    cy.get('li.MuiMenuItem-root').contains('DDIs').click();

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
      residentialDevice,
      routeType,
      user,
    });

    cy.contains('DDIs');

    cy.usePactWait(['editDdi']).its('response.statusCode').should('eq', 200);
  });
});
