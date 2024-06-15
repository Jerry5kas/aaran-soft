<?php

namespace Database\Seeders;

use Aaran\Aadmin\Database\Migrations\RefactorMigrationTable;
use Aaran\Aadmin\Src\DbMigration;
use Illuminate\Database\Seeder;

class S00_MigrationSeeder extends Seeder
{
    public static function run(): void
    {
        if (!DbMigration::hasDemo()) {

            RefactorMigrationTable::clear('2024_03_01_000101_create_cities_table');
        }

        if (!DbMigration::hasCore()) {
            RefactorMigrationTable::clear('2024_03_01_000001_create_tenants_table');
            RefactorMigrationTable::clear('2024_03_01_000002_create_roles_table');
            RefactorMigrationTable::clear('2024_03_01_000003_create_users_table');
            RefactorMigrationTable::clear('2024_03_01_000004_add_two_factor_columns_to_users_table');
            RefactorMigrationTable::clear('2024_03_01_000005_create_cache_table');
            RefactorMigrationTable::clear('2024_03_01_000006_create_jobs_table');
            RefactorMigrationTable::clear('2024_03_01_000007_create_personal_access_tokens_table');
            RefactorMigrationTable::clear('2024_03_01_000008_create_default_companies_table');
            RefactorMigrationTable::clear('2024_03_01_000009_create_soft_versions_table');
        }


        if (!DbMigration::hasAccounts()) {
            RefactorMigrationTable::clear('2024_03_01_000601_create_cashbooks_table');
            RefactorMigrationTable::clear('2024_03_01_000602_create_bankbooks_table');
        }

        if (!DbMigration::hasAttendance()) {
            RefactorMigrationTable::clear('2024_03_01_001301_create_attendances_table');
            RefactorMigrationTable::clear('2024_03_01_001302_add_uniqueno_field_to_attendances');
        }

        if (!DbMigration::hasAudit()) {
            RefactorMigrationTable::clear('2024_03_01_000401_create_clients_table');
            RefactorMigrationTable::clear('2024_03_01_000402_create_client_details_table');
            RefactorMigrationTable::clear('2024_03_01_000403_create_client_fees_table');
            RefactorMigrationTable::clear('2024_03_01_000405_create_client_gst_filings_table');
            RefactorMigrationTable::clear('2024_03_01_000406_create_client_banks_table');
            RefactorMigrationTable::clear('2024_03_01_000407_create_client_bank_balances_table');
            RefactorMigrationTable::clear('2024_03_01_000408_create_payment_slips_table');
            RefactorMigrationTable::clear('2024_03_01_000408_create_turnovers_table');
            RefactorMigrationTable::clear('2024_03_01_000409_create_gst_credits_table');
            RefactorMigrationTable::clear('2024_03_01_000409_create_vehicles_table');
            RefactorMigrationTable::clear('2024_03_01_000410_create_rootline_table');
            RefactorMigrationTable::clear('2024_03_01_000411_create_rootline_items_table');
            RefactorMigrationTable::clear('2024_03_01_000412_create_sales_traccks_table');
            RefactorMigrationTable::clear('2024_03_01_000413_create_sales_track_items_table');
            RefactorMigrationTable::clear('2024_03_01_000414_create_sales_bills_table');
            RefactorMigrationTable::clear('2024_03_01_000415_create_sales_bill_items_table');
            RefactorMigrationTable::clear('2024_03_01_000418_create_track_reports_table');
            RefactorMigrationTable::clear('2024_05_01_000417_create_discourses_table');
        }


        if (!DbMigration::hasDeveloper()) {
            RefactorMigrationTable::clear('2024_03_01_001100_create_demo_requests_table');
            RefactorMigrationTable::clear('2024_04_01_001101_create_software_details_table');
            RefactorMigrationTable::clear('2024_04_01_001103_create_project_tasks_table');
            RefactorMigrationTable::clear('2024_04_01_001105_create_project_replies_table');
            RefactorMigrationTable::clear('2024_05_11_001109_create_surfing_categories_table');
            RefactorMigrationTable::clear('2024_05_11_001110_create_surfings_table');
            RefactorMigrationTable::clear('2024_05_13_001111_create_surfing_replies_table');
            RefactorMigrationTable::clear('2024_05_20_001112_create_ui_tasks_table');
            RefactorMigrationTable::clear('2024_05_20_001113_create_ui_replies_table');
        }

        if (!DbMigration::hasMaster()) {
            RefactorMigrationTable::clear('2024_03_01_000201_create_companies_table');
            RefactorMigrationTable::clear('2024_03_01_000202_create_contacts_table');
            RefactorMigrationTable::clear('2024_03_01_000203_create_contact_details_table');
        }
        if (!DbMigration::hasProduct()) {
            RefactorMigrationTable::clear('2024_03_01_000203_crreate_products_table');

        }
        if (!DbMigration::hasOrder()) {
            RefactorMigrationTable::clear('2024_03_01_000204_create_orders_table');
        }
        if (!DbMigration::hasStyle()) {
            RefactorMigrationTable::clear('2024_03_01_000205_create_styles_table');

        }



        if (!DbMigration::hasMagalir()) {
            RefactorMigrationTable::clear('2024_05_06_001401_create_mg_clubs_table');
            RefactorMigrationTable::clear('2024_05_06_001402_create_mg_members_table');
            RefactorMigrationTable::clear('2024_05_06_001403_create_mg_loans_table');
            RefactorMigrationTable::clear('2024_05_06_001404_create_mg_passbooks_table');
        }
        if (!DbMigration::hasCashBook()) {
            RefactorMigrationTable::clear('2024_03_01_001001_create_credit_members_table');
            RefactorMigrationTable::clear('2024_03_01_001002_create_credit_books_table');
            RefactorMigrationTable::clear('2024_03_01_001003_create_credit_book_items_table');
            RefactorMigrationTable::clear('2024_03_01_001003_create_credit_interests_table');
            RefactorMigrationTable::clear('2024_03_01_001004_create_credit_summaries_table');
        }
        if (!DbMigration::hasMailids()) {
            RefactorMigrationTable::clear('2024_03_01_001005_create_mailids_table');
        }
        if (!DbMigration::hasShareTrades()) {
            RefactorMigrationTable::clear('2024_03_01_001006_create_share_trades_table');
        }

        if (!DbMigration::hasTaskManager()) {
            RefactorMigrationTable::clear('2024_03_01_000501_create_tasks_table');
            RefactorMigrationTable::clear('2024_03_01_000502_create_replies_table');
            RefactorMigrationTable::clear('2024_03_01_000503_create_activities_table');
            RefactorMigrationTable::clear('2024_03_01_000504_create_notice_boards_table');
            RefactorMigrationTable::clear('2024_03_01_000505_create_todos_table');
        }


        if (!DbMigration::hasLocation()) {
            RefactorMigrationTable::clear('2024_03_01_000101_create_cities_table');
            RefactorMigrationTable::clear('2024_03_01_000102_create_states_table');
            RefactorMigrationTable::clear('2024_03_01_000103_create_pincodes_table');
            RefactorMigrationTable::clear('2024_03_01_000104_create_countries_table');
        }

    }
}
