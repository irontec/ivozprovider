const helpers = require("@irontec/ivoz-ui/hygen/lib");

module.exports = {
  templates: `${__dirname}/../node_modules/@irontec/ivoz-ui/hygen/templates`,
  helpers: {
    ...helpers,
    url: () => "https://localhost/api/client/docs.json",
  },
};