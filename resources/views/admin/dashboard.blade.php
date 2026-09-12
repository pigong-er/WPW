@extends('layouts.admin')

@section('title', 'Dashboard - Administrator')

@section('content')
<!-- Bagian Page Header -->
<div class="page-header">
    <div>
    <h1 class="page-title">Dashboard</h1>
    <p class="page-subtitle">An easy way to manage sales with care and precision.</p>
    </div>
</div>

<!-- Grid Layout Statistik dan Chart (salin dari index.html) -->
<div class="row g-4">
    <!-- Stat Card 1 -->
    <div class="col-12">
        <!-- ... Isi baris Stat Card dan Chart (seperti Net Income, Total Return, Revenue) ... -->
        <div class="card alert-green-card">
            <div class="alert-green-text">Sales revenue increased 40% in 1 week</div>
        </div>
    </div>
</div>
@endsection
