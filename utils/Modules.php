<?php
/**
 * UFO Framework.
 * 
 * @copyright   Copyright (C) 2018 - 2019 Enikeishik <enikeishik@gmail.com>. All rights reserved.
 * @author      Enikeishik <enikeishik@gmail.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Utils;

use Ufo\Core\Config;
use Ufo\Core\Db;
use Ufo\Core\DbConnectException;
use Ufo\Core\DbQueryException;

class Modules
{
    /**
     * @var string
     */
    public const STORAGE = '/data/modules.php';
    
    /**
     * @var string
     */
    protected $storage = '';
    
    /**
     * Constructor.
     * @param string $rootPath
     */
    public function __construct(string $rootPath)
    {
        $this->storage = $rootPath . static::STORAGE;
    }
    
    /**
     * @param array $package
     * @return void
     * @throws \Utils\FilesystemException
     */
    public function loadModuleData(array $package)
    {
        $mspCls = $this->getModuleServiseProviderName($package);

        $modules = @include $this->storage;
        if (!is_array($modules)) {
            $modules = [];
        }

        if (!in_array($mspCls, $modules) && class_exists($mspCls)) {
            $modules[] = $mspCls;
            if (false === @file_put_contents($this->storage, $this->getModulesStorageCode($modules))) {
                throw new FilesystemException('Call file_put_contents(' . $this->storage . ', ...) failed');
            }
        }
    }

    /**
     * @param array $package
     * @return void
     * @throws \Utils\FilesystemException
     */
    public function loadModuleTemplates(array $package, bool $overwrite): void
    {
        $src = __DIR__ . '/vendor/' . $package[0] . '/' . $package[1] . '/resources/templates';
        $trg = __DIR__ . '/resources/templates/default/' . $package[0] . '/' . $package[1];

        if (file_exists($src) && (!file_exists($trg) || $overwrite)) {
            Filesystem::xcopy($src, $trg);
        }
    }

    /**
     * @param array $package
     * @return void
     * @throws \Ufo\Core\ConfigEmptyException
     * @throws \Ufo\Core\DbConnectException
     * @throws \Ufo\Core\DbQueryException
     */
    public function loadModuleDump(array $package): void
    {
        $mspCls = $this->getModuleServiseProviderName($package);
        if (!class_exists($mspCls)) {
            return;
        }
        
        $msp = new $mspCls();
        
        $sqlDump = $msp->getSqlDump();
        if (null === $sqlDump) {
            return;
        }
        
        $config = new Config();
        $config->loadFromIni(__DIR__ . '/.config', true);
        if (empty($config->dbServer) || empty ($config->dbUser)) {
            throw new ConfigEmptyException();
        }
        
        $db = Db::getInstance($config);
        
        $sqls = explode(';', $sqlDump);
        $result = true;
        foreach ($sqls as $sql) {
            if ('' != trim($sql) && !$db->query($sql)) {
                $db->close();
                throw new DbQueryException($db->error, $db->errno);
            }
        }
        
        $db->close();
    }
    
    /**
     * @param array $modules
     * @return string
     */
    protected function getModulesStorageCode(array $modules): string
    {
        if (0 == count($modules)) {
            return '<?php' . PHP_EOL . 'return [' . PHP_EOL . '];' . PHP_EOL;
        }
        
        return '<?php' . PHP_EOL . 
            'return [' . PHP_EOL . 
            '    \\' . implode('::class,' . PHP_EOL . '    \\', $modules) . '::class,' . PHP_EOL . 
            '];' . PHP_EOL;
    }

    /**
     * @param array $package
     * @return string
     */
    protected function getModuleServiseProviderName(array $package): string
    {
        return 'Ufo\Modules\\' . 
            ucfirst($package[0]) . '\\' . ucfirst($package[1]) . 
            '\\ServiceProvider';
    }
}
