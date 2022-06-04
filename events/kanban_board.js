function dragItem() {
    const items = document.querySelectorAll('.kanban__item-input');


    items.forEach(element => {

        element.addEventListener("dragstart", function (ev) {
            
            ev.dataTransfer.setData("text/plain", element.getAttribute('data-id'));
        });

        element.addEventListener("drop", function (ev) {
            ev.preventDefault();
        });

    });

}


function createDropZone() {
    const range = document.createRange();

    range.selectNode(document.body);

    const dropZone = document.querySelectorAll('.kanban__dropzone');

    dropZone.forEach(element => {
        element.addEventListener("dragover", e => {
            e.preventDefault();
            element.classList.add("kanban__dropzone--active");

        });

        element.addEventListener("dragleave", () => {
            element.classList.remove("kanban__dropzone--active");
        });

        element.addEventListener("drop", e => {

            e.preventDefault();
            element.classList.remove("kanban__dropzone--active");

            const columnElement = element.closest(".kanban__column");
            const columnId = Number(columnElement.dataset.id); 
      
 
            const itemId = Number(e.dataTransfer.getData("text/plain"));
            const droppedItemElement = document.querySelector(`[data-id="${itemId}"]`);
            const insertAfter = element.parentElement.classList.contains("kanban__item") ? element.parentElement : element;

            if (droppedItemElement.contains(element)) {
                return;
            }

            insertAfter.after(droppedItemElement);

            fetch(`../apis/api_order.php?id=${itemId}&st=${columnId}`, {
                method: "PUT"
            })
            .then(function(res) {
                return ;
            })
        });
    });

}

createDropZone();
dragItem();
