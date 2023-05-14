<?php

use kalanis\kw_paths\PathsException;
use kalanis\kw_tree\DataSources\Volume;
use kalanis\kw_tree\Essentials\FileNode;
use PHPUnit\Framework\TestCase;


/**
 * Class CommonTestClass
 * The structure for mocking and configuration seems so complicated, but it's necessary to let it be totally idiot-proof
 */
class CommonTestClass extends TestCase
{
    /**
     * @param callable|null $filterCallback
     * @param bool $recursive
     * @throws PathsException
     * @return FileNode|null
     */
    protected function getTree($filterCallback = null, bool $recursive = true): ?FileNode
    {
        $lib = new Volume(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'tree');
        $lib->wantDeep($recursive);
        if (!is_null($filterCallback)) {
            $lib->setFilterCallback($filterCallback);
        }
        $lib->process();
        return $lib->getRoot();
    }
}
