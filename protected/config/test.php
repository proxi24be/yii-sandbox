<?php

return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'),
    array(
        'components' => array(
            'fixture' => array(
                'class' => 'system.test.CDbFixtureManager',
            ),

//            'db' =>
//            array(
//                'class' => 'CDbConnection',
//                'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/breast_reborn_test.db',
//                'schemaCachingDuration' => 60 * 60 * 24 * 7, // 1 semaine
//            ),
//
//            'dbBiotracking' =>
//            array(
//                'class' => 'CDbConnection',
//                'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/breast_reborn_test.db',
//                'schemaCachingDuration' => 60 * 60 * 24 * 7, // 1 semaine
//            ),
        ),
    )
);
