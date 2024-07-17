import QueueCollection from '../../fixtures/Queue/getCollection.json';
import QueueItem from '../../fixtures/Queue/getItem.json';
import newQueue from '../../fixtures/Queue/post.json';
import editQueue from '../../fixtures/Queue/put.json';

describe('Queue', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Queue');
    cy.before();

    cy.contains('Routing endpoints').click();
    cy.contains('Queues').click();

    cy.get('header').should('contain', 'Queues');

    cy.get('table').should('contain', QueueCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Queue', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/queues*',
        response: newQueue.response,
        matchingRules: newQueue.matchingRules,
      },
      'createQueue'
    );

    cy.get('[aria-label=Add]').click();

    const {
      name,
      weight,
      strategy,
      displayName,
      memberCallTimeout,
      memberCallRest,
      preventMissedCalls,
      periodicAnnounceLocution,
      periodicAnnounceFrequency,
      announcePosition,
      announceFrequency,
      maxWaitTime,
      timeoutLocution,
      timeoutTargetType,
      timeoutExtension,
      timeoutVoicemail,
      timeoutNumberCountry,
      timeoutNumberValue,
      maxlen,
      fullLocution,
      fullTargetType,
      fullExtension,
      fullVoicemail,
      fullNumberCountry,
      fullNumberValue,
    } = newQueue.request;
    cy.fillTheForm({
      name,
      weight,
      strategy,
      displayName,
      memberCallTimeout,
      memberCallRest,
      preventMissedCalls,
      periodicAnnounceLocution,
      periodicAnnounceFrequency,
      announcePosition,
      announceFrequency,
      maxWaitTime,
      timeoutLocution,
      timeoutTargetType,
      timeoutExtension,
      timeoutVoicemail,
      timeoutNumberCountry,
      timeoutNumberValue,
      maxlen,
      fullLocution,
      fullTargetType,
      fullExtension,
      fullVoicemail,
      fullNumberCountry,
      fullNumberValue,
    });

    cy.get('header').should('contain', 'Queues');

    cy.usePactWait('createQueue').its('response.statusCode').should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Queue', () => {
    cy.intercept('GET', '**/api/client/queues/1', {
      ...QueueItem,
    }).as('getQueue-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/queues/${editQueue.response.body.id}`,
        response: editQueue.response,
      },
      'editQueue'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const {
      name,
      weight,
      strategy,
      displayName,
      memberCallTimeout,
      memberCallRest,
      preventMissedCalls,
      periodicAnnounceLocution,
      periodicAnnounceFrequency,
      announcePosition,
      announceFrequency,
      maxWaitTime,
      timeoutLocution,
      timeoutTargetType,
      timeoutExtension,
      timeoutVoicemail,
      timeoutNumberCountry,
      timeoutNumberValue,
      maxlen,
      fullLocution,
      fullTargetType,
      fullExtension,
      fullVoicemail,
      fullNumberCountry,
      fullNumberValue,
    } = editQueue.request;
    cy.fillTheForm({
      name,
      weight,
      strategy,
      displayName,
      memberCallTimeout,
      memberCallRest,
      preventMissedCalls,
      periodicAnnounceLocution,
      periodicAnnounceFrequency,
      announcePosition,
      announceFrequency,
      maxWaitTime,
      timeoutLocution,
      timeoutTargetType,
      timeoutExtension,
      timeoutVoicemail,
      timeoutNumberCountry,
      timeoutNumberValue,
      maxlen,
      fullLocution,
      fullTargetType,
      fullExtension,
      fullVoicemail,
      fullNumberCountry,
      fullNumberValue,
    });

    cy.contains('Queues');

    cy.usePactWait(['editQueue']).its('response.statusCode').should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Queue', () => {
    cy.intercept('DELETE', '**/api/client/queues/*', {
      statusCode: 204,
    }).as('deleteQueue');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Queues');

    cy.usePactWait(['deleteQueue'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
