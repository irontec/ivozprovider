import CarrierItem from '../../../fixtures/Provider/Carriers/getItem.json';
import newCarrier from '../../../fixtures/Provider/Carriers/post.json';
import editCarriers from '../../../fixtures/Provider/Carriers/put.json';
import CompaniesItem from '../../../fixtures/Provider/Companies/VirtualPbxs/getItem.json';

export const postCarrier = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/carriers*',
      response: newCarrier.response,
      matchingRules: newCarrier.matchingRules,
    },
    'createDdi'
  );

  cy.usePactIntercept(
    {
      method: 'GET',
      url: '**/api/brand/companies/1*',
      response: { ...CompaniesItem },
    },
    'getCompanies-1'
  );
  cy.get('[aria-label=Add]').click();
  const { description, name, transformationRuleSet, mediaRelaySet } =
    newCarrier.request;
  cy.fillTheForm({ description, name, transformationRuleSet, mediaRelaySet });
  cy.get('header li.MuiBreadcrumbs-li:last').should('contain', 'Carriers');

  cy.usePactWait(['createDdi']).its('response.statusCode').should('eq', 201);
};

export const putCarrier = () => {
  cy.usePactIntercept(
    {
      method: 'GET',
      url: '**/api/brand/carriers/1',
      response: { ...CarrierItem },
    },
    'getDdis-1'
  );

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/brand/carriers/${editCarriers.response.body.id}`,
      response: editCarriers.response,
    },
    'editCarriers'
  );
  cy.get('svg[data-testid="EditIcon"]').eq(1).click();
  const { description, name, proxyTrunk, mediaRelaySet } = editCarriers.request;
  cy.fillTheForm({ description, name, proxyTrunk, mediaRelaySet });
  cy.get('header').should('contain', 'Carriers');
  cy.usePactWait(['editCarriers']).its('response.statusCode').should('eq', 200);
};
