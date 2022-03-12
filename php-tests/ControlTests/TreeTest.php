<?php

namespace ControlTests;


use kalanis\kw_tree_controls\Controls;
use SplFileInfo;


class TreeTest extends \CommonTestClass
{
    public function testTree(): void
    {
        $tree = $this->getTree();
        $this->assertNotEmpty($tree);
    }

    public function testDirRadio(): void
    {
        $lib = new Controls\DirRadio();
        // empty one
        $lib->set('tstDRadio', '', '', null);
        $this->assertEmpty(trim($lib->render()));

        // filled one
        $tree = $this->getTree([$this, 'filterDirs']);
        $lib->set('tstDRadio', '', '', $tree);
        $this->assertNotEmpty(trim($lib->render()));
    }

    public function testFileRadio(): void
    {
        $lib = new Controls\FileRadio();

        $lib->set('tstFRadio', '', '', null);
        $this->assertEmpty(trim($lib->render()));

        $tree = $this->getTree([$this, 'filterFiles'], false);
        $lib->set('tstFRadio', '', '', $tree);
        $this->assertNotEmpty(trim($lib->render()));

        // now check values setter
        $this->assertEmpty($lib->getValue()); // default value, also root
        $lib->setValue('non-existent');
        $this->assertNull($lib->getValue());
        $lib->setValue('dummy1.txt');
        $this->assertEquals('dummy1.txt', $lib->getValue());
        $lib->setValue('other1.txt');
        $this->assertEquals('other1.txt', $lib->getValue());
    }

    public function testDirSelect(): void
    {
        $lib = new Controls\DirSelect();

        $lib->set('tstDSel', '', '', null);
        $this->assertEmpty(trim($lib->render()));

        $tree = $this->getTree([$this, 'filterDirs']);
        $lib->set('tstDSel', '', '', $tree);
        $this->assertNotEmpty(trim($lib->render()));

        // now check value setter
        $this->assertEmpty($lib->getValue());
        $lib->setValue('sub');
        $this->assertEquals('sub', $lib->getValue());
    }

    public function testFileSelect(): void
    {
        $lib = new Controls\FileSelect();

        $lib->set('tstFSel', '', '', null);
        $this->assertEmpty(trim($lib->render()));

        $tree = $this->getTree();
        $lib->set('tstFSel', '', '', $tree);
        $this->assertNotEmpty(trim($lib->render()));
    }

    public function testDirCheckboxes(): void
    {
        $lib = new Controls\DirCheckboxes();

        $lib->set('tstDChk', '', '', null);
        $this->assertEmpty(trim($lib->render()));

        $tree = $this->getTree([$this, 'filterDirs']);
        $lib->set('tstDChk', '', '', $tree);
        $this->assertNotEmpty(trim($lib->render()));
//var_dump($lib->render());
    }

    public function testFileCheckboxes(): void
    {
        $lib = new Controls\FileCheckboxes();

        $lib->set('tstFSel', '', '', null);
        $this->assertEmpty(trim($lib->render()));

        $tree = $this->getTree();
        $lib->set('tstFSel', '', '', $tree);
        $this->assertNotEmpty(trim($lib->render()));

        // now check values setter
        $this->assertEmpty($lib->getValues());
        $lib->setValues(['tstFSel' => ['dummy2.txt']]);
        $this->assertEquals(['dummy2.txt'], $lib->getValues());
        $lib->setValues(['tstFSel' => [
            'other1.txt',
            'other2.txt',
        ]]);
        $vals = $lib->getValues();
        sort($vals); // because it's a little dependent on volume's order
        $this->assertEquals(['other1.txt', 'other2.txt'], $vals);
    }

    public function filterFiles(SplFileInfo $info): bool
    {
        return $info->isFile();
    }

    public function filterDirs(SplFileInfo $info): bool
    {
        return $info->isDir();
    }
}
