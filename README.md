# QLib

QLib is aimed to help fullstack developers to have a unified interface while developing projects with 2 or more languages involved. With the help of QLib, fullstack developers will no longer be aware of the different method names and argument orders for the "same" function in different languages such as *array_slice(arr, start, length)* in **PHP** and *Array.prototype.slice(start, end)* in **Javascript**.

**Note**: This library will involve some overhead of extra function calls or object creations normally. So use it carefully in performace-sensitive places. 

## Languages and Naming Conventions

### PHP
For **PHP** QLib uses class static methods to provide the set of interfaces. For example, the code using native php function like:

	$arr = [1, 2, 3, 4, 5];
	$newArr = array_slice($arr, 0, 3);
	
will be like:

	$arr = [1, 2, 3, 4, 5];
	$newArr = QArray::slice($arr, 0, 3);
	
Note that all parameters and return values are php native data types. Some frequently used type mappings are shown in the following table. 

| PHP native type | QLib corresponding class |
|:---------------:|:------------------------:|
| string          | QString                  |
| array(non assoc)| QArray                   |
| array(assoc)    | QObject                  |

Note that though in PHP, sequential array and associative array are the same type, they do have much different behaivors. So in QLib they are classified in QArray and QObject respectively. Also, consistent with other languages is another concern.


### Javascript
For **Javascript** QLib use prototype way to provide the interfaces. For each interface, QLib uses a *q_* prefix with the interface name to naming the methods. For example, to use *slice* method in QLib, you may need to write code like:

	var slicedArr = [1, 2, 3, 4, 5].q_slice(2, 4);
	  

## Interfaces

### String
interface signature | interface outline
:---------------:|:------------------------:
size(void):int | Get string length
empty(void):bool | Check if empty
trim(option):string | Remove leading or trailing blanks
split(seperator):array | Split a string into an array
contains(substr, ignoreCase):bool | Check if has the substr
indexOf(substr, direction):int | Find the index of the first matched substr
slice(start, end):string | Create a substring
concat(string):string | Append another string
splice(start, count, replace):void | Insert/Remove elements at custom index

	
### Array
interface signature | interface outline
:---------------:|:------------------------:
size(void):int | Get array element counts
empty(void):bool | Check if empty
contains(element):bool | Check if element is contained in array
indexOf(element, direction):int | Find the index of the first match element
slice(start, end):array | Create a slice of an array
concat(array):array | Append another array
push(element):void | Insert a new element from end
pop(void) | Pop up the last element 
shift(void) | Remove the zero-indexed element 
unshift(element):void | Insert a new element at zero-index
splice(start, count, replace):void | Insert/Remove elements at custom index
reverse(void):array | Return a reverse ordered array
join(seperator):string | Join the elements


### Assoc Array
interface signature | interface outline
:---------------:|:------------------------:
size(void):int | Get element counts
empty(void):bool | Check if empty

### Date & Time, Calendar

### Regular Expression

