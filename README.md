iWorkPHP Standard Edition
=========================

Welcome to the iWorkPHP Standard Edition - a fully-functional iWorkPHP
application that you can use as the skeleton for your new applications.

iWorkPHP is a lightweight framework for rapid php projects in mind if 
you have a really big project we recommend using [Symfony][1] instead.

1) Installing the Standard Edition
----------------------------------

When it comes to installing the iWorkPHP Standard Edition, you have the
following options.

### Use Composer (*recommended*)

As iWorkPHP uses [Composer][2] to manage its dependencies, the recommended way
to create a new project is to use it.

If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

    curl -s http://getcomposer.org/installer | php

Then, use the `create-project` command to generate a new iWorkPHP application:

    composer create-project -s dev iworkphp/framework-standard-edition path/to/install

Composer will install Symfony and all its dependencies under the
`path/to/install` directory.

[1]:  http://symfony.com/
[2]:  http://getcomposer.org/
