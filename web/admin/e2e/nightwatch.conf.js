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
    "server_path" : "/opt/selenium/selenium-server-standalone-3.141.59.jar",
    "log_path" : "",
    "port" : 4444,
    "cli_args" : {
      "webdriver.chrome.driver" : "/usr/bin/chromedriver"
    }
  },
  "test_settings" : {
    "chromium" : {
      "launch_url" : "https://127.0.0.1/e2e.php",
      "globals" : {
        user: 'admin',
        password: 'changeme',
        brand: {
          portal: 'https://brand.artemis-test.irontec.com/e2e.php',
          user: 'test_brand_admin',
          password: '1234'
        },
        client: {
            portal: 'https://client.artemis-test.irontec.com/e2e.php',
            user: 'test_company_admin',
            password: '1234'
        },
        'waitForConditionTimeout': 20000,
        'retryAssertionTimeout': 20000
      },
      "selenium_port"  : 9515,
      "selenium_host"  : "localhost",
      "default_path_prefix" : "",
      "desiredCapabilities": {
        "browserName": "chrome",
        "chromeOptions" : {
          "args" : [
              "--no-sandbox",
              "window-size=1280,720"
          ]
        },
        "javascriptEnabled": true,
        "acceptSslCerts": true
      },
      "screenshots" : {
        "enabled" : true,
        "on_failure" : true,
        "on_error" : true,
        "path" : "./errors/"
      },
      "videos": {
        "enabled": false,
        "path": "errors",
        "format": "mp4",
        "resolution": "1280x720",
        "fps": 15,
        "display": ":1",
        "pixel_format": "yuv420p"
      }
    }
  }
}
