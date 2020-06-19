<?php

namespace App\Modules;

use \App\Forms\BaseForm;
use \Illuminate\Database\Eloquent\Model;
use \Exception;

class ModelRequestHelper
{
    private $messages;
    private $model;
    private $form;
    private $functionName;
    private $request;

    public function __construct(array $request, BaseForm $form, Model $model, string $functionName)
    {
        $this->model = $model;
        $this->form = $form;
        $this->request = $request;
        $this->functionName = $functionName;
    }

    public function run()
    {
        $function = [$this->model, $this->functionName];

        if ($this->form->verify()) {
            try {
                $success = $this->messages['success'] = $function($this->request);
            } catch (Exception $e) {
                $this->messages['modelError'] = $e->getMessage();
                $this->form->setError($e->getMessage());
            }
        }

        if ($this->form->hasErrors()) {
            $this->messages['errors'] = $this->form->getErrors();
        }

        return $this->messages;
    }
}
