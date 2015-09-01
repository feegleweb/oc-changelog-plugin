<?php

return [
    'plugin' => [
        'name'               => "Changelog",
        'description'        => "Adds a report widget to show the October CMS changelog on the dashboard.",
    ],
    'app' => [
        'permission_error'   => "You don't have permission to manage updates",
    ],
    'log' => [
        'widget_title'       => "System changes",
        'load_error'         => "Could not load changelog from %s",
        'slice_error'        => "Unable to slice changelog, build %s not found.",
    ],
    'recentLogs' => [
        'label'              => "Recent logs",
        'description'        => "When the system is up to date, this sets how many recent logs are displayed.",
        'validation_message' => "Recent logs must be a positive number",
    ],
];
