<?php

namespace Plugin\Management42;

use Eccube\Plugin\AbstractPluginManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PluginManager extends AbstractPluginManager
{

    // インストール時
    public function install(array $meta, ContainerInterface $container)
    {
    }

    // 有効化時
    public function enable(array $meta, ContainerInterface $container)
    {

        // ここで初期データを投入すれば良い
    }

    /**
     * アンイストール時
     */
    public function uninstall(array $meta, ContainerInterface $container)
    {
        // バックアップを取るとかできると良いかも？
    }
}