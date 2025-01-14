import CallForwardSettingCollection from '../../../fixtures/CallForwardSetting/getCollection.json';
import {
  deleteCallForwardSetting,
  postCallForwardSetting,
  putCallForwardSetting,
} from '../../CallForwardSetting/CallForwardSetting.tests';

describe('CallForwardSetting', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('User-CallForwardSetting');
    cy.before();

    cy.contains('Users').click();

    cy.get('header').should('contain', 'Users');

    cy.get('svg[data-testid="PhoneForwardedIcon"]').first().click();

    cy.get('table').should(
      'contain',
      CallForwardSettingCollection.body[0].numberValue
    );
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add CallForwardSetting', postCallForwardSetting);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit CallForwardSetting', putCallForwardSetting);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete CallForwardSetting', deleteCallForwardSetting);
});
