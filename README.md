# EightMarq - Core bundle

Core bundle is a basic bundle for all EightMarq bundles.

## Requirements

> PHP 8.3

> Symfony 7.1

## Installation

```bash
composer require eightmarq/core-bundle
```

## Usage

### Base entities

```php
class <your-entity-name> extends UuidBasedEntity
```

```php
class <your-entity-name> extends UlidBasedEntity
```

```php
class <your-entity-name> extends IdBasedEntity
```

**All of them provide basic entity functionalities:**

* $id property with getId() / setId() method
* Timestampable behavior
* SoftDeleteable behavior
* Blameable behavior (Eightmarq/DoctrineBehaviorsfork of KnpLabs/DoctrineBehaviors)

### Doctrine behavior

> Originally this package used the `KnpLabs/DoctrineBehaviors`, but there is/was a [maintainer issue](https://github.com/KnpLabs/DoctrineBehaviors/issues/711).

We implemented the most commonly used behaviors in this package based on the original package (not 100% equivalent).

#### Timestampable

TODO -- document it

#### SoftDeleteable

TODO -- document it

#### Blameable

TODO -- document it

### AbstractExtension

If you create a new bundle, you can extend `EightMarq\CoreBundle\DependencyInjection\AbstractExtension`
instead of using directly use `Symfony\Component\DependencyInjection\Extension\Extension` class.

#### Provides

##### Entity interface registration

Your entities from the bundles will be automatically added to your project.

**Usage**: override prepend function like below

```php
public function prepend(ContainerBuilder $container): void
{
    $this->targetEntities[<interface_class_name>] = <entity_class_name>;

    parent::prepend($container);
}
```

> More information: https://symfony.com/doc/current/doctrine/resolve_target_entity.html

## Configuration reference

Not needed any extra configuration