Anax comment
==================================

[![Latest Stable Version](https://poser.pugx.org/anax/comment/v/stable)](https://packagist.org/packages/anax/comment)
[![Join the chat at https://gitter.im/mosbth/anax](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/canax?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Build Status](https://travis-ci.org/canax/comment.svg?branch=master)](https://travis-ci.org/canax/comment)
[![CircleCI](https://circleci.com/gh/canax/comment.svg?style=svg)](https://circleci.com/gh/canax/comment)
[![Build Status](https://scrutinizer-ci.com/g/canax/comment/badges/build.png?b=master)](https://scrutinizer-ci.com/g/canax/comment/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/canax/comment/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/canax/comment/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/canax/comment/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/canax/comment/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d831fd4c-b7c6-4ff0-9a83-102440af8929/mini.png)](https://insight.sensiolabs.com/projects/d831fd4c-b7c6-4ff0-9a83-102440af8929)

Anax comment module.



Usage
------------------

Short examples on how to use the module comment.



License
------------------

This software carries a MIT license.



```
 .  
..:  Copyright (c) 2017 Martin Fagerlund (mngfagerlund@gmail.com)
```


For db:

cp -r vendor/anax/database/data/ data/
chmod 777 data
sqlite3 data/db.sqlite
(quit sqlite3 with .exit)
sqlite3 data/db.sqlite < vendor/mafd16/comment/sql/ddl/comments_sqlite.sql
chmod 666 data/db.sqlite
sqlite3 data/db.sqlite < vendor/mafd16/comment/sql/ddl/user_sqlite.sql


cp -r vendor/mafd16/comment/src/* src/
