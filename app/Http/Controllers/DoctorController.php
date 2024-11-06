<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Field;
use Illuminate\Support\Str;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use Illuminate\Support\Facades\Storage;

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
        $user = auth()->user();
        $fields = Field::all();
        return view('admin.doctors.create', compact('fields', 'user'));
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

        $form_data['user_name'] = auth()->user()->name;
        $form_data['user_surname'] = auth()->user()->surname;

        $slug = Doctor::createSlug($form_data['user_name'].' '.$form_data['user_surname']);
        while (Doctor::where('slug', $slug)->exists()) {
            // Aggiungi un suffisso casuale allo slug se già esiste nel database
            $slug = Doctor::createSlug($form_data['user_name'] . ' ' . $form_data['user_surname'] . '-' . rand(1000, 9999));
        }
        $form_data['slug'] = $slug;

        if($request->hasFile('thumb')){
            $path = Storage::disk('public')->put('thumb', $form_data['thumb']);
            $form_data['thumb'] = $path;
        }
        if($request->hasFile('cv')){
            $path = Storage::disk('public')->put('cv', $form_data['cv']);
            $form_data['cv'] = $path;
        }
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
        if ($doctor->user_id !== auth()->id()) {
            abort(403, 'Azione non autorizzata.');
        }
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
        if ($doctor->user_id !== auth()->id()) {
            abort(403, 'Azione non autorizzata.');
        }

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
        if ($doctor->user_id !== auth()->id()) {
            abort(403, 'Azione non autorizzata.');
        }

        $form_data = $request->validated();

        $form_data['slug'] = Doctor::createSlug($form_data['user_name'] . $form_data['user_surname']);

        if($request->hasFile('thumb')){
            if(!Str::startsWith($doctor->thumb, 'https')){
                Storage::disk('public')->delete($doctor->thumb);
            }
            $path = Storage::disk('public')->put('thumb', $form_data['thumb']);
            $form_data['thumb'] = $path;
        }
        if($request->hasFile('thumb')){
            if($doctor->cv){
                Storage::disk('public')->delete($doctor->cv);
            }
            $path = Storage::disk('public')->put('cv', $form_data['cv']);
            $form_data['cv'] = $path;
        }

        $doctor->fill($form_data);
        $doctor->save();

        if ($request->has('fields')) {
            $fields = $request->fields;
            $doctor->fields()->sync($fields);
        }

        
        return redirect()->route('admin.doctors.show', ['doctor' => $doctor->slug]);
                     
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
