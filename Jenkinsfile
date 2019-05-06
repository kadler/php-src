pipeline {
  agent {
    node {
      label 'ibmi'
    }

  }
  stages {
    stage('configure') {
      environment {
        ax_cv_check_cflags___fvisibility_hidden = "no"

        OBJECT_MODE = '64'
        CC = 'gcc'
        CXX = 'g++'
        CPPFLAGS = "-pthread"
        LDFLAGS = "-pthread -Wl,-bbigtoc -Wl,-blibpath:/QOpenSys/pkgs/lib:/QOpenSys/usr/lib"
        CFLAGS = "-pthread"
        LIBS = "-lbsd"
        PHP_ICONV_PREFIX = "/QOpenSys/pkgs"

        php_sapi_module = "shared"
      }
      steps {
        sh 'cp /QOpenSys/jenkins/php.cache config.cache || :'
        sh './buildconf'
        sh '''./configure \
          --config-cache \
          --without-iconv \
          --enable-fpm \
          --enable-shared=yes \
          --build=powerpc64-ibm-aix6  \
          --host=powerpc64-ibm-aix6
        '''
      }
    }
    stage('build') {
      environment {
        OBJECT_MODE = '64'
      }
      steps {
        sh 'make -j4'
      }
    }
    stage('test') {
      environment {
        OBJECT_MODE = '64'
      }
      steps {
        sh 'make test'
      }
    }
  }
}

