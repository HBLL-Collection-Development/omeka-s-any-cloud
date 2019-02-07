# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## \[v0.3.2\] - 2019-02-07
### Changed
- Upped version number to `v0.3.2`
- Fixed bug when `default` adapter is selected
- Added `README.md` to bundle so description shows up in Omeka’s website

## \[v0.3.1\] - 2019-02-05
### Changed
- Upped version number to `v0.3.1`
- Reduced complexity of `AnyCloudFactory.php`
- Reduced complexity of `ConfigForm.php`
- Fixed markdown style to be consistent

### Added
- Scrutinizer integration
- Code Climate integration
- StyleCI integration

### Removed
- Unused files

## \[v0.3.0\] - 2019-02-03
### Changed
- Upped version number to `v0.3.0`
- Updated `README.md`
- Simplified settings for fewer database entries in `setting` table (breaking change—should be last breaking change for a while)

### Added
- User friendly configuration form for multiple cloud adapters

## \[v0.2.0\] - 2019-01-29
### Removed
- Removed the need for users to manually change the file store alias in `config/local.config.php`

### Changed
- Upped version number to `v0.2.0`
- Updated `README.md`
- Allow settings to be configurable by the user from the Admin side of the system
- Changed the names of variables used to set up adapters (breaking change)
- Moved reused adapter code to a trait (`src/Service/File/Adapter/Common.php`)
- Updated `.gitignore` file to ignore `CHANGELOG.md` when exporting project

### Added
- Added `CHANGELOG.md`
- Added `CODE_OF_CONDUCT.md`
- Added templates for filing issues and requesting features

## \[v0.1.0\] - 2019-01-27
### Added
- Initial release
- Minimally viable module
