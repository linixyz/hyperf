<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace HyperfTest\DB\Cases;

use Hyperf\DB\DB;

/**
 * @internal
 * @coversNothing
 */
class DBTest extends AbstractTestCase
{
    public function testDBConnection()
    {
        $container = $this->getContainer();
        $db = $container->get(DB::class);
        $db2 = DB::connection('pdo');

        $this->assertInstanceOf(DB::class, $db);
        $this->assertInstanceOf(DB::class, $db2);

        $ref = new \ReflectionClass($db);
        $property = $ref->getProperty('poolName');
        $property->setAccessible(true);
        $this->assertSame('default', $property->getValue($db));
        $this->assertSame('pdo', $property->getValue($db2));
    }
}
