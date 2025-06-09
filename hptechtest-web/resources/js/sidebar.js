const mobileMenuBtn = document.getElementById('mobile-menu-btn');
const sidebar = document.getElementById('sidebar');
const sidebarOverlay = document.getElementById('sidebar-overlay');
const mainContentWrapper = document.getElementById('main-content-wrapper');
const mainHeader = document.getElementById('main-header');
const mainFooter = document.getElementById('main-footer');

const userMenuButton = document.getElementById('user-menu-button');
const userDropdownMenu = document.getElementById('user-dropdown-menu');
const userMenuArrow = document.getElementById('user-menu-arrow');

const LG_BREAKPOINT = 1024;

if (mobileMenuBtn && sidebar && sidebarOverlay && mainContentWrapper && mainHeader && mainFooter &&
    userMenuButton && userDropdownMenu && userMenuArrow) {

    const openSidebar = () => {
        sidebar.classList.remove('-translate-x-full');
        sidebarOverlay.classList.remove('hidden');

        if (window.innerWidth >= LG_BREAKPOINT) {
            mainContentWrapper.classList.add('lg:ml-72');
            mainHeader.classList.add('lg:left-72', 'lg:w-[calc(100%-18rem)]');
            mainFooter.classList.add('lg:left-72', 'lg:w-[calc(100%-18rem)]');
        }
        closeUserDropdown();
    };

    const closeSidebar = () => {
        sidebar.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('hidden');

        mainContentWrapper.classList.remove('lg:ml-72');
        mainHeader.classList.remove('lg:left-72', 'lg:w-[calc(100%-18rem)]');
        mainFooter.classList.remove('lg:left-72', 'lg:w-[calc(100%-18rem)]');
    };

    mobileMenuBtn.addEventListener('click', () => {
        if (sidebar.classList.contains('-translate-x-full')) {
            openSidebar();
        } else {
            closeSidebar();
        }
    });

    sidebarOverlay.addEventListener('click', closeSidebar);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeSidebar();
            closeUserDropdown();
        }
    });

    const checkSidebarVisibility = () => {
        if (window.innerWidth >= LG_BREAKPOINT) {
            openSidebar();
        } else {
            closeSidebar();
        }
    };

    document.addEventListener('DOMContentLoaded', checkSidebarVisibility);
    window.addEventListener('resize', checkSidebarVisibility);

    const showUserDropdown = () => {
        userDropdownMenu.classList.remove('hidden');
        setTimeout(() => {
            userDropdownMenu.classList.remove('scale-95', 'opacity-0');
            userDropdownMenu.classList.add('scale-100', 'opacity-100');
            userMenuArrow.classList.add('rotate-180');
        }, 10);
    };

    const closeUserDropdown = () => {
        userDropdownMenu.classList.remove('scale-100', 'opacity-100');
        userDropdownMenu.classList.add('scale-95', 'opacity-0');
        userMenuArrow.classList.remove('rotate-180');
        setTimeout(() => {
            userDropdownMenu.classList.add('hidden');
        }, 200);
    };

    userMenuButton.addEventListener('click', (event) => {
        event.stopPropagation();
        if (userDropdownMenu.classList.contains('hidden')) {
            showUserDropdown();
        } else {
            closeUserDropdown();
        }
    });

    window.addEventListener('click', (event) => {
        if (!userMenuButton.contains(event.target) && !userDropdownMenu.contains(event.target)) {
            closeUserDropdown();
        }
    });

} else {
    console.error("One or more required elements for sidebar or dropdown not found!");
}
