const defaults = {
  API_URL: `//${window.location.host}/api/platform`,
};

const dev = {
  ...defaults,
};

const prod = {
  ...defaults,
};

// Default to dev if not set
const config = import.meta.env.DEV ? dev : prod;

export default config;
