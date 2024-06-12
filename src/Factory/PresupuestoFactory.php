<?php

namespace App\Factory;

use App\Entity\Presupuesto;
use App\Repository\PresupuestoRepository;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;


/**
 * @extends PersistentProxyObjectFactory<Presupuesto>
 *
 * @method        Presupuesto|Proxy create(array|callable $attributes = [])
 * @method static Presupuesto|Proxy createOne(array $attributes = [])
 * @method static Presupuesto|Proxy find(object|array|mixed $criteria)
 * @method static Presupuesto|Proxy findOrCreate(array $attributes)
 * @method static Presupuesto|Proxy first(string $sortedField = 'id')
 * @method static Presupuesto|Proxy last(string $sortedField = 'id')
 * @method static Presupuesto|Proxy random(array $attributes = [])
 * @method static Presupuesto|Proxy randomOrCreate(array $attributes = [])
 * @method static PresupuestoRepository|ProxyRepositoryDecorator repository()
 * @method static Presupuesto[]|Proxy[] all()
 * @method static Presupuesto[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Presupuesto[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Presupuesto[]|Proxy[] findBy(array $attributes)
 * @method static Presupuesto[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Presupuesto[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
class PresupuestoFactory extends PersistentProxyObjectFactory{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Presupuesto $presupuesto): void {})
        ;
    }

    public static function class(): string
    {
        return Presupuesto::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'Nombre' => self::faker()->text(255),
            'Total' => self::faker()->randomFloat(),
        ];
    }
}
