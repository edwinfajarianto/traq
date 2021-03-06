<?php
$autoloader = require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/version.php';


use Avalon\Testing\TestSuite;

$testSuite = new TestSuite(
    Traq\Kernel::class,
    Traq\Database\Seeder::class,
    require __DIR__ . '/../config/config.php'
);

if ($testSuite->codeCoverageEnabled()) {
    $coverageFilter = $testSuite->getCodeCoverage()->filter();
    $coverageFilter->addDirectoryToWhitelist('src');
    $coverageFilter->removeDirectoryFromWhitelist('src/config');
    $coverageFilter->removeDirectoryFromWhitelist('src/Database');
    $coverageFilter->removeDirectoryFromWhitelist('src/Translations');
    $coverageFilter->removeDirectoryFromWhitelist('src/views');
    $coverageFilter->removeFileFromWhitelist('src/version.php');
    // $coverageFilter->removeFileFromWhitelist('src/Kernel.php');
    // $coverageFilter->removeFileFromWhitelist('src/Plugin.php');
}

require __DIR__ . '/helpers/common.php';
require __DIR__ . '/helpers/models.php';

require __DIR__ . '/tests/permissions.php';
require __DIR__ . '/tests/themes.php';
require __DIR__ . '/tests/models/project.php';

// Admin
require __DIR__ . '/tests/requests/admin/dashboard.php';
require __DIR__ . '/tests/requests/admin/settings.php';
require __DIR__ . '/tests/requests/admin/projects.php';
require __DIR__ . '/tests/requests/admin/project_roles.php';
require __DIR__ . '/tests/requests/admin/users.php';
require __DIR__ . '/tests/requests/admin/groups.php';
require __DIR__ . '/tests/requests/admin/plugins.php';
require __DIR__ . '/tests/requests/admin/types.php';
require __DIR__ . '/tests/requests/admin/statuses.php';
require __DIR__ . '/tests/requests/admin/priorities.php';
require __DIR__ . '/tests/requests/admin/severities.php';
require __DIR__ . '/tests/requests/admin/permissions/usergroups.php';
require __DIR__ . '/tests/requests/admin/permissions/project_roles.php';

// Project Settings
require __DIR__ . '/tests/requests/project_settings/options.php';
require __DIR__ . '/tests/requests/project_settings/milestones.php';
require __DIR__ . '/tests/requests/project_settings/components.php';
require __DIR__ . '/tests/requests/project_settings/custom_fields.php';

// Projects
require __DIR__ . '/tests/requests/projects/roadmap.php';
require __DIR__ . '/tests/requests/projects/listing.php';
require __DIR__ . '/tests/requests/tickets/listing.php';
require __DIR__ . '/tests/requests/tickets/new.php';
require __DIR__ . '/tests/requests/tickets/update.php';
require __DIR__ . '/tests/requests/wiki/main_page.php';
require __DIR__ . '/tests/requests/wiki/pages.php';
require __DIR__ . '/tests/requests/projects/timeline.php';

$testSuite->run();
