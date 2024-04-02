<?php

namespace ControlTests;


use kalanis\kw_forms\Exceptions\FormsException;
use kalanis\kw_input\Inputs;
use kalanis\kw_input\Interfaces\IFiltered;
use kalanis\kw_input\Sources\Basic;
use kalanis\kw_input\Filtered;
use kalanis\kw_tree_controls\TWhereDir;


class WhereTest extends \CommonTestClass
{
    public function testSubNodes(): void
    {
        $lib = new WhereDir();
        // nothing set, nothing get
        $lib->initWhereDir(new \ArrayObject(), null);
        $this->assertEquals('', $lib->getWhereDir());

        // from init - load data from system basics
        $source = new Basic();
        $source->setExternal([
            'dir' => 'qaywsxedc/rfv/tgbznh',
        ]);
        $inputs = new Inputs();
        $inputs->setSource($source);
        $inputs->loadEntries();

        // now check externally
        $lib->initWhereDir(new \ArrayObject(), new Filtered\Variables($inputs));
        $this->assertEquals('qaywsxedc/rfv/tgbznh', $lib->getWhereDir());

        // own values
        $lib->updateWhereDir('ijnuhb/zgvftc');
        $this->assertEquals('ijnuhb/zgvftc', $lib->getWhereDir());
    }

    public function testNoStore(): void
    {
        $lib = new WhereDir();
        // no init here!
        $this->expectException(FormsException::class);
        $lib->xStoreWhere();
    }

    public function testNoFilter(): void
    {
        $lib = new WhereDir();
        // no init here!
        $this->expectException(FormsException::class);
        $lib->xFilteredSource();
    }
}


class WhereDir
{
    use TWhereDir;

    /**
     * @throws FormsException
     * @return \ArrayAccess
     */
    public function xStoreWhere(): \ArrayAccess
    {
        return $this->getStoreWhere();
    }

    /**
     * @throws FormsException
     * @return IFiltered
     */
    public function xFilteredSource(): IFiltered
    {
        return $this->getFilteredSource();
    }
}
