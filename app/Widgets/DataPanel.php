<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Services\JsonRpcClient;
use Illuminate\Support\Str;

class DataPanel extends AbstractWidget
{
    protected $client;

    public function __construct(array $config = [])
    {
        $this->client = new JsonRpcClient();
        parent::__construct($config);
    }

    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'page_uid' => null
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data = $this->getDataByPageUid($this->config['page_uid']);

        $params = array_merge(['config' => $this->config], $data);

        return view('widgets.data_panel', $params);
    }

    /**
     * @param string $pageUid
     * @return array
     */
    public function getDataByPageUid(string $pageUid): array
    {
        $responseBody = $this->client->send('data@getByPageUid', ['page_uid' => $this->config['page_uid']]);

        $result = [];

        if (isset($responseBody['result'])) {
            foreach ($responseBody['result'] as $key => $item) {
                if ($item) {
                    $result[Str::camel($key)] = $item;
                }
            }
        }

        return $result;
    }
}
