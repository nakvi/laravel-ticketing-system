<!-- Reusable Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="confirmModalLabel">
                    <i class="ri-alert-line align-bottom me-2"></i>
                    <span id="modal-title">Confirm Action</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <p class="text-center fs-5" id="modal-message">
                    Are you sure you want to perform this action?
                </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary btn-lg px-5" data-bs-dismiss="modal">
                    Cancel
                </button>
                <form id="confirmForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE') <!-- Default for delete, will change for reopen -->
                    <button type="submit" class="btn btn-danger btn-lg px-5" id="confirmButton">
                        Yes, Proceed
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Dynamically Update Modal -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('confirmModal');
    const modalTitle = document.getElementById('modal-title');
    const modalMessage = document.getElementById('modal-message');
    const confirmForm = document.getElementById('confirmForm');
    const confirmButton = document.getElementById('confirmButton');

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal

        // Extract data attributes
        const action = button.getAttribute('data-action');
        const title = button.getAttribute('data-title');
        const message = button.getAttribute('data-message');
        const formAction = button.getAttribute('data-form-action');
        const method = button.getAttribute('data-method') || 'DELETE';

        // Update modal content
        modalTitle.textContent = title || 'Confirm Action';
        modalMessage.textContent = message || 'Are you sure you want to perform this action?';

        // Update form
        confirmForm.action = formAction;

        // Update method (for reopen it's POST, for delete it's DELETE)
        const methodInput = confirmForm.querySelector('input[name="_method"]');
        if (methodInput) {
            methodInput.remove();
        }
        if (method !== 'POST') {
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = method;
            confirmForm.appendChild(methodField);
        }

        // Update button color and text
        confirmButton.className = action === 'delete' 
            ? 'btn btn-danger btn-lg px-5' 
            : 'btn btn-warning btn-lg px-5';
        confirmButton.textContent = action === 'delete' ? 'Yes, Delete' : 'Yes, Reopen';
    });
});
</script>