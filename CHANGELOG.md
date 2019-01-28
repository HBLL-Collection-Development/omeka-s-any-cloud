# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]
### Removed
- Removed the need for users to manually change the file store alias in `config/local.config.php`

### Changed
- Upped version number to `v0.2.0`
- Updated `README.md`
- Moved reused adapter code to a trait (`src/Service/File/Adapter/Common.php`)
- Changed the names of variables used to set up adapters based on Amazon Web Services (breaking change)

### Added
- Added `CHANGELOG.md`

## [v0.1.0] - 2019-01-27
### Added
- Initial release
- Minimally viable module