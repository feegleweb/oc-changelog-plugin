<?php namespace Feegleweb\Changelog;

use System\Classes\PluginBase;

/**
 * Changelog Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Changelog',
            'description' => 'Adds a report widget to show the October CMS changelog on the dashboard.',
            'author'      => 'Dave Shoreman',
            'icon'        => 'icon-list-alt',
            'homepage'    => 'https://github.com/feegleweb/oc-changelog-plugin'
        ];
    }

    public function registerReportWidgets()
    {
        return [
            'Feegleweb\Changelog\ReportWidgets\Changelog' => [
                'label'   => 'System changes',
                'context' => 'dashboard',
            ],
        ];
    }
}
