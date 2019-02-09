<?php
/**
 * -----------------------------------------
 * Desc: 用户中心-招聘相关控制器
 * User: Bencai.Zhao
 * Date: 2017/04/24
 * Time: 23:08
 * File: GameController.php
 * Project: JiongMiGame
 * -----------------------------------------
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Http\Controllers\Controller;
use App\Models\JobCategory;

class GameController extends Controller
{
    public $job_config;

    public function __construct()
    {
        parent::__construct();
        $this->job_config = config('job');
    }

    /**
     * @name show
     * @desc 职位详细
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  date
     * @update date
     */
    public function show($id)
    {
        $game_info = Game::find($id);
        return view('game.show', [
            'game_info' => $game_info,
            'game_config' => $this->job_config,
        ]);
    }

}
