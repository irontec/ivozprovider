import CallForwardSettingCollection from '../../../fixtures/CallForwardSetting/getCollection.json';
import { CLIENT_TYPE } from '../../../support/commands/prepareGenericPactInterceptors';
import {
  deleteCallForwardSetting,
  postCallForwardSetting,
  putCallForwardSetting,
} from '../../CallForwardSetting/CallForwardSetting.tests';

describe('Retail Accounts CallForwardSetting', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Retail-Accounts-CallForwardSetting', {
      clientType: CLIENT_TYPE.Retail,
    });
    cy.before();

    cy.contains('Retail Accounts').click();

    cy.get('header').should('contain', 'Retail Accounts');

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
    postCallForwardSetting({ clientType: CLIENT_TYPE.Retail }));

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit CallForwardSetting', () =>
    putCallForwardSetting({ clientType: CLIENT_TYPE.Retail }));

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete CallForwardSetting', deleteCallForwardSetting);
});
