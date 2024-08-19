# Base entity bundle

A bundle which provides base doctrine entities and behaviors for Symfony projects.

## Installation

```bash
composer require schvoy/base-entity-bundle
```

## Usage

### Use base entities as Mapped Superclass

```php
class <your-entity-name> extends UuidBasedEntity
```

```php
class <your-entity-name> extends UlidBasedEntity
```

```php
class <your-entity-name> extends IdBasedEntity
```

**All of them provide commonly used entity functionalities:**

* `$id` property with getId() / setId() method - the value based on the class name can be integer, Uuid or Ulid
* Timestampable behavior
    * `$createdAt`
    * `$updatedAt`
* SoftDeleteable behavior
    * `$deletedAt`
* Blameable behavior
    * `$createdBy`
    * `$updatedBy`
    * `$deletedBy`

### Only traits? Yes

If you don't want to use the Mapped Superclasses? Than you can use only the traits.
In this case you can extend your entity classes with the traits what you want to use.

```php
# Id entity traits
use IdBasedEntityTrait;
use UUidBasedEntityTrait;
use UliddBasedEntityTrait;

# Doctrine Behavior traits
use BlameableTrait;
use SoftDeleteableTrait;
use TimestampableTrait;
```


## Doctrine behavior

Originally this package used the `KnpLabs/DoctrineBehaviors`, but there is/was a [maintainer issue](https://github.com/KnpLabs/DoctrineBehaviors/issues/711).
Therefore this bundle contains a new implementation of the most generally used behaviors, based on the original package.

> The implementation is not 100% equivalent to the original package.

Doctrine listeners for the behavior events are loaded automatically, but for the Blameable behavior you have to define
which one is your User class (check the configuration part).

There are built-in implementations of the behavior interfaces attached to the base entities, but you can define your own if you want.

### Timestampable

Timestampable handle the createdAt and updatedAt fields during persist and update.

Your entity have to implement the `Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\TimestampableInterface`. 

### SoftDeleteable

The behavior keeps the data in the database without real data removal, it is just set the deletedAt value on the entity.

This bundle provides extra helping methods for this behavior on the entity:

- delete()
- restore()
- isDeleted()
- willBeDeleted()

Your entity have to implement the `Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\SoftdeletableInterface`.

### Blameable

Tracks who did the changes on the entity during persist, update or remove (working only with soft delete).

When the entity implements the `Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\BlamableInterface` then the createdBy
and updatedBy field are tracked during persist and update by default.

To track also the deletedBy during remove, your entity have to implements the `Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\SoftdeletableInterface`.

> The deletedBy field will be added to the entity even if the SoftDeleteable behavior is not used, but it will be always null.

> More information: https://symfony.com/doc/current/doctrine/resolve_target_entity.html

## Configuration reference

Required config fo Blameable behavior

```yaml
doctrine:
    orm:
        resolve_target_entities:
            Symfony\Component\Security\Core\User\UserInterface: Your\Namespace\User
```
