<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Services\JsonRpcClient;

class DataController extends Controller
{
    protected $client;

    public function __construct(JsonRpcClient $client)
    {
        $this->client = $client;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'page_uid' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
        ]);

        $all = $request->all();
        $data = $this->client->send('data@saveByPageUid', $request->all());

        if (isset($data['error'])) {
            return Redirect::back()->withErrors($data['error']);
        }

        return Redirect::back();
    }
}
