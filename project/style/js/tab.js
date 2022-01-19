// Để biến $ thay thế phải gõ lại chuỗi document.querySelector.bind(document);
    const $ = document.querySelector.bind(document);
    const $$ = document.querySelectorAll.bind(document);

    // Lấy ra những tg có class=
    const tabs = $$(".tab-item");
    const panes = $$(".tab-pane");

    // Lấy kích thước của từng tab tiêu đề khi ta click. TH viết ở đây để chạy mặc đinh tab đầu
    const tabActive = $(".tab-item.active");
    const line = $(".tabs .line");

    line.style.left = tabActive.offsetLeft + "px";
    // offsetWidth kích thước chiều ngang của line. Set nó vào thuộc tính left vs width của line
    line.style.width = tabActive.offsetWidth + "px";

    tabs.forEach((tab, index) => {
        // khi click vào tab thì có thể lấy được content tương ứng
        const pane = panes[index];

        // tab.onclick để lắng nghe sự kiện trên các tab
        tab.onclick = function () {
        
        // Tìm những thằng đã active thì xóa;
        $(".tab-item.active").classList.remove("active");
        $(".tab-pane.active").classList.remove("active");

        line.style.left = this.offsetLeft + "px";
        line.style.width = this.offsetWidth + "px";

        this.classList.add("active");
        pane.classList.add("active");
        };
    }
	);