node {

    checkout scm

    env.DOCKER_API_VERSION="1.23"
    
    sh "git rev-parse --short HEAD > commit-id"

    tag = readFile('commit-id').replace("\n", "").replace("\r", "")
    appName = "httpd"
    registryHost = "127.0.0.1:30400/"
    imageName = "${registryHost}${appName}:${tag}"
    env.BUILDIMG=imageName
    env.BUILD_TAG=tag

    stage "Build"
    
        sh "docker build -t ${imageName} ${appName}/"
    
    stage "Push"

        sh "docker push ${imageName}"

    stage "Deploy"

        kubernetesDeploy configs: "deployment/*.yml", kubeconfigId: 'admin'

}

def label = "mypod-${UUID.randomUUID().toString()}"
podTemplate(name: 'jnlp', namespace: 'cicd', label: label, containers: [
    containerTemplate(name: 'jnlp', image: 'jenkins/jnlp-slave', ttyEnabled: false )
  ])  
    node(label) {
        stage('test project') {
            // git 'https://github.com/jenkinsci/kubernetes-plugin.git'
            container('jnlp') {
                stage('test echo') {
                    sh 'echo hello'
                }
            }
        }
    }



pipeline
{
  agent {
    kubernetes {
      label 'jnlp'
      defaultContainer 'jnlp'
    }
  }

  stages {
        stage('build') {
          steps {
            git 'https://github.com/MisderGAO/pipelinetest'
            script {
                try {
                    appName = "httpd"
                    registryHost = "127.0.0.1:30400/"

                    // sh "touch version.txt"
                    // sh "echo 'test1' | tee version.txt"
                    def exists = fileExists 'version.txt'
                    if (exists) {
                            tag = readFile('version.txt').replace("\n", "").replace("\r", "")                            
                            image = "${registryHost}${appName}:${tag}"
                            env.BUILDIMG = image
                            sh 'echo ${tag}'
                            sh "docker build -t ${image} ${appName}/"
                    } else {
                            throw e  
                            // sh "echo sorry"
                    }
                }catch (err) {
                        // echo "Caught: ${err}"
                            currentBuild.result = 'FAILURE'
                        // echo "${err.buildResult}"
                    }
                // step([$class: 'Mailer', recipients: 'admin@somewhere'])
                    }    
            }
        }
        stage('push') {
          steps {
                sh "docker push ${image}"
            }
        }
        stage('deploy') {
          steps {
            kubernetesDeploy configs: "deployment/*.yml", kubeconfigId: 'admin'
            }
        }
   }
    post {
        always {
            echo 'One way or another, I have finished'
            deleteDir() /* clean up our workspace */
        }
        success {
            echo 'I succeeeded!'
        }
        unstable {
            echo 'I am unstable :/'
        }
        failure {
            echo 'I failed :('
        }
        changed {
            echo 'Things were different before...'
        }
    }
}