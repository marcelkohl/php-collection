[![Maintenance](https://img.shields.io/badge/Maintained%3F-no-red.svg)](#)
[![GPLv3 license](https://img.shields.io/badge/License-Apache-purple.svg)](https://opensource.org/license/apache-2-0/)
[![Ask Me Anything !](https://img.shields.io/badge/Ask%20me-anything-1abc9c.svg)](https://github.com/marcelkohl)

# php-collection
This is a PHP collection implementation.

## Why collections instead of arrays?
Collections and arrays are similar in that they both hold references to objects and they can be managed as a group.

The advantage in using collections is that the objects in a collection can represent specific structures (classes/interfaces) instead of having an array where developers have to **guess** what is inside.

### Example
```PHP
public function getAllCats(AnimalCollection $animals):CatCollection
{
  /** ... **/
}
```
## About the implementation
This implementation covers the interfaces [Countable](https://www.php.net/manual/en/class.countable.php), [Iterator](https://www.php.net/manual/en/class.iterator.php) and [ArrayAccess](https://www.php.net/manual/en/class.arrayaccess.php).
