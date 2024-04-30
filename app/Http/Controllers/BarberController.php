<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Barber;

class BarberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
//     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barbers = Barber::all();

        return view('/barber/create')->with('barbers', $barbers);
    }

    /**
     * Show the form for creating a new resource.
     *
//     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'nombre' => 'bail|required|max:50',

        ]);

        $Barber = new Barber ([
            'nombre' => $request->nombre,

        ]);
//        dd($request);

        $Barber->save();

        return redirect('/barber')->with('success', 'Task has been added');
    }

    /**
     * Display the specified resource.
     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
    public function show($id)
    {
//        $barber = Barber::find($id);
//
//        dd($barber);

//        return view ('/barber.edit')->with('barber', $barber);

    }

    /**
     * Show the form for editing the specified resource.
     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
    public function edit($id)
    {
        $barber = Barber::find($id);

        return view ('/barber.edit')->with('barber', $barber);
    }

    /**
     * Update the specified resource in storage.
     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $barber = Barber::find($id);

        $this->validate($request, [
            'nombre' => 'bail|required|max:50',
        ]);

        $barber->update([
            'nombre' => $request->nombre,
        ]);

        return redirect('/barber')->with('success', 'Task has been added');
    }

    /**
     * Remove the specified resource from storage.
     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
    public function destroy($id)
    {
        $barber = Barber::findOrFail($id);
        $barber->delete();
        return back()->with('info', 'Fue eliminado exitosamente');
    }
}
