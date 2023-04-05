Cypress.Commands.add('before', (path = '') => {
  window.localStorage.setItem(
    'IP-client-appVersion',
    '20230303094436-a921fe9b8'
  );

  window.localStorage.setItem(
    'IP-client-token',
    'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2Nzc4MzY2OTMsImV4cCI6MTY3Nzg0MDI5Mywicm9sZXMiOlsiUk9MRV9DT01QQU5ZX0FETUlOIl0sInVzZXJuYW1lIjoiY2xpZW50In0.eUZuqUVipx3O6OE9pd-TfjCdCIq3t0w8vZxky_eclCDng3GNf2dJjjdVcTv16BDswy355tixdqHhTx_X3sK6bMJoqD52eDshPL821sNHm2b38zbZl3bnf9MRRqY82eT88MZ_cWiJQ5_fm6PxMickC4FtJzXqAP-SBV7XswA-zB57TMKhdNYFsz41GI0szfmqRpm_-CYv3AfORKozFxWHtKJNd71r-Re1-BmSR0neatx9fr2eJOjAKoNGJkQmmx8c6nMcaeZBDIiglQJkDXk-A7eq6q1iF6vrqLq2ov27mFn4YmuLQkNCloZEoQDJNFR1CNZJRNqod4jC0N-y1FXFSBmbMH7_-F0XyUrbUx7DRzP-4ZK9LDxNTGZRvylDHXcTmJgmMEmPZ64DuTW4SozUjVxeVFv4OgveeLtexbLbmJ9qLoh0d8dtQSMvDOyr-t4zGw2zOUOdudXUp-t0S1oqDcEfEM-3dx2EW6SL11QoXWgVkIaN6eARiKMVnAWmUDAn7uT6TbKAZ4F8rEo5MmZMjDT_YuOF57DcGeDbC6035Kyd8SFgTcS6i3UqGf1Fp6U9nT1Snux8ATrt6cLJ644ZF2nkFb39EXlHHF03kzvVsw05nHHerLSVvdLgoSRVJSQufIF8JMK0MNMFGlBcUs3q4drqVGKiFcWQ-qXVV97IFpk'
  );

  window.localStorage.setItem(
    'IP-client-refreshToken',
    '10841b9e8a47a556983dc0cbec97ad666cd424562c0a7cc680f813f6e0a8164d35cbe31b0240be179182610751dbfa08f601b93141c7b6ab15f56d12035f0f3e'
  );

  cy.visit(Cypress.env('APP_DOMAIN') + path);
});
