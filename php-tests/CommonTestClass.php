<?php

use kalanis\kw_paths\Path;
use kalanis\kw_tree\DataSources\Volume;
use kalanis\kw_tree\Essentials\FileNode;
use kalanis\kw_tree\Tree;
use PHPUnit\Framework\TestCase;


/**
 * Class CommonTestClass
 * The structure for mocking and configuration seems so complicated, but it's necessary to let it be totally idiot-proof
 */
class CommonTestClass extends TestCase
{
    protected function getTree($filterCallback = null, bool $recursive = true): ?FileNode
    {
        $paths = new Path();
        $paths->setDocumentRoot(__DIR__ . '/data'); // system root - where are all files
        $paths->setPathToSystemRoot('/tree');
        $lib = new Tree(new Volume($paths));
        $lib->canRecursive($recursive);
        $lib->startFromPath('/');
        if (!is_null($filterCallback)) {
            $lib->setFilterCallback($filterCallback);
        }
        $lib->process();
        return $lib->getTree();
    }
}
