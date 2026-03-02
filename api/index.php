<?php
/**
 * Vercel Entry Point
 * 
 * File ini bertindak sebagai jembatan agar Vercel bisa menjalankan index.php 
 * yang berada di root folder.
 */

// Sertakan file index.php utama
require __DIR__ . '/../index.php';
