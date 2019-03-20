<?php

namespace App;


class Prizes {

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

	protected static $quality_money = 10;
	protected static $quality_points = 50;


}