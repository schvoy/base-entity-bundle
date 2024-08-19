# Changelog

## 1.0.5 

* Fix README

## 1.0.4

* Introduce <Id|Uuid|Ulid>BasedEntityTrait to use base fields without Mapped Superclass
* Introduce <Id|Uuid|Ulid>BasedEntityPropertyTrait to use base fields without Mapped Superclass

## 1.0.3

* Improve AbstractTestCase - to allow test without entity class 
* Remove essential requirements from README.md

## 1.0.2

* Move config to src/Resources
* Add service config loading to the bundle extension file
* Test code improvements

## 1.0.1

* Rename bundle files: 
  * CoreBundle.php to BaseEntityBundle.php 
  * CoreExtension.php to BaseEntityExtension.php

## 1.0.0

* Move repository from eightmarq/core-bundle to schvoy/base-entity-bundle
* Bump composer packages, increase minimum versions (php to 8.3, Symfony to 7.1)
* Replace ramsey/uuid with symfony/uid in dependencies
* Replace doctrine/common with doctrine/orm in dependencies
* Add friendsofphp/php-cs-fixer, doctrine/doctrine-bundle packages
* Introduce new base entities instead of `Schvoy\BaseEntityBundle\Entity\BaseEntity`:  
  * `Schvoy\BaseEntityBundle\Entity\UuidBasedEntity`
  * `Schvoy\BaseEntityBundle\Entity\UlidBasedEntity`
  * `Schvoy\BaseEntityBundle\Entity\IdBasedEntity` 
* Add test environment for PhpUnit tests
* Add PhpUnit tests 
* Add `before-commit`, `code-quality` and `tests` composer scripts 
* Replace knplabs/doctrine-behaviors (fork) with new doctrine behavior implementations
  * `Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\TimestampableInterface`
    * `Schvoy\BaseEntityBundle\Entity\Traits\Behavior\SoftDeleteable\SoftDeleteableMethodsTrait`
    * `Schvoy\BaseEntityBundle\Entity\Traits\Behavior\SoftDeleteable\SoftDeleteableProperiesTrait`
    * `Schvoy\BaseEntityBundle\Entity\Traits\Behavior\SoftDeleteable\SoftDeleteableTrait`
  * `Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\SoftdeletableInterface`
    * `Schvoy\BaseEntityBundle\Entity\Traits\Behavior\Timestampable\TimestampableMethodsTrait`
    * `Schvoy\BaseEntityBundle\Entity\Traits\Behavior\Timestampable\TimestampableProperiesTrait`
    * `Schvoy\BaseEntityBundle\Entity\Traits\Behavior\Timestampable\TimestampableTrait` 
  * `Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\BlamableInterface`
    * `Schvoy\BaseEntityBundle\Entity\Traits\Behavior\Blamable\BlamableMethodsTrait`
    * `Schvoy\BaseEntityBundle\Entity\Traits\Behavior\Blamable\BlamableProperiesTrait`
    * `Schvoy\BaseEntityBundle\Entity\Traits\Behavior\Blamable\BlamableTrait`
  * Remove eightmarq/doctrine-behaviors (fork of knplabs/doctrine-behaviors) dependency
  * Add symfony/security-bundle dependency
  * Update README.md

## 0.9.0

* Allow to use higher php version than 8.1
* Replace knplabs/doctrine-behaviors with eightmarq/doctrine-behaviors
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

* Added `Schvoy\BaseEntityBundle\Entity\BaseEntity` for common entity base
* Added `Schvoy\BaseEntityBundle\DependencyInjection\AbstractExtension` for entity interface registration