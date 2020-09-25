<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\State;
use App\Models\Branch;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    public function index() {
        $username = $_COOKIE["username"] ?? '';
        try {
            $branches = Branch::where('username', $username)->get();
            return view('layout', [
                'page' => 'branch.php',
                'title' => 'Branch List',
                'username' => $username,
                'branches' => $branches,
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function add() {
       $username = $_COOKIE["username"] ?? '';
        // fetch states and district
        try {
            $states = DB::table('states')
                    ->selectRaw('states.name as state_name, states.id as state_id, districts.*')
                    ->leftJoin('districts', 'districts.state_id', '=', 'states.id')
                    ->get();
            $stateDistricts = [];
            $stateNames = [];
            foreach ($states as $state) {
                $stateNames[$state->state_id] = $state->state_name;
                $stateDistricts[$state->state_id][] = $state->name;
            }
        } catch (Exception $e) {
            return view('layout', [
                'error' => 'unexpected error',
                'message' => 'unable to fetch data',
            ]);
        }

        return view('layout', [
            'page' => 'add.php',
            'title' => 'add new branch',
            'username' => $username,
            'stateNames' => $stateNames,
            'stateDistricts' => $stateDistricts,
        ]);
    }

    public function addBranch(Request $request) {
        $input = $this->validate($request, [
            'ifsc' => 'required',
            'state' => 'required',
            'district' => 'required',
            'bank' => 'required',
            'name' => 'required',
            'username' => 'required',
        ]);

        try {
            Branch::updateOrCreate(['name' => $input['name']], $input);
            return redirect('/branch');
        } catch (Exception $e) {
            return view('layout', [
                'error' => 'Sorry there was an error',
                'message' => 'unable to add new branch',
            ]);
        }
    }
    public function deleteBranch($id) {
        try {
            Branch::where('id', $id)->delete();
            return redirect('/branch');
        } catch (Exception $e) {
            return view('layout', [
                'error' => 'Sorry there was an error',
                'message' => 'unable to add new branch',
            ]);
        }
    }
    public function search() {
        $username = $_COOKIE["username"] ?? '';
        // fetch states and district
        try {
            $branches = Branch::where('username', $username)->get();
            $states = DB::table('states')
                    ->selectRaw('states.name as state_name, states.id as state_id, districts.*')
                    ->leftJoin('districts', 'districts.state_id', '=', 'states.id')
                    ->get();

            $stateNames = [];
            $stateDistricts = [];
            foreach ($states as $state) {
                $stateNames[$state->state_id] = $state->state_name;
                $stateDistricts[$state->state_id][] = $state->name;
            }
            return view('layout', [
                'page' => 'search.php',
                'title' => 'Search banks',
                'username' => $username,
                'stateNames' => $stateNames,
                'stateDistricts' => $stateDistricts,
                'branches' => $branches,
            ]);
        } catch (Exception $e) {
            return view('layout', [
                'error' => 'unexpected error',
                'message' => 'unable to fetch data',
            ]);
        }
    }

    public function searchBranch(Request $request) {
        $input = $this->validate($request, [
        ]);
        $results = Branch::where($input)->toSql();
        echo $results;
        die;
        print_r($results);
    }
}
