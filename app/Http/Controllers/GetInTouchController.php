<?php

namespace App\Http\Controllers;

use App\Models\GetInTouch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class GetInTouchController extends Controller
{
    // public function index() {
    //     $contact = GetInTouch::all();
    //     return response()->json($contact);
    // }
    /**
     * Store a new contact form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Define valid support options based on the dropdown in the form
        $validSupport = ['Sales', 'Career', 'Partnership', 'Billing', 'Media', 'Others'];
        
        // Validate the request 
        $request->validate([
            'name' => ['required', 'string', 'regex:/^[\p{L}\sà-ỹÀ-Ỵ]+$/u', 'min:6', 'max:30'],
            'email' => [
                'required',
                'string',
                'email:rfc,strict,dns',
                'max:254'
                ,
                'unique:' . GetInTouch::class
            ],
            'country' => ['required','string'],
            'companyname' => ['required', 'string', 'max:255'],
            'choose_support' => ['required', Rule::in($validSupport)],
            'project_details' => ['required', 'string']
        ], [ // show error messages to user.

            'name.required' => 'Name must not be empty !',
            'name.regex' => 'Name must only contain letters !',
            'name.min' => 'Name must be at least 6 characters !',
            'name.max' => 'Name must be at most 30 characters !',

            'email.required' => 'Email must not be empty !',
            'email.email' => 'Email is invalid !',
            'email.max' => 'Email must be at most 254 characters !',
            'email.unique' => 'Email already exists !',

            'country.required' => 'Country must not be empty !',
            'country.string' => 'Country must be a string !',

            'companyname.required' => 'Company name must not be empty !',
            'companyname.string' => 'Company name must be a string !',
            'companyname.max' => 'Company name must be at most 255 characters !',

            'choose_support.required' => 'Support must not be empty !',
            'choose_support.in' => 'Support is not in our list !',

            'project_details.required' => 'Project details must not be empty !',
            'project_details.string' => 'Project details must be a string !',
        ]);

        // Create and store the contact submission
        GetInTouch::create([
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country,
            'companyname' => $request->companyname,
            'choose_support' => $request->choose_support,
            'project_details' => $request->project_details,
        ]);

        // Redirect back with success message
        return response()->json([
            'success' => true,
            'message' => 'We have received your message, we will contact you soon!',
            'redirect_url' => url('/') // This will redirect to the home page
        ]);
    }
}