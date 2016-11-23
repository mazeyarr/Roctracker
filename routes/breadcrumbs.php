<?php

// Dashboard
Breadcrumbs::register('dashboard', function($breadcrumbs)
{
    $breadcrumbs->push('Dashboard', route('dashboard'));
});

// Users
Breadcrumbs::register('users', function($breadcrumbs)
{
    $breadcrumbs->push('Gebruikers', route('users'));
});