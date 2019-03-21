<?php

namespace App\Http\Controllers;

use App\Main\PrizesSettings;
use App\Prizes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware( 'auth' );
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view( 'home' );
	}

	public function random_prize( Request $request ) {
		if ( $request->ajax() ) {

			$prize = PrizesSettings::random_prize();
			if ( empty( $prize ) || count( $prize ) !== 1 || empty( Auth::id() ) ) {
				return response()->json( [
					'success' => false,
					'errors'  => 'Try letter'
				] );
			}
			try {
				$save_prize          = new Prizes();
				$save_prize->user_id = Auth::id();
				foreach ( $prize as $prize_name => $prize_value ) {
					$save_prize->prize_name  = $prize_name;
					$save_prize->prize_value = $prize_value;
					$prize_text              = $prize_name . ' '.$prize_value;
				}
				$save_prize->save();
			} catch ( \Exception $exception ) {
				return response()->json( [
					'success' => false,
					'errors'  => $exception->getMessage()
				] );

			}

			return response()->json( [
				'success' => true,
				'text'  => 'Поздравляем! Ваш приз ' . $prize_text
			] );
		} else {
			abort( 404 );
		}
	}
}
