// รอจน DOM โหลดเสร็จ
document.addEventListener('DOMContentLoaded', () => {
  // ดึงปุ่ม Toggle และ Sidebar
  const toggleButton = document.getElementById('toggleSidebar');
  const sidebar = document.getElementById('sidebar');
  const content = document.getElementById('content'); // หากมีการปรับขนาด Content

  // ตรวจสอบว่าปุ่มและ Sidebar มีอยู่ใน DOM
  if (toggleButton && sidebar) {

    toggleButton.addEventListener('click', () => {

      // สลับคลาส hidden หรือ full-width
      sidebar.classList.toggle('hidden');

      // หากต้องการปรับ Content ให้เต็มจอเมื่อ Sidebar ถูกซ่อน
      if (content) {
        // console.log("full width ทำงาน");
        content.classList.toggle('full-width');
      }
    });
  } else {
    console.error("Sidebar or Toggle button not found in DOM.");
  }
});
