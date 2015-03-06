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
            'description' => 'No description provided yet...',
            'author'      => 'Feegleweb',
            'icon'        => 'icon-leaf'
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
