Cypress.Commands.add('before', (path = '') => {
  window.localStorage.setItem(
    'IP-brand-appVersion',
    '20230214124125-acb07de3b'
  );

  window.localStorage.setItem(
    'IP-brand-token',
    'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzU5ODA2MjAsImV4cCI6MTY3NTk4NDIyMCwicm9sZXMiOlsiUk9MRV9CUkFORF9BRE1JTiJdLCJ1c2VybmFtZSI6ImJyYW5kIn0.Sa-LdjAzOp2Q9d4__VyS9SA0z-caFuClUY7hVGxR0LqGjOwQdj7d-y3_3F381lRumS4FZbanE6KEWA8vdpE9mwdGN5yMXDqngyLuDzZaEUjrC2EHR_fujBpexJC3ZBn7_ew-gwRjsqcAmVfwo35LlzKGka0Df403cJGC-nIvAgfB8c74GgEowEe2wIPLO9rBMSA4f4a5BdNOhV-kH7bGtbnTguldYwR1kIT_touQjEPKVeA_iTes-7rfBeCmv3SLyv7nM0P2X78Xnf5cMQSxtWrkPSB4-siOOi6nrEdnGxmLxiqJ4w9RP0WRUEPAb5qzJMUodnZtAA2_yb38Rj1v-kzG_MXv9j3mkxBfKe1pMNIxml915D95_xquxDk05HKOkjz5cFdIuPxuOQBF3L6ExpRXrF_h1Hu8UIovn8EYxsRWnzxFMVrntroUWVAT3ZiSAA3pZqThAFyGDyZ1FZTgEqe3QHOUllHF1446WLj6LX9nG5zkWGfT1gQ-9INuZftUkfzZKH-E5lbN6VuLWCqsWuL6Nv8ErbH6EYxEQROLgjny1Rfl_nPyJD2xx_4iE-6C-Smzv6_uRGeKCTgTNxJtUkCiau6obRR8U1SRAxXvR-YL7MnnUCrtGFcGlUIcbVLU7Uklr-Qxctc6D_Hu_aeCdn4MvjR5LPGGq1NyM4VvhaQ'
  );

  window.localStorage.setItem(
    'IP-brand-refreshToken',
    '2554c3ef29559c0ed04e02ef276d6bd81445a00c41354c8d716762e89ea1f99fd98b207564ae8db97c5e13c6e9546cfc903a5803f79695d711dc676269b38935'
  );

  cy.visit(Cypress.env('APP_DOMAIN') + path);
});
