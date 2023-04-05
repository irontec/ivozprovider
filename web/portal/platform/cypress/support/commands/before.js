Cypress.Commands.add('before', (path = '') => {
  window.localStorage.setItem(
    'IP-platform-appVersion',
    '20230215092524-7e1247236'
  );

  window.localStorage.setItem(
    'IP-platform-token',
    'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzY0NTMxMzUsImV4cCI6MTY3NjQ1NjczNSwicm9sZXMiOlsiUk9MRV9TVVBFUl9BRE1JTiJdLCJ1c2VybmFtZSI6Imlyb250ZWMifQ.KahLJTPea7OLraAjnq9UxKKwBrqPOG7z6QSl0CtpKNTrXY2jgZavKztq64KWm-9j9ym98LRTI7Acj-MtWUqYiB11p8OFL3fQk0B9EmX-Thfk_z9UFT_oXNnzoXT4BZzyF0hDo9kedR1j4SPoVNug4WG7Lkx_-MV2Qz2PbsV-BF-Y3kb0QtGz5vtEWxLYGrCq7cEhGRsakHFAOxu2Z0Kdj5gDUFTaKR5G96fymnfWph1PmIRwyCCWAyUVMTpobMLbauJtEKTXiav6H7lE4RU5hSI7R20sScy75FDc9NQcelmGlFMOmMwMgri_xouvwtIg3O4tMKputyzyD-GbgOt0vRiLACf5jcqPrq0b5p6cKuVTdxzmUBpRWaGCvS4tdHVuMqlsdL9WCQDygxB4osoUqws06rEdUIfDWjVAtmygPAR3JDI6QE1cocw6B7-sDfpFfyxpSYwWGEhwLC1E9djsIdHYioYq_iCCE_jBy2pC5JEwMouiwbrfrDkxGHwKhC_1qeugdWjrUiyMufihOvjqBeGt7nCAvY0CGgygJ4Opnv4Rz2ueFbJJbHy1fZx6b5XxY2gWQymDyRjeZBs7hyz4X8yeWPsYDLce0jY5rKHOIBFJAEqHO2Ce97daE2I0WZR6Of2E6eLtpeT5zx_kfPGzN-qEvjj-42YD_Y2XWNokSWU'
  );

  window.localStorage.setItem(
    'IP-platform-refreshToken',
    'd124cab5795f6335e3817a5f4116acfdf782c2082dd3d92e08b0853572e4d5e75cf6d1d6a384afc86689ade7b4034c3f20c691c6b8834938cbcf0f0c400945cd'
  );

  cy.visit(Cypress.env('APP_DOMAIN') + path);
});
