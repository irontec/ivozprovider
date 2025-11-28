import ResidentialDevicesCollection from '../../fixtures/Provider/ResidentialDevices/getCollection.json';
import ResidentialDeviceItem from '../../fixtures/Provider/ResidentialDevices/getItem.json';
import newResidentialDevice from '../../fixtures/Provider/ResidentialDevices/post.json';
import editResidentialDevice from '../../fixtures/Provider/ResidentialDevices/put.json';

describe('in ResidentialDevices', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('ResidentialDevice');
    cy.before();

    cy.get('svg[data-testid="RoomPreferencesIcon"]').first().click();
    cy.contains('Residential Devices').click();

    cy.get('header').should('contain', 'Residential Devices');

    cy.get('table').should(
      'contain',
      ResidentialDevicesCollection.body[0].name
    );
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add ResidentialDevice', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/residential_devices*',
        response: newResidentialDevice.response,
        matchingRules: newResidentialDevice.matchingRules,
      },
      'createResidentialDevice'
    );

    cy.get('[aria-label=Add]').click();

    const { ...rest } = newResidentialDevice.request;

    delete rest.t38Passthrough;
    delete rest.allow;
    delete rest.ddiIn;
    delete rest.maxCalls;

    cy.fillTheForm(rest);

    cy.get('header').should('contain', 'Residential Devices');

    cy.usePactWait(['createResidentialDevice'])
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit a ResidentialDevice', () => {
    cy.usePactIntercept(
      {
        method: 'GET',
        url: '**/api/brand/residential_devices/1',
        response: { ...ResidentialDeviceItem },
      },
      'getResidentialDevice-1'
    );

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/residential_devices/${editResidentialDevice.response.body.id}`,
        response: editResidentialDevice.response,
      },
      'editResidentialDevice'
    );

    cy.get('svg[data-testid="EditIcon"]').eq(4).click();

    const { ...rest } = editResidentialDevice.request;

    delete rest.t38Passthrough;
    delete rest.allow;
    delete rest.ddiIn;
    delete rest.maxCalls;

    cy.fillTheForm(rest);

    cy.get('header').should('contain', 'Residential Devices');

    cy.usePactWait(['editResidentialDevice'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete ResidentialDevice', () => {
    cy.intercept('DELETE', '**/api/brand/residential_devices/1', {
      statusCode: 204,
    }).as('deleteResidentialDevice');

    cy.get('td button > svg[data-testid="DeleteIcon"]').eq(4).click();

    cy.contains('Remove element');

    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Residential Devices');

    cy.usePactWait(['deleteResidentialDevice'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
