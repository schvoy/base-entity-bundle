# Eightmarq - Core bundle

Core bundle is a basic bundle for all Eightmarq bundles.

## Requirements

> Important! PHP 7.4 is required for this bundle, because in this bundle we use typed properties feature!

## Installation

```bash
composer require knplabs/doctrine-behaviors
composer require eightmarq/core-bundle
```

## Usage

### Entity 

```php
class <your-entity-name> extends BaseEntity
```

`EightMarq\CoreBundle\Entity\BaseEntity` provides basic entity functionalities:

* $id property with getId() / setId() method
* Timestampable behavior (KnpLabs/DoctrineBehaviors)
* SoftDeleteable behavior (KnpLabs/DoctrineBehaviors)
* Blameable behavior (KnpLabs/DoctrineBehaviors)

### AbstractExtension

If you create a new bundle, you should use `EightMarq\CoreBundle\DependencyInjection\AbstractExtension`
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

No configuration