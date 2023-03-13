import HuntGroupCollection from '../../fixtures/HuntGroup/getCollection.json';
import newHuntGroup from '../../fixtures/HuntGroup/post.json';
import HuntGroupItem from '../../fixtures/HuntGroup/getItem.json';
import editHuntGroup from '../../fixtures/HuntGroup/put.json';

describe('in HuntGroup', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('HuntGroup');
    cy.before();

    cy.contains('Grupos de salto').click();

    cy.get('h3').should('contain', 'List of Grupos de salto');

    cy.get('table').should('contain', HuntGroupCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add HuntGroup', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/hunt_groups*',
        response: newHuntGroup.response,
        matchingRules: newHuntGroup.matchingRules,
      },
      'createHuntGroup'
    );

    cy.get('[aria-label=Add]').click();

    const {
      name,
      description,
      preventMissedCalls,
      allowCallForwards,
      strategy,
      ringAllTimeout,
      noAnswerLocution,
      noAnswerTargetType,
      noAnswerNumberCountry,
      noAnswerNumberValue,
      noAnswerExtension,
      noAnswerVoicemail,
    } = newHuntGroup.request;
    cy.fillTheForm({
      name,
      description,
      preventMissedCalls,
      allowCallForwards,
      strategy,
      ringAllTimeout,
      noAnswerLocution,
      noAnswerTargetType,
      noAnswerNumberCountry,
      noAnswerNumberValue,
      noAnswerExtension,
      noAnswerVoicemail,
    });

    cy.get('h3').should('contain', 'List of Grupos de salto');

    cy.usePactWait('createHuntGroup')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit HuntGroup', () => {
    cy.intercept('GET', '**/api/client/hunt_groups/1', {
      ...HuntGroupItem,
    }).as('getHuntGroup-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/hunt_groups/${editHuntGroup.response.body.id}`,
        response: editHuntGroup.response,
      },
      'editHuntGroup'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const {
      name,
      description,
      preventMissedCalls,
      allowCallForwards,
      strategy,
      ringAllTimeout,
      noAnswerLocution,
      noAnswerTargetType,
      noAnswerNumberCountry,
      noAnswerNumberValue,
      noAnswerExtension,
      noAnswerVoicemail,
    } = editHuntGroup.request;
    cy.fillTheForm({
      name,
      description,
      preventMissedCalls,
      allowCallForwards,
      strategy,
      ringAllTimeout,
      noAnswerLocution,
      noAnswerTargetType,
      noAnswerNumberCountry,
      noAnswerNumberValue,
      noAnswerExtension,
      noAnswerVoicemail,
    });

    cy.contains('List of Grupos de salto');

    cy.usePactWait(['editHuntGroup'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete HuntGroup', () => {
    cy.intercept('DELETE', '**/api/client/hunt_groups/*', {
      statusCode: 204,
    }).as('deleteHuntGroup');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Grupos de salto');

    cy.usePactWait(['deleteHuntGroup'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
