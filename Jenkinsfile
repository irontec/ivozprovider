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
        DOCKER_TAG = getDockerTag()
        BASE_BRANCH = getBaseBranch()
        JIRA_TICKET = getJiraTicket()
    }

    stages {
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
                sh '/opt/irontec/ivozprovider/tests/docker/bin/prepare-composer-deps'
            }
        }
        // --------------------------------------------------------------------
        // Backend Testing stage
        // --------------------------------------------------------------------
        stage('Backend') {
            when {
                anyOf {
                    expression { hasLabel("ci-force-tests-back") }
                    expression { hasLabel("ci-force-tests") }
                    expression { hasCommitTag("core:") }
                    expression { hasCommitTag("schema:") }
                    expression { hasCommitTag("microservice:") }
                    expression { hasCommitTag("rest") }
                    branch "bleeding"
                    branch "tempest"
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
                                    branch "bleeding"
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
                anyOf {
                    expression { hasLabel("ci-force-tests-front") }
                    expression { hasLabel("ci-force-tests") }
                    expression { hasCommitTag("portal") }
                    branch "bleeding"
                    branch "tempest"
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
                                anyOf {
                                    expression { hasLabel("ci-force-tests-front") }
                                    expression { hasLabel("ci-force-tests") }
                                    expression { hasCommitTag("portal:") }
                                    expression { hasCommitTag("portal/platform:") }
                                    branch "bleeding"
                                    branch "tempest"
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
                                                    sh '/opt/irontec/ivozprovider/web/portal/platform/bin/test-sync-api-spec platform'
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
                                anyOf {
                                    expression { hasLabel("ci-force-tests-front") }
                                    expression { hasLabel("ci-force-tests") }
                                    expression { hasCommitTag("portal:") }
                                    expression { hasCommitTag("portal/brand:") }
                                    branch "bleeding"
                                    branch "tempest"
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
                                                    sh '/opt/irontec/ivozprovider/web/portal/brand/bin/test-sync-api-spec brand'
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
                                anyOf {
                                    expression { hasLabel("ci-force-tests-front") }
                                    expression { hasLabel("ci-force-tests") }
                                    expression { hasCommitTag("portal:") }
                                    expression { hasCommitTag("portal/client:") }
                                    branch "bleeding"
                                    branch "tempest"
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
                                                    sh '/opt/irontec/ivozprovider/web/portal/client/bin/test-sync-api-spec client'
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
                                anyOf {
                                    expression { hasLabel("ci-force-tests-front") }
                                    expression { hasLabel("ci-force-tests") }
                                    expression { hasCommitTag("portal:") }
                                    expression { hasCommitTag("portal/user:") }
                                    branch "bleeding"
                                    branch "tempest"
                                }
                            }
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
        //
        // --------------------------------------------------------------------
        // Functional Testing stage
        // --------------------------------------------------------------------
        stage('functional') {
            steps {
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

                    // Functional Reviewer - 10105
                    if (issue.data.fields.customfield_10105) {
                        println "Functional Reviewer: ${issue.data.fields.customfield_10105.displayName}"
                        pullRequest.addLabel('functional-review')
                    } else {
                        println "No functional reviewer assigned."
                    }

                    // Link issue Pull Request field with current branch
                    // customfield_10126 - Pull Request
                    def fields = [fields: [customfield_10126: env.JOB_BASE_NAME]]
                    jiraEditIssue site: 'irontec.atlassian.net', idOrKey: env.JIRA_TICKET, issue: fields

                    // Validated - 10325
                    def status = issue.data.fields.status
                    println "Issue Status: ${status.name} (${status.id})"

                    // For Issues with Functional reviewer
                    if (issue.data.fields.customfield_10105) {
                        // Not validated
                        if (status.id != "10325") {
                            // Ensure the PR is not already marked as changed requested
                            def lastFuncReviewStatus
                            for (review in pullRequest.reviews) {
                                if (review.user == "ironArt3mis") {
                                    lastFuncReviewStatus = review.state
                                }
                            }
                            // PR already marked as review requested
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
            post {
                success { notifySuccessGithub() }
                failure { notifyFailureGithub() }
                unstable { notifyUnstableGithub() }
            }
        }
    }

    // ------------------------------------------------------------------------
    // Pipeline post-actions
    // ------------------------------------------------------------------------
    post {
        failure { notifyFailureMattermost() }
        fixed { notifyFixedMattermost() }
        unstable { script { currentBuild.result = 'ABORTED' } }
        always { cleanWs() }
    }
}

// -----------------------------------------------------------------------------
// Helper Functions
// -----------------------------------------------------------------------------
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

void getBaseBranch() {
    return env.CHANGE_TARGET ?: env.GIT_BRANCH
}

void getDockerTag() {
    return env.CHANGE_ID ?: env.GIT_BRANCH
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
