<div align="center">
  <!-- PROJECT LOGO -->
  <a href="https://github.com/SageITSolutions/phalcon-exception-handler">
    <img src=".readme/logo.png" alt="Logo" width="445" height="120">
  </a>

  <h1 align="center">Phalcon Micro-Annotation</h1>

  [![Latest Stable Version](http://poser.pugx.org/sageit/phalcon-exception-handler/v?style=plastic)](https://packagist.org/packages/sageit/phalcon-exception-handler) 
  [![Total Downloads](http://poser.pugx.org/sageit/phalcon-exception-handler/downloads?style=plastic)](https://packagist.org/packages/sageit/phalcon-exception-handler) 
  [![License](http://poser.pugx.org/sageit/phalcon-exception-handler/license?style=plastic)](https://packagist.org/packages/sageit/phalcon-exception-handler)
  [![PHP Version Require](http://poser.pugx.org/sageit/phalcon-exception-handler/require/php?style=plastic)](https://packagist.org/packages/sageit/phalcon-exception-handler)
  [![Phalcon Version](https://img.shields.io/packagist/dependency-v/sageit/phalcon-exception-handler/ext-phalcon?label=Phalcon&logo=Phalcon%20Version&style=plastic)](https://packagist.org/packages/sageit/phalcon-exception-handler)

  <p>
    Adds Preset throwable exceptions along with a built in handler with included logging.
  </p>

  **[Explore the docs »](https://github.com/SageITSolutions/phalcon-exception-handler)**

  **[Report Bug](https://github.com/SageITSolutions/phalcon-exception-handler/issues)** ·
  **[Request Feature](https://github.com/SageITSolutions/phalcon-exception-handler/issues)**
</div>

<!-- TABLE OF CONTENTS -->
## Table of Contents

* [About the Project](#about-the-project)
* [Installation](#installation)
* [Usage](#usage)
  * [Full Application](#full-application)
  * [Micro App](#micro-application)
  * [Custom Exceptions](#custom-exceptions)
  * [Additional Methods](#additional-methods)
* [Roadmap](#roadmap)
* [Contributing](#contributing)
* [License](#license)
* [Contact](#contact)


<br />

<!-- ABOUT THE PROJECT -->
## About The Project

### Built With

* [vscode](https://code.visualstudio.com/)
* [php 8.1.1](https://www.php.net/releases/8_1_1.php)
* [Phalcon 5](https://phalcon.io/en-us) (Micro Framework)

<br />

<!-- GETTING STARTED -->
## Installation

**Git:**
```sh
git clone https://github.com/SageITSolutions/phalcon-exception-handler.git
```

**Composer:**
```sh
composer require sageit/phalcon-exception-handler
```
<br />

<!-- USAGE EXAMPLES -->
## Usage

This project consists of an included Exception Handler which is supported by both Full suite Phalcon Applications and Micro Apps.
The intent is to integrate logging and presentation to generic exceptions.

_**This should not be used in lieu of `Phalcon\Support\Debug` functionality.  The exception-handler is intended for production handling of known events**_

### Full Application

```php
new Phalcon\Exception\Handler(true,'Error');
```
_This action would instantiation a new Exception Handler which is set globally (`true`) as the exception_handler.  `'Error'` Can be replaced with any CSS Class used by a flash service for displaying exceptions._

**if Logger is present**, and log level is greater than or equal to the `LOG_LEVEL` defined in the exception, an event will be logged according to the level specified.  This is useful for auditing failed authentication attempts.

**if Flash is present**, a flash alert will be displayed when an Exception is thrown.  Exceptions not included in this lib will be automagically converted to a generic "Unknown Exception". 

**if Flash is not present**, a simple echo with `Exception encountered: {error message}` will return.

### Micro Application
Add the following within the Micro class

```php
$this->error(function ($exception) {
  $handler = new \Phalcon\Exception\Handler(false);
  $this
    ->response
    ->setStatusCode($code)
    ->setJsonContent($handler->getJSON($exception))
    ->send();
  die;
});
```
_The same logging action of the Full Application takes place if a `Logger` Service is present in dependancy injection_

### Custom Exceptions

You are not limited to the provided Exceptions.  Any custom Exception can be created by extending `\Phalcon\Exception\Exception`

```php
class MyCustomException extends Phalcon\Exception\Exception {
    protected const ERROR_MESSAGE = 'I\'ve created a new custom Exceptions #reasons';
    protected const ERROR_CODE    = 401;
    protected const LOG_MESSAGE = 'My custom exception was activated';
    protected const LOG_LEVEL = 'alert';
```
_`LOG_LEVEL` Corresponds to the levels utilized by `\Phalcon\Logger\Logger`_

**Log Levels**

0. Emergency
1. Critical
2. Alert
3. Error
4. Warning
5. Notice
6. Info
7. Debug
8. Custom

<br />

### Additional Methods

**setDisplay**

_the CSS displayClass used by flash can be altered before an exception is thrown so the default exception handler can apply the correct styling_
```php
$handler->setDisplay('Notification');
```

**display**

_if global error catching is not in place, and you need to utilize the flash display service with a custom class, this can bbe called directly_
```php
$handler->display($exception,'Notification');
```
_The exception provided can be any Throwable \Exception_

**log**

_if there is a need to log an exception without displaying it, this can be called directly.  This will do nothing if no `Logger` Service is present_

```php
$handler->log($exception,'Notification');
```

**getJSON**

_as demonstrated in the MicroApp the method `getJSON` returns a named array with the elements of the exception.

```php
$handler->getJSON($exception);
```
`result`
```php
[
  'code' => 500,  //$this->getCode()
  'status' => 'error',
  'message' => 'Exception Encountered' //$this->getMessage()
]
```

**convertException**

_this **static** method is called within several other methds but can be used externally to transpose a generic exception into the `\Phalcon\Exception\Exception` utilized by this handler_

```php
\Phalcon\Exception\Handler::convertException($exception);
```
_there is no returned value, as this action is completed as a variable reference_




<br />

<!-- ROADMAP -->
## Roadmap

See the [open issues](/issues) for a list of proposed features (and known issues).

<br />

<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<br />

<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE` for more information.

<br />

<!-- CONTACT -->
## Contact

Sage IT Solutions - [Email](mailto:daniel.davis@sageitsolutions.net)

Project Link: [https://github.com/SageITSolutions/phalcon-exception-handler](https://github.com/SageITSolutions/phalcon-exception-handler)
