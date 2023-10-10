<?php

namespace App\Updater;

use App\Updater\Result\ResultFactoryInterface;

abstract class AbstractUpdater implements UpdaterInterface
{
    public function __construct(protected ResultFactoryInterface $resultFactory)
    {
    }
}
