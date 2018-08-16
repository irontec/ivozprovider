const {client} = require('nightwatch-cucumber');
const {Before, AfterAll} = require('cucumber');

let scenario, success = true;

Before((testCase, callback) => {

    let uri = testCase.sourceLocation.uri;
    let file = uri.split("/").pop();
    let folder = file.replace('.feature', '');

    if (scenario) {
        require('./video-recorder').stop(success, () => {
            callback();
            scenario = testCase.pickle.name;
            success = true;

            require('./video-recorder').start(client, callback, folder + "/" + scenario);
        });
    } else {
        scenario = testCase.pickle.name;
        require('./video-recorder').start(client, callback, folder + "/" + scenario);
    }
});

AfterAll(() => {

    let videoRecorder = require('./video-recorder');
    videoRecorder.stop(
        success,
        () => {
           videoRecorder.finish();
        }
    );
});

