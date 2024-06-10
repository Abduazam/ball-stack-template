<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>{{ config('app.name', 'Smart Clinic') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
