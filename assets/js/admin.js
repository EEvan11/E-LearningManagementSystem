document.addEventListener('DOMContentLoaded', function() {
    console.log('Role-specific JS Loaded');
    // Add role-specific scripts here
});

// Scripts specific to the admin interface in the E-Learning Management System

// Example function to confirm deletion of a record (can be used for user, subject, class deletions, etc.)
function confirmDeletion(itemName) {
    return confirm("Are you sure you want to delete " + itemName + "? This action cannot be undone.");
}
