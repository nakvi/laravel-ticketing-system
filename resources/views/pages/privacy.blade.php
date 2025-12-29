@extends('layouts.guest')

@section('title', 'Privacy Policy')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h2 class="mb-0">Privacy Policy</h2>
                    <p class="mb-0 mt-2">Last updated: December 29, 2025</p>
                </div>
                <div class="card-body p-5">
                    <p>We are committed to protecting your privacy. This Privacy Policy explains how we collect, use, and safeguard your information when you use our Ticketing System.</p>

                    <h5 class="mt-4">1. Information We Collect</h5>
                    <ul>
                        <li>Personal information (name, email) when you register</li>
                        <li>Ticket details (title, description, images) you submit</li>
                        <li>Usage data (IP address, browser type, activity logs)</li>
                    </ul>

                    <h5 class="mt-4">2. How We Use Your Information</h5>
                    <ul>
                        <li>To provide and maintain the ticketing service</li>
                        <li>To communicate with you about your tickets</li>
                        <li>To improve our platform and user experience</li>
                        <li>For security and fraud prevention</li>
                    </ul>

                    <h5 class="mt-4">3. Data Sharing</h5>
                    <p>We do not sell your personal data. We may share it with:</p>
                    <ul>
                        <li>Support agents to resolve your tickets</li>
                        <li>Service providers (hosting, analytics)</li>
                        <li>Legal authorities when required</li>
                    </ul>

                    <h5 class="mt-4">4. Data Security</h5>
                    <p>We use industry-standard security measures to protect your data.</p>

                    <h5 class="mt-4">5. Your Rights</h5>
                    <p>You can access, update, or delete your data by contacting us.</p>

                    <h5 class="mt-4">6. Contact Us</h5>
                    <p>For questions: support@yourcompany.com</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection