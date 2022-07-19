const defaults = {
  API_URL: `//${window.location.host}/api/user`,
};

const dev = {
  ...defaults,
  API_URL: `//${window.location.host}/api/user/dev.php`,
};

const prod = {
  ...defaults,
};

// Default to dev if not set
const config = process.env.APP_ENV === 'dev' ? dev : prod;

export default config;
