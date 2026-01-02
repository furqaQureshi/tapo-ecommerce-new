<div class="modal fade" id="pointSettingsModal" tabindex="-1" aria-labelledby="pointSettingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pointSettingsModalLabel">Point Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="pointSettingsForm">
                    @csrf
                    <div class="mb-3">
                        <label for="points_per_rm" class="form-label">Points</label>
                        <input type="number" step="0.01" class="form-control" id="points_per_rm"
                            name="points_per_rm" required
                            value="{{ $point_setting ? $point_setting->points_per_rm : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="rm_per_point" class="form-label">Conversion in RM</label>
                        <input type="number" step="0.01" class="form-control" id="rm_per_point" name="rm_per_point"
                            required value="1" readonly>
                    </div>
                    <div class="d-flex gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                {{ date('Y') }} <span>@</span>{{ config('app.name') }}.
            </div>
            <div class="col-sm-6">
                {{-- <div class="text-sm-end d-none d-sm-block">
                    Design & Develop by Themesbrand
                </div> --}}
            </div>
        </div>
    </div>
</footer>
