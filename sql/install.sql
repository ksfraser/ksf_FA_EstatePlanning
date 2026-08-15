-- ksf_FA_EstatePlanning/sql/install.sql
CREATE TABLE IF NOT EXISTS `0_ksf_estateplanning_records` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `debtor_no` INT NOT NULL,
    `scenario_name` VARCHAR(100) NOT NULL,
    `data` JSON DEFAULT NULL,
    `scenario_status` ENUM('draft', 'active', 'completed', 'archived') DEFAULT 'draft',
    `created_by` INT DEFAULT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`debtor_no`) REFERENCES `0_debtors`(`debtor_no`) ON DELETE CASCADE,
    INDEX `idx_debtor` (`debtor_no`),
    INDEX `idx_status` (`scenario_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `0_ksf_estateplanning_beneficiaries` (
    `beneficiary_id` INT AUTO_INCREMENT PRIMARY KEY,
    `record_id` INT NOT NULL,
    `beneficiary_name` VARCHAR(150) NOT NULL,
    `relationship` VARCHAR(50) DEFAULT NULL,
    `allocation_pct` DECIMAL(5,2) DEFAULT 0.00,
    `is_contingent` BOOLEAN DEFAULT FALSE,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`record_id`) REFERENCES `0_ksf_estateplanning_records`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `0_ksf_estateplanning_tax_calcs` (
    `calc_id` INT AUTO_INCREMENT PRIMARY KEY,
    `record_id` INT NOT NULL,
    `jurisdiction` VARCHAR(20) NOT NULL,
    `tax_year` YEAR NOT NULL,
    `gross_estate` DECIMAL(15,2) DEFAULT 0.00,
    `net_taxable` DECIMAL(15,2) DEFAULT 0.00,
    `federal_tax` DECIMAL(15,2) DEFAULT 0.00,
    `provincial_tax` DECIMAL(15,2) DEFAULT 0.00,
    `total_tax` DECIMAL(15,2) DEFAULT 0.00,
    `calc_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`record_id`) REFERENCES `0_ksf_estateplanning_records`(`id`) ON DELETE CASCADE,
    UNIQUE KEY `record_jurisdiction_year` (`record_id`, `jurisdiction`, `tax_year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;