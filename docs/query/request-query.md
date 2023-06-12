---
layout: default
---
### Btx/Query
Now API parameters can be used with the REST API to filter, sort, paginate results, select fields and filtering relation up to 3 deep relationships. Additionally, specific parameters related to optional features can be used.

> NOTE: Only work with SQL database like MySQL, SQLServer, PostgreSQL, SQLite, MariaDB

#### Support Query Filter
| Query | Required | Description | Example|
|--|--|--|--|
| _limit | required | limit data result | _limit: 10|
| _page | required | retrieve data page-n | _page: 1|
| _sort:[column]:[sort type] | optional | sorting data by column| _sort: id:desc or _sort: id:asc|
| [column]_is | optional | get data where column value is [value] |id_is: 5|
| [column]_contain | optional | get data where column value contain [value] |username_contain: admin|
| [column]_gte | optional | get data where column value greater than or equal with [value] |age_gte: 25|
| [column]_lte | optional | get data where column value less than or equal with [value] |age_lte: 25|
| [column]_gt | optional | get data where column value greater than [value] |age_gt: 25|
| [column]_lt | optional | get data where column value less than [value] |age_lt: 25|
| [column]_ne | optional | get data where column value not equal with [value] |gender_ne: male|
| [column]_between | optional | get data where column value between [values] |age_between: 20,30|
| [column]_null | optional | get data where column is null | address_null |
| [column]_notnull | optional | get data where column is not null | address_notnull |
| [column]_in | optional | get data where column value in [values] | age_in: 10,25,30|
| [column]_notin | optional | get data where column value not in [values] | age_notin: 10,25,30|

#### Query Filter in Relationship Database
Even query can filter data in relationship table up to 3 deep table relationship. Example 2 deep relationship data
```mermaid
graph LR
A[User] -- user has one department --> B[Department]
B[Department] -- department has many division --> C[Division]
```
and your user model and department model must be:
```
//user model
class User extends Model
{
   ...
   public function department(){
      return $this->hasOne(Department::class,'id');
   }
   ...
}

//Department model
class Department extends Model
{
   ...
   public function division(){
      return $this->hasMany(Division::class);
   }
   ...
}
```

so, to filter data using department name or division name from user list you can using parameter with *__* (double underscore) like:
| Param Key | Description| Example |
|--|--|--|
|department__name_is| filter user using department name where department name is [value] | department__name_is:production |
|department__division__name_is| filter user using division name where division name is [value] | department__division__name_is: it |

#### Example using trait
- Import Trait From Btx Package in your controller with `use Btx\Query\Traits\QueryFilter;`
- Implement the trait `use QueryFilter`
- Before query executing use function on trait `$this->filter(Model)`

Example:
```
use Btx\Query\Traits\QueryFilter; 
class UserController extends Controller(){
   use QueryFilter;

   public function getUsers(Request $request){
        $users = User::with('department');
        $this->filter($users);
        $users->get();

        return response()->json(['data' => $users]);
   }
   
}

```

#### Example using extending model class
- Import Btx\Query\Model From Btx Package in your model with override existing Model class
- Before query executing use function `filter()`

Example:
```
//Model
use Btx\Query\Model;
class User extends Model
{
  public function department(){
    return $this->hasOne(Department::class,'id','department_id');
  }
  ...
}

//Controller
class UserController extends Controller(){

   public function getUsers(Request $request){
        //implement filter function
        $users = User::with('department')->filter()->get();
        return response()->json(['data' => $users]);
   }
   
}

```