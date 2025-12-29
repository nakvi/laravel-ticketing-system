@extends('layouts.guest')

@section('title', 'Terms of Service')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h2 class="mb-0">Terms of Service</h2>
                    <p class="mb-0 mt-2">Last updated: December 29, 2025</p>
                </div>
                <div class="card-body p-5">
                    <p>By using our Ticketing System, you agree to these Terms of Service.</p>

                    <h5 class="mt-4">1. Use of Service</h5>
                    <p>You may use the service to submit and track support tickets.</p>

                    <h5 class="mt-4">2. Account Responsibilities</h5>
                    <ul>
                        <li>Keep your password secure</li>
                        <li>Provide accurate information</li>
                        <li>Do not share your account</li>
                    </ul>

                    <h5 class="mt-4">3. Prohibited Activities</h5>
                    <ul>
                        <li>Submit spam or malicious content</li>
                        <li>Attempt to hack or disrupt the service</li>
                        <li>Upload illegal or harmful files</li>
                    </ul>

                    <h5 class="mt-4">4. Ticket Handling</h5>
                    <p>We aim to respond within 24-48 hours. Resolution time varies by issue complexity.</p>

                    <h5 class="mt-4">5. Limitation of Liability</h5>
                    <p>We are not liable for indirect damages or data loss.</p>

                    <h5 class="mt-4">6. Changes to Terms</h5>
                    <p>We may update these terms. Continued use means acceptance.</p>

                    <h5 class="mt-4">7. Contact</h5>
                    <p>Questions: support@yourcompany.com</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection