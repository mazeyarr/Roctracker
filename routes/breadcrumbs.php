<?php

// Dashboard
Breadcrumbs::register('dashboard', function($breadcrumbs)
{
    $breadcrumbs->push('Dashboard', route('dashboard'));
});


// -------------------------------  COLLEGES ---------------------------- //
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

// ---------------------------------- ASSESSORS ---------------------------------------- //
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
    $breadcrumbs->push(\App\Teamleaders::find($id)->name, route('view_assessor', $id));
});

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