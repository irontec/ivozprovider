import CallForwardSettingCollection from '../../../fixtures/CallForwardSetting/getCollection.json';
import { CLIENT_TYPE } from '../../../support/commands/prepareGenericPactInterceptors';
import {
  deleteCallForwardSetting,
  postCallForwardSetting,
  putCallForwardSetting,
} from '../../CallForwardSetting/CallForwardSetting.tests';

describe('Residential Devices CallForwardSetting', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors(
      'Residential-Devices-CallForwardSetting',
      { clientType: CLIENT_TYPE.Residential }
    );
    cy.before();

    cy.contains('Residential Devices').click();

    cy.get('header').should('contain', 'Residential Devices');

    cy.get('svg[data-testid="PhoneForwardedIcon"]').first().click();

    cy.get('table').should(
      'contain',
      CallForwardSettingCollection.body[0].numberValue
    );
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add CallForwardSetting', () =>
    postCallForwardSetting({ clientType: CLIENT_TYPE.Residential }));

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit CallForwardSetting', () =>
    putCallForwardSetting({ clientType: CLIENT_TYPE.Residential }));

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete CallForwardSetting', deleteCallForwardSetting);
});
