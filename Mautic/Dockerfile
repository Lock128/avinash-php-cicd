# Use the official Mautic image as the base
FROM mautic/mautic:latest

# Set environment variables
ENV MAUTIC_DB_HOST=db
ENV MAUTIC_DB_NAME=mautic
ENV MAUTIC_DB_USER=mautic
ENV MAUTIC_DB_PASSWORD=mautic_password
ENV MAUTIC_TRUSTED_PROXIES='["0.0.0.0/0"]'
ENV DOCKER_MAUTIC_ROLE=mautic_web  

# Verify the entrypoint script location and permissions during build
RUN ls -l /entrypoint.sh && chmod +x /entrypoint.sh && cat /entrypoint.sh

# Expose HTTP port
EXPOSE 80

# Use shell to enforce entrypoint execution
ENTRYPOINT ["/bin/sh", "/entrypoint.sh"]

# Default command to run Apache
CMD ["apache2-foreground"]
