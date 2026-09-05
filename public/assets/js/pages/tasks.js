/* Page script for tasks */
let tasksDataTable = null;

function openTaskNotesModal(taskId, title, clientName, notes) {
    $("#taskNotesTitleHeader").text(title);
    $("#taskNotesClientSpan").text(clientName);
    
    // Set form action dynamically
    $("#taskNoteForm").attr("action", "/utilities/tasks/" + taskId + "/notes");
    
    // Render notes
    let notesHtml = "";
    if (notes && notes.length > 0) {
        notes.forEach((note, index) => {
            const date = new Date(note.created_at);
            const formattedDate = date.toLocaleString("en-GB", { day: "2-digit", month: "short", year: "numeric", hour: "2-digit", minute: "2-digit", hour12: true });
            notesHtml += `
                <div class="d-flex align-items-start gap-2 border-bottom py-2">
                    <div class="avatar-text avatar-xs bg-soft-primary text-primary rounded-circle mt-0.5 flex-shrink-0" style="width: 20px; height: 20px; display: inline-flex; align-items: center; justify-content: center; font-size: 10px;">${index + 1}</div>
                    <div>
                        <div class="text-muted fs-12">${note.note}</div>
                        <div class="text-muted fs-10 mt-1"><i class="feather-clock me-1"></i>${formattedDate}</div>
                    </div>
                </div>`;
        });
    } else {
        notesHtml = "<div class=\"text-muted fs-12\">No notes yet.</div>";
    }
    $("#taskNotesListContainer").html(notesHtml);
    
    $("#taskNotesModal").modal("show");
}

$(document).ready(function () {
    tasksDataTable = $("#tasksTable").DataTable({
        responsive: true,
        pageLength: 10,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search tasks..."
        },
        columnDefs: [
            { targets: [5], searchable: false, orderable: false }
        ]
    });
});

function filterTaskTable(filter) {
    if (!tasksDataTable) return;
    
    // Reset all searches
    tasksDataTable.search("").columns().search("");
    
    if (filter === "all") {
        tasksDataTable.draw();
    } else if (filter === "Completed" || filter === "Pending") {
        // Search only in column 4 (Status)
        tasksDataTable.column(4).search(filter).draw();
    } else if (filter === "High") {
        // Search only in column 3 (Priority)
        tasksDataTable.column(3).search(filter).draw();
    }
}

document.getElementById("mobile-collapse")?.addEventListener("click", function () {
    document.getElementById("mainSidebar")?.classList.toggle("mob-navigation-active");
});

