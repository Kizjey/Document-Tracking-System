document.addEventListener("DOMContentLoaded", function() {
    const destinationContainer = document.getElementById("destination_container");
    const addDestinationButton = document.getElementById("add_destination");

    let destinationCount = 0;

    addDestinationButton.addEventListener("click", function() {
        destinationCount++;

        const destinationName = "destination" + destinationCount;
        const label = document.createElement("label");
        label.textContent = "Choose Another Destination";

        const select = document.createElement("select");
        select.name = destinationName;
        
        const defaultOption = document.createElement("option");
        defaultOption.value = "";
        defaultOption.textContent = "Select an option";
        select.appendChild(defaultOption);

        <?php
        foreach ($intermediateDestinations as $option) {
            echo 'const option = document.createElement("option");';
            echo 'option.value = "' . $option . '";';
            echo 'option.textContent = "' . $option . '";';
            echo 'select.appendChild(option);';
        }
        ?>

        const description = document.createElement("div");
        description.className = "field_description";
        description.textContent = "Select the " + destinationName + " intermediate destination.";

        destinationContainer.appendChild(label);
        destinationContainer.appendChild(select);
        destinationContainer.appendChild(description);
    });
});
