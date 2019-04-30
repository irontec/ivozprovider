

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

    stages {
        // --------------------------------------------------------------------
        // Prepare stage
        // --------------------------------------------------------------------
        stage('Prepare') {
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
            parallel {
                stage ('app-console') {
                    agent {
                        docker {
                            image 'ironartemis/ivozprovider-testing-base'
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/library/bin/test-app-console'
                    }
                    post {
                        success { publishSuccess() }
                        failure { publishFailure() }
                    }
                }
                stage ('phpstan') {
                    agent {
                        docker {
                            image 'ironartemis/ivozprovider-testing-phpstan'
                            args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider/ --entrypoint ""'
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/tests/docker/bin/prepare-and-run'
                        sh '/opt/irontec/ivozprovider/library/bin/test-phpstan'
                    }
                    post {
                        success { publishSuccess() }
                        failure { publishFailure() }
                        always  { cleanWs() }
                    }
                }
                stage ('codestyle') {
                    agent {
                        docker {
                            image 'ironartemis/ivozprovider-testing-base'
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/library/bin/test-codestyle --branch'
                    }
                    post {
                        success { publishSuccess() }
                        failure { publishFailure() }
                    }
                }
                stage ('i18n') {
                    agent {
                        docker {
                            image 'ironartemis/ivozprovider-testing-base'
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/library/bin/test-i18n'
                    }
                    post {
                        success { publishSuccess() }
                        failure { publishFailure() }
                    }
                }
                stage ('phpspec') {
                    agent {
                        docker {
                            image 'ironartemis/ivozprovider-testing-base'
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/library/bin/test-phpspec'
                    }
                    post {
                        success { publishSuccess() }
                        failure { publishFailure() }
                    }
                }
                stage ('api-platform') {
                    agent {
                        docker {
                            image 'ironartemis/ivozprovider-testing-base'
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/web/rest/platform/bin/test-api-spec'
                        sh '/opt/irontec/ivozprovider/web/rest/platform/bin/test-api'
                    }
                    post {
                        success { publishSuccess() }
                        failure { publishFailure() }
                    }
                }
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
                        sh '/opt/irontec/ivozprovider/web/rest/brand/bin/test-api'
                    }
                    post {
                        success { publishSuccess() }
                        failure { publishFailure() }
                    }
                }
                stage ('api-client') {
                    agent {
                        docker {
                            image 'ironartemis/ivozprovider-testing-base'
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/web/rest/client/bin/test-api-spec'
                        sh '/opt/irontec/ivozprovider/web/rest/client/bin/test-api'
                    }
                    post {
                        success { publishSuccess() }
                        failure { publishFailure() }
                    }
                }
                stage ('orm') {
                    agent {
                        docker {
                            image 'ironartemis/ivozprovider-testing-base'
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/schema/bin/test-orm'
                    }
                    post {
                        success { publishSuccess() }
                        failure { publishFailure() }
                    }
                }
                stage ('generators') {
                    agent {
                        docker {
                            image 'ironartemis/ivozprovider-testing-base'
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/tests/docker/bin/prepare-and-run'
                        sh '/opt/irontec/ivozprovider/schema/bin/test-generators'
                    }
                    post {
                        success { publishSuccess() }
                        failure { publishFailure() }
                        always  { cleanWs() }
                    }
                }
                stage ('schema') {
                    steps {
                        script {
                            docker.image('mysql:5.7').withRun('-e "MYSQL_ROOT_PASSWORD=changeme"') { c ->
                                docker.image('mysql:5.7').inside("--link ${c.id}:data.ivozprovider.local") {
                                    /* Wait until mysql service is up */
                                    sh 'while ! mysqladmin ping -hdata.ivozprovider.local --silent; do sleep 1; done'
                                }
                                docker.image('ironartemis/ivozprovider-testing-base')
                                      .inside("--volume ${WORKSPACE}:/opt/irontec/ivozprovider --link ${c.id}:data.ivozprovider.local") {
                                    sh 'cd library/CoreBundle/Resources/config/ && mv parameters.yml.dist parameters.yml'
                                    sh '/opt/irontec/ivozprovider/tests/docker/bin/prepare-and-run'
                                    sh '/opt/irontec/ivozprovider/schema/bin/test-schema'
                                }
                            }
                        }
                    }
                    post {
                        success { publishSuccess() }
                        failure { publishFailure() }
                    }
                }
            }
        }
    }

    // ------------------------------------------------------------------------
    // Pipeline post-actions
    // ------------------------------------------------------------------------
    post {
        cleanup {
            cleanWs()
        }
    }
}

// -----------------------------------------------------------------------------
// Helper Functions
// -----------------------------------------------------------------------------

void publishSuccess() {
    githubNotify([
        context: "ivozprovider-testing-${STAGE_NAME}",
        description: "Finished",
        status: "SUCCESS"
    ])
}

void publishFailure() {
    githubNotify([
        context: "ivozprovider-testing-${STAGE_NAME}",
        description: "Finished",
        status: "FAILURE"
    ])
}
