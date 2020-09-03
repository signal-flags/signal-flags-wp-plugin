# Signal Flags

Integrate flags from the Interational Code of Signals (and more) in WordPress™.

## Development

The following scripts may be used during development.
```bash
# Build for upload
composer build
# Sync with svn repo
composer build:sync
# Run tests
composer test
# Create api documentation.
composer apidocs
# Create api documentation (force download of phpDocumentor).
composer apidocs download
```

### New version release
```bash
# Bump version
composer build:version 1.1.1
# Copy to svn repo
composer build:sync
```
