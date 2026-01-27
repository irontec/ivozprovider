@Library('jenkins-pipeline-library@0.0.2') _

pipeline {

    agent any

    // ------------------------------------------------------------------------
    // Pipeline options
    // ------------------------------------------------------------------------
    options {
        timeout(time: 60, unit: 'MINUTES')
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
        // Shared library configuration (Provider-specific)
        GITHUB_CONTEXT_PREFIX = 'ivozprovider-testing'
        MATTERMOST_CHANNEL = '#comms-provider'

        // Application configuration
        SYMFONY_PHPUNIT_DIR = "/opt/phpunit/"
        SYMFONY_PHPUNIT_VERSION = "9.5.3"

        DOCKER_TAG = getDockerTag()
        BRANCH_NAME = getBranchName()
        BASE_BRANCH = getBaseBranch()
        JIRA_TICKET = getJiraTicket()
        HASH_BACK = getCurrentHash("asterisk/agi doc library microservices schema web/rest")
        HASH_FRONT_PLATFORM = getCurrentHash("web/portal/platform web/portal/yarn.lock")
        HASH_FRONT_BRAND = getCurrentHash("web/portal/brand web/portal/yarn.lock")
        HASH_FRONT_CLIENT = getCurrentHash("web/portal/client web/portal/yarn.lock")
        HASH_FRONT_USER = getCurrentHash("web/portal/user web/portal/yarn.lock")
        HASH_FILE = "${JENKINS_HOME}/jobs/${JOB_NAME}/../cached_pipelines.txt"
        MAX_HASHES = 400
    }

    stages {
        stage('Pull Request') {
            agent any
            when {
                expression {
                    env.BRANCH_NAME.startsWith("PROVIDER-")
                }
            }
            steps {
                script {
                    jiraUpdateCustomFields()
                    githubUpdatePullRequestTitle()
                }
            }
        }

        // --------------------------------------------------------------------
        // Image stage
        // --------------------------------------------------------------------
        stage('Image') {
            steps {
                script{
                    docker.build("ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}", "-f tests/docker/Dockerfile .")
                }
                dir('tests/httpd/'){
                    script{
                        docker.build("ivozprovider-testing-httpd")
                    }
                }
            }
        }

        // --------------------------------------------------------------------
        // Generic Project pipeline tests
        // --------------------------------------------------------------------
        stage('Generic') {
            agent {
                docker {
                    image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                    args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                    reuseNode true
                }
            }
            steps {
                sh "/opt/irontec/ivozprovider/library/bin/test-commit-tags origin/${env.BASE_BRANCH}"
                sh "/opt/irontec/ivozprovider/library/bin/test-file-perms"
                sh '/opt/irontec/ivozprovider/tests/docker/bin/prepare-composer-deps'
            }
        }

        // --------------------------------------------------------------------
        // Check if tests are required for current sources
        // --------------------------------------------------------------------
        stage('Cached Pipeline') {
            agent any
            when {
                not {
                    anyOf {
                        expression { hasLabel("ci-force-tests-back") }
                        expression { hasLabel("ci-force-tests-front") }
                        expression { hasLabel("ci-force-tests") }
                        branch "main"
                    }
                }
            }
            steps {
                script {
                    env.CACHED_PIPELINE_BACK = isHashTested(env.HASH_BACK)
                    echo "Back Hash ${env.HASH_BACK} tested before? ${env.CACHED_PIPELINE_BACK}"
                    env.CACHED_PIPELINE_FRONT_PLATFORM = isHashTested(env.HASH_FRONT_PLATFORM)
                    echo "Front Platform Hash ${env.HASH_FRONT_PLATFORM} tested before? ${env.CACHED_PIPELINE_FRONT_PLATFORM}"
                    env.CACHED_PIPELINE_FRONT_BRAND = isHashTested(env.HASH_FRONT_BRAND)
                    echo "Front Brand Hash ${env.HASH_FRONT_BRAND} tested before? ${env.CACHED_PIPELINE_FRONT_BRAND}"
                    env.CACHED_PIPELINE_FRONT_CLIENT = isHashTested(env.HASH_FRONT_CLIENT)
                    echo "Front Client Hash ${env.HASH_FRONT_CLIENT} tested before? ${env.CACHED_PIPELINE_FRONT_CLIENT}"
                    env.CACHED_PIPELINE_FRONT_USER = isHashTested(env.HASH_FRONT_USER)
                    echo "Front User Hash ${env.HASH_FRONT_USER} tested before? ${env.CACHED_PIPELINE_FRONT_USER}"
                }
            }
        }

        // --------------------------------------------------------------------
        // Backend Testing stage
        // --------------------------------------------------------------------
        stage('Backend') {
            when {
                allOf {
                    expression { env.CACHED_PIPELINE_BACK != "true" }
                    anyOf {
                        expression { hasLabel("ci-force-tests-back") }
                        expression { hasLabel("ci-force-tests") }
                        expression { hasCommitTag("agi:") }
                        expression { hasCommitTag("core:") }
                        expression { hasCommitTag("doc:") }
                        expression { hasCommitTag("schema:") }
                        expression { hasCommitTag("microservices/") }
                        expression { hasCommitTag("rest/") }
                        branch "main"
                        branch "tempest"
                    }
                }
            }
            stages {
                stage('prepare-backend') {
                    agent {
                        docker {
                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                            args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/tests/docker/bin/prepare-fixtures'
                        sh '/opt/irontec/ivozprovider/web/rest/platform/bin/generate-keys --test'
                    }
                }
                stage('test-backend') {
                    parallel {
                        stage('app-generic') {
                            agent {
                                docker {
                                    image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                                    args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                                    reuseNode true
                                }
                            }
                            steps {
                                sh '/opt/irontec/ivozprovider/library/bin/test-app-console'
                                sh '/opt/irontec/ivozprovider/library/bin/test-app-dependencies'
                            }
                            post {
                                success { notifySuccessGithub() }
                                failure { notifyFailureGithub() }
                            }
                        }
                        stage('static analysis') {
                            agent {
                                docker {
                                    image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                                    args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                                    reuseNode true
                                }
                            }
                            steps {
                                sh '/opt/irontec/ivozprovider/library/bin/test-phpstan'
                                sh '/opt/irontec/ivozprovider/library/bin/test-psalm'
                                sh '/opt/irontec/ivozprovider/library/bin/test-psalm-update-baseline'
                            }
                            post {
                                success { notifySuccessGithub() }
                                failure { notifyFailureGithub() }
                            }
                        }
                        stage('codestyle') {
                            agent {
                                docker {
                                    image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                                    args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                                    reuseNode true
                                }
                            }
                            steps {
                                sh '/opt/irontec/ivozprovider/library/bin/test-codestyle --full'
                                sh '/opt/irontec/ivozprovider/library/bin/test-codestyle-gherkin'
                            }
                            post {
                                success { notifySuccessGithub() }
                                failure { notifyFailureGithub() }
                            }
                        }
                        stage('i18n') {
                            agent {
                                docker {
                                    image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                                    args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
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
                        stage('phpspec') {
                            agent {
                                docker {
                                    image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                                    args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
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
                        stage('api-platform') {
                            agent {
                                docker {
                                    image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                                    args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
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
                        stage('api-brand') {
                            agent {
                                docker {
                                    image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                                    args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
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
                        stage('api-client') {
                            agent {
                                docker {
                                    image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                                    args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
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
                        stage('api-user') {
                            agent {
                                docker {
                                    image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                                    args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
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
                        stage('microservice-provision') {
                            agent {
                                docker {
                                    image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                                    args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                                    reuseNode true
                                }
                            }
                            steps {
                                sh '/opt/irontec/ivozprovider/microservices/provision/bin/test-provision'
                            }
                            post {
                                success { notifySuccessGithub() }
                                failure { notifyFailureGithub() }
                            }
                        }
                        stage ('microservice-realtime') {
                            agent {
                                docker {
                                    image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                                    args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                                    reuseNode true
                                }
                            }
                            steps {
                                sh '/opt/irontec/ivozprovider/microservices/realtime/tests/test-build.sh'
                                sh '/opt/irontec/ivozprovider/microservices/realtime/tests/test-codestyle.sh'
                            }
                            post {
                                success { notifySuccessGithub() }
                                failure { notifyFailureGithub() }
                            }
                        }

                        stage('orm') {
                            agent {
                                docker {
                                    image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                                    args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
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
                        stage('generators') {
                            agent {
                                docker {
                                    image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                                    args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
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
                        stage('schema') {
                            when {
                                anyOf {
                                    expression { hasLabel("ci-force-tests") }
                                    expression { hasLabel("ci-force-tests-back") }
                                    expression { hasCommitTag("schema:") }
                                    branch "main"
                                    branch "tempest"
                                }
                            }
                            steps {
                                script {
                                    docker.image('percona/percona-server:8.0').withRun('-e "MYSQL_ROOT_PASSWORD=changeme"', '--default-authentication-plugin=mysql_native_password') { c ->
                                        docker.image('percona/percona-server:8.0').inside("--link ${c.id}:data.ivozprovider.local") {
                                            // Wait until mysql service is up
                                            sh 'while ! mysqladmin ping -hdata.ivozprovider.local --silent; do sleep 1; done'
                                        }
                                        docker.image("ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}")
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
        }

        // --------------------------------------------------------------------
        // Frontend Testing stage
        // --------------------------------------------------------------------
        stage('Frontend') {
            when {
                allOf {
                    anyOf {
                        expression { env.CACHED_PIPELINE_FRONT_PLATFORM != "true" }
                        expression { env.CACHED_PIPELINE_FRONT_BRAND != "true" }
                        expression { env.CACHED_PIPELINE_FRONT_CLIENT != "true" }
                        expression { env.CACHED_PIPELINE_FRONT_USER != "true" }
                    }
                    anyOf {
                        expression { hasLabel("ci-force-tests-front") }
                        expression { hasLabel("ci-force-tests") }
                        expression { hasCommitTag("portal") }
                        expression { hasCommitTag("rest/") }
                        branch "main"
                        branch "tempest"
                    }
                }
            }
            stages {
                stage('prepare-frontend') {
                    agent {
                        docker {
                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                            args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                            reuseNode true
                        }
                    }
                    steps {
                        sh '/opt/irontec/ivozprovider/tests/docker/bin/prepare-node-modules'
                    }
                }
                stage('test-frontend') {
                    parallel {
                        stage('web-platform') {
                            when {
                                allOf {
                                    expression { env.CACHED_PIPELINE_FRONT_PLATFORM != "true" }
                                    anyOf {
                                        expression { hasLabel("ci-force-tests-front") }
                                        expression { hasLabel("ci-force-tests") }
                                        expression { hasCommitTag("portal:") }
                                        expression { hasCommitTag("portal/platform:") }
                                        expression { hasCommitTag("rest/platform:") }
                                        branch "main"
                                        branch "tempest"
                                    }
                                }
                            }
                            stages {
                                stage('web-platform-build') {
                                    agent {
                                        docker {
                                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                                            args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                                            reuseNode true
                                        }
                                    }
                                    steps {
                                        sh '/opt/irontec/ivozprovider/web/portal/platform/bin/test-lint'
                                        sh '/opt/irontec/ivozprovider/web/portal/platform/bin/test-i18n'
                                        sh '/opt/irontec/ivozprovider/web/portal/platform/bin/test-build'
                                    }
                                    post {
                                        success { notifySuccessGithub() }
                                        failure { notifyFailureGithub() }
                                    }
                                }
                                stage('web-platform-cypress') {
                                    steps {
                                        script {
                                            docker.image('ivozprovider-testing-httpd').withRun('-v "${WORKSPACE}":/opt/irontec/ivozprovider') { c ->
                                                docker.image("ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}")
                                                    .inside("--env CYPRESS_APP_DOMAIN='http://server/platform/' --volume ${WORKSPACE}:/opt/irontec/ivozprovider --link ${c.id}:server") {
                                                    sh '/opt/irontec/ivozprovider/web/portal/platform/bin/test-pact'
                                                }
                                            }
                                        }
                                    }
                                    post {
                                        success { notifySuccessGithub() }
                                        failure { notifyFailureGithub() }
                                        always { archiveArtifacts artifacts: "web/portal/platform/cypress/screenshots/**/*.png", allowEmptyArchive: true }
                                    }
                                }
                            }
                        }
                        stage('web-brand') {
                            when {
                                allOf {
                                    expression { env.CACHED_PIPELINE_FRONT_BRAND != "true" }
                                    anyOf {
                                        expression { hasLabel("ci-force-tests-front") }
                                        expression { hasLabel("ci-force-tests") }
                                        expression { hasCommitTag("portal:") }
                                        expression { hasCommitTag("portal/brand:") }
                                        expression { hasCommitTag("rest/brand:") }
                                        branch "main"
                                        branch "tempest"
                                    }
                                }
                            }
                            stages {
                                stage('web-brand-build') {
                                    agent {
                                        docker {
                                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                                            args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
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
                                stage('web-brand-cypress') {
                                    steps {
                                        script {
                                            docker.image('ivozprovider-testing-httpd').withRun('-v "${WORKSPACE}":/opt/irontec/ivozprovider') { c ->
                                                docker.image("ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}")
                                                    .inside("--env CYPRESS_APP_DOMAIN='http://server/brand/' --volume ${WORKSPACE}:/opt/irontec/ivozprovider --link ${c.id}:server") {
                                                    sh '/opt/irontec/ivozprovider/web/portal/brand/bin/test-pact'
                                                }
                                            }
                                        }
                                    }
                                    post {
                                        success { notifySuccessGithub() }
                                        failure { notifyFailureGithub() }
                                        always { archiveArtifacts artifacts: "web/portal/brand/cypress/screenshots/**/*.png", allowEmptyArchive: true }
                                    }
                                }
                            }
                        }
                        stage('web-client') {
                            when {
                                allOf {
                                    expression { env.CACHED_PIPELINE_FRONT_CLIENT != "true" }
                                    anyOf {
                                        expression { hasLabel("ci-force-tests-front") }
                                        expression { hasLabel("ci-force-tests") }
                                        expression { hasCommitTag("portal:") }
                                        expression { hasCommitTag("portal/client:") }
                                        expression { hasCommitTag("rest/client:") }
                                        branch "main"
                                        branch "tempest"
                                    }
                                }
                            }
                            stages {
                                stage('web-client-build') {
                                    agent {
                                        docker {
                                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                                            args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                                            reuseNode true
                                        }
                                    }
                                    steps {
                                        sh '/opt/irontec/ivozprovider/web/portal/client/bin/test-lint'
                                        sh '/opt/irontec/ivozprovider/web/portal/client/bin/test-i18n'
                                        sh '/opt/irontec/ivozprovider/web/portal/client/bin/test-build'
                                    }
                                    post {
                                        success { notifySuccessGithub() }
                                        failure { notifyFailureGithub() }
                                    }
                                }
                                stage('web-client-cypress') {
                                    steps {
                                        script {
                                            docker.image('ivozprovider-testing-httpd').withRun('-v "${WORKSPACE}":/opt/irontec/ivozprovider') { c ->
                                                docker.image("ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}")
                                                    .inside("--env CYPRESS_APP_DOMAIN='http://server/client/' --volume ${WORKSPACE}:/opt/irontec/ivozprovider --link ${c.id}:server") {
                                                    sh '/opt/irontec/ivozprovider/web/portal/client/bin/test-pact'
                                                }
                                            }
                                        }
                                    }
                                    post {
                                        success { notifySuccessGithub() }
                                        failure { notifyFailureGithub() }
                                        always { archiveArtifacts artifacts: "web/portal/client/cypress/screenshots/**/*.png", allowEmptyArchive: true }
                                    }
                                }
                            }
                        }
                        stage('web-user') {
                            when {
                                allOf {
                                    expression { env.CACHED_PIPELINE_FRONT_USER != "true" }
                                    anyOf {
                                        expression { hasLabel("ci-force-tests-front") }
                                        expression { hasLabel("ci-force-tests") }
                                        expression { hasCommitTag("portal:") }
                                        expression { hasCommitTag("portal/user:") }
                                        expression { hasCommitTag("rest/user:") }
                                        branch "main"
                                        branch "tempest"
                                    }
                                }
                            }
                            stages {
                                stage('web-user-build') {
                                    agent {
                                        docker {
                                            image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                                            args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                                            reuseNode true
                                        }
                                    }
                                    steps {
                                        sh '/opt/irontec/ivozprovider/web/portal/user/bin/test-lint'
                                        sh '/opt/irontec/ivozprovider/web/portal/user/bin/test-i18n'
                                        sh '/opt/irontec/ivozprovider/web/portal/user/bin/test-build'
                                    }
                                    post {
                                        success { notifySuccessGithub() }
                                        failure { notifyFailureGithub() }
                                    }
                                }
                                stage('web-user-cypress') {
                                    steps {
                                        script {
                                            docker.image('ivozprovider-testing-httpd').withRun('-v "${WORKSPACE}":/opt/irontec/ivozprovider') { c ->
                                                docker.image("ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}")
                                                    .inside("--env CYPRESS_APP_DOMAIN='http://server/user/' --volume ${WORKSPACE}:/opt/irontec/ivozprovider --link ${c.id}:server") {
                                                    sh '/opt/irontec/ivozprovider/web/portal/user/bin/test-pact'
                                                }
                                            }
                                        }
                                    }
                                    post {
                                        success { notifySuccessGithub() }
                                        failure { notifyFailureGithub() }
                                        always { archiveArtifacts artifacts: "web/portal/user/cypress/screenshots/**/*.png", allowEmptyArchive: true }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        // --------------------------------------------------------------------
        // Packaging Testing stage
        // --------------------------------------------------------------------
        stage ('package') {
            when {
                anyOf {
                    expression { hasLabel("packaging") }
                    expression { hasCommitTag("pkg:") }
                }
            }
            stages {
                stage ('package-image') {
                    steps {
                        dir ('debian') {
                            script {
                                docker.build("ivozprovider-package-testing:${env.CHANGE_ID}")
                            }
                        }
                    }
                }
                stage ('package-build') {
                    agent {
                        docker {
                            image "ivozprovider-package-testing:${env.CHANGE_ID}"
                            args "--entrypoint= --volume ${WORKSPACE}:/build/source"
                            reuseNode true
                        }
                    }
                    steps {
                        sh "cd /build/source && dpkg-buildpackage -b"
                    }
                }
            }
            post {
                success { notifySuccessGithub() }
                failure { notifyFailureGithub() }
            }
        }
        // --------------------------------------------------------------------
        // Functional validation
        // --------------------------------------------------------------------
        stage ('functional') {
            steps {
                script {
                    validateFunctionalReview()
                }
            }
            post {
                success { notifySuccessGithub() }
                failure { notifyFailureGithub() }
            }
        }

        // --------------------------------------------------------------------
        // Mergeability validation
        // --------------------------------------------------------------------
        stage ('mergeability') {
            steps {
                script {
                    validateMergeability()
                }
            }
            post {
                success { notifySuccessGithub() }
                failure { notifyFailureGithub() }
            }
        }
    }

    // ------------------------------------------------------------------------
    // Pipeline post-actions
    // ------------------------------------------------------------------------
    post {
        failure {
            notifyFailureMattermost()
        }
        success {
            githubMarkApproved()
            saveTestedHash(env.HASH_BACK)
            saveTestedHash(env.HASH_FRONT_PLATFORM)
            saveTestedHash(env.HASH_FRONT_BRAND)
            saveTestedHash(env.HASH_FRONT_CLIENT)
            saveTestedHash(env.HASH_FRONT_USER)
        }
        unstable {
            script { currentBuild.rawBuild.@result = hudson.model.Result.SUCCESS }
            githubMarkChangesRequested()
            saveTestedHash(env.HASH_BACK)
            saveTestedHash(env.HASH_FRONT_PLATFORM)
            saveTestedHash(env.HASH_FRONT_BRAND)
            saveTestedHash(env.HASH_FRONT_CLIENT)
            saveTestedHash(env.HASH_FRONT_USER)
        }
        fixed {
            notifyFixedMattermost()
        }
        always {
            cleanWs()
        }
    }
}

// -----------------------------------------------------------------------------
// All helper functions have been moved to the shared library:
// https://github.com/irontec/jenkins-pipeline-library
// -----------------------------------------------------------------------------
