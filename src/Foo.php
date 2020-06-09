<?php

declare(strict_types=1);

namespace DotEnvNotEmpty;

use Dotenv\Dotenv;
use Dotenv\Repository\RepositoryBuilder;

class Foo
{
    private $repository;

    public function __construct()
    {
        $this->repository = RepositoryBuilder::createWithDefaultAdapters()
            ->allowList([
                'NO_SUCH_VARIABLE',
                'EMPTY',
                'EMPTY_STRING',
            ])
            ->make();
    }

    public function assertVariablesNotEmpty(): void
    {
        $dotenv = Dotenv::create($this->repository, __DIR__ . '/..');
        $dotenv->load();

        $dotenv->required([
            'NO_SUCH_VARIABLE',
            'EMPTY',
            'EMPTY_STRING',
        ])->notEmpty();
    }
}
