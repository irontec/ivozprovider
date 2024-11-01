import ResidentialDeviceCollection from '../../fixtures/ResidentialDevice/getCollection.json';
import ResidentialDeviceItem from '../../fixtures/ResidentialDevice/getItem.json';
import editResidentialDevice from '../../fixtures/ResidentialDevice/put.json';
import { CLIENT_TYPE } from '../../support/commands/prepareGenericPactInterceptors';

describe('Residential Device', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Residential-Devices', {
      clientType: CLIENT_TYPE.Residential,
    });
    cy.before();

    cy.contains('Residential Devices').click();

    cy.get('header').should('contain', 'Residential Devices');

    cy.get('table').should('contain', ResidentialDeviceCollection.body[0].name);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Residential Device', () => {
    cy.intercept('GET', '**/api/client/residential_devices/1', {
      ...ResidentialDeviceItem,
    }).as('getResidentialDevices-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/residential_devices/${editResidentialDevice.response.body.id}`,
        response: editResidentialDevice.response,
      },
      'editResidentialDevice'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { ...rest } = editResidentialDevice.request;

    delete rest.name;
    cy.fillTheForm({
      ...rest,
    });

    cy.contains('Residential Devices');

    cy.usePactWait(['editResidentialDevice'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Terminal', () => {
    cy.get(
      'td > div.actions-cell > span > button:has(svg[data-testid="DeleteIcon"])'
    ).should('be.disabled');
  });
});
