<?php

namespace App\Controller;

use \App\Core\Controller;
use \App\Core\ResponseAdapter;
use \App\Forms\SubscribeForm;
use \App\Models\Subscribe;
use \App\Modules\ModelRequestHelper;

class SubscribeController extends Controller
{
    public function add(array $request)
    {
        $success = '';
        $messages = [];
        $subscribe = new Subscribe();
        $form = new SubscribeForm($request, $subscribe::VALIDATE);

        $messages = (new ModelRequestHelper($request, $form, $subscribe, 'add'))->run();

        return (new ResponseAdapter($messages))->json();
    }
}
