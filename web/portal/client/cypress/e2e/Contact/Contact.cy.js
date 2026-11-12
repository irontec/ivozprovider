import ContactCollection from '../../fixtures/Contact/getCollection.json';
import ContactItem from '../../fixtures/Contact/getItem.json';
import contactsMassImport from '../../fixtures/Contact/massImport.json';
import newContact from '../../fixtures/Contact/post.json';
import editContact from '../../fixtures/Contact/put.json';
import ProfileItem from '../../fixtures/My/Profile/getProfile.json';

describe('Contact', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Contact');
    cy.before();

    cy.contains('Address Book').click();

    cy.get('header').should('contain', 'Address Book');

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

    cy.get('header').should('contain', 'Address Book');

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

    const { workPhoneCountry, workPhone, mobilePhoneCountry, mobilePhone } =
      editContact.request;
    cy.fillTheForm({
      workPhoneCountry,
      workPhone,
      mobilePhoneCountry,
      mobilePhone,
    });

    cy.contains('Address Book');

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

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Address Book');

    cy.usePactWait(['deleteContact'])
      .its('response.statusCode')
      .should('eq', 204);
  });

  ///////////////////////
  // Mass import
  ///////////////////////
  it('import Contacts', () => {
    cy.intercept(
      {
        method: 'POST',
        url: '**/api/client/contacts/mass_import',
        middleware: true,
      },
      (req) => {
        req.on('response', (res) => {
          res.setDelay(1500);
        });
      }
    );

    cy.intercept('POST', '**/api/client/contacts/mass_import', {
      statusCode: contactsMassImport.response.statusCode,
      headers: contactsMassImport.response.headers,
      body: contactsMassImport.response.body,
    }).as('contactsMassImport');

    cy.get('button svg[data-testid="MoreHorizIcon"]').first().click();
    cy.get('li.MuiMenuItem-root').contains('Import contacts').click();
    cy.get('h2').should('contain', 'Import contacts');
    cy.contains('Download template');

    cy.get('input[type="file"]').selectFile(
      {
        contents: Cypress.Buffer.from(
          'id,name,lastname,email,workPhoneCountry,workPhone,mobilePhoneCountry,mobilePhone,otherPhone\n' +
            ',Ana,García,ana@example.com,ES,944048182,ES,600000000,\n' +
            '1234,Juan,Pérez,,,,,,Fax 2010\n' +
            ',Marta,López,,,944000111,,,\n'
        ),
        fileName: 'contacts.csv',
        mimeType: 'text/csv',
      },
      { force: true }
    );

    cy.contains('button', 'Send').click();
    cy.contains('button', 'Cancel').should('be.disabled');
    cy.contains('Importing, please wait');

    cy.wait('@contactsMassImport').its('response.statusCode').should('eq', 201);

    cy.contains('Created: 2');
    cy.contains('Updated: 0');
    cy.contains('Rejected: 1');
    cy.contains('Line 3: Contact 1234 not found');
    cy.contains('Fix and import only the failed lines');

    cy.get('@getContact.all').then((requests) => {
      const loadedTimes = requests.length;

      cy.contains('button', 'Close').click();
      cy.get('@getContact.all').should('have.length.greaterThan', loadedTimes);
    });
    cy.get('header').should('contain', 'Address Book');
  });
});

describe('Contact as a restricted admin without write privileges', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Contact');
    cy.intercept('GET', '**/api/client/my/profile', {
      statusCode: 200,
      body: {
        ...ProfileItem.body,
        restricted: true,
        acls: [
          {
            iden: 'Contacts',
            create: false,
            read: true,
            update: false,
            delete: false,
          },
        ],
      },
    });
    cy.before();

    cy.contains('Address Book').click();
    cy.get('table').should('contain', ContactCollection.body[0].name);
  });

  it('hides the import action', () => {
    cy.get('header').should('contain', 'Address Book');
    cy.contains('Import contacts').should('not.exist');
    cy.get('svg[data-testid="UploadFileIcon"]').should('not.exist');
  });
});
