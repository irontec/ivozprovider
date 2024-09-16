import editProfile from '../../fixtures/Profile/put.json';

export const putMyPreferences = () => {
  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/user/my/profile`,
      response: editProfile.response,
    },
    'editProfile'
  );

  const { timezone, doNotDisturb, maxCalls } = editProfile.request;
  cy.fillTheForm({ timezone, doNotDisturb, maxCalls });
  cy.get('div[role="alert"]')
    .find('div')
    .eq(1)
    .should('contain.text', 'Entity sucessfully updated');
};
