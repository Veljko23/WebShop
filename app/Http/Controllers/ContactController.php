<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        
//        if($request->isMethod('POST')){
//            
//        }
        
        $systemMessage = session()->pull('system_message');
        
        return view('front.contact.index', [
            'systemMessage' => $systemMessage,
        ]);
    }
    
    public function sendMessage(Request $request)
    {
        //input funkcija sluzi za dobijanje POST parametara
        //query funkcija sluzi za dobijanje GET parametara iz URL ?page=3
        
        //validate validira podatke sa forme i vraca niz podataka sa forme AKO JE SVE U REDU!
        //ako nije u redu, baca se ValidationException
        //u slucaju ValidationExceptiona Laravel automatski vraca na prikaz forme
        $formData = $request->validate([
            'name' => 'required|string|min:2',
            'email' => ['required', 'email'],
            'message' => ['required', 'string', 'min:50', 'max:250'], 
        ],
        );
        
        // SLANJE MEJLA
        //dd($formData);
        \Mail::to('borinaborina@gmail.com')->send(new ContactFormMail(
                $formData['email'],
                $formData['name'],
                $formData['message']
         ));
        
        //session()->put() upis u sesiju
        session()->flash( // kratkotrajan upis u sesiju, gubi se u narednom requestu
                'system_message', 
                __('We have received your message') //data je mogucnost prevodjenja
        );
        
        //$request->session();
        //dd($formData);
        
        //vraca na prethodnu stranicu
        //return redirect()->route('front.contact.index'); //vratice na rutu
        return redirect()->back(); //vratice na prethodnu stranicu
    }
}
