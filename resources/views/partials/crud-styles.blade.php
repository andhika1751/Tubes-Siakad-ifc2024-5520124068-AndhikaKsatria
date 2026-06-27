@once
@push('styles')
<style>
    /* Card umum */
    .card { background: #fff; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden; margin-bottom: 1.5rem; }
    .card-header { background: #f7f7f7; padding: 0.8rem 1.2rem; font-weight: 600; border-bottom: 1px solid #e0e0e0; }
    .card-body { padding: 1.2rem; }
    .form-max { max-width: 550px; }
    .page-title { font-size: 1.6rem; font-weight: 700; margin-bottom: 1.2rem; color: #222; }

    table { width: 100%; border-collapse: collapse; }
    table th, table td { padding: 0.6rem 0.9rem; border-bottom: 1px solid #eee; font-size: 0.88rem; text-align: left; }
    table th { background: #fafafa; font-weight: 600; color: #444; }
    table tr:hover td { background: #fafafa; }

    .detail-table td:first-child { font-weight: 600; width: 200px; color: #555; background: #fafafa; }

    /* Form */
    .form-group { margin-bottom: 1.2rem; }
    label { display: block; font-size: 0.85rem; font-weight: 600; color: #333; margin-bottom: 0.35rem; }
    input[type="text"], input[type="number"], input[type="time"], input[type="email"], input[type="password"], select {
        width: 100%; padding: 0.5rem 0.8rem; border: 1px solid #ccc; border-radius: 4px;
        font-size: 0.875rem; color: #333; outline: none; transition: border-color 0.2s;
        background: #fff;
    }
    input:focus, select:focus { border-color: #1976D2; box-shadow: 0 0 0 3px rgba(25,118,210,0.1); }
    .is-invalid { border-color: #e53935 !important; }
    .invalid-feedback { color: #e53935; font-size: 0.78rem; margin-top: 0.3rem; }

    /* Buttons */
    .btn { display: inline-block; padding: 0.45rem 0.9rem; border-radius: 4px; font-size: 0.82rem;
           font-weight: 600; text-decoration: none; border: none; cursor: pointer; }
    .btn-primary   { background: #1976D2; color: #fff; }
    .btn-secondary { background: #757575; color: #fff; }
    .btn-warning   { background: #f0ad4e; color: #fff; }
    .btn-danger    { background: #e53935; color: #fff; }
    .btn-info      { background: #17a2b8; color: #fff; }
    .btn-success   { background: #2e7d32; color: #fff; }
    .btn-group { display: flex; gap: 0.5rem; flex-wrap: wrap; }
    .aksi-cell { display: flex; gap: 0.4rem; flex-wrap: wrap; }
    .mb-3 { margin-bottom: 0.8rem; }
    .mb-4 { margin-bottom: 1.2rem; }

    /* Dashboard stat cards */
    .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 1rem; margin-bottom: 1.5rem; }
    .stat-card { padding: 1.3rem; border-radius: 10px; color: #fff; box-shadow: 0 2px 6px rgba(0,0,0,0.08); }
    .stat-number { font-size: 2rem; font-weight: 800; line-height: 1; }
    .stat-label { font-size: 0.85rem; margin-top: 0.4rem; opacity: 0.95; }
    .stat-blue   { background: linear-gradient(135deg, #1976D2, #1565C0); }
    .stat-green  { background: linear-gradient(135deg, #2e7d32, #1b5e20); }
    .stat-orange { background: linear-gradient(135deg, #f57c00, #e65100); }
    .stat-purple { background: linear-gradient(135deg, #6a1b9a, #4a148c); }
    .stat-red    { background: linear-gradient(135deg, #e53935, #b71c1c); }
</style>
@endpush
@endonce
