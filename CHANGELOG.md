# Changelog

## 1.0.0

* Bump composer packages, increase minimum versions (php to 8.3, Symfony to 7.1)
* Replace ramsey/uuid with symfony/uid in dependencies
* Replace doctrine/common with doctrine/orm in dependencies
* Add friendsofphp/php-cs-fixer, doctrine/doctrine-bundle packages
* Introduce new base entities instead of `EightMarq\CoreBundle\Entity\BaseEntity`:  
  * `EightMarq\CoreBundle\Entity\UuidBasedEntity`
  * `EightMarq\CoreBundle\Entity\UlidBasedEntity`
  * `EightMarq\CoreBundle\Entity\IdBasedEntity` 
* Add test environment for phpunit tests
* Add tests for basic entities
* Add `before-commit` composer script 

## 0.9.0

* Allow to use higher php version than 8.1
* Replace knplabs/doctrine-behaviors to eightmarq/doctrine-behaviors
* Bump minimum version of Symfony to 6.4, allow Symfony 7.0

## 0.8.0

* Update required php version to 8.1
* Update required symfony version to 6.1

## 0.7.1

### Change 

* Update CHANGELOG.md

## 0.7.0

### Change

* Replace annotations to PHP8 attributes
* Remove unnecessary doc blocks

## 0.6.0

### Change

* Update to PHP8

## 0.5.0

### Added

* Added `EightMarq\CoreBundle\Entity\BaseEntity` for common entity base
* Added `EightMarq\CoreBundle\DependencyInjection\AbstractExtension` for entity interface registration