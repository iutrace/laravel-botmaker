# Changelog

All notable changes to this project will be documented in this file.

## [2.0.0] - 2025-08-12

### Added
- Support for Laravel 9, 10, 11, and 12
- Support for PHP 8.1, 8.2, and 8.3
- Proper return type hints throughout the codebase
- Constructor property promotion in Event classes
- Type declarations for class properties
- Comprehensive README with usage examples

### Changed
- **BREAKING**: Minimum PHP version is now 8.1
- **BREAKING**: Minimum Laravel version is now 9.0
- **BREAKING**: Migrations now use anonymous classes (Laravel 9+ format)
- Updated all method signatures with proper type hints
- Improved error handling in WhatsappTemplateState::getState()
- Enhanced code formatting and PHP 8.1+ syntax usage

### Fixed
- Fixed bug in WhatsappTemplateState::getState() where null coalescing wasn't working properly
- Improved error messages in state validation
- Better return type for deleteWhatsappTemplate method

### Deprecated
- Removed support for Laravel 8.x
- Removed support for PHP < 8.1

## [1.0.0] - 2024-08-29

### Added
- Initial release
- WhatsApp template management
- Laravel 8 support
- PHP 7.4+ support
- Botmaker API integration
- Events for template lifecycle
- Commands for template updates
- HasWhatsappTemplates trait
