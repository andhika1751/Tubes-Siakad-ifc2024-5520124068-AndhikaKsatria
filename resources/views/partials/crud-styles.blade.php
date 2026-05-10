<style>
    .page-title { font-size: 1.65rem; font-weight: 700; color: #1a1a1a; margin-bottom: 1.25rem; }

    /* Buttons */
    .btn { display: inline-block; padding: 0.45rem 1rem; border-radius: 4px; font-size: 0.875rem; font-weight: 600; text-decoration: none; cursor: pointer; border: none; transition: opacity 0.15s, transform 0.1s; line-height: 1.4; }
    .btn:active { transform: scale(0.97); }
    .btn:hover { opacity: 0.85; }
    .btn-primary   { background: #1976D2; color: #fff; }
    .btn-danger    { background: #e53935; color: #fff; }
    .btn-warning   { background: #F9A825; color: #fff; }
    .btn-info      { background: #00BCD4; color: #fff; }
    .btn-secondary { background: #757575; color: #fff; }
    .btn-disabled  { background: #e53935; color: #fff; opacity: 0.5; cursor: not-allowed; pointer-events: none; }

    /* Card */
    .card { background: #fff; border: 1px solid #e0e0e0; border-radius: 6px; overflow: hidden; }
    .card-header { padding: 0.8rem 1.25rem; border-bottom: 1px solid #e0e0e0; font-size: 0.9rem; color: #555; background: #fafafa; }
    .card-body { padding: 1.5rem; }

    /* Table */
    table { width: 100%; border-collapse: collapse; }
    thead tr { background: #f5f5f5; }
    th, td { padding: 0.8rem 1.25rem; text-align: left; font-size: 0.875rem; border-bottom: 1px solid #eee; }
    th { font-weight: 700; color: #333; }
    td { color: #444; }
    tbody tr:hover { background: #fafafa; }
    tbody tr:last-child td { border-bottom: none; }
    .aksi-cell { display: flex; gap: 0.35rem; align-items: center; }

    /* Detail page */
    .detail-table { width: 100%; border-collapse: collapse; }
    .detail-table tr td { padding: 0.7rem 1rem; border-bottom: 1px solid #eee; font-size: 0.9rem; }
    .detail-table tr td:first-child { font-weight: 600; color: #555; width: 200px; background: #fafafa; }
    .detail-table tr:last-child td { border-bottom: none; }

    /* Form */
    .form-group { margin-bottom: 1.2rem; }
    label { display: block; font-size: 0.85rem; font-weight: 600; color: #333; margin-bottom: 0.35rem; }
    input[type="text"], input[type="number"], input[type="time"], select {
        width: 100%; padding: 0.5rem 0.8rem; border: 1px solid #ccc; border-radius: 4px;
        font-size: 0.875rem; color: #333; outline: none; transition: border-color 0.2s;
        background: #fff;
    }
    input:focus, select:focus { border-color: #1976D2; box-shadow: 0 0 0 3px rgba(25,118,210,0.1); }
    .is-invalid { border-color: #e53935 !important; }
    .invalid-feedback { color: #e53935; font-size: 0.78rem; margin-top: 0.25rem; }
    .form-max { max-width: 580px; }
    .btn-group { display: flex; gap: 0.6rem; margin-top: 0.5rem; }
    .mb-4 { margin-bottom: 1.25rem; }
</style>