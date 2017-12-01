'use strict'

/*
 * Nightwatch.js module to record the webdriver X11 display via ffmpeg.
 * Based on https://github.com/blueimp/nightwatch-video-recorder v1.1.x
 */

// Function to create a directory similar to the shell "mkdir -p" command:
function mkdirp (dir, mode) {
  const path = require('path')
  const fs = require('fs')
  dir = path.resolve(dir)
  if (fs.existsSync(dir)) return dir
  try {
    fs.mkdirSync(dir, mode)
    return dir
  } catch (error) {
    if (error.code === 'ENOENT') {
      return mkdirp(path.dirname(dir), mode) && mkdirp(dir, mode)
    }
    throw error
  }
}

let tmpFile, targetFile, process, debug = false;

module.exports = {
  start: function (browser, done, name) {
    const settings = browser.globals.test_settings
    const videoSettings = settings.videos
    const currentTest = name.replace(/\s/g, '-');
    if (videoSettings && videoSettings.enabled) {
      const format = videoSettings.format || 'mp4'
      const fileName = `${currentTest}.${format}`
      const path = require('path')
      targetFile = path.resolve(path.join(videoSettings.path || '', fileName))
      tmpFile = path.resolve(path.join(videoSettings.path || '', 'ongoingTest.')) + format;
      mkdirp(path.dirname(tmpFile))

      browser.ffmpeg = process = require('child_process').execFile(
        'ffmpeg',
        [
            '-video_size',
            videoSettings.resolution || '1440x900',
            '-r',
            videoSettings.fps || 15,
            '-f',
            'x11grab',
            '-i',
            (videoSettings.display || ':60'),
            '-pix_fmt',
            videoSettings.pixel_format || 'yuv420p', // QuickTime compatibility
            '-loglevel',
            'error',
            '-y',
            tmpFile
        ],
        function (error, stdout, stderr) {

            browser.ffmpeg = null
            if (error && debug) {

                if (error.code == 255) {
                    return;
                }

                // At the start, the video capture always logs an ignorable x11grab
                // "image data event_error", which we can safely ignore:
                const stderrLines = stderr.split('\n')
                if (stderrLines.length !== 2 ||
                    !/x11grab .* image data event_error/.test(stderrLines[0])) {
                    throw error
                }
            }
        }
      )
    }
    done();
  },
  stop: function (removeFile, done) {

    let timeoutId = setTimeout(done, 1000);

    let callback = () => {

        let fs = require('fs');
        if (!tmpFile || !fs.existsSync(tmpFile)) {
            done();
            return;
        }

        if (removeFile) {
            fs.unlink(tmpFile);
        } else if (targetFile) {
            let fs = require('fs');
            let path = require('path');

            mkdirp(path.dirname(targetFile));
            fs.createReadStream(tmpFile).pipe(fs.createWriteStream(targetFile));
        }

        clearTimeout(timeoutId);
        done();
    }

    if (process) {
        process
            .on('exit', callback)
            .kill('SIGTERM');
    }
  },
  finish: function () {
    let fs = require('fs');
    if (!fs.existsSync(tmpFile)) {
        return;
    }
    fs.unlink(tmpFile);
  }
}
