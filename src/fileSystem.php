<?php
function upload($file, $filePath) {
    $error = $file['error'];
    switch ($error) {
        case 0:
            $fileName = $file['name'];
            $fileTemp = $file['tmp_name'];
            $destination = $filePath . "/" . $fileName;
            move_uploaded_file($fileTemp, $destination);
            return "�ϴ��ɹ�";
        case 1:
            return "�ϴ�����upload_max_filesize";
        case 2:
            return "�ϴ��ļ�����form��MAX_FILE_SIZE";
        case 3:
            return "���������ϴ�";
        case 4:
            return "û���ϴ�";
    }
}
?>