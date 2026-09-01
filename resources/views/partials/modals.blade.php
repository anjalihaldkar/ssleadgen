<!-- Modal: Reset Password -->
    <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-key me-2"></i> Reset Advisor Password</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="resetPasswordForm"
                    onsubmit="event.preventDefault(); alert('Password updated successfully!'); $('#resetPasswordModal').modal('hide');">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-13 text-dark">Current Password *</label>
                            <input type="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-13 text-dark">New Password *</label>
                            <input type="password" class="form-control" placeholder="Minimum 8 characters" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-13 text-dark">Confirm New Password *</label>
                            <input type="password" class="form-control" placeholder="Repeat new password" required>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm fw-bold">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Logout Confirmation -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-body p-4 text-center">
                    <div class="avatar-text avatar-lg bg-soft-danger text-danger rounded-circle mx-auto mb-3"
                        style="width: 50px; height: 50px; display: inline-flex; align-items: center; justify-content: center;">
                        <i class="feather-log-out fs-3"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">Confirm Logout</h5>
                    <p class="text-muted fs-13 mb-4">Are you sure you want to log out of your session?</p>
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-light btn-sm px-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger btn-sm px-4 fw-bold"
                            onclick="window.location.href='{{ url('auth/login') }}'">Yes, Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
