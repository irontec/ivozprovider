import Trusteds from '../../../../fixtures/Kam/Trusted/getCollection.json';
import TrustedItem from '../../../../fixtures/Kam/Trusted/getItem.json';
import NewTrusted from '../../../../fixtures/Kam/Trusted/post.json';
import EditTrusted from '../../../../fixtures/Kam/Trusted/put.json';

describe('in Administrator', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('wholesale-client-trusted');

    cy.before('');
    cy.contains('Clients').click();
    cy.contains('Wholesales').click();

    cy.get('header').should('contain', 'Wholesales');
    cy.get('td button svg[data-testid="MoreHorizIcon"]').eq(3).click();
    cy.get('li.MuiMenuItem-root').contains('Authorized Ip Addresses').click();
    cy.get('header').should('contain', 'Authorized Ip Addresses');

    cy.get('table').should('contain', Trusteds.body[0].srcIp);
  });

  it('add Trusted', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/trusteds*',
        response: NewTrusted.response,
      },
      'postTrusteds'
    );

    cy.get('button').contains('Add').click();

    cy.get('header').should('contain', 'New');

    const { srcIp, description } = NewTrusted.body;

    cy.fillTheForm({
      srcIp,
      description,
    });

    cy.usePactWait('postTrusteds').its('response.statusCode').should('eq', 201);
  });

  it('edit Trusted', () => {
    cy.usePactIntercept(
      {
        method: 'GET',
        url: '**/api/brand/trusteds/1',
        response: TrustedItem.response,
      },
      'getTrusteds-1'
    );

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: '**/api/brand/trusteds/1',
        response: EditTrusted.response,
      },
      'putTrusteds-1'
    );

    cy.get('table [data-testid="EditIcon"]').click();

    cy.usePactWait('getTrusteds-1')
      .its('response.statusCode')
      .should('eq', 200);

    const { srcIp, description } = EditTrusted.request;
    cy.fillTheForm({
      srcIp: srcIp,
      description: description,
    });

    cy.usePactWait(['putTrusteds-1'])
      .its('response.statusCode')
      .should('eq', 201);
  });

  it('delete Trusted', () => {
    cy.usePactIntercept(
      {
        method: 'DELETE',
        url: '**/api/brand/trusteds/1',
        response: '200',
      },
      'deleteTrusted-1'
    );

    cy.get('table [data-testid="DeleteIcon"]').first().click();
    cy.contains('Remove element');
    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click({ force: true });

    cy.usePactWait('deleteTrusted-1')
      .its('response.statusCode')
      .should('eq', 200);
  });
});
