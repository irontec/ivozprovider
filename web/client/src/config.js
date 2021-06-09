const dev = {
    API_URL: 'http://10.10.3.31:3000/api/client' /*/dev.php*/
};

const prod = {
    API_URL: 'http://10.10.3.31:3000/api/client'
};

// Default to dev if not set
const config = process.env.APP_ENV === 'prod'
    ? prod
    : dev;

export default config;