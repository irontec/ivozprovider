pipeline {
    agent any;

    options {
        timeout(time: 25, unit: 'MINUTES')
        timestamps()
        disableConcurrentBuilds()
        buildDiscarder(logRotator(numToKeepStr: '30', artifactNumToKeepStr: '30'))
    }

    stages {
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

        stage('Static Analysis') {
            parallel {
                stage ('phplint') {
                    agent {
                        docker {
                            image 'ironartemis/ivozprovider-testing-base'
                            args '--user jenkins --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/library/bin/test-phplint'
                    }
                    post {
                        success { publishStatus("ivozprovider-testing-phplint", "SUCCESS") }
                        failure { publishStatus("ivozprovider-testing-phplint", "FAILURE") }
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
                        success { publishStatus("ivozprovider-testing-codestyle", "SUCCESS") }
                        failure { publishStatus("ivozprovider-testing-codestyle", "FAILURE") }
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
                        success { publishStatus("ivozprovider-testing-i18n", "SUCCESS") }
                        failure { publishStatus("ivozprovider-testing-i18n", "FAILURE") }
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
                        success { publishStatus("ivozprovider-testing-library", "SUCCESS") }
                        failure { publishStatus("ivozprovider-testing-library", "FAILURE") }
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
                        success { publishStatus("ivozprovider-testing-api-platform", "SUCCESS") }
                        failure { publishStatus("ivozprovider-testing-api-platform", "FAILURE") }
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
                        success { publishStatus("ivozprovider-testing-api-brand", "SUCCESS") }
                        failure { publishStatus("ivozprovider-testing-api-brand", "FAILURE") }
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
                        success { publishStatus("ivozprovider-testing-api-client", "SUCCESS") }
                        failure { publishStatus("ivozprovider-testing-api-client", "FAILURE") }
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
                        sh '/opt/irontec/ivozprovider/scheme/bin/test-orm'
                    }
                    post {
                        success { publishStatus("ivozprovider-testing-orm", "SUCCESS") }
                        failure { publishStatus("ivozprovider-testing-orm", "FAILURE") }
                    }
                }
                stage ('scheme') {
                    agent any
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
                                    sh '/opt/irontec/ivozprovider/scheme/bin/test-scheme'
                                }
                            }
                        }
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
