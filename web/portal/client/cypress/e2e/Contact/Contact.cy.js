import ContactCollection from '../../fixtures/Contact/getCollection.json';
import newContact from '../../fixtures/Contact/post.json';
import ContactItem from '../../fixtures/Contact/getItem.json';
import editContact from '../../fixtures/Contact/put.json';

describe('in Contact', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Contact');
    cy.before();

    cy.contains('Contact').click();

    cy.get('h3').should('contain', 'List of Contact');

    cy.get('table').should('contain', ContactCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Contact', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/contacts*',
        response: newContact.response,
        matchingRules: newContact.matchingRules,
      },
      'createContact'
    );

    cy.get('[aria-label=Add]').click();

    const {
      name,
      lastname,
      email,
      workPhoneCountry,
      workPhone,
      mobilePhoneCountry,
      mobilePhone,
      otherPhone,
    } = newContact.request;
    cy.fillTheForm({
      name,
      lastname,
      email,
      workPhoneCountry,
      workPhone,
      mobilePhoneCountry,
      mobilePhone,
      otherPhone,
    });

    cy.get('h3').should('contain', 'List of Contact');

    cy.usePactWait('createContact')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Contact', () => {
    cy.intercept('GET', '**/api/client/contacts/1', {
      ...ContactItem,
    }).as('getContact-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/contacts/${editContact.response.body.id}`,
        response: editContact.response,
      },
      'editContact'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const {
      name,
      lastname,
      email,
      workPhoneCountry,
      workPhone,
      mobilePhoneCountry,
      mobilePhone,
      otherPhone,
    } = editContact.request;
    cy.fillTheForm({
      name,
      lastname,
      email,
      workPhoneCountry,
      workPhone,
      mobilePhoneCountry,
      mobilePhone,
      otherPhone,
    });

    cy.contains('List of Contact');

    cy.usePactWait(['editContact'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Contact', () => {
    cy.intercept('DELETE', '**/api/client/contacts/*', {
      statusCode: 204,
    }).as('deleteContact');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Contact');

    cy.usePactWait(['deleteContact'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
