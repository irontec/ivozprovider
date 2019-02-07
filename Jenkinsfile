pipeline {
    agent {
        docker {
            image 'ironartemis/ivozprovider-testing-base'
            args '--dns 10.60.75.73  --user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
        }
    }

    options {
        timeout(time: 25, unit: 'MINUTES')
        timestamps()
        disableConcurrentBuilds()
        buildDiscarder(logRotator(numToKeepStr: '30', artifactNumToKeepStr: '30'))
    }

    stages {
        stage('Prepare') {
            steps {
                sh '/opt/irontec/ivozprovider/tests/docker/bin/prepare-and-run'
                sh '/opt/irontec/ivozprovider/web/rest/platform/bin/generate-keys --test'
            }
        }

        stage('Static Analysis') {
            parallel {
                stage ('phplint') {
                    steps {
                        sh '/opt/irontec/ivozprovider/library/bin/test-phplint'
                    }
                    post {
                        success { publishStatus("ivozprovider-testing-phplint", "SUCCESS") }
                        failure { publishStatus("ivozprovider-testing-phplint", "FAILURE") }
                    }
                }
                stage ('codestyle') {
                    steps {
                        sh '/opt/irontec/ivozprovider/library/bin/test-codestyle --branch'
                    }
                    post {
                        success { publishStatus("ivozprovider-testing-codestyle", "SUCCESS") }
                        failure { publishStatus("ivozprovider-testing-codestyle", "FAILURE") }
                    }
                }
                stage ('i18n') {
                    steps {
                        sh '/opt/irontec/ivozprovider/library/bin/test-i18n'
                    }
                    post {
                        success { publishStatus("ivozprovider-testing-i18n", "SUCCESS") }
                        failure { publishStatus("ivozprovider-testing-i18n", "FAILURE") }
                    }
                }
                stage ('generators') {
                    steps {
                        sh '/opt/irontec/ivozprovider/scheme/bin/test-generators'
                    }
                    post {
                        success { publishStatus("ivozprovider-testing-generators", "SUCCESS") }
                        failure { publishStatus("ivozprovider-testing-generators", "FAILURE") }
                    }
                }
            }
        }

        stage('Testing') {
            parallel {
                stage ('phpsec') {
                    steps {
                        sh '/opt/irontec/ivozprovider/library/bin/test-phpspec'
                    }
                    post {
                        success { publishStatus("ivozprovider-testing-library", "SUCCESS") }
                        failure { publishStatus("ivozprovider-testing-library", "FAILURE") }
                    }
                }
                stage ('api-platform') {
                    steps {
                        sh '/opt/irontec/ivozprovider/web/rest/platform/bin/test-api-spec'
                        sh '/opt/irontec/ivozprovider/web/rest/platform/bin/test-api'
                    }
                    post {
                        success { publishStatus("ivozprovider-testing-api-platform", "SUCCESS") }
                        failure { publishStatus("ivozprovider-testing-api-platform", "FAILURE") }
                    }
                }
                stage ('api-brand') {
                    steps {
                        sh '/opt/irontec/ivozprovider/web/rest/brand/bin/test-api-spec'
                        sh '/opt/irontec/ivozprovider/web/rest/brand/bin/test-api'
                    }
                    post {
                        success { publishStatus("ivozprovider-testing-api-brand", "SUCCESS") }
                        failure { publishStatus("ivozprovider-testing-api-brand", "FAILURE") }
                    }
                }
                stage ('api-client') {
                    steps {
                        sh '/opt/irontec/ivozprovider/web/rest/client/bin/test-api-spec'
                        sh '/opt/irontec/ivozprovider/web/rest/client/bin/test-api'
                    }
                    post {
                        success { publishStatus("ivozprovider-testing-api-client", "SUCCESS") }
                        failure { publishStatus("ivozprovider-testing-api-client", "FAILURE") }
                    }
                }
                stage ('orm') {
                    steps {
                        sh '/opt/irontec/ivozprovider/scheme/bin/test-orm'
                    }
                    post {
                        success { publishStatus("ivozprovider-testing-orm", "SUCCESS") }
                        failure { publishStatus("ivozprovider-testing-orm", "FAILURE") }
                    }
                }
                stage ('scheme') {
                    steps {
                        sh 'cp -f /opt/irontec/ivozprovider/library/CoreBundle/Resources/config/parameters.yml.dist /opt/irontec/ivozprovider/library/CoreBundle/Resources/config/parameters.yml'
                        sh '/bin/sed -i \'s#database_name: ivozprovider#database_name: ivozprovider_scheme_test#g\' /opt/irontec/ivozprovider/library/CoreBundle/Resources/config/parameters.yml'
                        sh '/opt/irontec/ivozprovider/scheme/bin/test-scheme'
                    }
                    post {
                        success { publishStatus("ivozprovider-testing-scheme", "SUCCESS") }
                        failure { publishStatus("ivozprovider-testing-scheme", "FAILURE") }
                    }
                }
            }
        }
    }
}

void publishStatus(test, status) {
    githubNotify([
        context: "${test}",
        description: "Finished",
        status: "${status}"
    ])
}
