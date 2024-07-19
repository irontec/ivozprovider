import ConferenceRoomCollection from '../../fixtures/ConferenceRoom/getCollection.json';
import ConferenceRoomItem from '../../fixtures/ConferenceRoom/getItem.json';
import newConferenceRoom from '../../fixtures/ConferenceRoom/post.json';
import editConferenceRoom from '../../fixtures/ConferenceRoom/put.json';

describe('ConferenceRoom', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('ConferenceRoom');
    cy.before();

    cy.contains('Routing endpoints').click();
    cy.contains('Conference rooms').click();

    cy.get('header').should('contain', 'Conference rooms');

    cy.get('table').should('contain', ConferenceRoomCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add ConferenceRoom', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/conference_rooms*',
        response: newConferenceRoom.response,
        matchingRules: newConferenceRoom.matchingRules,
      },
      'createConferenceRoom'
    );

    cy.get('[aria-label=Add]').click();

    const { name, maxMembers, pinProtected, pinCode } =
      newConferenceRoom.request;
    cy.fillTheForm({
      name,
      maxMembers,
      pinProtected,
      pinCode,
    });

    cy.get('header').should('contain', 'Conference rooms');

    cy.usePactWait('createConferenceRoom')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit ConferenceRoom', () => {
    cy.intercept('GET', '**/api/client/conference_rooms/1', {
      ...ConferenceRoomItem,
    }).as('getConferenceRoom-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/conference_rooms/${editConferenceRoom.response.body.id}`,
        response: editConferenceRoom.response,
      },
      'editConferenceRoom'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { name, maxMembers, pinProtected, pinCode } =
      editConferenceRoom.request;
    cy.fillTheForm({
      name,
      maxMembers,
      pinProtected,
      pinCode,
    });

    cy.contains('Conference rooms');

    cy.usePactWait(['editConferenceRoom'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete ConferenceRoom', () => {
    cy.intercept('DELETE', '**/api/client/conference_rooms/*', {
      statusCode: 204,
    }).as('deleteConferenceRoom');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Conference rooms');

    cy.usePactWait(['deleteConferenceRoom'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
