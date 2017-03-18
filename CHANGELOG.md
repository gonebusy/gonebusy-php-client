# Change Log
All notable changes to this project will be documented in this file.

## [0.0.10] - 2017-03-18 ##
### Fixed
- [#22](https://github.com/gonebusy/gonebusy-php-client/pull/22) - Fix type of :gender to String; Add :primary_cal to ResourceResponse - [@alexagranov](https://github.com/alexagranov)

## [0.0.9] - 2017-03-16 ##
### Fixed
- [#21](https://github.com/gonebusy/gonebusy-php-client/pull/21) - Add back :max_duration on CreateServiceBody/UpdateServiceByIdBody - [@alexagranov](https://github.com/alexagranov)

## [0.0.8] - 2017-03-06 ##
### Added
- update GET /schedules for query by resource_id, service_id
- update Service response bodies with max_duration

## [0.0.7] - 2017-02-14 ##
### Added
- update for latest APIMatic generated code

## [0.0.6] - 2017-02-13 ##
### Added
- update for HTTPS

## [0.0.5] - 2017-01-19 ##
### Removed
- Unnecessary /user/pros endpoint

## [0.0.4] - 2017-01-19 ##
### Fixed
- PR #4 - Correct 'pricing_model' (instead of plural) response root for GET/PUT /pricing_models/:id and POST /pricing_models/new

## [0.0.3] - 2017-01-15 ##
### Added
- Pull #2 - adding Service :max_duration support
- CHANGELOG.md

## [0.0.2] - 2016-10-14 ##
- Initial public version
