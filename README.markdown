JotApps
=======

A set of classes and utility functions for building applications, both web and command line applications.

* `JotApp\Applicationbase`: A base class for a JotApp application.
* `JotApp\Controller`: A base class for Controllers, providing an API to an application
* `JotApp\Middleware\`: For Slim middleware components
    * `User`: Given a session id in a cookie, this component populates the Slim environment with a User object for that user.
* `JotApp\Utilities\`:
    * `PasswordUtils`
    * `Slug`
    * `FeatureFlags`
* `JotApp\Assets\`:
    * `Bundler`: This class concatenantes multiple JavaScript or CSS files into one, serving up the aggregate in one HTTP Response.


