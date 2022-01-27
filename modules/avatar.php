<?php
function getAvatarFileByIndex(int $index): string {
    $FNAME = [
        'avt-1.jpg',
        'avt-2.jpg',
        'avt-3.jpg',
        'avt-4.jpg',
        'avt-5.jpg',
        'avt-6.jpg',
        'avt-7.jpg',
        'avt-8.jpg',
        'avt-9.jpeg',
        'avt-10.jpg',
        'avt-11.jpg',
        'avt-1.jpg'
    ];
    $name = $FNAME[$index];
    if($name){
        return $name;
    }
    throw new Exception('Avatar Tidak Ditemukan', 1);
}
?>