#!/usr/bin/env bash

SONAR_CLI_ZIP=sonar-scanner-cli-3.3.0.1492-linux.zip
SONAR_CLI_DIR=sonar-scanner-3.3.0.1492-linux

wget https://binaries.sonarsource.com/Distribution/sonar-scanner-cli//$SONAR_CLI_ZIP
unzip $SONAR_CLI_ZIP

SONAR_CLI_BIN=`pwd`/$SONAR_CLI_DIR/bin

echo "export PATH=$SONAR_CLI_BIN:\$PATH" >> $BASH_ENV
