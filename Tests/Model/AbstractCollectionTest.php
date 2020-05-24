<?php

namespace App\Tests\Model;

use App\Model\AbstractCollection;
use PHPUnit\Framework\TestCase;

class AbstractCollectionTest extends TestCase
{
    public function testCount()
    {
        $collection = $this->createConcreteCollection(["foo", "bar", "baz"]);

        $this->assertEquals(3, $collection->count(), "count MUST be equal collectionInput count");
    }

    /**
     * @covers AbstractCollection::rewind
     */
    public function testRewind()
    {
        $collection = $this->createConcreteCollection(["foo", "bar", "baz"]);

        // return value on initial cursor
        $initialElement = $collection->current();
        // increase cursor position
        $collection->next();
        // reset cursor position
        $collection->rewind();

        $this->assertEquals($initialElement, $collection->current(), "Element MUST be equal initialElement");
    }

    /**
     * @covers AbstractCollection::key
     * @covers AbstractCollection::next
     */
    public function testKeyAndNext()
    {
        $collection = $this->createConcreteCollection(["foo", "bar", "baz"]);

        $this->assertEquals(0, $collection->key(), "key MUST be 0");

        $collection->next();
        $this->assertEquals(1, $collection->key(), "key MUST be 1");

        $collection->next();
        $this->assertEquals(2, $collection->key(), "key MUST be 2");

        $collection->next();
        $this->assertEquals(3, $collection->key(), "key MUST be 3");
    }

    /**
     * @covers AbstractCollection::current
     */
    public function testGetCurrent()
    {
        $collection = $this->createConcreteCollection(["foo", "bar", "baz"]);

        $this->assertEquals("foo", $collection->current(), "current MUST be equal foo");

        $collection->next();
        $this->assertEquals("bar", $collection->current(), "current MUST be equal bar");

        $collection->next();
        $this->assertEquals("baz", $collection->current(), "current MUST be equal baz");

        $collection->next();
        $this->assertNull($collection->current(), "current MUST be equal null");
    }

    /**
     * @covers AbstractCollection::valid
     */
    public function testValid()
    {
        $collection = $this->createConcreteCollection([]);
        $this->assertFalse($collection->valid(), "empty collection MUST be invalid");

        $collection = $this->createConcreteCollection(["a", "b", "c"]);
        $this->assertTrue($collection->valid(), "collection [\"a\", \"b\", \"c\"] MUST be valid");
    }

    /**
     * @covers AbstractCollection::offsetExists
     */
    public function testOffsetExists()
    {
        $collection = $this->createConcreteCollection(["foo", "bar", "baz"]);

        $this->assertTrue($collection->offsetExists(0), "offset 0 MUST exist");

        $this->assertFalse($collection->offsetExists(3), "offset 3 MUST NOT exist");
    }

    /**
     * @covers AbstractCollection::offsetGet
     */
    public function testOffsetGet()
    {
        $collection = $this->createConcreteCollection(["foo", "bar", "baz"]);

        $this->assertEquals("foo", $collection->offsetGet(0), "element MUST exist be foo");

        $this->assertNull($collection->offsetGet(30), "element MUST be null");
    }

    /**
     * @covers AbstractCollection::offsetSet
     */
    public function testOffsetSet()
    {
        $collection = $this->createConcreteCollection();

        $collection->offsetSet("foo", "bar");

        $this->assertEquals("bar", $collection->offsetGet("foo"), "element MUST exist be bar");
    }

    /**
     * @covers AbstractCollection::offsetUnset
     */
    public function testOffsetSetUnset()
    {
        $collection = $this->createConcreteCollection(["foo"]);

        $collection->offsetUnset(0);

        $this->assertNull($collection->offsetGet("foo"), "element MUST be null");
    }

    public function testArrayHasKey()
    {
        $collection = $this->createConcreteCollection();
        $collection["foo"] = new \stdClass();

        $this->assertArrayHasKey("foo", $collection, "collection MUST have key foo");
        $this->assertArrayNotHasKey("bar", $collection, "collection MUST NOT have key bar");
    }

    private function createConcreteCollection(array $collectionInput = []): AbstractCollection
    {
        $abstractCollection = $this->getMockForAbstractClass(AbstractCollection::class);

        return new $abstractCollection($collectionInput);
    }
}
