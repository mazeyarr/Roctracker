<?php

// Dashboard
Breadcrumbs::register('dashboard', function($breadcrumbs)
{
    $breadcrumbs->push('Dashboard', route('dashboard'));
});

// Dashboard / Colleges
Breadcrumbs::register('colleges', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Colleges', route('colleges'));
});

// Dashboard / Teamleaders
Breadcrumbs::register('teamleaders', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Teamleiders', route('teamleaders'));
});

// Dashboard / Assessors
Breadcrumbs::register('assessors', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Assessoren', route('assessors'));
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