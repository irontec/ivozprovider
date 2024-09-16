import CallForwardSettingCollection from '../../fixtures/CallForwardSetting/getCollection.json';
import {
  deleteCallForwardSetting,
  postCallForwardSetting,
  putCallForwardSetting,
} from './CallForwardSettings.tests';

describe('CallForwardSetting', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('User-CallForwardSetting');
    cy.before();

    cy.get('svg[data-testid="PhoneForwardedIcon"]').first().click();

    const callTypeFilter = CallForwardSettingCollection.body[0].callTypeFilter;
    cy.get('table').should(
      'contain',
      callTypeFilter.charAt(0).toUpperCase() + callTypeFilter.slice(1)
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
