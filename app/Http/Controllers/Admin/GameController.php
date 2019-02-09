<?php
/**
 * -----------------------------------------
 * Desc: 游戏控制器
 * User: Bencai.Zhao
 * Date: 2017/3/23
 * Time: 20:10
 * File: GameController.php
 * Project: DoctorVisit
 * -----------------------------------------
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    public $job_config;

    public function __construct()
    {
        $this->job_config = config('job');
    }

    public function index()
    {
        $data = Game::get();
        return view('admin.game.index', ['data' => $data, 'jobc' => $this->job_config]);
    }

    public function edit($id)
    {
        $data = Game::find($id);
        return view('admin.game.edit', ['data' => $data, 'jobc' => $this->job_config]);
    }


    public function update(Request $request)
    {
        $updata_data = [
            'status' => $request->input('status'),
        ];

        $affect_rows = Game::where('id', $request->input('id'))->update($updata_data);
        if($affect_rows) {
            return redirect()->route('admin.game.index')->withSuccess('更新成功');
        } else {
            return redirect()->route('admin.game.index')->withErrors('操作异常');
        }

    }
}