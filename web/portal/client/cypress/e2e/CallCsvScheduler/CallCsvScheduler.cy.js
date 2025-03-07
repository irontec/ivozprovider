import CallCsvSchedulerCollection from '../../fixtures/CallCsvScheduler/getCollection.json';
import CallCsvSchedulerItem from '../../fixtures/CallCsvScheduler/getItem.json';
import newCallCsvScheduler from '../../fixtures/CallCsvScheduler/post.json';
import editCallCsvScheduler from '../../fixtures/CallCsvScheduler/put.json';

describe('CallCsvScheduler', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('CallCsvScheduler');
    cy.before();

    cy.contains('Calls').click();
    cy.contains('Call CSV schedulers').click();

    cy.get('header').should('contain', 'Call CSV schedulers');

    cy.get('table').should('contain', CallCsvSchedulerCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add CallCsvScheduler', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/call_csv_schedulers*',
        response: newCallCsvScheduler.response,
        matchingRules: newCallCsvScheduler.matchingRules,
      },
      'createCallCsvScheduler'
    );

    cy.get('[aria-label=Add]').click();

    const { name, email, frequency, unit, callDirection } =
      newCallCsvScheduler.request;
    cy.fillTheForm({
      name,
      email,
      frequency,
      unit,
      callDirection,
    });

    cy.get('header').should('contain', 'Call CSV schedulers');

    cy.usePactWait('createCallCsvScheduler')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit CallCsvScheduler', () => {
    cy.intercept('GET', '**/api/client/call_csv_schedulers/1', {
      ...CallCsvSchedulerItem,
    }).as('getCallCsvScheduler-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/call_csv_schedulers/${editCallCsvScheduler.response.body.id}`,
        response: editCallCsvScheduler.response,
      },
      'editCallCsvScheduler'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const {
      name,
      email,
      frequency,
      unit,
      callDirection,
      user,
      retailAccount,
      residentialDevice,
      fax,
      friend,
    } = editCallCsvScheduler.request;
    cy.fillTheForm({
      name,
      email,
      frequency,
      unit,
      callDirection,
      user,
      retailAccount,
      residentialDevice,
      fax,
      friend,
    });

    cy.contains('Call CSV schedulers');

    cy.usePactWait(['editCallCsvScheduler'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete CallCsvScheduler', () => {
    cy.intercept('DELETE', '**/api/client/call_csv_schedulers/*', {
      statusCode: 204,
    }).as('deleteCallCsvScheduler');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Call CSV schedulers');

    cy.usePactWait(['deleteCallCsvScheduler'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
