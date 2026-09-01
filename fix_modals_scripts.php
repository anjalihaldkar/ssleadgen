<?php

$map = [
    "index.html" => "pages/dashboard/index.blade.php",
    "dashboard.html" => "pages/dashboard/dashboard.blade.php",
    "analytics.html" => "pages/dashboard/analytics.blade.php",
    "login.html" => "pages/auth/login.blade.php",
    "forgot-password.html" => "pages/auth/forgot-password.blade.php",
    "reset-password.html" => "pages/auth/reset-password.blade.php",
    "clients-login.html" => "pages/auth/clients-login.blade.php",
    "crm-leads-pipeline.html" => "pages/crm/pipeline.blade.php",
    "crm-leads-create.html" => "pages/crm/create.blade.php",
    "reports-leads.html" => "pages/crm/reports.blade.php",
    "clients.html" => "pages/clients/index.blade.php",
    "clients-inforce.html" => "pages/clients/inforce.blade.php",
    "clients-inactive.html" => "pages/clients/inactive.blade.php",
    "clients-cancellation.html" => "pages/clients/cancellation.blade.php",
    "clients-npw-deferred.html" => "pages/clients/npw-deferred.blade.php",
    "policies.html" => "pages/policies/index.blade.php",
    "claims.html" => "pages/policies/claims.blade.php",
    "calendar.html" => "pages/utilities/calendar.blade.php",
    "tasks.html" => "pages/utilities/tasks.blade.php",
    "documents.html" => "pages/utilities/documents.blade.php",
    "communications.html" => "pages/utilities/communications.blade.php",
    "users.html" => "pages/settings/users.blade.php",
    "access.html" => "pages/settings/access.blade.php",
    "commissions.html" => "pages/settings/commissions.blade.php",
    "settings-sources.html" => "pages/settings/sources.blade.php",
];

$global_scripts = [
    "assets/vendors/js/vendors.min.js",
    "assets/vendors/js/nxlNavigation.min.js",
    "https://cdn.jsdelivr.net/npm/flatpickr",
    "https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js",
    "https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js",
    "https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js",
    "https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js",
    "assets/vendors/js/apexcharts.min.js",
    "https://cdn.jsdelivr.net/npm/apexcharts",
    "assets/js/common-init.min.js",
    "assets/js/script.js",
    "assets/js/script.js?v=1.3",
];

foreach ($map as $htmlFile => $bladeFile) {
    $htmlPath = __DIR__ . '/_template_backup/' . $htmlFile;
    $bladePath = __DIR__ . '/resources/views/' . $bladeFile;

    if (!file_exists($htmlPath)) {
        echo "Missing HTML: $htmlPath\n";
        continue;
    }
    if (!file_exists($bladePath)) {
        echo "Missing Blade: $bladePath\n";
        continue;
    }

    $htmlContent = file_get_contents($htmlPath);
    $bladeContent = file_get_contents($bladePath);

    // Skip if already processed (check if it already has @push('scripts') maybe)
    // Wait, some blades like index might already have it manually.
    // Let's remove existing @push('scripts') blocks to be safe and re-apply cleanly.
    $bladeContent = preg_replace("/@push\('scripts'\).*?@endpush\s*/s", "", $bladeContent);

    // Extract everything after </main> and before </body>
    if (preg_match("/<\/main>(.*?)<\/body>/s", $htmlContent, $matches)) {
        $bottomPart = $matches[1];
        
        // Find modals: anything that looks like a modal.
        // We'll just take the whole bottom part, strip the scripts, and strip the global modals.
        $modalsPart = preg_replace("/<script.*?<\/script>/s", "", $bottomPart);
        $modalsPart = preg_replace("/<!-- JavaScript Vendor & Init Files -->/s", "", $modalsPart);
        $modalsPart = preg_replace("/<!-- Scripts -->/s", "", $modalsPart);
        
        // Remove global modals (Reset Password and Logout)
        $modalsPart = preg_replace("/<!-- Modal: Reset Password -->.*?<\/div>\s*<\/div>\s*<\/div>/s", "", $modalsPart);
        $modalsPart = preg_replace("/<!-- Modal: Logout Confirmation -->.*?<\/div>\s*<\/div>\s*<\/div>/s", "", $modalsPart);

        // Find scripts
        preg_match_all("/<script src=\"([^\"]+)\"><\/script>/", $bottomPart, $scriptMatches);
        $pageScripts = [];
        if (!empty($scriptMatches[1])) {
            foreach ($scriptMatches[1] as $scriptSrc) {
                if (!in_array($scriptSrc, $global_scripts)) {
                    $pageScripts[] = '<script src="{{ asset(\'' . $scriptSrc . '\') }}"></script>';
                }
            }
        }

        // Prepare the new content to insert before @endsection
        $insertion = "\n\n" . trim($modalsPart) . "\n\n";
        if (!empty($pageScripts)) {
            $insertion .= "@push('scripts')\n    " . implode("\n    ", $pageScripts) . "\n@endpush\n";
        }

        // Insert before @endsection
        if (strpos($bladeContent, '@endsection') !== false) {
            $bladeContent = str_replace('@endsection', $insertion . "\n@endsection", $bladeContent);
            file_put_contents($bladePath, $bladeContent);
            echo "Updated: $bladeFile\n";
        } else {
            echo "Could not find @endsection in $bladeFile\n";
        }
    } else {
        echo "Could not find </main>...</body> in $htmlFile\n";
    }
}
echo "Done.\n";
