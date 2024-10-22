# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com) and this project adheres to [Semantic Versioning](https://semver.org).

## 5.0.0 - 2024-10-22

### Added

- prunable configuration
- use MassPrunable in model

### Changed

- rename column ac_date_time_local in migrtion to ac_date_time
- make column ac_event_name nullable
- model

### Deprecated

- Nothing

### Removed

- column ac_date_time_utc in migrtion

### Fixed

- column prefix from al_ to ac_ for some columns

## 4.0.1 - 2023-01-18

### Added

- Nothing

### Changed

- Path for config and database

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- AccessLogSubscriber handleAccessLogEvent($event) set data['success'] to true on model create success

## 4.0.0 - 2022-09-13

### Added

- Nothing

### Changed

- Path for config and database

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- Nothing

## 3.0.0 - 2022-07-26

### Added

- SimpleAccessLog contract

### Changed

- renamed model to SimpleAccessLog

### Deprecated

- Nothing

### Removed

- custom fields as we can implement custom model

### Fixed

- Nothing

## 2.0.0 - 2022-07-26

### Added

- Nothing

### Changed

- migration file
- al_actor_id column nullable, as string to support UUID
- al_actor_global_uid column as string
- al_target_id column as string

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- Nothing

## 1.2.0 - 2022-03-04

### Added

- Nothing

### Changed

- README.MD - explain table fields

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- Nothing

## 1.1.0 - 2022-01-25

### Added

- custom fields in migration filed

### Changed

- migration file
- model

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- Nothing