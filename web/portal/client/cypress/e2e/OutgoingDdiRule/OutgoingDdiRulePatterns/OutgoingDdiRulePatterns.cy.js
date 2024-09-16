import OutgoingDdiRulePatternsCollection from '../../../fixtures/OutgoingDdiRulePatterns/getCollection.json';
import OutgoingDdiRulePatternsItem from '../../../fixtures/OutgoingDdiRulePatterns/getItem.json';
import newOutgoingDdiRulePattern from '../../../fixtures/OutgoingDdiRulePatterns/post.json';
import editOutgoingDdiRulePattern from '../../../fixtures/OutgoingDdiRulePatterns/put.json';

describe('OutgoingDdiRulePatterns', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors(
      'OutgoingDdiRule-OutgoingDdiRulePatterns'
    );
    cy.before('outgoing_ddi_rules');

    cy.get('button > svg[data-testid="PhoneCallbackIcon"]').first().click();
    cy.get('header').should('contain', 'Outgoing DDI Rule Patterns');
    cy.get('table').should(
      'contain',
      OutgoingDdiRulePatternsCollection.body[0].type
    );
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add OutgoingDdiRulePatterns', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/outgoing_ddi_rules_patterns*',
        response: newOutgoingDdiRulePattern.response,
        matchingRules: newOutgoingDdiRulePattern.matchingRules,
      },
      'createOutgoingDdiRulePattern'
    );

    cy.get('[aria-label=Add]').click();

    const { ...rest } = newOutgoingDdiRulePattern.request;
    delete rest.outgoingDdiRule;

    cy.fillTheForm({
      ...rest,
    });

    cy.get('header').should('contain', 'Outgoing DDI Rule Patterns');

    cy.usePactWait('createOutgoingDdiRulePattern')
      .its('response.statusCode')
      .should('eq', 201);
  });
  ///////////////////////
  // PUT
  ///////////////////////
  it('edit OutgoingDdiRulePatterns', () => {
    cy.intercept('GET', '**/api/client/outgoing_ddi_rules_patterns/1', {
      ...OutgoingDdiRulePatternsItem,
    }).as('getOutgoingDdiRulePattern-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/outgoing_ddi_rules_patterns/${editOutgoingDdiRulePattern.response.body.id}`,
        response: editOutgoingDdiRulePattern.response,
      },
      'editOutgoingDdiRulePatterns'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { ...rest } = editOutgoingDdiRulePattern.request;
    delete rest.outgoingDdiRule;

    cy.fillTheForm({
      ...rest,
    });

    cy.get('header').should('contain', 'Outgoing DDI Rule Patterns');

    cy.usePactWait(['editOutgoingDdiRulePatterns'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete OutgoingDdiRulePatterns', () => {
    cy.intercept('DELETE', '**/api/client/outgoing_ddi_rules_patterns/*', {
      statusCode: 204,
    }).as('deleteOutgoingDdiRulePattern');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Outgoing DDI Rule Patterns');

    cy.usePactWait(['deleteOutgoingDdiRulePattern'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
