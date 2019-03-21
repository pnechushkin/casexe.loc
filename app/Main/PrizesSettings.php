<?php

namespace App\Main;

use App\Prizes as Prize;

class PrizesSettings {

	protected static $prises_type = [
		'money',
		'points',
		'object',
	];

	protected static $prises_list = [
		'prise1',
		'prise2',
		'prise3',
		'prise4',
		'prise5',
		'prise6',
	];

	protected static $money_limit = [ 50, 500 ];
	protected static $points_limit = [ 250, 1000 ];

	protected static $quality_money = 50;
	protected static $quality_object = 100;

	static function random_prize() {
		$money_count  = Prize::where( 'prize_name', '=', 'money' )->count();
		$object_count = Prize::where( 'prize_name', '=', 'object' )->count();
		if ( $money_count == self::$quality_money || $money_count > self::$quality_money ) {
			unset( self::$prises_type[0] );
		}
		if ( $object_count == self::$quality_object || $object_count > self::$quality_object ) {
			unset( self::$prises_type[2] );
		}
		$type_prizes = self::$prises_type[ array_rand( self::$prises_type ) ];
		switch ( $type_prizes ) {
			case 'money':
				$random_prize = [ 'money' => rand( self::$money_limit[0], self::$money_limit[1] ) ];
				break;
			case 'object':
				$random_prize = [ 'object' => self::$prises_list[ array_rand( self::$prises_list ) ] ];
				break;
			default:
				$random_prize = [ 'points' => rand( self::$points_limit[0], self::$points_limit[1] ) ];
		}

		return $random_prize;
	}


}