<?php
/**
 * Vercel Entry Point
 * 
 * File ini bertindak sebagai jembatan agar Vercel bisa menjalankan index.php 
 * yang berada di root folder.
 */

// Berpindah ke folder utama agar require relative tetap bekerja
chdir(__DIR__ . '/..');

// Sertakan file index.php utama
require 'index.php';
