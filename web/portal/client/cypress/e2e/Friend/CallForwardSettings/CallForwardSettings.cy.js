import CallForwardSettingCollection from '../../../fixtures/CallForwardSetting/getCollection.json';
import {
  deleteCallForwardSetting,
  postCallForwardSetting,
  putCallForwardSetting,
} from '../../CallForwardSetting/CallForwardSetting.tests';

describe('CallForwardSetting', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Friend-CallForwardSetting');
    cy.before();

    cy.contains('Routing endpoints').click();
    cy.contains('Friends').click();

    cy.get('header').should('contain', 'Friends');

    cy.get('svg[data-testid="MoreHorizIcon"       ]').first().click();
    cy.contains('Call forward settings').click();

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
