Mafd16 comment
==================================

[![Latest Stable Version](https://poser.pugx.org/mafd16/comment/v/stable)](https://packagist.org/packages/mafd16/comment)
[![Build Status](https://travis-ci.org/mafd16/comment.svg?branch=master)](https://travis-ci.org/mafd16/comment.svg?branch=master)
[![CircleCI](https://circleci.com/gh/mafd16/comment.svg?style=svg)](https://circleci.com/gh/mafd16/comment)
[![Build Status](https://scrutinizer-ci.com/g/mafd16/comment/badges/build.png?b=master)](https://scrutinizer-ci.com/g/mafd16/comment/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mafd16/comment/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mafd16/comment/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/mafd16/comment/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mafd16/comment/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d831fd4c-b7c6-4ff0-9a83-102440af8929/mini.png)](https://insight.sensiolabs.com/projects/d831fd4c-b7c6-4ff0-9a83-102440af8929)

Mafd16 comment module.

Install
========

Install using composer and then integrate the module with your Anax installation.

Install with composer
---------------------

    composer require mafd16/comment

Configuration files for comment module
---------------------------------------

    cp vendor/mafd16/comment/config/route/* config/route
    cp vendor/mafd16/comment/config/database.php config/

Integrate the following parts in to your own installation of Anax (do not just copy!)

    vendor/mafd16/comment/config/di.php to config/di.php
    vendor/mafd16/comment/config/route.php to config/route.php
    vendor/mafd16/comment/config/view.php to config/view.php

Set up and configure an sqlite database
------------------------------------------

If you don´t already have a database set up

    cp -r vendor/anax/database/data/ data/
    chmod 777 data

    sqlite3 data/db.sqlite < vendor/mafd16/comment/sql/ddl/comments_sqlite.sql
    sqlite3 data/db.sqlite < vendor/mafd16/comment/sql/ddl/user_sqlite.sql
    chmod 666 data/db.sqlite



License
------------------

This software carries a MIT license.



```
Copyright (c) 2017 Martin Fagerlund (mngfagerlund@gmail.com)
```
