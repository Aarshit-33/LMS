<?php include_once("../head.php"); ?>
<style>
    @import "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css";

    #context-menus {
        position: fixed;
        top: 100px;
        left: 10px;
        background: #fdfdfd;
        width: 250px;
        box-shadow: 3px 3px 5px 3px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        transform: scale(0);
        transform-origin: top left;
        z-index: 999999999999999;
        overflow-x: auto;
    }

    #context-menus.visible {
        transform: scale(1);
        transition: transform 250ms ease-in-out;
        z-index: 999999999999999;
    }

    #context-menus .list {
        border-bottom: 1px solid #eee;
    }

    #context-menus .item {
        position: relative;
        padding: 10px;
        font-size: 14px;
        color: #555;
        cursor: pointer;
    }

    #context-menus .item i {
        display: inline-block;
        width: 20px;
        margin-right: 5px;
    }

    #context-menus .item:before {
        content: "";
        position: absolute;
        top: 0px;
        left: 0px;
        width: 0%;
        height: 100%;
        background: #eee;
        z-index: -1;
        transition: all 150ms ease-in-out;
    }

    #context-menus .list .item:hover:before {
        width: 100%;
    }
</style>




<div id="context-menus">
    <div class="list">
        <div class="item" onclick="javascript:history.go(0);">
            <a class="nav-item" style="color: #6F6F6F;">
                <i class="fa uil-refresh"></i>
                Refresh</a>
        </div>
        <div class="item" onclick="window.location.href='logout.php';">
            <a class="nav-item" style="color: #6F6F6F;">
                <i class="fa uil-signout"></i>
                Logout</a>
        </div>
    </div>
    <div class="list">
        <div class="item" onclick="window.location.href='student_list.php';">
            <a class="nav-item" style="color: #6F6F6F;">
                <i class="fe uil-user"></i>
                Students</a>
        </div>
        <div class="item" onclick="window.location.href='faculty_list.php';">
            <a class="nav-item" style="color: #6F6F6F;">
                <i class="fe uil-graduation-cap"></i>
                Faculties</a>
        </div>
        <div class="item" onclick="window.location.href='';">
            <a class="nav-item" style="color: #6F6F6F;">
                <i class="fe uil-code-branch"></i>
                Branches</a>
        </div>
        <div class="item" onclick="window.location.href='subject_list.php';">
            <a class="nav-item" style="color: #6F6F6F;">
                <i class="fe uil-book"></i>
                Subjects</a>
        </div>
        <div class="item" onclick="window.location.href='update_list.php';">
            <a class="nav-item" style="color: #6F6F6F;">
                <i class="fe fe-bell"></i>
                Updates</a>
        </div>
    </div>
    <div class="list">
        <div class="item" onclick="window.location.href='student_queries.php';">
            <a class="nav-item" style="color: #6F6F6F;">
                <i class="fa uil-question-circle"></i>
                Student Queries</a>
        </div>
    </div>
    <div class="list">
        <div class="item" onclick="window.location.href='institute_perks.php';">
            <a class="nav-item" style="color: #6F6F6F;">
                <i class="fa uil-user"></i>
                Institute Perks</a>
        </div>
    </div>
</div>

<script>
    window.addEventListener("contextmenu", e => e.preventDefault());
    const contextMenu = document.getElementById("context-menus");
    const scope = document.querySelector("body");

    const normalizePozition = (mouseX, mouseY) => {
        // ? compute what is the mouse position relative to the container element (scope)
        let {
            left: scopeOffsetX,
            top: scopeOffsetY,
        } = scope.getBoundingClientRect();

        scopeOffsetX = scopeOffsetX < 0 ? 0 : scopeOffsetX;
        scopeOffsetY = scopeOffsetY < 0 ? 0 : scopeOffsetY;

        const scopeX = mouseX - scopeOffsetX;
        const scopeY = mouseY - scopeOffsetY;

        // ? check if the element will go out of bounds
        const outOfBoundsOnX =
            scopeX + contextMenu.clientWidth > scope.clientWidth;

        const outOfBoundsOnY =
            scopeY + contextMenu.clientHeight > scope.clientHeight;

        let normalizedX = mouseX;
        let normalizedY = mouseY;

        // ? normalize on X
        if (outOfBoundsOnX) {
            normalizedX =
                scopeOffsetX + scope.clientWidth - contextMenu.clientWidth;
        }

        // ? normalize on Y
        if (outOfBoundsOnY) {
            normalizedY =
                scopeOffsetY + scope.clientHeight - contextMenu.clientHeight;
        }

        return {
            normalizedX,
            normalizedY
        };
    };

    scope.addEventListener("contextmenu", (event) => {
        event.preventDefault();

        const {
            clientX: mouseX,
            clientY: mouseY
        } = event;

        const {
            normalizedX,
            normalizedY
        } = normalizePozition(mouseX, mouseY);

        contextMenu.classList.remove("visible");

        contextMenu.style.top = `${normalizedY}px`;
        contextMenu.style.left = `${normalizedX}px`;

        setTimeout(() => {
            contextMenu.classList.add("visible");
        });
    });

    scope.addEventListener("click", (e) => {
        // ? close the menu if the user clicks outside of it
        if (e.target.offsetParent != contextMenu) {
            contextMenu.classList.remove("visible");
        }
    });
</script>