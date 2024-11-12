import DdiResidentialItem from '../../../fixtures/Ddi/getItemResidential.json';
import DdiResidentialCollection from '../../../fixtures/Ddi/getResidentialCollection.json';
import editResidentialDdi from '../../../fixtures/Ddi/putResidential.json';
import { CLIENT_TYPE } from '../../../support/commands/prepareGenericPactInterceptors';

describe('Ddi Residential', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Ddi-Residential', {
      clientType: CLIENT_TYPE.Residential,
    });
    cy.before();

    cy.contains('DDIs').click();

    cy.get('header').should('contain', 'DDIs');

    cy.get('table').should('contain', DdiResidentialCollection.body[0].ddie164);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Ddi Residential', () => {
    cy.intercept('GET', '**/api/client/ddis/1', {
      ...DdiResidentialItem,
    }).as('gerResidentialDdi-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/ddis/${editResidentialDdi.response.body.id}`,
        response: editResidentialDdi.response,
      },
      'editResidentialDdi'
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
      routeType,
      user,
    } = editResidentialDdi.request;

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
      routeType,
      user,
    });

    cy.contains('DDIs');

    cy.usePactWait(['editResidentialDdi'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('cannot delete DDIs', () => {
    cy.get('svg[data-testid="MoreHorizIcon"]').first().click();
    cy.contains('Delete').should('have.class', 'disabled');

    cy.get('header').should('contain', 'DDIs');
  });
});
