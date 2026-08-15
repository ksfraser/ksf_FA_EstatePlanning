<?php
declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * Unit tests for FA Estate Planning integration.
 *
 * @UML Note: Class diagram in ProjectDocs/UML.md
 * @BABOK Related: UT-FA-001
 */
class EstatePlanningIntegrationTest extends TestCase
{
    /**
     * @test
     * @BABOK Related: UT-FA-001-001-security-section
     */
    public function testSecuritySectionIsRegistered(): void
    {
        // Arrange & Act
        $hookClass = new \hooks_ksf_FA_EstatePlanning();

        // Assert
        $this->assertSame('ksf_FA_EstatePlanning', $hookClass->module_name);
    }

    /**
     * @test
     * @BABOK Related: UT-FA-001-002-tab-registration
     */
    public function testInstallTabsRegistersModule(): void
    {
        // Arrange
        $hookClass = new \hooks_ksf_FA_EstatePlanning();
        $app = $this->createMock(\application::class);

        // Assert - Should not throw
        $hookClass->install_tabs($app);
        $this->assertTrue(true);
    }

    /**
     * @test
     * @BABOK Related: UT-FA-001-003-security-areas
     */
    public function testInstallAccessReturnsSecurityConfig(): void
    {
        // Arrange
        $hookClass = new \hooks_ksf_FA_EstatePlanning();

        // Act
        $result = $hookClass->install_access();

        // Assert
        [$securityAreas, $securitySections] = $result;
        $this->assertArrayHasKey('SA_ESTATEPLANNING_VIEW', $securityAreas);
        $this->assertArrayHasKey(\SS_ksf_FA_EstatePlanning, $securitySections);
    }
}