---
layout: default
---
#### Available Methods
| Methods | Class | Description |
|--|--|--|
| generate(number, language) | SpellNumber | Spelling number into another language. Available language: id (Indonesian: default),en (English)|
| onCoordinateRadius(needle, haystack) | Map | To determine the coordinates are within a predetermined radius in meter using **Haversine formula**|

##### Example

###### SpellNumber::generate()

Spelling number 225000

```
use Btx\Common\SpellNumber;
use Btx\Http\Response;

class UserController {

    /** function to spelling a number */
    ...
        $number = 225000;
        $spell = SpellNumber::generate($number);
        //$spell must be : "Dua Ratus Dua Puluh Lima Ribu"
        Response::ok('Uploaded',$spell)
    ...
}

```

###### Map::inCoordinateRadius()
If you want to search <code>-6.248390079516094, 106.78650109830369</code> is in radius <code>-6.248269838250153, 106.7853721399023</code> with distance 50 meter.

```
use Btx\Common\Map;
use Btx\Http\Response;

class UserController {

    /** function to coordinate is in radius */
    ...
        $centerPoint = [-6.248269838250153, 106.7853721399023];
        $point = [
          'radius' => 50, 
          'lat' => -6.248390079516094, 
          'lng' => 106.78650109830369
        ];
        $inRadius = Map::inCoordinateRadius($centerPoint,$point);
        Response::ok('Is on Radius Center Point?.',$onRadius)
    ...
}

```