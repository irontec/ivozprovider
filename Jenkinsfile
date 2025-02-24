pipeline {
    agent any

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

    environment {
        SYMFONY_PHPUNIT_DIR = "/opt/phpunit/"
        SYMFONY_PHPUNIT_VERSION = "9.5.3"
        DOCKER_TAG = getDockerTag()
        BRANCH_NAME = getBranchName()
        BASE_BRANCH = getBaseBranch()
        JIRA_TICKET = getJiraTicket()
        HASH_BACK = getCurrentHash("asterisk/agi library microservices schema web/rest")
        HASH_FRONT_PLATFORM = getCurrentHash("web/portal/platform")
        HASH_FRONT_BRAND = getCurrentHash("web/portal/brand")
        HASH_FRONT_CLIENT = getCurrentHash("web/portal/client")
        HASH_FRONT_USER = getCurrentHash("web/portal/user")
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
                updateJiraTicket()
            }
        }

        stage('Image') {
            steps {
                buildDockerImages()
            }
        }

        stage('Generic') {
            agent {
                docker {
                    image "ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}"
                    args '--volume ${WORKSPACE}:/opt/irontec/ivozprovider'
                    reuseNode true
                }
            }
            steps {
                runGenericTests()
            }
        }

        stage('Cached Pipeline') {
            agent any
            when {
                not {
                    anyOf {
                        expression { hasLabel("ci-force-tests-back") }
                        expression { hasLabel("ci-force-tests-front") }
                        expression { hasLabel("ci-force-tests") }
                        branch "bleeding"
                    }
                }
            }
            steps {
                checkCachedPipeline()
            }
        }

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
                        branch "bleeding"
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
                        prepareBackend()
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
                                runAppGenericTests()
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
                                runStaticAnalysis()
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
                                runCodeStyleTests()
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
                                runI18nTests()
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
                                runPhpSpecTests()
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
                                runApiPlatformTests()
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
                                runApiBrandTests()
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
                                runApiClientTests()
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
                                runApiUserTests()
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
                                runMicroserviceProvisionTests()
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
                                runMicroserviceRealtimeTests()
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
                                runOrmTests()
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
                                runGeneratorsTests()
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
                                    branch "bleeding"
                                    branch "tempest"
                                }
                            }
                            steps {
                                runSchemaTests()
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
                        branch "bleeding"
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
                        prepareFrontend()
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
                                        branch "bleeding"
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
                                        runWebPlatformBuild()
                                    }
                                    post {
                                        success { notifySuccessGithub() }
                                        failure { notifyFailureGithub() }
                                    }
                                }
                                stage('web-platform-cypress') {
                                    steps {
                                        runWebPlatformCypress()
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
                                        branch "bleeding"
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
                                        runWebBrandBuild()
                                    }
                                    post {
                                        success { notifySuccessGithub() }
                                        failure { notifyFailureGithub() }
                                    }
                                }
                                stage('web-brand-cypress') {
                                    steps {
                                        runWebBrandCypress()
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
                                        branch "bleeding"
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
                                        runWebClientBuild()
                                    }
                                    post {
                                        success { notifySuccessGithub() }
                                        failure { notifyFailureGithub() }
                                    }
                                }
                                stage('web-client-cypress') {
                                    steps {
                                        runWebClientCypress()
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
                                        branch "bleeding"
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
                                        runWebUserBuild()
                                    }
                                    post {
                                        success { notifySuccessGithub() }
                                        failure { notifyFailureGithub() }
                                    }
                                }
                                stage('web-user-cypress') {
                                    steps {
                                        runWebUserCypress()
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
                        buildPackageImage()
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
                        buildPackage()
                    }
                }
            }
            post {
                success { notifySuccessGithub() }
                failure { notifyFailureGithub() }
            }
        }

        stage('functional') {
            steps {
                runFunctionalTests()
            }
            post {
                success { notifySuccessGithub() }
                failure { notifyFailureGithub() }
                unstable { notifyUnstableGithub() }
            }
        }

        stage ('mergeability') {
            steps {
                validateMergeability()
            }
            post {
                success { notifySuccessGithub() }
                failure { notifyFailureGithub() }
                unstable { notifyUnstableGithub() }
            }
        }
    }

    post {
        failure { notifyFailureMattermost() }
        fixed { notifyFixedMattermost() }
        unstable { script { currentBuild.result = 'ABORTED' } }
        always { cleanWs() }
        success {
            saveTestedHash(env.HASH_BACK)
            saveTestedHash(env.HASH_FRONT_PLATFORM)
            saveTestedHash(env.HASH_FRONT_BRAND)
            saveTestedHash(env.HASH_FRONT_CLIENT)
            saveTestedHash(env.HASH_FRONT_USER)
        }
    }
}

// Helper Functions
void updateJiraTicket() {
    script {
        def fields = [
            fields: [
                customfield_10165: env.JOB_BASE_NAME,
                customfield_10166: env.CHANGE_BRANCH,
            ]
        ]
        jiraEditIssue site: 'irontec.atlassian.net', idOrKey: env.JIRA_TICKET, issue: fields
    }
}

void buildDockerImages() {
    script {
        docker.build("ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}", "-f tests/docker/Dockerfile .")
    }
    dir('tests/httpd/') {
        script {
            docker.build("ivozprovider-testing-httpd")
        }
    }
}

void runGenericTests() {
    sh "/opt/irontec/ivozprovider/library/bin/test-commit-tags origin/${env.BASE_BRANCH}"
    sh '/opt/irontec/ivozprovider/tests/docker/bin/prepare-composer-deps'
}

void checkCachedPipeline() {
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

void prepareBackend() {
    sh '/opt/irontec/ivozprovider/tests/docker/bin/prepare-fixtures'
    sh '/opt/irontec/ivozprovider/web/rest/platform/bin/generate-keys --test'
}

void runAppGenericTests() {
    sh '/opt/irontec/ivozprovider/library/bin/test-app-console'
    sh '/opt/irontec/ivozprovider/library/bin/test-app-dependencies'
}

void runStaticAnalysis() {
    sh '/opt/irontec/ivozprovider/library/bin/test-phpstan'
    sh '/opt/irontec/ivozprovider/library/bin/test-psalm'
    sh '/opt/irontec/ivozprovider/library/bin/test-psalm-update-baseline'
}

void runCodeStyleTests() {
    sh '/opt/irontec/ivozprovider/library/bin/test-codestyle --full'
    sh '/opt/irontec/ivozprovider/library/bin/test-codestyle-gherkin'
}

void runI18nTests() {
    sh '/opt/irontec/ivozprovider/library/bin/test-i18n'
}

void runPhpSpecTests() {
    sh '/opt/irontec/ivozprovider/library/bin/test-phpspec'
}

void runApiPlatformTests() {
    sh '/opt/irontec/ivozprovider/web/rest/platform/bin/test-api-spec'
    sh '/opt/irontec/ivozprovider/web/rest/platform/bin/test-api --skip-db'
    sh '/opt/irontec/ivozprovider/web/portal/platform/bin/test-sync-api-spec platform'
}

void runApiBrandTests() {
    sh '/opt/irontec/ivozprovider/web/rest/brand/bin/test-api-spec'
    sh '/opt/irontec/ivozprovider/web/rest/brand/bin/test-api --skip-db'
    sh '/opt/irontec/ivozprovider/web/portal/brand/bin/test-sync-api-spec brand'
}

void runApiClientTests() {
    sh '/opt/irontec/ivozprovider/web/rest/client/bin/test-api-spec'
    sh '/opt/irontec/ivozprovider/web/rest/client/bin/test-api --skip-db'
    sh '/opt/irontec/ivozprovider/web/portal/client/bin/test-sync-api-spec client'
}

void runApiUserTests() {
    sh '/opt/irontec/ivozprovider/web/rest/user/bin/test-api-spec'
    sh '/opt/irontec/ivozprovider/web/rest/user/bin/test-api --skip-db'
    sh '/opt/irontec/ivozprovider/web/portal/user/bin/test-sync-api-spec user'
}

void runMicroserviceProvisionTests() {
    sh '/opt/irontec/ivozprovider/microservices/provision/bin/test-provision'
}

void runMicroserviceRealtimeTests() {
    sh '/opt/irontec/ivozprovider/microservices/realtime/tests/test-build.sh'
    sh '/opt/irontec/ivozprovider/microservices/realtime/tests/test-codestyle.sh'
}

void runOrmTests() {
    sh '/opt/irontec/ivozprovider/schema/bin/test-orm --skip-db'
}

void runGeneratorsTests() {
    sh '/opt/irontec/ivozprovider/tests/docker/bin/prepare-and-run'
    sh '/opt/irontec/ivozprovider/schema/bin/test-generators'
}

void runSchemaTests() {
    script {
        docker.image('percona/percona-server:8.0').withRun('-e "MYSQL_ROOT_PASSWORD=changeme"', '--default-authentication-plugin=mysql_native_password') { c ->
            docker.image('percona/percona-server:8.0').inside("--link ${c.id}:data.ivozprovider.local") {
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

void prepareFrontend() {
    sh '/opt/irontec/ivozprovider/tests/docker/bin/prepare-node-modules'
}

void runWebPlatformBuild() {
    sh '/opt/irontec/ivozprovider/web/portal/platform/bin/test-lint'
    sh '/opt/irontec/ivozprovider/web/portal/platform/bin/test-i18n'
    sh '/opt/irontec/ivozprovider/web/portal/platform/bin/test-build'
}

void runWebPlatformCypress() {
    script {
        docker.image('ivozprovider-testing-httpd').withRun('-v "${WORKSPACE}":/opt/irontec/ivozprovider') { c ->
            docker.image("ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}")
                .inside("--env CYPRESS_APP_DOMAIN='http://server/platform/' --volume ${WORKSPACE}:/opt/irontec/ivozprovider --link ${c.id}:server") {
                sh '/opt/irontec/ivozprovider/web/portal/platform/bin/test-sync-api-spec platform'
                sh '/opt/irontec/ivozprovider/web/portal/platform/bin/test-pact'
            }
        }
    }
}

void runWebBrandBuild() {
    sh '/opt/irontec/ivozprovider/web/portal/brand/bin/test-lint'
    sh '/opt/irontec/ivozprovider/web/portal/brand/bin/test-i18n'
    sh '/opt/irontec/ivozprovider/web/portal/brand/bin/test-build'
}

void runWebBrandCypress() {
    script {
        docker.image('ivozprovider-testing-httpd').withRun('-v "${WORKSPACE}":/opt/irontec/ivozprovider') { c ->
            docker.image("ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}")
                .inside("--env CYPRESS_APP_DOMAIN='http://server/brand/' --volume ${WORKSPACE}:/opt/irontec/ivozprovider --link ${c.id}:server") {
                sh '/opt/irontec/ivozprovider/web/portal/brand/bin/test-sync-api-spec brand'
                sh '/opt/irontec/ivozprovider/web/portal/brand/bin/test-pact'
            }
        }
    }
}

void runWebClientBuild() {
    sh '/opt/irontec/ivozprovider/web/portal/client/bin/test-lint'
    sh '/opt/irontec/ivozprovider/web/portal/client/bin/test-i18n'
    sh '/opt/irontec/ivozprovider/web/portal/client/bin/test-build'
}

void runWebClientCypress() {
    script {
        docker.image('ivozprovider-testing-httpd').withRun('-v "${WORKSPACE}":/opt/irontec/ivozprovider') { c ->
            docker.image("ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}")
                .inside("--env CYPRESS_APP_DOMAIN='http://server/client/' --volume ${WORKSPACE}:/opt/irontec/ivozprovider --link ${c.id}:server") {
                sh '/opt/irontec/ivozprovider/web/portal/client/bin/test-sync-api-spec client'
                sh '/opt/irontec/ivozprovider/web/portal/client/bin/test-pact'
            }
        }
    }
}

void runWebUserBuild() {
    sh '/opt/irontec/ivozprovider/web/portal/user/bin/test-lint'
    sh '/opt/irontec/ivozprovider/web/portal/user/bin/test-i18n'
    sh '/opt/irontec/ivozprovider/web/portal/user/bin/test-build'
}

void runWebUserCypress() {
    script {
        docker.image('ivozprovider-testing-httpd').withRun('-v "${WORKSPACE}":/opt/irontec/ivozprovider') { c ->
            docker.image("ironartemis/ivozprovider-testing-base:${env.DOCKER_TAG}")
                .inside("--env CYPRESS_APP_DOMAIN='http://server/user/' --volume ${WORKSPACE}:/opt/irontec/ivozprovider --link ${c.id}:server") {
                sh '/opt/irontec/ivozprovider/web/portal/user/bin/test-sync-api-spec user'
                sh '/opt/irontec/ivozprovider/web/portal/user/bin/test-pact'
            }
        }
    }
}

void buildPackageImage() {
    dir ('debian') {
        script {
            docker.build("ivozprovider-package-testing:${env.CHANGE_ID}")
        }
    }
}

void buildPackage() {
    sh "cd /build/source && dpkg-buildpackage -b"
}

void runFunctionalTests() {
    script {
        if (!env.JIRA_TICKET) {
            echo "No ticket associated."
            return
        }

        if (!env.CHANGE_ID) {
            echo "Not a Pull request."
            return
        }

        def issue = jiraGetIssue site: 'irontec.atlassian.net', idOrKey: env.JIRA_TICKET

        if (issue.data.fields.customfield_10168) {
            println "Functional Reviewer: ${issue.data.fields.customfield_10168.displayName}"
            pullRequest.addLabel('functional-review')
        } else {
            println "No functional reviewer assigned."
        }

        def status = issue.data.fields.status
        println "Issue Status: ${status.name} (${status.id})"

        if (issue.data.fields.customfield_10168) {
            if (status.id != "10325") {
                def lastFuncReviewStatus
                for (review in pullRequest.reviews) {
                    if (review.user == "ironArt3mis") {
                        lastFuncReviewStatus = review.state
                    }
                }
                if (lastFuncReviewStatus == "CHANGES_REQUESTED") {
                    echo "This PR is already marked as functional review required"
                    return
                }
                pullRequest.review('REQUEST_CHANGES', 'Functional review required')
            } else {
                pullRequest.review('APPROVE')
            }
        }
    }
}

void validateMergeability() {
    script {
        if (!env.CHANGE_TARGET) {
            echo "Not a merge request branch. Merge checks not required."
            return
        }

        if (env.BRANCH_NAME.startsWith("dependabot")) {
            echo "Security alarm branch. Merge checks not required."
            return
        }

        if (!env.JIRA_TICKET) {
            failure "No ticket associated. Can not validate mergeability."
        }

        def issue = jiraGetIssue site: 'irontec.atlassian.net', idOrKey: env.JIRA_TICKET

        isSubtask = issue.data.fields.issuetype.subtask
        if (isSubtask) {
            def task = issue.data.fields.parent
            echo "${env.JIRA_TICKET} is a subtask part of a feature task."

            if (!env.CHANGE_TARGET.startsWith(task.key)) {
                unstable "Target branch ${env.CHANGE_TARGET} is not an feature branch. Merge will be blocked until all previous task are merged"
            }

            def status = task.fields.status
            if (status.id != "10325") {
                unstable "Feature not yet validated. Merge is blocked."
            }

            try {
                sh "git merge-base --is-ancestor origin/master origin/${env.CHANGE_TARGET}"
            } catch (Exception e) {
                unstable "Feature branch ${env.CHANGE_TARGET} is not properly rebased. Merge is blocked."
            }
        } else {
            echo "${env.JIRA_TICKET} is a task. Checking subtasks..."

            if (env.CHANGE_TARGET != "bleeding") {
                unstable "Target branch ${env.CHANGE_TARGET} is not an bleeding branch."
            }

            def subtasks = issue.data.fields.subtasks
            subtasks.each { subtask ->
                def status = subtask.fields.status
                if (status.id != "10002") {
                    unstable "Subtask ${subtask.key} is not completed (Status: ${status.name})."
                }
            }
        }
    }
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

void notifyUnstableGithub() {
    githubNotify([
        context: "ivozprovider-testing-${STAGE_NAME}",
        description: "Cancelled",
        status: "ERROR"
    ])
}

void notifyFailureMattermost() {
    if (env.GIT_BRANCH == 'bleeding' || env.GIT_BRANCH == 'tempest') {
        mattermostSend([
            channel: "#comms-provider",
            color: "#FF0000",
            message: ":red_circle: Branch ${env.GIT_BRANCH} tests failed :red_circle: - (<${env.BUILD_URL}|Open>)"
        ])
    }
}

void notifyFixedMattermost() {
    if (env.GIT_BRANCH == 'bleeding' || env.GIT_BRANCH == 'tempest') {
        mattermostSend([
            channel: "#comms-provider",
            color: "#008000",
            message: ":thumbsup_all: Branch ${env.GIT_BRANCH} tests fixed :thumbsup_all: - (<${env.BUILD_URL}|Open>)"
        ])
    }
}

def getCurrentHash(dir) {
    return sh(script: "find ${dir} -type f -not -path './.git/*' -exec sha256sum {} + | sort | sha256sum | awk '{print \$1}'", returnStdout: true).trim()
}

def isHashTested(hash) {
    if (!fileExists(env.HASH_FILE)) {
        return false
    }
    def hashes = readFile(env.HASH_FILE).split("\n")
    return hashes.contains(hash)
}

def saveTestedHash(hash) {
    if (isHashTested(hash)) {
        echo "Hash ${hash} already saved cache file."
        return
    }

    def hashes = fileExists(env.HASH_FILE) ? readFile(env.HASH_FILE).split("\n") as List : []

    if (hashes.size() >= env.MAX_HASHES.toInteger()) {
        hashes.remove(0)
    }

    hashes.add(hash)

    writeFile(file: env.HASH_FILE, text: hashes.join("\n"))
    echo "Saved new tested hash: ${hash}. Total hashes stored: ${hashes.size()}"
}

void getJiraTicket() {
    def matcher = "${env.CHANGE_BRANCH}" =~ /^(?<jira>\w+-\d+)-.*$/
    if (matcher.matches()) {
        return matcher.group("jira")
    } else {
        return ""
    }
}

boolean hasLabel(String label) {
    return env.CHANGE_ID && pullRequest.labels.contains(label)
}

boolean hasCommitTag(String module) {
  return env.CHANGE_TARGET && sh(
    returnStatus: true,
    script: "git log --oneline origin/${env.CHANGE_TARGET}...${env.GIT_COMMIT} | grep ${module}"
  ) == 0
}

void getBranchName() {
    return env.CHANGE_BRANCH ?: env.GIT_BRANCH
}

void getBaseBranch() {
    return env.CHANGE_TARGET ?: env.GIT_BRANCH
}

void getDockerTag() {
    return env.CHANGE_ID ?: env.GIT_BRANCH
}
