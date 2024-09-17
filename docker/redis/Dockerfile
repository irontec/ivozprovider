# Use Redis 7.0 bookworm base image
FROM redis:7.0-bookworm

# Install supervisor to manage multiple processes
RUN apt-get update && apt-get install -y supervisor && rm -rf /var/lib/apt/lists/*

# Create supervisor directory for configuration
RUN mkdir -p /etc/supervisor/conf.d

# Copy supervisor configuration to manage Redis and Sentinel
COPY docker/redis/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy Redis and Sentinel config files
COPY docker/redis/redis.conf /usr/local/etc/redis/redis.conf
COPY docker/redis/sentinel.conf /usr/local/etc/redis/sentinel.conf

# Expose ports for Redis and Sentinel
EXPOSE 6379 26379

# Start supervisord to run both services
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
