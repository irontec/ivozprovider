import CallCsvSchedulerItem from '../../../fixtures/Provider/CallCsvScheduler/getItem.json';
import newCallCsvScheduler from '../../../fixtures/Provider/CallCsvScheduler/post.json';
import editCallCsvScheduler from '../../../fixtures/Provider/CallCsvScheduler/put.json';

export const postCallCsvSchedulers = () => {
  cy.intercept('GET', '**/api/brand/call_csv_schedulers/1', {
    ...CallCsvSchedulerItem,
  }).as('getCallCsvSchedulers-1');
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/call_csv_schedulers*',
      response: newCallCsvScheduler.response,
      matchingRules: newCallCsvScheduler.matchingRules,
    },
    'createCallCsvSchedulers'
  );

  cy.get('[aria-label=Add]').click();
  const {
    name,
    unit,
    frequency,
    callDirection,
    email,
    callCsvNotificationTemplate,
    retailAccount,
    user,
    friend,
    ddiProvider,
  } = newCallCsvScheduler.request;
  cy.fillTheForm({
    name,
    unit,
    frequency,
    callDirection,
    email,
    callCsvNotificationTemplate,
    retailAccount,
    user,
    friend,
    ddiProvider,
  });

  cy.get('header').should('contain', 'Call CSV Schedulers');

  cy.usePactWait('createCallCsvSchedulers')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putCallCsvSchedulers = () => {
  cy.intercept('GET', '**/api/brand/call_csv_schedulers/1', {
    ...CallCsvSchedulerItem,
  }).as('getCallCsvSchedulers-1');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/brand/call_csv_schedulers/${editCallCsvScheduler.response.body.id}`,
      response: editCallCsvScheduler.response,
    },
    'editCallCsvSchedulers-1'
  );
  cy.get('svg[data-testid="EditIcon"]').eq(0).click();
  const {
    name,
    unit,
    frequency,
    callDirection,
    email,
    callCsvNotificationTemplate,
    retailAccount,
    user,
    friend,
    ddiProvider,
  } = editCallCsvScheduler.request;
  cy.fillTheForm({
    name,
    unit,
    frequency,
    callDirection,
    email,
    callCsvNotificationTemplate,
    retailAccount,
    user,
    friend,
    ddiProvider,
  });
  cy.get('header').should('contain', 'Call CSV Schedulers');
  cy.usePactWait(['editCallCsvSchedulers-1'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteteCallCsvSchedulers = () => {
  cy.intercept('DELETE', '**/api/brand/call_csv_schedulers/*', {
    statusCode: 204,
  }).as('deleteCallCsvSchedulers');

  cy.get('td svg[data-testid="DeleteIcon"]').first().click();

  cy.contains('Remove element');
  cy.get('[role="dialog"]')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.usePactWait(['deleteCallCsvSchedulers'])
    .its('response.statusCode')
    .should('eq', 204);
};
