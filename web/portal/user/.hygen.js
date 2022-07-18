const helpers = require("@irontec/ivoz-ui/hygen/lib");

module.exports = {
  templates: `${__dirname}/node_modules/@irontec/ivoz-ui/hygen/templates`,
  helpers: {
    ...helpers,
    url: () => "https://10.60.75.33/api/user/docs.json",
  },
};