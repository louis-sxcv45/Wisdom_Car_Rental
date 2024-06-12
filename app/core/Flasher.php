<?php 

class Flasher {
    public static function setFlash($aksi, $tipe)
    {
        $_SESSION['flash'] = [
            'aksi'  => $aksi,
            'tipe'  => $tipe
        ];
    }

    public static function flash()
    {
        if( isset($_SESSION['flash']) ) {
            echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible" role="alert">
                    Maaf anda memasukkan ' . $_SESSION['flash']['aksi'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            unset($_SESSION['flash']);
        }
    }
    public static function flashprofile()
    {
        if( isset($_SESSION['flash']) ) {
            echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible" role="alert">
                    Maaf anda gagal memasukkan ' . $_SESSION['flash']['aksi'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            unset($_SESSION['flash']);
        }
    }
    public static function flashapus()
    {
        if (isset($_SESSION['flash'])) {
            if ($_SESSION['flash']['aksi'] === 'berhasil-dihapus') {
                echo '<div class="alert alert-warning alert-dismissible" role="alert">
                        Berhasil Dihapus.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                unset($_SESSION['flash']);
            }
        }
    }
    public static function flastambah()
    {
        if( isset($_SESSION['flash']) ) {
            echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible" role="alert">
                        Produk '. $_SESSION['flash']['aksi'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            unset($_SESSION['flash']);
        }
    }

    public static function flashProfileIncomplete()
    {
        if (isset($_SESSION['flash'])) {
            if ($_SESSION['flash']['aksi'] === 'lengkapi-profile') {
                echo '<div class="alert alert-warning alert-dismissible" role="alert">
                        Lengkapi profile Anda sebelum melanjutkan.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                unset($_SESSION['flash']);
            }
        }
    }
}