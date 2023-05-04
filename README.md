# Patienceman - Handler

Provide a convenient way creating single action handlers. 
The idea of a action handler is a single action controller that means 
a unique class handles each action

## Installation

Install the package doesn't require much requirement except to use the following command in the laravel terminal,  and you're good to go.

```bash
    composer require patienceman/handler
```

## Usage

To start working with handler, u need to run command :tada: 
in your custom directories:

```bash
    php artisan make:handler NewStartupHandler
```
so it will create the filter file for u, Just in 

```PHP
    App\Handlers
```

```PHP
    namespace App\Handlers;

    use Patienceman\CustomHandler\Handler;

    class NewStartupHandler extends Handler {
        /**
         * Custom execution from Handler Pipeline
         * @return Exception|void
         */
        public function execute() {
            // do whatever action inside handler
        }
    }
```

So you may want even to specify the custom path for your Handler, Just relax and add it in front of your Handler name.
Let's take again our current example.

```bash
php artisan make:handler Model/DatabaseHandler
```
So far so good, Let see how you can your handlers anywhere in controller or services or ...:
```PHP 
    namespace App\Http\Controllers;

    use App\Handlers\NewStartupHandler;
    use Patienceman\CustomHandler\CustomHandler;

    class TestBuilderController extends Controller {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index() {
            $handler = CustomHandler::handle(new NewStartupHandler());
        }
    }
```
But don't worry, you chain many handlers as you want, what you need to do is keep add ``` ->handle() ```, let see it in action:

```PHP 
    namespace App\Http\Controllers;

    use App\Handlers\NewStartupHandler;
    use App\Handlers\NewCompanyHandler;
    use Patienceman\CustomHandler\CustomHandler;

    class TestBuilderController extends Controller {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index() {
            $handler = CustomHandler::handle(new NewStartupHandler())
                                    ->handle(new NewCompanyHandler());
        }
    }
```
And now once your controller get execution, all your handler will run.

## Exchanges of data
There might a time you need to store and exchange tou data throughout your handlers,
This package provide convinient way to do so, by just use ``` ->collect(array data) ``` to collect data and ``` ->collection() ``` to get collected data, let take example:

In our ``` NewStartupHandler ```:
```PHP
    namespace App\Handlers;

    use Patienceman\CustomHandler\Handler;
    use App\Models\Startup;

    class NewStartupHandler extends Handler {
        /**
         * Custom execution from Handler Pipeline
         * @return Exception|void
         */
        public function execute() {
            $startup = Startup::create([ 'name' => "MorganTv" ]);
            $this->collect([ 'startup' => $startup ]);
        }
    }
```
That look to clear 🎉, so Let see how you can call the collected data anywhere your want, for example in our
``` NewCompanyHandler ``` class:
```PHP
    namespace App\Handlers;

    use Patienceman\CustomHandler\Handler;

    class NewCompanyHandler extends Handler {
        /**
         * Custom execution from Handler Pipeline
         * 
         * @return Exception|void
         */
        public function execute() {
            $startup = $this->collection()->get('startup');
        }
    }
```
🚨 You've seen where we are using ``` ->collection() ``` function, and this is coming from Laravel collection, you can read more about it to their website: [Laravel collection avalibale method](https://laravel.com/docs/8.x/collections#available-methods) for more about getting and filtering data.

There is also another way to get collected data, for instance when you're outside handler, and to apply this you use same functionality 
as ``` ->collection() ``` after your handler, take a look:

```PHP 
    namespace App\Http\Controllers;

    use App\Handlers\NewStartupHandler;
    use App\Handlers\NewCompanyHandler;
    use Patienceman\CustomHandler\CustomHandler;

    class TestBuilderController extends Controller {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index() {
            $handler = CustomHandler::handle(new NewStartupHandler())
                                    ->handle(new NewCompanyHandler())
                                    ->collection()
                                    ->get('startup') // or ->get(), ->filter() ->sort();
        }
    }
```

## Am Manirabona Patience
as Software Engineer who is passionate about creating quality applications, and Never tired of learning, creating, and building, I've been collaborating and contributing with different Teams and companies to develop their products from ideas up to Marketplace, including open source projects.

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.
## Connect with Me
<p align="center">
	<a href="https://www.linkedin.com/in/manirabona-patience-3b08051b4"><img alt="Linkedin" title="Manirabona patience Linkedin" src="https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white"></a>
  <a href="https://github.com/manirabona-programer/manirabona-programer"><img alt="Github" title="Manirabona patience Github" src="https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white"></a>
  <a href="https://www.instagram.com/manirabona_walker"><img alt="Instagram" title="Manirabona Patience Instagram" src="https://img.shields.io/badge/Instagram-E4405F?style=for-the-badge&logo=instagram&logoColor=white"></a>
	  <a href="https://twitter.com/ManirabonaW"><img alt="Twitter" title="Manirabona Patience Twitter" src="https://img.shields.io/badge/Twitter-1DA1F2?style=for-the-badge&logo=twitter&logoColor=white"></a>
	  </p>
