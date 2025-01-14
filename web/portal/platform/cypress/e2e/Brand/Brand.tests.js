import BrandItem from '../../fixtures/Provider/Brand/getItem.json';
import newBrand from '../../fixtures/Provider/Brand/post.json';
import editBrand from '../../fixtures/Provider/Brand/put.json';

export const postBrand = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/platform/brands*',
      response: newBrand.response,
      matchingRules: newBrand.matchingRules,
    },
    'createBrands'
  );

  cy.get('[aria-label=Add]').click();

  cy.get('header').should('contain', 'Brands');

  const { ...rest } = newBrand.request;

  delete rest.domainUsers;

  cy.fillTheForm({ ...rest });

  cy.usePactWait(['createBrands']).its('response.statusCode').should('eq', 201);
};

export const putBrand = () => {
  cy.usePactIntercept(
    {
      method: 'PUT',
      url: '**/api/platform/brands/1*',
      response: editBrand.response,
      matchingRules: editBrand.matchingRules,
    },
    'editBrands'
  );

  cy.usePactIntercept(
    {
      method: 'GET',
      url: `**/api/platform/brands/1`,
      response: editBrand.response,
    },
    'getBrands-1'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  cy.get('header').should('contain', 'Brands');

  const { ...rest } = editBrand.request;
  delete rest.domainUsers;
  delete rest.recordingsLimitEmail;
  delete rest.recordingsLimitMB;
  delete rest.invoice;

  cy.fillTheForm({ ...rest });

  cy.usePactWait(['editBrands']).its('response.statusCode').should('eq', 200);
};

export const deleteBrand = () => {
  cy.intercept('DELETE', '**/api/platform/brands/*', {
    statusCode: 204,
  }).as('deleteBrands');

  cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
  cy.get('li.MuiMenuItem-root').contains('Delete').click();

  cy.contains('Remove element');
  cy.get('.MuiDialogContent-root .MuiFormControl-root .MuiOutlinedInput-input')
    .eq(0)
    .type(BrandItem.body.name);

  cy.get('div.MuiDialog-container button')
    .filter(':visible')
    .contains('Yes, delete it')
    .click({ force: true });

  cy.get('header').should('contain', 'Brands');

  cy.usePactWait(['deleteBrands']).its('response.statusCode').should('eq', 204);
};
