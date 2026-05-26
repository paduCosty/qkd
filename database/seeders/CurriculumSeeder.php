<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Grade;
use App\Models\Technique;
use Illuminate\Database\Seeder;

class CurriculumSeeder extends Seeder
{
    public function run(): void
    {
        $this->grade0();
        $this->grade1();
        $this->grade2();
        $this->grade3();
    }

    // ── Helpers ──────────────────────────────────────────────────────────────

    private function grade(string $name, int $order): Grade
    {
        return Grade::firstOrCreate(['name' => $name], ['order' => $order]);
    }

    private function category(Grade $grade, string $nameViet, string $nameRo, int $order): Category
    {
        return Category::firstOrCreate(
            ['grade_id' => $grade->id, 'name_viet' => $nameViet],
            ['name_ro' => $nameRo, 'order' => $order]
        );
    }

    private function techs(Category $cat, array $list, string $type = 'simple'): void
    {
        foreach ($list as $i => [$viet, $ro]) {
            Technique::firstOrCreate(
                ['category_id' => $cat->id, 'name_viet' => $viet],
                ['name_ro' => $ro, 'type' => $type, 'order' => $i]
            );
        }
    }

    // ── 0 Câp — Începător ───────────────────────────────────────────────────

    private function grade0(): void
    {
        $g = $this->grade('0 Câp — Începător', 0);

        $boPhap = $this->category($g, 'BO PHAP', 'Poziții', 0);
        $this->techs($boPhap, [
            ['LAP TAN',           'Poziția în picioare cu picioarele apropiate'],
            ['CHUAN BI',          'Poziția de așteptare'],
            ['HAC TAN',           'Poziția cocorului'],
            ['DOC HANH VU TAN',   'Poziția călătorului singuratic'],
            ['TRUNG BINH TAN',    'Poziția cavalerului de fier'],
            ['AM DUONG TAN',      'Poziția polarităților (negativ — pozitiv)'],
            ['LIEN HOA TAN',      'Poziția florii de lotus'],
            ['NHI TAN TAA',       'Poziția literei NHI — privirea spre stânga'],
            ['NHI TAN HUU',       'Poziția literei NHI — privirea spre dreapta'],
            ['TIEU TAN',          'Mica poziție'],
            ['XA TAN',            'Poziția șarpelui'],
            ['BAT CUOC TAN',      'Poziția cameleonului (8 lovituri de picior)'],
            ['DINH TAN TIEN',     'Corpul înfipt în sol — spre înainte'],
            ['DINH TAN HAU',      'Corpul înfipt în sol — spre înapoi'],
        ]);

        $thanPhap = $this->category($g, 'THAN PHAP', 'Deplasări', 1);
        $this->techs($thanPhap, [
            ['XA HANH',           'Deplasarea șarpelui'],
            ['DAO THAN',          'Deplasarea în U / eschiva corpului'],
            ['DI ANH',            'Inversarea imaginii / transferul bustului'],
            ['SAU QUAY',          'Întoarcere cu piciorul din spate simetric'],
            ['QUAY',              'Întoarcere retragând piciorul din față'],
            ['DOI BO',            'Întoarcere la 90° pe înaintare'],
            ['THOI THAN',         'Retragerea bustului (întoarcere 180°)'],
            ['DI THAN',           'Rotația bustului / deplasare alunecătoare'],
            ['CHUYEN THAN',       'Deplasarea bețivului'],
            ['THIEM THU QUA HAI', 'Broasca ce trece marea'],
        ]);

        $boCongThu = $this->category($g, 'BO CONG THU', 'Blocaje', 2);
        $this->techs($boCongThu, [
            ['BAN HA HOANH CONG',     'Puternica rotație a masei la sol'],
            ['THOI SON KIM BAO',      'Laba panterei galbene în acțiune'],
            ['LA HAN PHAN QUYEN',     'Brațul pliat al Arhatului Budist'],
            ['CUONG DAO KHAI MON',    'Sabia mâinii care deschide o ușă'],
            ['PHUONG DUC BAT HO',     'Aripa păsării Phoenix degajează tigrul'],
            ['THAN THONG THUONG QUYEN','Geniul înțelepciunii ridică cartea'],
            ['LOI CONG HA QUYEN',     'Zeul fulgerelor lovește cu masa sa'],
            ['THOI SON THUY DE',      'Pumnul care tulbură apa glacială'],
            ['CUONG DAO KHAI VI',     'Sabia mâinii curăță crengile copacului'],
        ]);

        $docLuyen = $this->category($g, 'DOC LUYEN', 'Înlănțuiri solo', 3);
        $this->techs($docLuyen, [
            ['BO PHAP DOC LUYEN',      'Înlănțuire fără brațe'],
            ['BO LINH DOC LUYEN',      'Înlănțuire de bază'],
            ['BO PHAP NHAP MON - MOT', 'Înlănțuire de intrare — Primul'],
            ['DANG MON DOC LUYEN',     'Înlănțuire la poartă'],
        ], 'form');
    }

    // ── 1 Câp ───────────────────────────────────────────────────────────────

    private function grade1(): void
    {
        $g = $this->grade('1 Câp', 1);

        $thanPhap = $this->category($g, 'THAN PHAP', 'Deplasări', 0);
        $this->techs($thanPhap, [
            ['PHI TAU MA',           'Galopul calului'],
            ['PHI DANG THANG THIEN', 'Săritura cu picioarele apropiate'],
            ['HOANH THAN',           'Pivotarea bustului la 180° prin săritură'],
        ]);

        $boCongThu = $this->category($g, 'BO CONG THU', 'Blocaje', 1);
        $this->techs($boCongThu, [
            ['THOI SON THUONG THUAN', 'Pumnul care ridică scutul'],
            ['AM DUONG DAO',          'Cuong dao tram xa + cuong dao khai vi'],
        ]);

        $docLuyen = $this->category($g, 'DOC LUYEN', 'Înlănțuiri solo', 2);
        $this->techs($docLuyen, [
            ['BO PHAP DOC LUYEN',  'Înlănțuire cu brațe'],
            ['BO THOI SON - MOT',  'Înlănțuire cu pumnul — Primul'],
            ['THU PHAP DOC LUYEN', 'Înlănțuire de tehnici de braț'],
        ], 'form');

        $khoaGo = $this->category($g, 'KHOA GO', 'Eliberări', 3);
        $this->techs($khoaGo, [
            ['KHOA GO FIXE — nr. 4',  'Eliberare fixă nr. 4'],
            ['KHOA GO FIXE — nr. 5',  'Eliberare fixă nr. 5'],
            ['KHOA GO MOBILE — nr. 1', 'Eliberare mobilă nr. 1'],
        ]);
    }

    // ── 2 Câp ───────────────────────────────────────────────────────────────

    private function grade2(): void
    {
        $g = $this->grade('2 Câp', 2);

        $docLuyen = $this->category($g, 'DOC LUYEN', 'Înlănțuiri solo', 0);
        $this->techs($docLuyen, [
            ['BO CUONG DAO',           'Înlănțuire de tehnici cu sabia mâinii'],
            ['BO PHUONG DUC',          'Înlănțuire de tehnici de cot'],
            ['BO PHAP NHAP MON - HAI', 'Înlănțuire de intrare — Al doilea'],
        ], 'form');

        $khoaGo = $this->category($g, 'KHOA GO', 'Eliberări', 1);
        $this->techs($khoaGo, [
            ['KHOA GO FIXE — nr. 1',    'Eliberare fixă nr. 1'],
            ['KHOA GO FIXE — nr. 2',    'Eliberare fixă nr. 2'],
            ['KHOA GO FIXE — nr. 3',    'Eliberare fixă nr. 3'],
            ['KHOA GO MOBILE — nr. 2, 3', 'Eliberări mobile nr. 2 și 3'],
        ]);

        $camNa = $this->category($g, 'CAM NA', 'Imobilizări', 2);
        $this->techs($camNa, [
            ['CAM NA — nr. 1', 'Imobilizare nr. 1'],
            ['CAM NA — nr. 2', 'Imobilizare nr. 2'],
            ['CAM NA — nr. 3', 'Imobilizare nr. 3'],
            ['CAM NA — nr. 4', 'Imobilizare nr. 4'],
            ['CAM NA — nr. 5', 'Imobilizare nr. 5'],
        ]);

        $nhatThu = $this->category($g, 'NHAT THU NHAT CONG', 'Un atac — o apărare', 3);
        $this->techs($nhatThu, [
            ['NHAT THU NHAT CONG — MOT', 'Un atac, o apărare — Primul'],
            ['NHAT THU NHAT CONG — HAI', 'Un atac, o apărare — Al doilea'],
            ['NHAT THU NHAT CONG — BA',  'Un atac, o apărare — Al treilea'],
        ]);

        $boPhap2 = $this->category($g, 'BO PHAP CUOC', 'Tehnici de picior', 4);
        $this->techs($boPhap2, [
            ['TIEN CUOC',        'Lovitura frontală cu piciorul'],
            ['HOANH CUOC',       'Lovitura laterală cu piciorul'],
            ['AU CUOC',          'Lovitura întoarsă cu tocul'],
            ['THAP CUOC',        'Lovitura descendentă cu piciorul'],
            ['NGOAI VONG CUOC',  'Lovitura circulară exterioară cu piciorul'],
            ['NOI VONG CUOC',    'Lovitura circulară interioară cu piciorul'],
        ]);
    }

    // ── 3 Câp ───────────────────────────────────────────────────────────────

    private function grade3(): void
    {
        $g = $this->grade('3 Câp', 3);

        $giao = $this->category($g, 'GIAO LONG CUOC', 'Combinații de lovituri de picior', 0);
        $this->techs($giao, [
            ['GIAO LONG CUOC — MOT', 'Combinație de lovituri de picior — Prima'],
            ['GIAO LONG CUOC — HAI', 'Combinație de lovituri de picior — A doua'],
            ['GIAO LONG CUOC — BA',  'Combinație de lovituri de picior — A treia'],
        ]);

        $lienThu = $this->category($g, 'LIEN THU LIEN CONG', 'Lanț de atacuri și apărări', 1);
        $this->techs($lienThu, [
            ['LIEN THU LIEN CONG — MOT', 'Lanț de atacuri și apărări — Primul'],
            ['LIEN THU LIEN CONG — HAI', 'Lanț de atacuri și apărări — Al doilea'],
            ['LIEN THU LIEN CONG — BA',  'Lanț de atacuri și apărări — Al treilea'],
            ['LIEN THU LIEN CONG — BON', 'Lanț de atacuri și apărări — Al patrulea'],
        ]);

        $quatVat = $this->category($g, 'QUAT / VAT', 'Proiecții', 2);
        $this->techs($quatVat, [
            ['QUAT CHAN',         'Proiecție cu secera piciorului'],
            ['VAT CUONG DAO',     'Proiecție cu sabia mâinii'],
            ['QUAT HAU CHAN',     'Proiecție cu secera din spate'],
            ['VAT TAM GIAC',     'Proiecție triunghiulară cu picioarele'],
            ['QUAT THUONG CUOC', 'Proiecție cu piciorul ridicat'],
        ]);

        $camNaAv = $this->category($g, 'CAM NA AVANSAT', 'Imobilizări avansate', 3);
        $this->techs($camNaAv, [
            ['CAM NA — nr. 6',  'Imobilizare nr. 6'],
            ['CAM NA — nr. 7',  'Imobilizare nr. 7'],
            ['CAM NA — nr. 8',  'Imobilizare nr. 8'],
            ['CAM NA — nr. 9',  'Imobilizare nr. 9'],
            ['CAM NA — nr. 10', 'Imobilizare nr. 10'],
        ]);

        $khoaGo3 = $this->category($g, 'KHOA GO AVANSAT', 'Eliberări avansate', 4);
        $this->techs($khoaGo3, [
            ['KHOA GO FIXE — nr. 6',    'Eliberare fixă nr. 6'],
            ['KHOA GO FIXE — nr. 7',    'Eliberare fixă nr. 7'],
            ['KHOA GO MOBILE — nr. 4',  'Eliberare mobilă nr. 4'],
            ['KHOA GO MOBILE — nr. 5',  'Eliberare mobilă nr. 5'],
        ]);

        $docLuyen3 = $this->category($g, 'DOC LUYEN', 'Înlănțuiri solo', 5);
        $this->techs($docLuyen3, [
            ['BO CUOC DOC LUYEN',      'Înlănțuire de tehnici de picior'],
            ['BO PHAP NHAP MON - BA',  'Înlănțuire de intrare — Al treilea'],
            ['TOAN BO DOC LUYEN',      'Înlănțuire completă'],
        ], 'form');
    }
}
