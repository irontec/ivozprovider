import OutgoingDdiRuleCollection from '../../fixtures/OutgoingDdiRule/getCollection.json';
import newOutgoingDdiRule from '../../fixtures/OutgoingDdiRule/post.json';
import OutgoingDdiRuleItem from '../../fixtures/OutgoingDdiRule/getItem.json';
import editOutgoingDdiRule from '../../fixtures/OutgoingDdiRule/put.json';

describe('in OutgoingDdiRule', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('OutgoingDdiRule');
    cy.before();

    cy.contains('Reglas DDI de salida').click();

    cy.get('h3').should('contain', 'List of Reglas DDI de salida');

    cy.get('table').should('contain', OutgoingDdiRuleCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add OutgoingDdiRule', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/outgoing_ddi_rules*',
        response: newOutgoingDdiRule.response,
        matchingRules: newOutgoingDdiRule.matchingRules,
      },
      'createOutgoingDdiRule'
    );

    cy.get('[aria-label=Add]').click();

    const { name, defaultAction, forcedDdi } = newOutgoingDdiRule.request;
    cy.fillTheForm({
      name,
      defaultAction,
      forcedDdi,
    });

    cy.get('h3').should('contain', 'List of Reglas DDI de salida');

    cy.usePactWait('createOutgoingDdiRule')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit OutgoingDdiRule', () => {
    cy.intercept('GET', '**/api/client/outgoing_ddi_rules/1', {
      ...OutgoingDdiRuleItem,
    }).as('getOutgoingDdiRule-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/outgoing_ddi_rules/${editOutgoingDdiRule.response.body.id}`,
        response: editOutgoingDdiRule.response,
      },
      'editOutgoingDdiRule'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { name, defaultAction } = editOutgoingDdiRule.request;
    cy.fillTheForm({
      name,
      defaultAction,
    });

    cy.contains('List of Reglas DDI de salida');

    cy.usePactWait(['editOutgoingDdiRule'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete OutgoingDdiRule', () => {
    cy.intercept('DELETE', '**/api/client/outgoing_ddi_rules/*', {
      statusCode: 204,
    }).as('deleteOutgoingDdiRule');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Reglas DDI de salida');

    cy.usePactWait(['deleteOutgoingDdiRule'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
