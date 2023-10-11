function toggleContent() {
    var content = document.getElementById("parent");
    var button = document.getElementById("toggle-button");
    if (content.style.display === "none") {
        content.style.display = "block";
        button.textContent = "元の投稿を非表示";
    } else {
        content.style.display = "none";
        button.textContent = "元の投稿を表示";
    }
}
