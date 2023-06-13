<?php

namespace ControlTests;


use kalanis\kw_forms\Controls as RootControls;
use kalanis\kw_forms\Exceptions\RenderException;
use kalanis\kw_paths\PathsException;
use kalanis\kw_tree\Essentials\FileNode;
use kalanis\kw_tree\Traits\TVolumeDirs;
use kalanis\kw_tree\Traits\TVolumeFile;
use kalanis\kw_tree_controls\ControlNode;
use kalanis\kw_tree_controls\Controls;


class TreeTest extends \CommonTestClass
{
    use TVolumeFile;
    use TVolumeDirs;

    /**
     * @throws PathsException
     */
    public function testTree(): void
    {
        $tree = $this->getTree();
        $this->assertNotEmpty($tree);
    }

    /**
     * @throws PathsException
     * @throws RenderException
     */
    public function testDirRadio(): void
    {
        $lib = new Controls\DirRadio();
        // empty one
        $lib->set('tstDRadio', '', '', null);
        $this->assertEmpty(trim($lib->render()));

        // filled one
        $tree = $this->getTree([$this, 'justDirsCallback']);
        $lib->set('tstDRadio', '', '', $tree);
        $this->assertNotEmpty(trim($lib->render()));

        $lib->set('tstDRadio', '', '', $tree, false);
        $this->assertNotEmpty(trim($lib->render()));
    }

    /**
     * @throws PathsException
     * @throws RenderException
     */
    public function testFileRadio(): void
    {
        $lib = new Controls\FileRadio();

        $lib->set('tstFRadio', '', '', null);
        $this->assertEmpty(trim($lib->render()));

        $tree = $this->getTree([$this, 'justFilesCallback'], false);
        $lib->set('tstFRadio', '', '', $tree);
        $this->assertNotEmpty(trim($lib->render()));

        $lib->set('tstFRadio', '', '', $tree, false);
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

    /**
     * @throws PathsException
     * @throws RenderException
     */
    public function testDirSelect(): void
    {
        $lib = new Controls\DirSelect();

        $lib->set('tstDSel', '', '', null);
        $this->assertEmpty(trim($lib->render()));

        $tree = $this->getTree([$this, 'justDirsCallback']);
        $lib->set('tstDSel', '', '', $tree);
        $this->assertNotEmpty(trim($lib->render()));

        $lib->set('tstDSel', '', '', $tree, false);
        $this->assertNotEmpty(trim($lib->render()));

        // now check value setter
        $this->assertEmpty($lib->getValue());
        $lib->setValue('sub');
        $this->assertEquals('sub', $lib->getValue());
    }

    /**
     * @throws PathsException
     * @throws RenderException
     */
    public function testFileSelect(): void
    {
        $lib = new Controls\FileSelect();

        $lib->set('tstFSel', '', '', null);
        $this->assertEmpty(trim($lib->render()));

        $tree = $this->getTree();
        $lib->set('tstFSel', '', '', $tree);
        $this->assertNotEmpty(trim($lib->render()));

        $lib->set('tstFSel', '', '', $tree, false);
        $this->assertNotEmpty(trim($lib->render()));
    }

    /**
     * @throws PathsException
     * @throws RenderException
     */
    public function testDirCheckboxes(): void
    {
        $lib = new Controls\DirCheckboxes();

        $lib->set('tstDChk', '', '', null);
        $this->assertEmpty(trim($lib->render()));

        $tree = $this->getTree([$this, 'justDirsCallback']);
        $lib->set('tstDChk', '', '', $tree);
        $this->assertNotEmpty(trim($lib->render()));

        $lib->set('tstDChk', '', '', $tree, false);
        $this->assertNotEmpty(trim($lib->render()));
//var_dump($lib->render());
    }

    /**
     * @throws PathsException
     * @throws RenderException
     */
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

        $lib->set('tstFSel', '', '', $tree, false);
        $this->assertNotEmpty(trim($lib->render()));
    }

    public function testNaming(): void
    {
        $lib = new XTreeControl();

        $lib->set('tsNmg', 'ijn', 'rfv', null);

        $this->assertEquals('', $lib->testingName(null));
        $this->assertEquals('/', $lib->testingPath(null));

        $node = new FileNode();
        $node->setData(['ertz', 'dfgh', 'cvbn'], 2, 'char', false, false);

        $this->assertEquals('cvbn', $lib->testingName($node));
        $this->assertEquals('ertz/dfgh/cvbn', $lib->testingPath($node));
    }

    /**
     * @throws RenderException
     */
    public function testEmptyControl(): void
    {
        $lib = new Controls\EmptyControl();

        $lib->set('tsNmg', 'ijn', 'rfv');
        $lib->setValue('ijnhubzgv');
        $this->assertNull($lib->getValue());
        $this->assertEquals('<label for="tsNmg">rfv</label>  ', $lib->render());
    }
}


class XTreeControl extends Controls\ATreeControl
{
    public function testingPath(?FileNode $node): string
    {
        return $this->stringPath($node);
    }

    public function testingName(?FileNode $node): string
    {
        return $this->stringName($node);
    }

    protected function getInput(FileNode $node): RootControls\AControl
    {
        $input = new RootControls\Hidden();
        $input->set($this->getKey(), $this->stringPath($node));
        $this->inputs[] = $input;
        return $input;
    }

    protected function renderTree(?ControlNode $baseNode): string
    {
        return '';
    }
}
