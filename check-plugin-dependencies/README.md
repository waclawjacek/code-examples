# Check Plugin Dependencies

An example WordPress plugin that checks if some other plugins are running
and prevents its actual logic from executing if they are not.

Related blog article: https://waclawjacek.com/check-wordpress-plugin-dependencies/

## Project structure

* The *includes* directory holds the class files.
* The *views* directory holds the PHP view templates.

Each directory contains an *index.php* file to prevent listing the directory
contents in case of a too permissive server configuration.

Each PHP file contains DocBlocks explaining what a specific piece of code does,
written according to [WordPress' PHP Documentation Standards.](https://make.wordpress.org/core/handbook/best-practices/inline-documentation-standards/php/)

## How it works

[`check-plugins-dependencies.php`](check-plugin-dependencies.php) is a standard
WordPress plugin entry point. It sets up an [autoloader](https://www.php.net/manual/en/language.oop5.autoload.php)
and creates an instance of [`Check_Plugin_Dependencies`](includes/Check_Plugin_Dependencies.php) -
the plugin's main class that takes care of setting up the rest of the plugin,
but only if its dependencies are met.

`Check_Plugin_Dependencies::setup()` is the method ordering the check and
controlling the flow of what happens afterwards.
[`Dependency_Checker`](includes/Dependency_Checker.php) is the class doing
the actual check.

If no exception is thrown by `Dependency_Checker`, the code execution will
stay in the `try` block of `Check_Plugin_Dependencies::setup()` and the
`run()` method will be called.

If `Dependency_Checker` does throw an exception (indicating some required
plugins are not running), the `catch` block inside
`Check_Plugin_Dependencies::setup()` will catch it instead and pass the
control to [`Admin\Missing_Dependency_Reporter`](includes/Admin/Missing_Dependency_Reporter.php) -
a class that renders a notice about unmet dependencies in the admin dashboard.

## License

The example is licensed under the GNU General Public License
version 2 or later - see the LICENSE file for details.
