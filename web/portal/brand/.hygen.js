const helpers = require("@irontec-voip/ivoz-ui/hygen/lib");

module.exports = {
  templates: `${__dirname}/../node_modules/@irontec-voip/ivoz-ui/hygen/templates`,
  helpers: {
    ...helpers,
    url: () => "https://localhost/api/brand/docs.json",
  },
};