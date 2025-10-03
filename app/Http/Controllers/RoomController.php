<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Yajra\DataTables\DataTables;

class RoomController extends Controller
{
    public function roomIndex(){

        if ($request->ajax()) {
            $rooms = Room::select(['id','roomnumber','roomname','type','capacity','price','status']);
            return DataTables::of($rooms)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '
                        <a href="/rooms/'.$row->id.'/edit" class="btn btn-sm btn-primary">Edit</a>
                        <a href="/rooms/'.$row->id.'/delete" class="btn btn-sm btn-danger">Delete</a>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('rooms.index');
        
    }
}
