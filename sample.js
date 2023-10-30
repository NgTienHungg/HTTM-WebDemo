function toggleEditing() {

    var audioNameInput = document.getElementById("audio-name");
    var audioPathInput = document.getElementById("audio-path");
    var transcriptNameInput = document.getElementById("transcript-name");
    var transcriptContentInput = document.getElementById("transcript-content");
    var editButton = document.getElementById("edit-button");

    if (audioNameInput.hasAttribute("readonly")) {
        event.preventDefault(); 
        // Bật chế độ chỉnh sửa.
        audioNameInput.removeAttribute("readonly");
        audioPathInput.removeAttribute("readonly");
        transcriptNameInput.removeAttribute("readonly");
        transcriptContentInput.removeAttribute("readonly");
        editButton.textContent = "Lưu";
        editButton.style.backgroundColor = "#00ff00"; // Màu xanh lục.
    } else {
        // Lưu các thay đổi khi người dùng bấm "Lưu."
        var updatedAudioName = audioNameInput.value;
        var updatedAudioPath = audioPathInput.value;
        var updatedTranscriptName = transcriptNameInput.value;
        var updatedTranscriptContent = transcriptContentInput.value;

        // Thực hiện lưu các thay đổi vào cơ sở dữ liệu (bạn cần viết mã PHP cho điều này).


        // Khóa lại các input sau khi đã lưu.
        audioNameInput.setAttribute("readonly", "readonly");
        audioPathInput.setAttribute("readonly", "readonly");
        transcriptNameInput.setAttribute("readonly", "readonly");
        transcriptContentInput.setAttribute("readonly", "readonly");
        editButton.textContent = "Sửa";
        editButton.style.backgroundColor = "#ffff00"; // Màu vàng.
    }
}