// JavaScript for Sidebar Toggle
document.addEventListener('DOMContentLoaded', () => {
  const sidebar = document.getElementById('sidebar');
  const content = document.getElementById('content');
  const toggleButton = document.getElementById('toggleSidebar');

  toggleButton.addEventListener('click', () => {
    sidebar.classList.toggle('closed');
    if (sidebar.classList.contains('closed')) {
      content.classList.remove('sidebar-open');
      content.classList.add('sidebar-closed');
    } else {
      content.classList.remove('sidebar-closed');
      content.classList.add('sidebar-open');
    }
  });
});
