@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Some notes about this Web App</h1>
        </div>
        <div class="col-12 pl-5 mt-5">
            <h2>Testing Data: </h2>
            <p>Currently in development stages the web app has testing data generating factories. so once you set up your relational database in the .env file remember to migrate the tables with --seed flag i.e <code>php artisan migrate --seed</code> so the web app will be easier to test for quality assurance.</p>
        </div>
        <div class="col-12 pl-5 mt-5">
            <h2>Email: </h2>
            <p>Currently in development stages the emails are sent to the log file of laravel which is under <code>Storage/logs/laravel.log</code> . But you are free to use any mail drivers i.e mailgun postmark etc just set it up your own mail driver keys in your .env file and then the emails will be forwarded to real emails automatically. </p>
        </div>
        <div class="col-12 pl-5 mt-5">
            <h2>Stripe: </h2>
            <p>The web app supports all kinds of credit cards payments even the ones with Strong Customer Authentication (SCA) or 3D Secure payments which is required in some countries. So feel free to test the payment with 3D secure methods cards information as well https://stripe.com/docs/testing#regulatory-cards. </p>
        </div>
        <div class="col-12 pl-5 mt-5">
            <h2>Exceptions: </h2>
            <p>The web app throws proper json exceptions customly crafted when an exception occurs instead of throwing the laravel default exceptions which expose sensitive data. </p>
        </div>
        <div class="col-12 pl-5 mt-5">
            <h2>List of this webapp Api's to test with Postman: </h2>
            <pre>  
<code>GET       - api/categories</code>                         Get a list of all categories.
<code>GET       - api/products</code>                           Get list of all Products.
<code>GET       - api/categories/{category}/products</code>     Get list of Products by Category.
<code>POST      - api/categories</code>                         create categories.
<code>PUT|PATCH - api/categories/{category}</code>              update categories.
<code>DELETE    - api/categories/{category}</code>              delete categories.
            </pre>
        </div>
        
    </div>

       
</div>
@endsection