<?php

// Dashboard
Breadcrumbs::register('dashboard', function($breadcrumbs)
{
    $breadcrumbs->push('Dashboard', route('dashboard'));
});

// Dashboard / Teamleaders
Breadcrumbs::register('teamleaders', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Teamleiders', route('teamleaders'));
});

// Dashboard / Colleges
Breadcrumbs::register('college', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Colleges', route('college'));
});

// Dashboard / Colleges
Breadcrumbs::register('add_college', function($breadcrumbs)
{
    $breadcrumbs->parent('college');
    $breadcrumbs->push('College toevoegen', route('add_college'));
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