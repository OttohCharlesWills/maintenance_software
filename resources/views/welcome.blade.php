<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>AppName</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-white">

<!-- NAVBAR -->
<nav class="fixed top-0 left-0 right-0 bg-white border-b z-50">
<div class="max-w-7xl mx-auto px-4">
<div class="flex justify-between items-center h-16">

<div class="flex items-center gap-2">
<div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg"></div>
<span class="text-xl font-semibold">AppName</span>
</div>

<div class="flex gap-4 items-center">
{{-- <a href="#features" class="text-gray-600 hover:text-black hidden sm:block">Features</a>
<a href="#about" class="text-gray-600 hover:text-black hidden sm:block">About</a> --}}

<button onclick="login()" class="bg-blue-600 text-white px-6 py-2 rounded-lg">
    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
</button>

</div>

</div>
</div>
</nav>


<!-- HERO -->
<section class="pt-32 pb-20 px-4">
<div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 items-center">

<div>

<h1 class="text-5xl font-bold mb-6">
Build Your Future with 
<span class="text-blue-600">Modern Software</span>
</h1>

<p class="text-xl text-gray-600 mb-8">
Transform your business with our powerful web application.
Streamline workflows and boost productivity.
</p>

<div class="flex gap-4">

<button onclick="login()" class="bg-blue-600 text-white px-8 py-4 rounded-lg">
Get Started
</button>

<button class="border px-8 py-4 rounded-lg">
Learn More
</button>

</div>

<div class="flex gap-6 mt-8 text-gray-600">

<div>✔ No credit card required</div>
<div>✔ Free trial</div>

</div>

</div>

<div>
<img src="https://images.unsplash.com/photo-1763718528755-4bca23f82ac3?auto=format&fit=crop&w=1080&q=80"
class="rounded-2xl shadow-xl w-full">
</div>

</div>
</section>


<!-- FEATURES -->
<section id="features" class="py-20 bg-gray-50">

<div class="max-w-7xl mx-auto px-4">

<div class="text-center mb-16">
<h2 class="text-4xl font-bold mb-4">
Everything you need to succeed
</h2>

<p class="text-gray-600 text-xl">
Tools to take your business to the next level.
</p>
</div>


<div class="grid md:grid-cols-3 gap-8">

<div class="bg-white p-8 rounded-xl shadow">
<h3 class="text-xl font-semibold mb-3">Lightning Fast</h3>
<p class="text-gray-600">
Experience blazing fast performance with optimized infrastructure.
</p>
</div>

<div class="bg-white p-8 rounded-xl shadow">
<h3 class="text-xl font-semibold mb-3">Secure & Reliable</h3>
<p class="text-gray-600">
Enterprise-grade security protecting your data.
</p>
</div>

<div class="bg-white p-8 rounded-xl shadow">
<h3 class="text-xl font-semibold mb-3">Team Collaboration</h3>
<p class="text-gray-600">
Work seamlessly with your team in real-time.
</p>
</div>

</div>

</div>
</section>


<!-- ABOUT -->
<section id="about" class="py-20">

<div class="max-w-7xl mx-auto px-4 grid lg:grid-cols-2 gap-12 items-center">

<img src="https://images.unsplash.com/photo-1601509876296-aba16d4c10a4?auto=format&fit=crop&w=1080&q=80"
class="rounded-2xl shadow-xl">

<div>

<h2 class="text-4xl font-bold mb-6">
Built for teams of all sizes
</h2>

<p class="text-gray-600 mb-6">
Whether you're a startup or enterprise, our platform scales with you.
</p>

<ul class="space-y-3 text-gray-700">

<li>✔ Real-time collaboration</li>
<li>✔ Advanced analytics</li>
<li>✔ Custom workflows</li>
<li>✔ App integrations</li>
<li>✔ 24/7 support</li>

</ul>

</div>

</div>

</section>


<!-- CTA -->
<section class="py-20 bg-gradient-to-br from-blue-600 to-purple-600 text-center text-white">

<h2 class="text-4xl font-bold mb-6">
Ready to get started?
</h2>

<p class="text-xl mb-8">
Join thousands of teams already using our platform.
</p>

<button onclick="login()" class="bg-white text-blue-600 px-8 py-4 rounded-lg">
Start Free Trial
</button>

</section>


<!-- FOOTER -->
<footer class="bg-gray-900 text-gray-400 py-12">

<div class="max-w-7xl mx-auto px-4 grid md:grid-cols-4 gap-8">

<div>
<h3 class="text-white font-semibold mb-4">AppName</h3>
<p>Building the future of web apps.</p>
</div>

<div>
<h3 class="text-white font-semibold mb-4">Product</h3>
<ul>
<li>Features</li>
<li>Pricing</li>
<li>Security</li>
</ul>
</div>

<div>
<h3 class="text-white font-semibold mb-4">Company</h3>
<ul>
<li>About</li>
<li>Blog</li>
<li>Careers</li>
</ul>
</div>

<div>
<h3 class="text-white font-semibold mb-4">Support</h3>
<ul>
<li>Help Center</li>
<li>Contact</li>
<li>Status</li>
</ul>
</div>

</div>

<div class="text-center mt-8 text-sm">
© 2026 AppName
</div>

</footer>


</body>
</html>