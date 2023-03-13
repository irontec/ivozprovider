import PickUpGroupCollection from '../../fixtures/PickUpGroup/getCollection.json';
import newPickUpGroup from '../../fixtures/PickUpGroup/post.json';
import PickUpGroupItem from '../../fixtures/PickUpGroup/getItem.json';
import editPickUpGroup from '../../fixtures/PickUpGroup/put.json';

describe('in PickUpGroup', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('PickUpGroup');
    cy.before();

    cy.contains('Grupos de captura').click();

    cy.get('h3').should('contain', 'List of Grupos de captura');

    cy.get('table').should('contain', PickUpGroupCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add PickUpGroup', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/pick_up_groups*',
        response: newPickUpGroup.response,
        matchingRules: newPickUpGroup.matchingRules,
      },
      'createPickUpGroup'
    );

    cy.get('[aria-label=Add]').click();

    const { name } = newPickUpGroup.request;
    cy.fillTheForm({
      name,
    });

    cy.get('h3').should('contain', 'List of Grupos de captura');

    cy.usePactWait('createPickUpGroup')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit PickUpGroup', () => {
    cy.intercept('GET', '**/api/client/pick_up_groups/1', {
      ...PickUpGroupItem,
    }).as('getPickUpGroup-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/pick_up_groups/${editPickUpGroup.response.body.id}`,
        response: editPickUpGroup.response,
      },
      'editPickUpGroup'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { name, userIds } = editPickUpGroup.request;
    cy.fillTheForm({
      name,
      userIds,
    });

    cy.contains('List of Grupos de captura');

    cy.usePactWait(['editPickUpGroup'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete PickUpGroup', () => {
    cy.intercept('DELETE', '**/api/client/pick_up_groups/*', {
      statusCode: 204,
    }).as('deletePickUpGroup');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Grupos de captura');

    cy.usePactWait(['deletePickUpGroup'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
