(() => {
    const toggleMainMenu = (e) => {
        e.preventDefault();

        if(e.currentTarget.closest('.header').classList.contains('menu-open')){
            e.currentTarget.closest('.header').classList.remove('menu-open');
        }else{
            e.currentTarget.closest('.header').classList.add('menu-open');
        }
    }

    document.querySelectorAll('.header-menu-toggle').forEach((element) => {
        element.addEventListener('click', toggleMainMenu);
    });

    // document.querySelectorAll('.header').forEach((header) => {
    //     let lastScrollPosition = 0;

    //     const fixHeader = (header) => {
    //         const bodyOffset = document.body.getBoundingClientRect().top + Math.round(window.scrollY);
    //         const currentScrollPosition = Math.round(window.scrollY);
    //         let headerStart = header.parentNode.getBoundingClientRect().top;
    //         if(header.previousElementSibling){
    //             headerStart = header.previousElementSibling.getBoundingClientRect().top + header.previousElementSibling.offsetHeight;
    //         }
    //         const basePosition = headerStart + Math.round(window.scrollY) - bodyOffset;

    //         if(currentScrollPosition >= basePosition && currentScrollPosition >= 0){
    //             header.classList.add('scrolled');
    //         }else{
    //             header.classList.remove('scrolled');
    //         }

    //         if(currentScrollPosition < lastScrollPosition && currentScrollPosition > 0){
    //             header.classList.add('scrolling-up');
    //         }else{
    //             header.classList.remove('scrolling-up');
    //         }

    //         lastScrollPosition = currentScrollPosition;
    //         document.documentElement.style.setProperty('--header-offset', basePosition + 'px');
    //         document.documentElement.style.setProperty('--fixed-header-height', header.offsetHeight + 'px');
    //     }

    //     const headerHeight = (header) => {
    //         let reopen = false;

    //         if(header.classList.contains('menu-open')){
    //             header.classList.remove('menu-open');
    //             reopen = true;
    //         }
            
    //         document.documentElement.style.setProperty('--header-height', header.offsetHeight + 'px');
    //         document.documentElement.style.setProperty('--fixed-header-height', header.offsetHeight + 'px');

    //         if(reopen){
    //             header.classList.add('menu-open');
    //         }
    //     }

    //     headerHeight(header);
    //     fixHeader(header);

    //     document.addEventListener('scroll', () => {
    //         fixHeader(header);
    //     });

    //     window.addEventListener('resize', () => {
    //         headerHeight(header);
    //         fixHeader(header);
    //     });
    // });

    document.querySelectorAll('.header-main-menu a[href="#"]').forEach((link) => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            if(event.currentTarget.parentNode.classList.contains('menu-item-has-children')){
                event.currentTarget.parentNode.querySelector('.sub-menu-toggle').click();
            }
        });
    });

    document.querySelectorAll('.sub-menu-toggle').forEach((button) => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            event.currentTarget.parentNode.classList.toggle('sub-menu-open');
        });
    });

    const resetHeaderSearch = (e) => {
        e.preventDefault();

        e.currentTarget.closest('.header').querySelector('.header-search-form input').value = '';
    }

    const toggleHeaderSearch = (e) => {
        e.preventDefault();

        if(e.currentTarget.closest('.header').classList.contains('search-open')){
            e.currentTarget.closest('.header').classList.remove('search-open');
        }else{
            e.currentTarget.closest('.header').classList.add('search-open');
            e.currentTarget.closest('.header').querySelector('.header-search-form input').focus();
        }
    }

    document.querySelectorAll('.header-search-toggle').forEach((element) => {
        element.addEventListener('click', toggleHeaderSearch);
    });

    document.querySelectorAll('.header-search-form-close').forEach((element) => {
        element.addEventListener('click', resetHeaderSearch);
        element.addEventListener('click', toggleHeaderSearch);
    });

    document.querySelectorAll('.pre-header a[href^="#"]:not(.ignore)').forEach((element) => {
        element.addEventListener('click', (event) =>  {
            const link = event.target.closest('a');
            const target = link.getAttribute('href');
            if(document.querySelector(target)){
                event.preventDefault();

                const admin_bar_height = document.querySelector('#wpadminbar')?.offsetHeight || 0;
                const fixed_header_height = parseInt(document.documentElement.style.getPropertyValue('--fixed-header-height'));
                const margin_offset = 60;
                const target_position = document.querySelectorAll(target)[0].getBoundingClientRect().top + window.scrollY - fixed_header_height - admin_bar_height - margin_offset;

                window.scrollTo({
                    top: target_position,
                    behavior: "smooth",
                });
            }            
        });
    });
})();