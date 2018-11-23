<?php
namespace tests\util\xhprof;

use util\xhprof\XhprofRuntimeCli;
use PHPUnit\Framework\TestCase;

require_once __DIR__. '/../../init.php';

XhprofRuntimeCli::start('tag1');

XhprofRuntimeCli::stop('tag1');
