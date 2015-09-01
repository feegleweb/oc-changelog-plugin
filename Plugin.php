<?php namespace Feegleweb\Changelog;

use System\Classes\PluginBase;

/**
 * Changelog Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'feegleweb.changelog::lang.plugin.name',
            'description' => 'feegleweb.changelog::lang.plugin.description',
            'author'      => 'Dave Shoreman',
            'icon'        => 'icon-list-alt',
            'homepage'    => 'https://github.com/feegleweb/oc-changelog-plugin',
        ];
    }

    public function registerReportWidgets()
    {
        return [
            'Feegleweb\Changelog\ReportWidgets\Changelog' => [
                'label'   => 'feegleweb.changelog::lang.log.widget_title',
                'context' => 'dashboard',
            ],
        ];
    }
}
