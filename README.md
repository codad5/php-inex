# PHP IMPORTER

This is a package that simulates node.js import feature.

## Installing it 
```
composer require codad5/php-inex
```
## SAMPLE FOR DEFAULT EXPORT

##### Exporting data

- Export.js

    ```js
    export default const greet = () => {
        console.log('hello')
    }
    ```

- Export.php

    ```php
    <?php
    $export = function(){
        echo "hello";
    }
    ```

##### Importing Data

- Import.js

    ```js
    const greeting = require('Export')
    greeting(); // hello
    ```

- Import.php

    ```php
    <?php
        require __DIR__.'/vendor/autoload.php';
        use Codad5\PhpInex\Import;
        $greeting = Import::this('Export');
        $greeting(); // hello
    ```


## SAMPLE FOR MULTIPLE EXPORT

##### Exporting data

- Export.js

    ```js
    const greet = () => {
        console.log('hello')
    }
    const sum = (a, b) => {
         return a + b
    }
    export {greet, sum}
    ```

- Export.php

    ```php
    <?php
    $export['greet'] = function(){
        echo "hello";
    }

    $export['sum'] = function($a, $b){
        return $a + $b;
    }
    ```

##### Importing Data

- Import.js

    ```js
    const {greet, sum} = require('Export')
    greet();
    console.log(sum(2,4)) // 6
    ```

- Import.php

    ```php
    <?php
        require __DIR__.'/vendor/autoload.php';
        use Codad5\PhpInex\Import;
        ["greet" => $greet, "sum" => $sum] = Import::this('Export');
        $greet(); // hello
        echo $sum(2,4) // 6
    ```

## USING ROUTER LIBRARY

- For php we will use [TrulyAo php-router](https://github.com/aosasona/php-router)
- For Node.js we will use Express.js

##### Exporting routes

- `routes/api.js`

    ```js
    const route = require('express').Router()

    route.get('/food', (req, res) => {
        res.json({
            'name' : "rice"
        })
    })

    export default route
    ```

- `routes/api.php`

    ```php
    <?php
    require __DIR__.'/vendor/autoload.php';
    use \Trulyao\PhpRouter\Router as Router;
    $route = new Router();
    $route->get('/food', function($req, $res){
        $res->json([
            'name' => "rice"
            ]);
    });
    $export = $route;
    ```

##### Importing routes

- Import.js

    ```js
    const app = require('express')();
    const apiRoute = require('routes/api')

    app.get('', (req, res) => {
        res.send('welcome')
    })
    app.use('/api', apiRoute)
    
    // serving the application
    app.listen(4000)
    
    ```

- Import.php

    ```php
    <?php
    require __DIR__.'/vendor/autoload.php';
    use \Trulyao\PhpRouter\Router as Router;
    use Codad5\PhpInex\Import;

    $route = new Router();
    $apiRoute = Import::this('routes/api');
    
    $route->get('/', function($req, $res){
        $res->send('welcome');
    });
    $route->set_route('/api', $apiRoute);
    
    // serving the application
    $route->serve();
    ```

### More 
You can also import non php files but you get their file content instead

### Coming soon
- Formatted json import

> Built with 🧡 by [Aniezeofor Chibueze](https://github.com/codad5)
