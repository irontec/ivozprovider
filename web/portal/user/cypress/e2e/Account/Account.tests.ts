import editProfile from '../../fixtures/Profile/put.json';

export const putMyAccount = () => {
  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/user/my/profile`,
      response: editProfile.response,
    },
    'editProfile'
  );

  const { name, lastname, email } = editProfile.request;
  cy.fillTheForm({ name, lastname, email });

  cy.get('div[role="alert"]')
    .find('div')
    .eq(1)
    .should('contain.text', 'Entity sucessfully updated');
};
