function initFilterDropdowns(){

    document.querySelectorAll(".filter-dropdown").forEach(dropdown=>{

        const button = dropdown.querySelector(".filter-toggle");
        const menu = dropdown.querySelector(".filter-menu");

        button.addEventListener("click",function(e){

            e.stopPropagation();

            document.querySelectorAll(".filter-menu").forEach(item=>{

                if(item !== menu){
                    item.classList.remove("show");
                }

            });

            menu.classList.toggle("show");

        });

    });

    document.addEventListener("click",()=>{

        document.querySelectorAll(".filter-menu").forEach(menu=>{

            menu.classList.remove("show");

        });

    });

}