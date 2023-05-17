// SIDEBAR TOGGLE

var sidebarOpen = false;
var sidebar = document.getElementById("sidebar");

function openSidebar() {
  if(!sidebarOpen) {
    sidebar.classList.add("sidebar-responsive");
    sidebarOpen = true;
  }
}

function closeSidebar() {
  if(sidebarOpen) {
    sidebar.classList.remove("sidebar-responsive");
    sidebarOpen = false;
  }
}

// Sample announcement data
const announcement = {
  title: "Important Announcement",
  message: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed consequat est quis ipsum interdum, vel ultrices lorem bibendum."
};

// Display the announcement
function displayAnnouncement() {
  const titleElement = document.getElementById("announcement-title");
  const messageElement = document.getElementById("announcement-message");

  titleElement.textContent = announcement.title;
  messageElement.textContent = announcement.message;
}

// Edit the announcement
function editAnnouncement() {
  const newTitle = prompt("Enter the new title:");
  const newMessage = prompt("Enter the new message:");

  if (newTitle && newMessage) {
    announcement.title = newTitle;
    announcement.message = newMessage;
    displayAnnouncement();
  }
}

// Delete the announcement
function deleteAnnouncement() {
  if (confirm("Are you sure you want to delete the announcement?")) {
    // Clear the announcement data
    announcement.title = "";
    announcement.message = "";

    // Clear the announcement container
    displayAnnouncement();
  }
}

// Attach event listeners to buttons
document.getElementById("edit-button").addEventListener("click", editAnnouncement);
document.getElementById("delete-button").addEventListener("click", deleteAnnouncement);

// Display the initial announcement
displayAnnouncement();
c
