import SurvivalDeviceCollection from '../../fixtures/SurvivalDevice/getCollection.json';
import SurvivalDeviceItem from '../../fixtures/SurvivalDevice/getItem.json';
import newSurvivalDevice from '../../fixtures/SurvivalDevice/post.json';
import editSurvivalDevice from '../../fixtures/SurvivalDevice/put.json';

describe('SurvivalDevices', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('SurvivalDevice');
    cy.before();

    cy.contains('User configuration').click();
    cy.contains('Survival Devices').click();

    cy.get('header').should('contain', 'Survival Devices');

    cy.get('table').should('contain', SurvivalDeviceCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Survial Device', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/survival_devices*',
        response: newSurvivalDevice.response,
        matchingRules: newSurvivalDevice.matchingRules,
      },
      'createSurvivalDevice'
    );

    cy.get('[aria-label=Add]').click();

    cy.fillTheForm(newSurvivalDevice.request);

    cy.contains('Survival Devices').click();

    cy.usePactWait('createSurvivalDevice')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Survival Device', () => {
    cy.intercept('GET', '**/api/client/survival_devices/1', {
      ...SurvivalDeviceItem,
    }).as('getSurvivalDevice-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/survival_devices/${editSurvivalDevice.response.body.id}`,
        response: editSurvivalDevice.response,
      },
      'editSurvivalDevice'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    cy.fillTheForm(editSurvivalDevice.request);

    cy.contains('Survival Devices');

    cy.usePactWait(['editSurvivalDevice'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Survival Device', () => {
    cy.intercept('DELETE', '**/api/client/survival_devices/*', {
      statusCode: 204,
    }).as('deleteSurvivalDevice');

    cy.get(
      'td > div.actions-cell > span > button:has(svg[data-testid="DeleteIcon"])'
    )
      .first()
      .click();

    cy.contains('Remove element');

    cy.get('div[role=dialog] button')
      .should('be.visible')
      .contains('Yes, delete it')
      .click({ force: true });

    cy.get('header').should('contain', 'Survival Devices');

    cy.usePactWait(['deleteSurvivalDevice'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
