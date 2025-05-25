docker run --rm --network=host -v "$(pwd):/usr/src" -e SONAR_HOST_URL="http://localhost:9000" sonarsource/sonar-scanner-cli sonar-scanner
