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
