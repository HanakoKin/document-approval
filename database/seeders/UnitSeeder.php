<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $data = [
            ['nama' => 'ADM KEUANGAN'],
            ['nama' => 'ADM PASIEN'],
            ['nama' => 'ADMISSION'],
            ['nama' => 'AKREDITASI'],
            ['nama' => 'AKUNTING'],
            ['nama' => 'BENDAHARA'],
            ['nama' => 'BRONCHOSCOPY'],
            ['nama' => 'BUILDING MAINTENANCE'],
            ['nama' => 'CASEMIX'],
            ['nama' => 'CATH LAB'],
            ['nama' => 'CSSD'],
            ['nama' => 'EEG EMG'],
            ['nama' => 'ENDOSCOPY'],
            ['nama' => 'FARMASI'],
            ['nama' => 'FISIOTERAPI'],
            ['nama' => 'GIZI MEDIK'],
            ['nama' => 'GIZI PRODUKSI'],
            ['nama' => 'GRAHA UTAMA LT V'],
            ['nama' => 'GRAHA UTAMA LT VI'],
            ['nama' => 'HEMODIALISA'],
            ['nama' => 'HUBUNGAN MASYARAKAT'],
            ['nama' => 'KAMAR OPERASI'],
            ['nama' => 'KAS DOKTER'],
            ['nama' => 'KASIR'],
            ['nama' => 'KEPERAWATAN'],
            ['nama' => 'KESEHATAN LINGKUNGAN'],
            ['nama' => 'KESELAMATAN PASIEN'],
            ['nama' => 'KEUANGAN BENDAHARA'],
            ['nama' => 'KLINIK SPESIALIS'],
            ['nama' => 'KPBA'],
            ['nama' => 'LABORATORIUM'],
            ['nama' => 'LAUNDRY'],
            ['nama' => 'LEGAL'],
            ['nama' => 'LOGISTIK'],
            ['nama' => 'MEDICAL CHECKUP'],
            ['nama' => 'MOD'],
            ['nama' => 'NOSOKOMIAL'],
            ['nama' => 'PATOLOGI'],
            ['nama' => 'PAV ICCU'],
            ['nama' => 'PAV ICU'],
            ['nama' => 'PAV ANGGREK'],
            ['nama' => 'PAV CEMPAKA'],
            ['nama' => 'PAV DIABETES TERPADU'],
            ['nama' => 'PAV GLADIOLA'],
            ['nama' => 'PAV ICU ANAK'],
            ['nama' => 'PAV LANTAI HATI'],
            ['nama' => 'PAV LANTAI JANTUNG'],
            ['nama' => 'PAV LANTAI STROKE'],
            ['nama' => 'PAV MAWAR'],
            ['nama' => 'PAV MELATI'],
            ['nama' => 'PAV NUSA INDAH'],
            ['nama' => 'PAV PUTRA I'],
            ['nama' => 'PAV PUTRA III'],
            ['nama' => 'PAV TERATAI'],
            ['nama' => 'PEMASARAN'],
            ['nama' => 'PEMBELIAN FARMASI'],
            ['nama' => 'PENAGIHAN'],
            ['nama' => 'PERINA'],
            ['nama' => 'PERSONALIA'],
            ['nama' => 'PMI'],
            ['nama' => 'POKJA KEPERAWATAN'],
            ['nama' => 'RADIOLOGI'],
            ['nama' => 'REKAM MEDIS'],
            ['nama' => 'SAT PENGAWAS INTERN'],
            ['nama' => 'SATUAN PENGAMANAN'],
            ['nama' => 'SDM KEPERAWATAN'],
            ['nama' => 'SEKRETARIAT DIREKSI'],
            ['nama' => 'SENTRAL TELEPHONE'],
            ['nama' => 'SOKA ISOLASI'],
            ['nama' => 'TEKNIK SIPIL'],
            ['nama' => 'TEKNIK UMUM'],
            ['nama' => 'TI'],
            ['nama' => 'TREADMILL'],
            ['nama' => 'ULTRASONOGRAFI'],
            ['nama' => 'UNIT GAWAT DARURAT'],
            ['nama' => 'UNIT RAWAT JALAN'],
            ['nama' => 'UNIT STROKE'],
            ['nama' => 'VK GRAHA 5'],
        ];

        Unit::insert($data);
    }
}
