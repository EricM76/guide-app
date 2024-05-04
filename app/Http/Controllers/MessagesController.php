<?php

namespace App\Http\Controllers;

use App\Mail\MessageContactPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('contact');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        /*  
            dump($request); 
            dump($request->name); 
        */
        $message = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'content' => 'required|min:10'
        ],[
            'name.required' => 'El nombre es obligatorio',
            'email.required' => 'Tu email es obligatorio',
            'email.email' => 'El formato de email es incorrecto',
            'subjet.required' => 'El asunto es obligatorio',
            'content.required' => 'El contenido es obligatorio',
            'content.min' => 'Vamos... escribí un toque más',
        ]);

        Mail::to('menaericdaniel@gmail.com')->send(new MessageContactPage($message));

        return 'Datos correctos!!';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
