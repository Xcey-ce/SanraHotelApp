<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Exception;

class RoomController extends Controller
{
    public function roomIndex()
    {
        $rooms = Room::all();
        return view('layouts.rooms', compact('rooms')); 
    }

    public function storeRoom(Request $request)
    {
        try {

            // Create new room
            $room = new Room();
            $room->roomnumber = $request->roomnumber;
            $room->roomname = $request->roomname;
            $room->type = $request->type;
            $room->capacity = $request->capacity;
            $room->price = $request->price;
            $room->status = $request->status;
            $room->description = $request->description ?? ' ';
            $room->amenities = $request->amenities ?? ' ';

            // Handle image upload if exists
            if ($request->hasFile('image_path')) {
                $image = $request->file('image_path');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('assets/roomImages'), $imageName);
                $room->image_path = 'assets/roomImages/' . $imageName;

                $room->save();
                return redirect()->back()->with('success', 'Room added successfully.');          
            }
            } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to add room: ' . $e->getMessage());
      }
    }

    public function updateRoom(Request $request, $id)
{
    try {
        $room = Room::findOrFail($id);

        $room->roomnumber   = $request->roomnumber;
        $room->roomname     = $request->roomname;
        $room->type         = $request->type;
        $room->capacity     = $request->capacity;
        $room->price        = $request->price;
        $room->status       = $request->status;
        $room->description  = $request->description ?? '';
        $room->amenities    = $request->amenities ?? '';


        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/roomImages'), $imageName);

            // store relative path
            $room->image_path = 'assets/roomImages/' . $imageName;
        }

        $room->save();

        return redirect()->back()->with('success', 'Room updated successfully.');
    } catch (\Exception $e) {
        \Log::error('Failed to update room: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to update room.');
    }
}
public function deleteRoom($id)
{
    try {
        $room = Room::findOrFail($id);

        if ($room->image_path && File::exists(public_path($room->image_path))) {
            File::delete(public_path($room->image_path));
        }
        $room->delete();

        return redirect()->back()->with('success', 'Room and image deleted successfully.');
    } catch (Exception $e) {
        Log::error('Failed to delete room: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to delete room.');
    }
}

}
