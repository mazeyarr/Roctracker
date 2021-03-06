<?php

// Dashboard
Breadcrumbs::register('assessor_message_standard', function($breadcrumbs)
{
    $breadcrumbs->push('Standaard Assessor Berichten', route('assessor_message_standard'));
});

// Dashboard
Breadcrumbs::register('assessor_message_incidenteel', function($breadcrumbs)
{
    $breadcrumbs->push('Incidentele Assessor Berichten', route('assessor_message_incidenteel'));
});

// ----------------------------^ TEMP ^--------------------------------------

// Dashboard
Breadcrumbs::register('dashboard', function($breadcrumbs)
{
    $breadcrumbs->push('Dashboard', route('dashboard'));
});

Breadcrumbs::register('advanced_search', function($breadcrumbs)
{
    $breadcrumbs->push('Geavanceerd Zoeken', route('advanced_search'));
});

// Profile
Breadcrumbs::register('profile', function($breadcrumbs)
{
    $breadcrumbs->push('Uw Profiel', route('profile'));
});


// -------------------------------  COLLEGES ----------------------------------- //
// Dashboard / Colleges
Breadcrumbs::register('colleges', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Colleges', route('colleges'));
});

// Dashboard / Colleges / View College
Breadcrumbs::register('view_colleges', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('colleges');
    $breadcrumbs->push(\App\College::find($id)->name, route('view_colleges', $id));
});

// Dashboard / Colleges / Change College
Breadcrumbs::register('change_colleges', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('colleges');
    $breadcrumbs->push(\App\College::find($id)->name, route('change_colleges', $id));
});

// Dashboard / Colleges / Change College / Selection
Breadcrumbs::register('change_college_assessors', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('colleges');
    $breadcrumbs->push(\App\College::find($id)->name, route('change_college_assessors', $id));
});

// Dashboard / Colleges / Add
Breadcrumbs::register('add_college', function($breadcrumbs)
{
    $breadcrumbs->parent('colleges');
    $breadcrumbs->push('College Toevoegen', route('add_college'));
});

// Dashboard / Details / College
Breadcrumbs::register('view_college_details', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push("College Details", route('view_college_details', $id));
});
//------------ ------------------------- end ---------------------------------- //


// ------------------------------------ TEAMLEADERS ------------------------------------- //
// Dashboard / Teamleaders
Breadcrumbs::register('teamleaders', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Teamleiders', route('teamleaders'));
});

// Dashboard / Teamleaders / View Teamleaders
Breadcrumbs::register('view_teamleaders', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('teamleaders');
    $breadcrumbs->push(\App\Teamleaders::find($id)->name, route('view_teamleaders', $id));
});

// Dashboard / Teamleaders / Change Teamleader
Breadcrumbs::register('change_teamleaders', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('teamleaders');
    $breadcrumbs->push(\App\Teamleaders::find($id)->name, route('change_teamleaders', $id));
});

// Dashboard / Teamleader / Teamleader Toevoegen
Breadcrumbs::register('add_teamleader', function($breadcrumbs)
{
    $breadcrumbs->parent('teamleaders');
    $breadcrumbs->push("Teamleider Toevoegen", route('add_teamleader'));
});

// Dashboard / Teamleader / Teamleader Toevoegen / Manueel Toevoegen
Breadcrumbs::register('add_teamleader_manual', function($breadcrumbs)
{
    $breadcrumbs->parent('add_teamleader');
    $breadcrumbs->push("Teamleider Manueel Toevoegen", route('add_teamleader_manual'));
});

// Dashboard / Teamleader / Teamleader Automatisch Toevoegen
Breadcrumbs::register('add_teamleader_change_save', function($breadcrumbs)
{
    $breadcrumbs->parent('add_teamleader');
    $breadcrumbs->push("Teamleider veranderen", route('add_teamleader_change_save'));
});

//------------ ------------------------- end -------------------------------------------- //


// ---------------------------------- ASSESSORS ----------------------------------------- //
// Dashboard / Assessors
Breadcrumbs::register('assessors', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Assessoren', route('assessors'));
});

// Dashboard / Assessors / View Assessor
Breadcrumbs::register('view_assessor', function($breadcrumbs, $id)
{

    $breadcrumbs->parent('assessors');
    $breadcrumbs->push(\App\Assessors::find($id)->name, route('view_assessor', $id));
});

// Dashboard / Assessors / View Assessor profile
Breadcrumbs::register('view_assessor_profiel', function($breadcrumbs, $id)
{

    $breadcrumbs->parent('assessors');
    $breadcrumbs->push(\App\Assessors::find($id)->name, route('view_assessor_profiel', $id));
});

// Dashboard / Assessors / Change Assessor
Breadcrumbs::register('change_assessor', function($breadcrumbs, $id)
{

    $breadcrumbs->parent('assessors');
    $breadcrumbs->push(\App\Assessors::find($id)->name, route('change_assessor', $id));
});

// Dashboard / Assessors / Assessors Toevoegen
Breadcrumbs::register('add_assessor', function($breadcrumbs)
{

    $breadcrumbs->parent('assessors');
    $breadcrumbs->push("Assessoren Toevoegen", route('add_assessor'));
});

// Dashboard / Assessors / Assessors Manueel Toevoegen
Breadcrumbs::register('add_assessor_manual', function($breadcrumbs)
{

    $breadcrumbs->parent('add_assessor');
    $breadcrumbs->push("Assessoren Manueel Toevoegen", route('add_assessor_manual'));
});

// Dashboard / Assessors / Assessors Automatisch Toevoegen
Breadcrumbs::register('add_assessor_automatic', function($breadcrumbs)
{

    $breadcrumbs->parent('add_assessor');
    $breadcrumbs->push("Assessoren Automatisch Toevoegen", route('add_assessor_automatic'));
});
//------------ ------------------------- end ------------------------------------------- //

// ---------------------------------- Assessor Maintenance ----------------------------- //

// Dashboard / Assessor Maintenance
Breadcrumbs::register('maintenance_assessor', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push("Onderhouds Overzicht", route('maintenance_assessor'));
});

// Dashboard / Assessor Maintenance / Draft Groups
Breadcrumbs::register('maintenance_assessor_groups', function($breadcrumbs)
{
    $breadcrumbs->parent('maintenance_assessor');
    $breadcrumbs->push("Onderhouds Groepen", route('maintenance_assessor_groups'));
});

//------------ ------------------------- end ------------------------------------------- //

// ---------------------------------- Search Results ------------------------------------ //

// Dashboard / Assessor Maintenance
Breadcrumbs::register('search', function($breadcrumbs)
{
    $breadcrumbs->push("Zoek Resultaten", route('search'));
});

//------------ ------------------------- end ------------------------------------------- //

// ---------------------------------- Officials ------------------------------------ //

// Officials / Constructors
Breadcrumbs::register('constructors', function($breadcrumbs)
{
    $breadcrumbs->parent('officials_home');
    $breadcrumbs->push("Constructeurs", route('constructors'));
});
// Officials
Breadcrumbs::register('officials_home', function($breadcrumbs)
{
    $breadcrumbs->push("Functionarissen", route('officials_home'));
});

// Officials / Detectors
Breadcrumbs::register('detectors', function($breadcrumbs)
{
    $breadcrumbs->parent('officials_home');
    $breadcrumbs->push("Vaststellers", route('detectors'));
});

// Officials / Exam Comittee
Breadcrumbs::register('exam-comittee', function($breadcrumbs)
{
    $breadcrumbs->parent('officials_home');
    $breadcrumbs->push("Examencommissie", route('exam-comittee'));
});

// Officials / Surveyors
Breadcrumbs::register('surveyors', function($breadcrumbs)
{
    $breadcrumbs->parent('officials_home');
    $breadcrumbs->push("Surveillanten", route('surveyors'));
});

// Officials / Staff Exam Office
Breadcrumbs::register('staff-exam-office', function($breadcrumbs)
{
    $breadcrumbs->parent('officials_home');
    $breadcrumbs->push("Examenbureau", route('staff-exam-office'));
});

//------------ ------------------------- end ------------------------------------------- //

// ---------------------------------- Notifications ------------------------------------ //

// Notifications / Overview
Breadcrumbs::register('notification_overview', function($breadcrumbs)
{
    $breadcrumbs->push("Berichten", route('notification_overview'));
});

// Notifications / Overview / View
Breadcrumbs::register('notification_view', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('notification_overview');
    $breadcrumbs->push("Bericht bekijken", route('notification_view', $id));
});

// Notifications / Create
Breadcrumbs::register('notification_create', function($breadcrumbs)
{
    $breadcrumbs->push("Berichten Aanmaken", route('notification_create'));
});

//------------ ------------------------- end ------------------------------------------- //

// Users
Breadcrumbs::register('users', function($breadcrumbs)
{
    $breadcrumbs->push('Administratoren', route('users'));
});

// new users
Breadcrumbs::register('add_users', function($breadcrumbs)
{
    $breadcrumbs->parent('users');
    $breadcrumbs->push('Administratoren toevoegen', route('add_users'));
});