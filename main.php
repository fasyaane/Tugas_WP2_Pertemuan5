<?php

class Buku
{
    private $judul;
    private $pengarang;
    private $tahunPublikasi;
    private $dipinjam;

    public function __construct($judul, $pengarang, $tahunPublikasi)
    {
        $this->judul = $judul;
        $this->pengarang = $pengarang;
        $this->tahunPublikasi = $tahunPublikasi;
        $this->dipinjam = false;
    }

    public function getJudul()
    {
        return $this->judul;
    }

    public function getPengarang()
    {
        return $this->pengarang;
    }

    public function getTahunPublikasi()
    {
        return $this->tahunPublikasi;
    }

    public function dipinjam()
    {
        return $this->dipinjam;
    }

    public function pinjamBuku()
    {
        $this->dipinjam = true;
    }

    public function kembalikanBuku()
    {
        $this->dipinjam = false;
    }
}

class Perpustakaan
{
    private $listBuku = [];

    public function tambahBuku(Buku $buku)
    {
        $this->listBuku[] = $buku;
    }

    public function pinjamBuku($judul)
    {
        foreach ($this->listBuku as $book) {
            if ($book->getJudul() == $judul && !$book->dipinjam()) {
                $book->pinjamBuku();
                echo "Buku \"$judul\" berhasil dipinjam.\n";
                return;
            }
        }
        echo "Buku \"$judul\" tidak tersedia untuk dipinjam.\n";
    }

    public function kembalikanBuku($judul)
    {
        foreach ($this->listBuku as $buku) {
            if ($buku->getJudul() == $judul && $buku->dipinjam()) {
                $buku->kembalikanBuku();
                echo "Buku \"$judul\" berhasil dikembalikan.\n";
                return;
            }
        }
        echo "Buku \"$judul\" tidak dapat dikembalikan karena belum dipinjam.\n";
    }

    public function listBukuYangAda()
    {
        echo "Daftar Buku yang Tersedia:\n";
        $counter = 1;
        foreach ($this->listBuku as $buku) {
            if (!$buku->dipinjam()) {
                echo "$counter. {$buku->getJudul()} ({$buku->getPengarang()} - {$buku->getTahunPublikasi()})\n";
                $counter++;
            }
        }
    }
}

$buku1 = new Buku("Laskar Pelangi", "Andrea Hirata", 2005);
$buku2 = new Buku("Ayat-Ayat Cinta", "Habiburrahman El Shirazy", 2004);
$buku3 = new Buku("Negeri 5 Menara", "Ahmad Fuadi", 2009);
$buku4 = new Buku("Bumi Manusia", "Pramoedya Ananta Toer", 1980);
$buku5 = new Buku("Tenggelamnya Kapal Van Der Wijck", "Hamka", 1939);
$buku6 = new Buku("Sang Pemimpi", "Andrea Hirata", 2006);
$buku7 = new Buku("Perahu Kertas", "Dee Lestari", 2009);
$buku8 = new Buku("Laut Bercerita", "Leila S. Chudori", 2012);
$buku9 = new Buku("Supernova: Ksatria, Puteri, dan Bintang Jatuh", "Dee Lestari", 2001);
$buku10 = new Buku("Tentang Kamu", "Tere Liye", 2013);


$library = new Perpustakaan();
$library->tambahBuku($buku1);
$library->tambahBuku($buku2);
$library->tambahBuku($buku3);
$library->tambahBuku($buku4);
$library->tambahBuku($buku5);
$library->tambahBuku($buku6);
$library->tambahBuku($buku7);
$library->tambahBuku($buku8);
$library->tambahBuku($buku9);
$library->tambahBuku($buku10);

$library->listBukuYangAda();
echo "\n";
echo str_repeat('-', 70) . "\n";
$library->pinjamBuku("Laskar Pelangi");
$library->pinjamBuku("Bumi Manusia");
$library->pinjamBuku("Bumi Manusia");
echo str_repeat('-', 70) . "\n";
echo "\n";
$library->listBukuYangAda();
echo "\n";
echo str_repeat('-', 70) . "\n";
$library->kembalikanBuku("Bumi Manusia");
echo str_repeat('-', 70) . "\n";
echo "\n";
$library->listBukuYangAda();
echo "\n";
?>
