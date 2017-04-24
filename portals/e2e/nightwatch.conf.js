'use strict';

require('nightwatch-cucumber')({
  cucumberArgs: [
    '--require', 'hooks/eventHandlers.js',
    '--require', 'features/step_definitions',
    '--format', 'json:reports/cucumber.json',
    'features'
  ]
});

module.exports = {
  "output_folder" : "",
  "globals_path": "hooks/chromedriver.js",
  "page_objects_path": ["features/pages"],
  "custom_commands_path" : "commands",
	"custom_assertions_path" : "",
  "selenium" : {
    "start_process" : false,
    "server_path" : "",
    "log_path" : "",
    "port" : 4444,
    "cli_args" : {
      "webdriver.chrome.driver" : "./node_modules/.bin/chromedriver"
    }
  },
  "test_settings" : {
    "default" : {
      "launch_url" : "https://127.0.0.1",
      "globals" : {
        'user': 'admin',
        'password': 'changeme',
        'waitForConditionTimeout': 10000,
        'retryAssertionTimeout': 10000
      },
      "selenium_port"  : 9515,
      "selenium_host"  : "localhost",
      "default_path_prefix" : "",
      "desiredCapabilities": {
        "browserName": "chrome",
        "chromeOptions" : {
          "args" : ["--no-sandbox"]
        },
        "javascriptEnabled": true,
        "acceptSslCerts": true
      },
      "screenshots" : {
        "enabled" : false,
        "on_failure" : true,
        "on_error" : true,
        "path" : "./screenshots/"
      }
    }
  }
}
