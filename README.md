# Bouncer
Simple authentication for symfony app endpoints.

To make this running you need to do only two steps.
- Add `X_AUTH_TOKEN` global variable to your .env
- Implements `Bouncer` on endpoint you want to protect
