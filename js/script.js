// รอจน DOM โหลดเสร็จ
document.addEventListener('DOMContentLoaded', () => {
  // ดึงปุ่ม Toggle และ Sidebar
  const toggleButton = document.getElementById('toggleSidebar');
  const sidebar = document.getElementById('sidebar');
  const content = document.getElementById('content');

  // ตรวจสอบว่าปุ่มและ Sidebar มีอยู่ใน DOM
  if (toggleButton && sidebar) {

    toggleButton.addEventListener('click', () => {
      console.log("กด sidebar แล้วโว้ยยยยย");
      if (window.innerWidth > 767 && screen.width > 768) {
        sidebar.classList.toggle("hidden");
        content.classList.toggle("full-width");
      } else {
        sidebar.classList.toggle("active");
      }
    });
  } else {
    console.error("Sidebar or Toggle button not found in DOM.");
  }
});


function toggleFullscreen() {
  const content = document.getElementById('content');
  if (!document.fullscreenElement) {
    content.requestFullscreen();
  } else {
    document.exitFullscreen();
  }
}


// เมื่อหน้าโหลดเสร็จ
window.addEventListener("load", function () {
  // เลื่อนไปยังตำแหน่งบนสุด
  window.scrollTo(0, 0);
});


