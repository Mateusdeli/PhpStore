<?php

namespace App\WebStore\Config;

use App\WebStore\Classes\Database\Database;
use App\WebStore\Controllers\AuthController;
use App\WebStore\Services\AuthServices;
use App\WebStore\Utils\Libs\FormValidator\FormValidator;
use App\WebStore\Utils\Libs\FormValidator\FormValidatorAdapterInterface;
use App\WebStore\Utils\Libs\FormValidator\RakitFormValidator;
use App\WebStore\Utils\Libs\FormValidator\RakitFormValidatorAdapter;
use App\WebStore\Utils\Libs\FormValidator\RespectValidator;
use App\WebStore\Utils\Libs\FormValidator\ValitronFormValidationAdapter;
use DI\Container as DIContainer;
use DI\ContainerBuilder;
use Rakit\Validation\Validator;

use function DI\create;

class Container
{

    public function buildContainer(): DIContainer
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions($this->resolveDependency());
        return $builder->build();
    }

    private function resolveDependency(): array
    {
       return [
            FormValidator::class => 
                create(RakitFormValidatorAdapter::class)
                    ->constructor(new Validator())
       ];
    }

}