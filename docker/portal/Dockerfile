FROM node:bookworm

################################################################################
# Install package dependencies
################################################################################
ENV DEBIAN_FRONTEND=noninteractive
RUN apt-get update && apt-get install jq -y

################################################################################
# Startup script
################################################################################
ADD docker/portal/start.sh /var/run
RUN chmod +x /var/run/start.sh

WORKDIR /opt/web/portal
CMD [ "/bin/bash", "/var/run/start.sh"]
