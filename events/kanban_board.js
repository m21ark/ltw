function dragItem() {
    const items = document.querySelectorAll('.kanban__item-input');

    
    items.forEach( element => {

        element.addEventListener("dragstart", function(ev) {
            console.log("eeeee")
            //element.dataTransfer = element.originalEvent.dataTransfer;
            ev.dataTransfer.setData("text/plain", element.getAttribute('data-id'));
        });

        element.addEventListener("drop", function(ev) {
            console.log("ekokokoke")
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
            console.log("hregepplplg")
    
        });
    
        element.addEventListener("dragleave", () => {
            element.classList.remove("kanban__dropzone--active");
            console.log("hregekookog")
            
        });
    
        element.addEventListener("drop", e => {
            console.log("hregeg")
    
            e.preventDefault();
            element.classList.remove("kanban__dropzone--active");
     
            const columnElement = element.closest(".kanban__column");
            const columnId = Number(columnElement.dataset.id);
            const dropZonesInColumn = Array.from(columnElement.querySelectorAll(".kanban__dropzone"));
            const droppedIndex = dropZonesInColumn.indexOf(element);
            const itemId = Number(e.dataTransfer.getData("text/plain"));
            const droppedItemElement = document.querySelector(`[data-id="${itemId}"]`);
            const insertAfter = element.parentElement.classList.contains("kanban__item") ? element.parentElement : element;
     
            if (droppedItemElement.contains(element)) {
                return;
            }
            console.log(insertAfter)

            insertAfter.after(droppedItemElement);
            
        });
    });
    
}

createDropZone();
dragItem();
