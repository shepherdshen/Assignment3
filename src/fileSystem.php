<?php
class fileSystem{
    /**
     * uploads picture file and return case
     * @param $file
     * @param $filePath
     * @return string
     */
    public function upload($file, $filePath) {
        $error = $file['error'];
        switch ($error) {
            case 0:
                $fileName = $file['name'];
                $fileTemp = $file['tmp_name'];
                $destination = $filePath . "/" . $fileName;
                move_uploaded_file($fileTemp, $destination);
                return "upload complete";
            case 1:
                return "picture error: The file is too large for server";
            case 2:
                return "picture error: The file is too large in the form";
            case 3:
                return "picture error: The file is only partially uploaded";
            case 4:
                return "no upload";
        }
    }
}
?>