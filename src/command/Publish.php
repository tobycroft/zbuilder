<?php

namespace tobycroft\zbuilder\command;

use tobycroft\zbuilder\util\Resources;
use think\console\Command;
use think\console\Input;
use think\console\Output;

/**
 * 发布配置文件、迁移文件指令
 */
class Publish extends Command
{
    /**
     * 配置指令
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('zbuilder:publish')->setDescription('Publish bingher zbuilder');
    }

    /**
     * 执行指令
     *
     * @param Input  $input  输入对象
     * @param Output $output 输出对象
     *
     * @return null|int
     * @throws LogicException
     */
    protected function execute(Input $input, Output $output)
    {
        /* 复制静态资源文件 */
        Resources::install(true);
        $output->writeln('静态资源复制完成');
    }
}
