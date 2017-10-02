'use strict';

require('nightwatch-cucumber')({
  nightwatchOutput: false,
  cucumberArgs: [
    '--require', 'hooks/eventHandlers.js',
    '--require', 'tests/steps',
    '--format', 'node_modules/cucumber-pretty',
    '--format', 'json:reports/cucumber.json',
    'tests/features'
  ]
});

module.exports = {
  "output_folder" : "",
  "globals_path": "hooks/chromedriver.js",
  "page_objects_path": ["tests/pages"],
  "custom_commands_path" : "commands",
  "custom_assertions_path" : "",
  "selenium" : {
    "start_process" : true,
    "server_path" : "/opt/selenium/selenium-server-standalone-3.5.3.jar",
    "log_path" : "",
    "port" : 4444,
    "cli_args" : {
      "webdriver.chrome.driver" : "./node_modules/.bin/chromedriver"
    }
  },
  "test_workers" : {
    "enabled" : false,
    "workers" : 2
  },
  "test_settings" : {
    "default" : {
      "launch_url" : "https://127.0.0.1/e2e.php",
      "globals" : {
        'user': 'admin',
        'password': 'changeme',
        'waitForConditionTimeout': 20000,
        'retryAssertionTimeout': 20000
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
        "enabled" : true,
        "on_failure" : true,
        "on_error" : true,
        "path" : "./screenshots/"
      }
    }
  }
}
