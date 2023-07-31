<?php

namespace tobycroft\zbuilder;

use think\Service;
use tobycroft\zbuilder\command\Publish;
use tobycroft\zbuilder\util\Resources;

class ZbuilderService extends Service
{
    public function boot()
    {
        Resources::install(false); //检查资源文件

        $this->commands(['zbuilder:publish' => Publish::class]);
    }
}
