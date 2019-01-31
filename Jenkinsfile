pipeline {
    agent {
        docker {
            image 'ironartemis/ivozprovider-testing-base'
            args '--user jeninks --volume ${WORKSPACE}:/opt/irontec/ivozprovider'
        }
    }
    stages {
        stage('Test') {
            steps {
                sh '/opt/irontec/ivozprovider/library/bin/test-phplint'
            }
        }
    }
}
