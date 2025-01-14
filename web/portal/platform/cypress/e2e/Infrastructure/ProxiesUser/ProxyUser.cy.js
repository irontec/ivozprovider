import ProxyUserCollection from '../../../fixtures/ProxyUser/getCollection.json';
import {
  deleteteProxyUser,
  postProxyUser,
  putProxyUser,
} from './ProxyUser.tests';

describe('in Proxy users', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Proxy-user');
    cy.before();

    cy.contains('Infrastructure').click();
    cy.contains('Proxies User').click();

    cy.get('header').should('contain', 'Proxies User');

    cy.get('table').should('contain', ProxyUserCollection.body[0].id);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Proxy user', postProxyUser);

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Proxy user', putProxyUser);

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Invoice Template', deleteteProxyUser);
});
