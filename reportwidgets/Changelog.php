<?php namespace Feegleweb\Changelog\ReportWidgets;

use GuzzleHttp\Client;
use October\Rain\Support\Markdown; // Beta
// use Markdown; // RC
use Backend\Classes\ReportWidgetBase;

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
        $uri = 'https://raw.githubusercontent.com/octobercms/october/master/CHANGELOG.md';

        $client = new Client();
        $response = $client->get($uri);

        $this->vars['changes'] = Markdown::parse($response->getBody());
    }
}
