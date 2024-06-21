package collage.sekolah.service;

import collage.sekolah.entity.Siswa;
import java.util.List;

public interface SiswaService {
    Siswa createSiswa(Siswa siswa);

    Siswa getSiswaById(Long id);

    List<Siswa> getAllSiswa();

    Siswa updateSiswa(Siswa siswa);

    void deleteSiswa(Long id);
}
