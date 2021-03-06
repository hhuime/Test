<?php
/**********************************************************\
|                                                          |
|                          hprose                          |
|                                                          |
| Official WebSite: http://www.hprose.com/                 |
|                   http://www.hprose.org/                 |
|                                                          |
\**********************************************************/

/**********************************************************\
 *                                                        *
 * HproseFilter.php                                       *
 *                                                        *
 * hprose filter interface for php5.                      *
 *                                                        *
 * LastModified: Feb 27, 2015                             *
 * Author: Ma Bingyao <andot@hprose.com>                  *
 *                                                        *
\**********************************************************/

if (!extension_loaded('hprose')) {

interface HproseFilter {
    function inputFilter($data, $context);
    function outputFilter($data, $context);
}

} // endif (!extension_loaded('hprose'))
