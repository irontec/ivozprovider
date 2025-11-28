import CarrierItem from '../../../../fixtures/Provider/Carriers/getItem.json';
import CarrierServerItem from '../../../../fixtures/Provider/CarrierServer/getItem.json';
import newCarrierServer from '../../../../fixtures/Provider/CarrierServer/post.json';
import editCarriersServer from '../../../../fixtures/Provider/CarrierServer/put.json';

export const postCarrierServer = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/carrier_servers*',
      response: newCarrierServer.response,
      matchingRules: newCarrierServer.matchingRules,
    },
    'createCarrierServer'
  );

  cy.usePactIntercept(
    {
      method: 'GET',
      url: '**/api/brand/carriers/1*',
      response: { ...CarrierItem },
    },
    'getCompanies-1'
  );
  cy.get('[aria-label=Add]').click();
  const { authUser, outboundProxy, sipProxy } = newCarrierServer.request;
  cy.fillTheForm({
    authUser,
    outboundProxy,
    sipProxy,
  });
  cy.get('header li.MuiBreadcrumbs-li:last').should(
    'contain',
    'Carrier servers'
  );

  cy.usePactWait(['createCarrierServer'])
    .its('response.statusCode')
    .should('eq', 201);
};

export const putCarrierServer = () => {
  cy.usePactIntercept(
    {
      method: 'GET',
      url: '**/api/brand/carrier_servers/1',
      response: { ...CarrierServerItem },
    },
    'getCarrier-1'
  );

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/brand/carrier_servers/${editCarriersServer.response.body.id}`,
      response: editCarriersServer.response,
    },
    'editCarriers'
  );
  cy.get('svg[data-testid="EditIcon"]').eq(0).click();
  const { authUser, outboundProxy } = editCarriersServer.request;
  cy.fillTheForm({
    authUser,
    outboundProxy,
  });
  cy.get('header').should('contain', 'Carriers');
  cy.usePactWait(['editCarriers']).its('response.statusCode').should('eq', 200);
};

export const deleteCarrierServer = () => {
  cy.intercept('DELETE', '**/api/brand/carrier_servers/*', {
    statusCode: 204,
  }).as('deleteCarrierServer');
  cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();
  cy.contains('Remove element');
  cy.get('[role="dialog"]')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'Carrier servers');

  cy.usePactWait(['deleteCarrierServer'])
    .its('response.statusCode')
    .should('eq', 204);
};
