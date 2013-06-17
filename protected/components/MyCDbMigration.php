<?php
/**
 * User: TRANN
 * Date: 4/3/13
 * Time: 11:12 AM
 */

class MyCDbMigration  extends CDbMigration {

    // To customize following the database.
    // sqlite
    public $CURRENT_TIMESTAMP_YYYYMMDD = "(datetime(strftime('%s','now'),'unixepoch','localtime'))";

}