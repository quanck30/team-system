// 安否リスト処理
// 2026/05/01

document.addEventListener("DOMContentLoaded", () => {
  const rows = document.querySelectorAll(".clickable-row");

  rows.forEach((row) => {
    row.addEventListener("click", function (e) {
      if (e.target.closest("a")) return;

      const url = this.dataset.href;
      if (url) window.location.href = url;
    });
  });
});
