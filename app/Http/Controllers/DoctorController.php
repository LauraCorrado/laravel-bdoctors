<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Field;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::all();
        return view('admin.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fields = Field::all();
        return view('admin.doctors.create', compact('fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDoctorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDoctorRequest $request, Doctor $doctor)
    {
        $form_data = $request->validated();

        $form_data['slug'] = Doctor::createSlug($form_data['user_name'].' '.$form_data['user_surname']);
        $doctor->fill($form_data);
        // auth = funzione globale che restituisce l'istanza del gestore di autenticazione (verifica se utente è autenticato e in caso restituisce id user, altrimenti è null)
        $doctor->user_id = auth()->id();
        $doctor->save();

        if($request->has('fields')) {
            //salvo il valore del campo (l'array di id)
            $fields = $request->fields;
            // attach()->prendo array di fields e creo record nella pivot che rappresenta la relazione m-to-m
            $doctor->fields()->attach($fields);
        }
        
        return redirect()->route('admin.doctors.show', ['doctor' => $doctor->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $doctor = Doctor::where('slug', $slug)->firstOrFail();
        $doctor->load('fields');
        return view('admin.doctors.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        $fields = Field::all();
        return view('admin.doctors.edit', compact('doctor', 'fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDoctorRequest  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
   
        $form_data = $request->validated();

        $form_data['slug'] = Doctor::createSlug($form_data['user_name'] . $form_data['user_surname']);

        $doctor->fill($form_data);
        $doctor->save();

        if ($request->has('fields')) {
            $fields = $request->fields;
            $doctor->fields()->sync($fields);
        }

        
        return redirect()->route('admin.doctors.show', ['doctor' => $doctor->id]);
                     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
