<?php
declare(strict_types = 1);

namespace App\Model;

abstract class AbstractCollection implements \Countable, \Iterator, \ArrayAccess
{
    private $indexes = [];
    private $values = [];
    private $position = 0;

    /**
     * This constructor is here in order to be able to create a collection with its values already added
     * @param array $values
     */
    public function __construct(array $values = [])
    {
        foreach ($values as $key=>$value) {
            $this->offsetSet($key, $value);
        }
    }

    /**
     * Implementation of method declared in \Countable.
     * Provides support for count()
     */
    public function count():int
    {
        return count($this->values);
    }

    /**
     * Implementation of method declared in \Iterator
     * Resets the internal cursor to the beginning of the array
     */
    public function rewind():void
    {
        $this->position = 0;
    }

    /**
     * Implementation of method declared in \Iterator
     * Used to get the current key (as for instance in a foreach() structure
     * @return mixed
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Implementation of method declared in \Iterator
     * Used to get the value at the current cursor position
     * @return mixed
     */
    public function current()
    {
        return isset($this->indexes[$this->position]) ? $this->values[$this->indexes[$this->position]] : null;
    }

    /**
     * Implementation of method declared in \Iterator
     * Used to move the cursor to the next position
     */
    public function next():void
    {
        $this->position++;
    }

    /**
     * Implementation of method declared in \Iterator
     * Checks if the current cursor position is valid
     */
    public function valid():bool
    {
        return isset($this->indexes[$this->position]) && isset($this->values[$this->indexes[$this->position]]);
    }

    /**
     * Implementation of method declared in \ArrayAccess
     * Used to be able to use functions like isset()
     * @param mixed $offset
     */
    public function offsetExists($offset):bool
    {
        return isset($this->values[$offset]);
    }

    /**
     * Implementation of method declared in \ArrayAccess
     * Used for direct access array-like ($collection[$offset]);
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->values[$offset] : null;
    }

    /**
     * Implementation of method declared in \ArrayAccess
     * Used for direct setting of values
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if (empty($offset)) {
            $this->values[] = $value;
            $this->indexes[] = count($this->values) - 1;
        } else {
            $this->values[$offset] = $value;
            $key = array_search($offset, array_keys($this->values), true);
            $this->indexes[$key] = $offset;
        }
    }

    /**
     * Implementation of method declared in \ArrayAccess
     * Used for unset()
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->values[$offset]);
    }

    public function asArray():array
    {
        return $this->values;
    }
}
