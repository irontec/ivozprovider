import ProxyTrunkCollection from '../../../fixtures/ProxyTrunk/getCollection.json';
import {
  deleteteProxyTrunk,
  postProxyTrunk,
  putProxyTrunk,
} from './ProxyTrunk.tests';

describe('in Proxy users', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Proxy-trunk');
    cy.before();

    cy.contains('Infrastructure').click();
    cy.contains('Proxies Trunk').click();

    cy.get('header').should('contain', 'Proxies Trunk');

    cy.get('table').should('contain', ProxyTrunkCollection.body[0].id);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Proxy trunk', postProxyTrunk);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Proxy trunk', putProxyTrunk);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Proxy trunk', deleteteProxyTrunk);
});
