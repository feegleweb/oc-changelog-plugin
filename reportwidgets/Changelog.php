<?php namespace Feegleweb\Changelog\ReportWidgets;

use GuzzleHttp\Client;
use Markdown;
use Backend\Classes\ReportWidgetBase;
use System\Models\Parameters;

class Changelog extends ReportWidgetBase
{

    public function render()
    {
        try {
            $this->loadData();
        } catch (Exception $e) {
            $this->vars['error'] = $e->getMessage();
        }

        return $this->makePartial('widget');
    }

    public function defineProperties()
    {
        return [
            'title' => [
                'title'             => 'backend::lang.dashboard.widget_title_label',
                'default'           => 'System changes',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'backend::lang.dashboard.widget_title_error',
            ],
        ];
    }

    public function loadData()
    {
        $this->checkPermissions();
        $this->loadBuildNum();
        $this->loadChangelog();

        $this->vars['current'] = $this->build;
        $this->vars['behind'] = $this->countBuildsBehind();

        $this->vars['detail'] = Markdown::parse($this->changelog);
    }

    protected function checkPermissions()
    {
        if ($this->controller->user->hasAccess('system.manage_updates')) {
            return;
        }

        throw new Exception("You don't have permission to manage updates");
    }

    protected function loadBuildNum()
    {
        $this->build = Parameters::get('system::core.build');
    }

    protected function countBuildsBehind()
    {
        return substr_count($this->changelog, '* **Build ');
    }

    protected function loadChangelog()
    {
        $uri = 'https://raw.githubusercontent.com/octobercms/october/master/CHANGELOG.md';

        $response = (new Client())->get($uri);

        $this->changelog = $this->slice($response->getBody());
    }

    protected function slice($data)
    {
        $build = $this->build;
        $foundBuild = false;

        // Build 64 was the first public release, so don't go past it
        while (!$foundBuild && $build >= 64) {
            $pos = strpos($data, "* **Build {$build}**");

            $pos === false ? $build-- : $foundBuild = true;
        }

        if (!$foundBuild) {
            throw new Exception("Unable to slice changelog, build {$this->build} not found.");
        }

        return substr($data, 0, $pos);
    }
}
