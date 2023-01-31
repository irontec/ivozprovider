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
        SYMFONY_PHPUNIT_VERSION = "9.5.3"
        DOCKER_IMAGE_TAG = getDockerImageTag()
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
                    branch "halliday"
                }
            }
            agent {
                docker {
                    image "ironartemis/ivozprovider-testing-base:${env.DOCKER_IMAGE_TAG}"
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
                    branch "halliday"
                }
            }
            parallel {
                stage ('app-console') {
                    agent {
                        docker {
                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_IMAGE_TAG}"
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/library/bin/test-app-console'
                    }
                    post {
                        success { notifySuccessGithub() }
                        failure { notifyFailureGithub() }
                    }
                }
                stage ('static analysis') {
                    agent {
                        docker {
                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_IMAGE_TAG}"
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/library/bin/test-phpstan'
                        sh '/opt/irontec/ivozprovider/library/bin/test-psalm'
                    }
                    post {
                        success { notifySuccessGithub() }
                        failure { notifyFailureGithub() }
                    }
                }
                stage ('codestyle') {
                    agent {
                        docker {
                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_IMAGE_TAG}"
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/library/bin/test-codestyle --full'
                    }
                    post {
                        success { notifySuccessGithub() }
                        failure { notifyFailureGithub() }
                    }
                }
                stage ('i18n') {
                    agent {
                        docker {
                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_IMAGE_TAG}"
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/library/bin/test-i18n'
                    }
                    post {
                        success { notifySuccessGithub() }
                        failure { notifyFailureGithub() }
                    }
                }
                stage ('phpspec') {
                    agent {
                        docker {
                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_IMAGE_TAG}"
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/library/bin/test-phpspec'
                    }
                    post {
                        success { notifySuccessGithub() }
                        failure { notifyFailureGithub() }
                    }
                }
                stage ('api-platform') {
                    agent {
                        docker {
                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_IMAGE_TAG}"
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/web/rest/platform/bin/test-api-spec'
                        sh '/opt/irontec/ivozprovider/web/rest/platform/bin/test-api --skip-db'
                    }
                    post {
                        success { notifySuccessGithub() }
                        failure { notifyFailureGithub() }
                    }
                }
                stage ('api-brand') {
                    agent {
                        docker {
                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_IMAGE_TAG}"
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
                stage ('api-client') {
                    agent {
                        docker {
                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_IMAGE_TAG}"
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/web/rest/client/bin/test-api-spec'
                        sh '/opt/irontec/ivozprovider/web/rest/client/bin/test-api --skip-db'
                    }
                    post {
                        success { notifySuccessGithub() }
                        failure { notifyFailureGithub() }
                    }
                }
                stage ('api-user') {
                    agent {
                        docker {
                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_IMAGE_TAG}"
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/web/rest/user/bin/test-api-spec'
                        sh '/opt/irontec/ivozprovider/web/rest/user/bin/test-api --skip-db'
                    }
                    post {
                        success { notifySuccessGithub() }
                        failure { notifyFailureGithub() }
                    }
                }
                stage ('web-platform') {
                    agent {
                        docker {
                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_IMAGE_TAG}"
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/web/portal/platform/bin/test-lint'
                        sh '/opt/irontec/ivozprovider/web/portal/platform/bin/test-build'
                    }
                    post {
                        success { notifySuccessGithub() }
                        failure { notifyFailureGithub() }
                    }
                }
                stage ('web-brand') {
                    agent {
                        docker {
                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_IMAGE_TAG}"
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/web/portal/brand/bin/test-lint'
                        sh '/opt/irontec/ivozprovider/web/portal/brand/bin/test-i18n'
                        sh '/opt/irontec/ivozprovider/web/portal/brand/bin/test-build'
                    }
                    post {
                        success { notifySuccessGithub() }
                        failure { notifyFailureGithub() }
                    }
                }
                stage ('web-client') {
                    agent {
                        docker {
                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_IMAGE_TAG}"
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/web/portal/client/bin/test-lint'
                        sh '/opt/irontec/ivozprovider/web/portal/client/bin/test-build'
                    }
                    post {
                        success { notifySuccessGithub() }
                        failure { notifyFailureGithub() }
                    }
                }
                stage ('web-user') {
                    agent {
                        docker {
                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_IMAGE_TAG}"
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/web/portal/user/bin/test-lint'
                        sh '/opt/irontec/ivozprovider/web/portal/user/bin/test-build'
                    }
                    post {
                        success { notifySuccessGithub() }
                        failure { notifyFailureGithub() }
                    }
                }
                stage ('orm') {
                    agent {
                        docker {
                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_IMAGE_TAG}"
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/schema/bin/test-orm --skip-db'
                    }
                    post {
                        success { notifySuccessGithub() }
                        failure { notifyFailureGithub() }
                    }
                }
                stage ('generators') {
                    agent {
                        docker {
                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_IMAGE_TAG}"
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/tests/docker/bin/prepare-and-run'
                        sh '/opt/irontec/ivozprovider/schema/bin/test-generators'
                    }
                    post {
                        success { notifySuccessGithub() }
                        failure { notifyFailureGithub() }
                        always  { cleanWs() }
                    }
                }
                stage ('schema') {
                    steps {
                        script {
                            docker.image('percona/percona-server:8.0').withRun('-e "MYSQL_ROOT_PASSWORD=changeme"', '--default-authentication-plugin=mysql_native_password') { c ->
                                docker.image('percona/percona-server:8.0').inside("--link ${c.id}:data.ivozprovider.local") {
                                    /* Wait until mysql service is up */
                                    sh 'while ! mysqladmin ping -hdata.ivozprovider.local --silent; do sleep 1; done'
                                }
                                docker.image("ironartemis/ivozprovider-testing-base:${env.DOCKER_IMAGE_TAG}")
                                      .inside("--env MYSQL_PWD=changeme --volume ${WORKSPACE}:/opt/irontec/ivozprovider --link ${c.id}:data.ivozprovider.local") {
                                    sh '/opt/irontec/ivozprovider/schema/bin/test-schema'
                                    sh '/opt/irontec/ivozprovider/schema/bin/test-duplicate-keys'
                                }
                            }
                        }
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

void getDockerImageTag() {
    return env.CHANGE_TARGET ?: env.GIT_BRANCH
}

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
    if (env.GIT_BRANCH == 'bleeding' || env.GIT_BRANCH == 'halliday') {
        mattermostSend([
            channel: "#ivozprovider",
            color: "#FF0000",
            message: ":red_circle: Branch ${env.GIT_BRANCH} tests failed :red_circle: - (<${env.BUILD_URL}|Open>)"
        ])
    }
}

void notifyFixedMattermost() {
    if (env.GIT_BRANCH == 'bleeding' || env.GIT_BRANCH == 'halliday') {
        mattermostSend([
            channel: "#ivozprovider",
            color: "#008000",
            message: ":thumbsup_all: Branch ${env.GIT_BRANCH} tests fixed :thumbsup_all: - (<${env.BUILD_URL}|Open>)"
        ])
    }
}
