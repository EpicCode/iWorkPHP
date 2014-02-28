iWorkPHP Standard Edition
=========================

Welcome to the iWorkPHP Standard Edition - a fully-functional 
lightweight framework for rapid php projects.

**iWorkPHP is currently in beta phase.**

Installing the Standard Edition
-------------------------------

When it comes to installing the iWorkPHP Standard Edition, you have the
following options.

### Use Composer (*recommended*)

As iWorkPHP uses [Composer][1] to manage its dependencies, the recommended way
to create a new project is to use it.

If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

    curl -s http://getcomposer.org/installer | php

Then, use the `create-project` command to generate a new iWorkPHP application:

    composer create-project -s dev iworkphp/framework-standard-edition path/to/install

Composer will install iWorkPHP and all its dependencies under the
`path/to/install` directory.

[1]:  http://getcomposer.org/
