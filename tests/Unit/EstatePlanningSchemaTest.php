<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * The estate-planning schema declared a foreign key to `0_debtors`, a table
 * that exists nowhere - not in FA core (whose debtor table is
 * `0_debtors_master`) and not in any schema in this estate. MySQL rejects the
 * CREATE TABLE outright with error 3730 ("Failed to create a foreign key
 * constraint"), so `0_ksf_estateplanning_records` was never created and the
 * whole module schema was missing.
 *
 * @BABOK Related: UT-FA-001
 */
class EstatePlanningSchemaTest extends TestCase
{
    private string $moduleDir;

    protected function setUp(): void
    {
        $this->moduleDir = dirname(__DIR__, 2);
    }

    public function testSchemaDoesNotReferenceTheNonExistentDebtorsTable(): void
    {
        $contents = (string) file_get_contents($this->moduleDir . '/sql/install.sql');

        $this->assertStringNotContainsString(
            'REFERENCES `0_debtors`',
            $contents,
            'sql/install.sql must not declare a foreign key to 0_debtors: that table does not exist'
        );
    }

    public function testDebtorForeignKeyTargetsFaCoreDebtorsMaster(): void
    {
        $contents = (string) file_get_contents($this->moduleDir . '/sql/install.sql');

        $this->assertStringContainsString(
            'FOREIGN KEY (`debtor_no`) REFERENCES `0_debtors_master`(`debtor_no`)',
            $contents,
            'the debtor foreign key must target FA core\'s 0_debtors_master'
        );
    }

    public function testDebtorColumnTypeMatchesFaCoreDebtorNumber(): void
    {
        $contents = (string) file_get_contents($this->moduleDir . '/sql/install.sql');

        // FA core: 0_debtors_master.debtor_no is int(11) auto_increment PRIMARY KEY.
        $this->assertMatchesRegularExpression(
            '/`debtor_no`\s+INT\b/i',
            $contents,
            'the debtor_no column must stay INT to match FA core\'s 0_debtors_master.debtor_no'
        );
    }
}
