pipeline {

    agent any

    // ------------------------------------------------------------------------
    // Pipeline options
    // ------------------------------------------------------------------------
    options {
        timeout(time: 25, unit: 'MINUTES')
        timestamps()
        disableConcurrentBuilds()
        buildDiscarder(
            logRotator(
                artifactDaysToKeepStr: '10',
                artifactNumToKeepStr: '10',
                daysToKeepStr: '10',
                numToKeepStr: '10'
            )
        )
    }

    // ------------------------------------------------------------------------
    // Environment configuration
    // ------------------------------------------------------------------------
    environment {
        SYMFONY_PHPUNIT_DIR = "/opt/phpunit/"
        SYMFONY_PHPUNIT_VERSION = "6.5.14"
        GITHUB_TOKEN=credentials('github')
        COMPOSER_AUTH="{\"github-oauth\": {\"github.com\": \"${env.GITHUB_TOKEN_PSW}\"}}"
    }

    stages {
        // --------------------------------------------------------------------
        // Prepare stage
        // --------------------------------------------------------------------
        stage('Prepare') {
            when {
                anyOf {
                    expression { env.CHANGE_ID && pullRequest.labels.contains('ci-no-tests') == false }
                    branch "bleeding"
                    branch "artemis"
                }
            }
            agent {
                docker {
                    image 'ironartemis/ivozprovider-testing-base'
                    args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                    reuseNode true
                }
            }
            steps {
                sh '/opt/irontec/ivozprovider/tests/docker/bin/prepare-and-run'
                sh '/opt/irontec/ivozprovider/web/rest/platform/bin/generate-keys --test'
            }
        }

        // --------------------------------------------------------------------
        // Testing stage
        // --------------------------------------------------------------------
        stage('Testing') {
            when {
                anyOf {
                    expression { env.CHANGE_ID && pullRequest.labels.contains('ci-no-tests') == false }
                    branch "bleeding"
                    branch "artemis"
                }
            }
            parallel {
                stage ('api-brand') {
                    agent {
                        docker {
                            image 'ironartemis/ivozprovider-testing-base'
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/web/rest/brand/bin/test-api-spec'
                        sh '/opt/irontec/ivozprovider/web/rest/brand/bin/test-api --skip-db'
                    }
                    post {
                        success { notifySuccessGithub() }
                        failure { notifyFailureGithub() }
                    }
                }
            }
        }
    }

    // ------------------------------------------------------------------------
    // Pipeline post-actions
    // ------------------------------------------------------------------------
    post {
        failure { notifyFailureMattermost() }
        fixed { notifyFixedMattermost() }
        cleanup { cleanWs()}
    }
}

// -----------------------------------------------------------------------------
// Helper Functions
// -----------------------------------------------------------------------------

void notifySuccessGithub() {
    githubNotify([
        context: "ivozprovider-testing-${STAGE_NAME}",
        description: "Finished",
        status: "SUCCESS"
    ])
}

void notifyFailureGithub() {
    githubNotify([
        context: "ivozprovider-testing-${STAGE_NAME}",
        description: "Finished",
        status: "FAILURE"
    ])
}

void notifyFailureMattermost() {
    if (env.GIT_BRANCH == 'artemis' || env.GIT_BRANCH == 'bleeding') {
        mattermostSend([
            channel: "#ivozprovider",
            color: "#FF0000",
            message: ":red_circle: Branch ${env.GIT_BRANCH} tests failed :red_circle: - (<${env.BUILD_URL}|Open>)"
        ])
    }
}

void notifyFixedMattermost() {
    if (env.GIT_BRANCH == 'artemis' || env.GIT_BRANCH == 'bleeding') {
        mattermostSend([
            channel: "#ivozprovider",
            color: "#008000",
            message: ":thumbsup_all: Branch ${env.GIT_BRANCH} tests fixed :thumbsup_all: - (<${env.BUILD_URL}|Open>)"
        ])
    }
}
