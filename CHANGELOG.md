# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2024-01-01

### Added
- Initial release of the UberEats PHP SDK
- Support for PHP 7.4 and above
- OAuth2 authentication with client credentials
- Order management (get, list, accept, deny, cancel)
- Store management (get, list, update, status)
- Delivery management (get, list, create, update, cancel, tracking)
- Menu and inventory management
- Webhook handling for order and delivery events
- Comprehensive test suite
- PSR-12 coding standards
- PHPStan level max static analysis
- Full documentation with examples

### Features
- Type-safe request/response objects
- Enum support for order and delivery states
- Collection classes with pagination
- PSR-3 logging support
- Guzzle HTTP client integration
- Symfony Serializer integration
- Exception handling with detailed error messages
- Row-level security for all database operations
- Webhook event handling with type safety

### Dependencies
- PHP ^7.4 || ^8.0
- guzzlehttp/guzzle ^7.4
- psr/log ^1.1 || ^2.0 || ^3.0
- symfony/serializer ^5.4 || ^6.0
- symfony/property-access ^5.4 || ^6.0
- symfony/validator ^5.4 || ^6.0