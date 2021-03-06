<?php

return CMap::mergeArray(
    require(dirname(__FILE__) . '/../base.php'),
    array(
        'params' => array(),
        'components' => array(
            // 读从库
            'dbPhotoTask' => array(
                'class' => 'MongoConnection',
                'server' => 'mongodb://en-ap-phototask-mongodb0:28110,en-ap-phototask-mongodb1:28111,en-ap-phototask-mongodb2:28112,en-ap-phototask-mongodb3:28113,en-ap-phototask-mongodb4:28114,en-ap-phototask-mongodb5:28115,en-ap-phototask-mongodb6:28116',
                'options' => array(
                    'connect' => false,
                    'readPreference' => MongoClient::RP_SECONDARY_PREFERRED,//,RP_NEAREST,MongoClient::RP_PRIMARY,//
                    //'connectTimeoutMS' => 1000,
                    'connectTimeoutMS' => 50, // 跨机房写时时间要设长.
                    'replicaSet' => 'phototask_rs1',
                ),
            ),
            //msg
            'dbPhotoTaskMsg' => array(
                'class' => 'MongoConnection',
                'server' => 'mongodb://en-ap-phototask-mongodb7:28117,en-ap-phototask-mongodb8:28118,en-ap-phototask-mongodb9:28119',
                'options' => array(
                    'connect' => false,
                    'readPreference' => MongoClient::RP_SECONDARY_PREFERRED,//,RP_NEAREST,MongoClient::RP_PRIMARY,//
                    //'connectTimeoutMS' => 1000,
                    'connectTimeoutMS' => 50, // 跨机房写时时间要设长.
                    'replicaSet'  => 'phototask_msg_rs1',
                ),
            ),
            'log' => array(
                'class' => 'CLogRouter',
                'routes' => array(
                    'file' => array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'error,warning',
                        'maxFileSize' => 2 * 1024 * 1024,
                        'maxLogFiles' => 100,
                    ),
                    'notice' => array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'notice',
                        'logFile' => 'notice.log',
                        'maxFileSize' => 2 * 1024 * 1024,
                        'maxLogFiles' => 100,
                    ),
                    'recommend' => array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'info',
                        'logFile' => 'recommend.log',
                        'maxFileSize' => 2 * 1024 * 1024,
                        'maxLogFiles' => 100,
                    ),
                    'profile' => array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'profile',
                        'logFile' => 'profile.log',
                        'maxFileSize' => 100 * 1024,
                        'maxLogFiles' => 100,
                    ),
                ),
            ),
        ),
    )
);
